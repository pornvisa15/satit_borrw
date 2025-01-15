<?php
// เชื่อมต่อฐานข้อมูล
include '../mysql_borrow.php';
session_start();

// Debugging: Print the POST data to ensure it is being received
// var_dump($_POST);  // เพิ่มบรรทัดนี้เพื่อการดีบัก

// รับค่าจากฟอร์ม
$finance_Id = $_POST['finance_Id'] ?? null;  // ใช้ finance_Id ในการอัปเดตข้อมูล
$useripass = $_POST['useripass'] ?? null;  // รับค่าจากฟอร์มที่เลือก useripass
$officer_Cotton = $_POST['officer_Cotton'] ?? null;  
$device_Access = $_POST['device_Access'] ?? null;

// ตรวจสอบการเชื่อมต่อฐานข้อมูล
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// ตรวจสอบไฟล์ที่อัปโหลด
if (isset($_FILES['finance_Image']) && $_FILES['finance_Image']['error'] === UPLOAD_ERR_OK) {
    $device_Image = time() . "_" . basename($_FILES['finance_Image']['name']);
    $target_dir = "finance/img/";
    $target_file = $target_dir . $device_Image;

    // ตรวจสอบประเภทไฟล์
    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
    if (!in_array($_FILES['finance_Image']['type'], $allowedTypes)) {
        echo "<script>alert('ประเภทไฟล์ไม่ถูกต้อง'); location.href = '../../pages/admin_finance.php';</script>";
        exit;
    }

    // ตรวจสอบขนาดไฟล์
    if ($_FILES['finance_Image']['size'] > 5000000) { // 5MB
        echo "<script>alert('ขนาดไฟล์ใหญ่เกินไป'); location.href = '../../pages/admin_finance.php';</script>";
        exit;
    }

    // อัปโหลดไฟล์
    if (move_uploaded_file($_FILES['finance_Image']['tmp_name'], $target_file)) {
        // ใช้ Prepared Statements เพื่อลดความเสี่ยงจาก SQL Injection
        $stmt = $conn->prepare("UPDATE finance SET finance_Image = ?, officer_Cotton = ?, useripass = ? WHERE finance_Id = ?");
        $stmt->bind_param("ssss", $device_Image, $officer_Cotton, $useripass, $finance_Id);

        // ตรวจสอบผลการอัปเดต
        if ($stmt->execute()) {
            echo "<script>alert('อัปเดตข้อมูลสำเร็จ'); location.href = '../../pages/admin_finance.php';</script>";
        } else {
            echo "<script>alert('เกิดข้อผิดพลาด: " . $stmt->error . "'); location.href = '../../pages/admin_finance.php';</script>";
        }

        // ปิดการเตรียมคำสั่ง
        $stmt->close();
    } else {
        echo "<script>alert('อัปโหลดรูปภาพไม่สำเร็จ'); location.href = '../../pages/admin_finance.php';</script>";
    }
} else {
    echo "<script>alert('กรุณาเลือกไฟล์รูปภาพ'); location.href = '../../pages/admin_finance.php';</script>";
    exit;
}

// ปิดการเชื่อมต่อฐานข้อมูล
$conn->close();
?>
