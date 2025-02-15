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
$officer_Cotton = $conn->real_escape_string($_POST['officer_Cotton']);

// ตรวจสอบว่าเลขพัสดุ/ครุภัณฑ์ซ้ำในฐานข้อมูลหรือไม่
$sql_check = "SELECT * FROM device_information WHERE device_Numder = '$device_Numder'";
$result_check = $conn->query($sql_check);

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
        // เตรียมคำสั่ง SQL ที่จะทำการแทรกข้อมูล
        $stmt = $conn->prepare("INSERT INTO device_information (device_Numder, device_Name, device_Date, device_Price, device_Other, device_Image, device_Access, device_Con, officer_Cotton) 
                                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

        // ผูกค่าพารามิเตอร์
        $stmt->bind_param("ssssssiii", $device_Numder, $device_Name, $device_Date, $device_Price, $device_Other, $device_Image, $device_Access, $device_Con, $officer_Cotton);

        // execute คำสั่ง SQL
        if ($stmt->execute()) {
            echo "success";
        } else {
            echo "เกิดข้อผิดพลาด: " . $stmt->error;
        }

        // ปิด statement
        $stmt->close();
    } else {
        echo "<script>alert('อัปโหลดรูปภาพไม่สำเร็จ'); location.href = '../../pages/admin_equipment.php';</script>";
    }
} else {
    echo "<script>alert('กรุณาเลือกไฟล์รูปภาพ'); location.href = '../../pages/admin_equipment.php';</script>";
    exit;
}
?>
