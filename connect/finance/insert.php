<?php
// เชื่อมต่อฐานข้อมูล
include '../mysql_borrow.php';
session_start();
$useripass = $_REQUEST['useripass'];
// ตรวจสอบว่า 'device_Access' ถูกส่งมาจากฟอร์มหรือไม่
$device_Access = isset($_POST['device_Access']) ? $conn->real_escape_string($_POST['device_Access']) : ''; // การเข้าถึง
$device_Con = 1; // ค่าเริ่มต้น = ปกติ
$cotton_Id = $conn->real_escape_string($_POST['cotton_Id']);

// ตรวจสอบว่ามีไฟล์ที่อัปโหลดหรือไม่
if (isset($_FILES['finance_Image']) && $_FILES['finance_Image']['error'] === UPLOAD_ERR_OK) {
    $device_Image = time() . "_" . basename($_FILES['finance_Image']['name']);
    $target_dir = "finance/img/";
    $target_file = $target_dir . $device_Image;

    // ตรวจสอบและสร้างโฟลเดอร์ถ้ายังไม่มี
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

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
                VALUES ('$device_Image', '$cotton_Id', '$useripass')";  // เพิ่ม cotton_Id และ useripass ด้วย

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
