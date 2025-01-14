<?php
// เชื่อมต่อฐานข้อมูล
include '../mysql_borrow.php';
session_start();

// รับค่าจากฟอร์ม
$useripass = $_POST['useripass'] ?? '';
$cotton_Id = $_POST['officer_Cotton'] ?? '';
$device_Access = $_POST['device_Access'] ?? '';

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
        // สร้างคำสั่ง SQL เพื่อเพิ่มข้อมูลลงในฐานข้อมูล
        $sql = "INSERT INTO finance (finance_Image, cotton_Id, useripass)
                VALUES ('$device_Image', '$cotton_Id', '$useripass')";

        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('บันทึกข้อมูลสำเร็จ'); location.href = '../../pages/admin_finance.php';</script>";
        } else {
            echo "<script>alert('เกิดข้อผิดพลาด: " . $conn->error . " คำสั่ง SQL: $sql'); location.href = '../../pages/admin_finance.php';</script>";
        }
    } else {
        echo "<script>alert('อัปโหลดรูปภาพไม่สำเร็จ'); location.href = '../../pages/admin_finance.php';</script>";
    }
} else {
    echo "<script>alert('กรุณาเลือกไฟล์รูปภาพ'); location.href = '../../pages/admin_finance.php';</script>";
    exit;
}
?>
