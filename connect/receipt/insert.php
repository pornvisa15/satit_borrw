<?php

include '../mysql_borrow.php';
session_start();

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// ตรวจสอบการอัปโหลดไฟล์
if (isset($_FILES['money_Image']) && $_FILES['money_Image']['error'] === UPLOAD_ERR_OK) {
    // ตั้งชื่อไฟล์ที่อัปโหลดให้ไม่ซ้ำกับเวลาปัจจุบัน
    $money_Image = time() . "_" . basename($_FILES['money_Image']['name']);
    $target_dir = "../receipt/img/";  // โฟลเดอร์ที่เก็บไฟล์
    $target_file = $target_dir . $money_Image;

    // กำหนดประเภทไฟล์ที่อนุญาต
    $allowedTypes = ['image/jpeg', 'image/png'];

    // ตรวจสอบว่าเป็นไฟล์ภาพจริงหรือไม่
    $imageSize = getimagesize($_FILES['money_Image']['tmp_name']);
    if ($imageSize === false || !in_array($_FILES['money_Image']['type'], $allowedTypes)) {
        echo "<script>alert('ประเภทไฟล์ไม่ถูกต้องหรือไม่ใช่ไฟล์ภาพ'); location.href = '../../pages/admin_record.php';</script>";
        exit;
    }

    // ตรวจสอบขนาดไฟล์
    if ($_FILES['money_Image']['size'] > 5000000) { // 5MB
        echo "<script>alert('ขนาดไฟล์ใหญ่เกินไป'); location.href = '../../pages/admin_record.php';</script>";
        exit;
    }

   // ตรวจสอบว่า device_Id ถูกส่งมา
$device_Id = isset($_POST['device_Id']) ? $_POST['device_Id'] : null;
if (!$device_Id) {
    echo "<script>alert('ไม่พบ device_Id สำหรับการอัปเดต'); location.href = '../../pages/admin_record.php';</script>";
    exit;
}

// ตรวจสอบว่า device_Id มีข้อมูลในฐานข้อมูลหรือไม่
$sql = "SELECT * FROM borrow.history_brs WHERE device_Id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $device_Id);
$stmt->execute();
$result = $stmt->get_result();

// ถ้าไม่พบข้อมูลในฐานข้อมูล
if ($result->num_rows === 0) {
    echo "<script>alert('ไม่พบข้อมูลของ device_Id ที่ระบุ'); location.href = '../../pages/admin_record.php';</script>";
    exit;
}

// การอัปโหลดไฟล์
if (move_uploaded_file($_FILES['money_Image']['tmp_name'], $target_file)) {
    // อัปเดตข้อมูลในตาราง borrow.history_brs
    $stmt = $conn->prepare("UPDATE borrow.history_brs SET money_Image = ? WHERE device_Id = ?");
    $stmt->bind_param("ss", $money_Image, $device_Id);

    if ($stmt->execute()) {
        echo "<script>alert('บันทึกข้อมูลสำเร็จ'); location.href = '../../pages/admin_record.php';</script>";
    } else {
        echo "<script>alert('เกิดข้อผิดพลาดในการอัปเดตฐานข้อมูล: " . $stmt->error . "'); location.href = '../../pages/admin_record.php';</script>";
    }
} else {
    echo "<script>alert('อัปโหลดรูปภาพไม่สำเร็จ'); location.href = '../../pages/admin_record.php';</script>";
}
exit;


} else {
    echo "<script>alert('ไม่พบไฟล์ที่อัปโหลด'); location.href = '../../pages/admin_record.php';</script>";
}
?>
