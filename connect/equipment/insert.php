<?php
// เชื่อมต่อฐานข้อมูล
include '../mysql_borrow.php';
session_start();

// รับค่าจากฟอร์มและป้องกัน SQL Injection
$device_Numder = $conn->real_escape_string($_POST['device_Numder']); // เลขพัสดุ/ครุภัณฑ์
$device_Name = $conn->real_escape_string($_POST['device_Name']);   // ชื่ออุปกรณ์
$device_Date = $conn->real_escape_string($_POST['device_Date']);  // วันที่เดือนปีซื้อ
$device_Price = $conn->real_escape_string($_POST['device_Price']);  // ราคา
$device_Other = $conn->real_escape_string($_POST['device_Other']); // รายละเอียดเพิ่มเติม
$device_Access = $conn->real_escape_string($_POST['device_Access']); // การเข้าถึง
$device_Con = 1; // ค่าเริ่มต้น = ปกติ
$cotton_Id = $conn->real_escape_string($_POST['cotton_Id']);

// ตรวจสอบว่ามีไฟล์ที่อัปโหลดหรือไม่
if (isset($_FILES['device_Image']) && $_FILES['device_Image']['error'] === UPLOAD_ERR_OK) {
    $device_Image = time() . "_" . basename($_FILES['device_Image']['name']);
    $target_dir = "equipment/img/";
    $target_file = $target_dir . $device_Image;

    // ตรวจสอบและสร้างโฟลเดอร์ถ้ายังไม่มี
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    // ตรวจสอบประเภทไฟล์
    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
    if (!in_array($_FILES['device_Image']['type'], $allowedTypes)) {
        echo "<script>alert('ประเภทไฟล์ไม่ถูกต้อง'); location.href = '../../pages/admin_equipment.php';</script>";
        exit;
    }

    // อัปโหลดไฟล์
    if (move_uploaded_file($_FILES['device_Image']['tmp_name'], $target_file)) {
        // เพิ่มข้อมูลลงในฐานข้อมูล
        $sql = "INSERT INTO device_information (device_Numder, device_Name, device_Date, device_Price, device_Other, device_Image, device_Access, device_Con, cotton_Id)
                VALUES ('$device_Numder', '$device_Name', '$device_Date', '$device_Price', '$device_Other', '$device_Image', '$device_Access', '$device_Con', '$cotton_Id')";

        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('บันทึกข้อมูลสำเร็จ'); location.href = '../../pages/admin_equipment.php';</script>";
        } else {
            echo "<script>alert('เกิดข้อผิดพลาด: " . $conn->error . " คำสั่ง SQL: $sql'); location.href = '../../pages/admin_equipment.php';</script>";
        }
    } else {
        echo "<script>alert('อัปโหลดรูปภาพไม่สำเร็จ'); location.href = '../../pages/admin_equipment.php';</script>";
    }
} else {
    echo "<script>alert('กรุณาเลือกไฟล์รูปภาพ'); location.href = '../../pages/admin_equipment.php';</script>";
    exit;
}
?>
