<?php
include "../mysql_borrow.php";

if ($conn->connect_error) {
    die("การเชื่อมต่อฐานข้อมูลล้มเหลว: " . $conn->connect_error);
}

$useripass = $_POST['useripass'] ?? '';
$officer_Right = $_POST['officer_Right'] ?? '';
$officer_Cotton = $_POST['officer_Cotton'] ?? '';

// ตรวจสอบว่าข้อมูลครบถ้วนหรือไม่
if (empty($useripass) || empty($officer_Right) || empty($officer_Cotton)) {
    echo "ข้อมูลไม่ครบถ้วน";
    exit;
}

// ใช้ Prepared Statement ป้องกัน SQL Injection
$sql = "INSERT INTO `officer_staff` (`useripass`, `officer_Right`, `officer_Cotton`) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    echo "เกิดข้อผิดพลาดในการเตรียม SQL: " . $conn->error;
    exit;
}

$stmt->bind_param("sss", $useripass, $officer_Right, $officer_Cotton);

if ($stmt->execute()) {
    echo "success"; // ส่งค่ากลับให้ AJAX
} else {
    echo "เกิดข้อผิดพลาด: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
