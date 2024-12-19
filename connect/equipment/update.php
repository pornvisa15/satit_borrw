<?php

include '../mysql_borrow.php';
// ตรวจสอบว่าข้อมูลถูกส่งมาครบหรือไม่
if (
    isset($_POST['device_Numder']) && isset($_POST['device_Name']) &&
    isset($_POST['cotton_Name']) && isset($_POST['device_Access']) &&
    isset($_POST['device_Date']) && isset($_POST['device_Price']) &&
    isset($_POST['device_Other'])
) {
    $device_Numder = $_POST['device_Numder']; // varchar
    $device_Name = $_POST['device_Name']; // text
    $cotton_Name = $_POST['cotton_Name']; // text
    $device_Access = $_POST['device_Access']; // varchar
    $device_Date = $_POST['device_Date']; // date
    $device_Price = $_POST['device_Price']; // text
    $device_Other = $_POST['device_Other']; // text

    // ตรวจสอบการอัปโหลดไฟล์
    if (!empty($_FILES['device_Image']['name'])) {
        $targetDir = "../connect/equipment/equipment/img/";
        $device_Image = time() . "_" . basename($_FILES['device_Image']['name']); // text
        $targetFilePath = $targetDir . $device_Image;

        // อัปโหลดรูปภาพ
        if (!move_uploaded_file($_FILES['device_Image']['tmp_name'], $targetFilePath)) {
            echo "<script>alert('เกิดข้อผิดพลาดในการอัปโหลดไฟล์รูปภาพ'); window.history.back();</script>";
            exit();
        }
    } else {
        // ใช้รูปภาพเดิมหากไม่มีการอัปโหลดใหม่
        $device_Image = isset($_POST['current_Image']) ? $_POST['current_Image'] : '';
    }

    // ตรวจสอบความถูกต้องของข้อมูล
    if (
        empty($device_Numder) || empty($device_Name) || empty($cotton_Name) ||
        empty($device_Access) || empty($device_Date) || empty($device_Price) ||
        empty($device_Other)
    ) {
        echo "<script>alert('กรุณากรอกข้อมูลให้ครบถ้วน'); window.history.back();</script>";
        exit();
    }

    // คำสั่ง SQL สำหรับอัปเดตข้อมูล
    $sql = "UPDATE `device_information` 
            SET `device_Name` = ?, 
                `cotton_Name` = ?, 
                `device_Access` = ?, 
                `device_Date` = ?, 
                `device_Price` = ?, 
                `device_Other` = ?, 
                `device_Image` = ? 
            WHERE `device_Numder` = ?";

    $stmt = $conn->prepare($sql);

    if ($stmt) {
        // ผูกค่ากับคำสั่ง SQL
        $stmt->bind_param(
            "ssssssss",
            $device_Name,
            $cotton_Name,
            $device_Access,
            $device_Date,
            $device_Price,
            $device_Other,
            $device_Image,
            $device_Numder
        );

        // ดำเนินการอัปเดต
        if ($stmt->execute()) {
            echo "<script>alert('อัปเดตข้อมูลสำเร็จ'); location.href = '../../pages/admin_equipment.php';</script>";
        } else {
            echo "<script>alert('เกิดข้อผิดพลาด: {$stmt->error}'); window.history.back();</script>";
        }

        $stmt->close();
    } else {
        echo "<script>alert('เกิดข้อผิดพลาดในการเตรียมคำสั่ง: {$conn->error}'); window.history.back();</script>";
    }
} else {
    echo "<script>alert('ข้อมูลไม่ครบถ้วน'); window.history.back();</script>";
}

$conn->close();
?>