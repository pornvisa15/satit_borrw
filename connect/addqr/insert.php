<?php
include '../mysql_borrow.php';
session_start();

// รับค่าจากฟอร์ม
$useripass = $_POST['useripass'] ?? null;
$officer_Cotton = $_POST['officer_Cotton'] ?? null;
$promptpay = $_POST['promptpay'] ?? null;
$officerl_Id = isset($_POST['officerl_Id']) ? (int)$_POST['officerl_Id'] : 1;

// ตรวจสอบว่ามีการส่งข้อมูล promptpay หรือไม่
if (!$promptpay) {
    echo "<script>alert('กรุณากรอกหมายเลข PromptPay'); location.href = '../../pages/admin_finance.php';</script>";
    exit;
}

// สร้าง URL ของ QR Code
$finance_Image = "https://promptpay.io/{$promptpay}.png";

// ตรวจสอบการเชื่อมต่อฐานข้อมูล
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// ดาวน์โหลดไฟล์ QR Code
$imageData = file_get_contents($finance_Image);
$filename = "{$promptpay}.png";
$savePath = "../addqr/img/{$filename}";

// บันทึกไฟล์ QR Code ลงเซิร์ฟเวอร์
file_put_contents($savePath, $imageData);

// เตรียมคำสั่ง SQL บันทึกข้อมูล
$stmt = $conn->prepare("INSERT INTO finance (officer_Cotton, useripass, finance_Image, officerl_Id) VALUES (?, ?, ?, ?)");
$stmt->bind_param("sssi", $officer_Cotton, $useripass, $filename, $officerl_Id);  // แก้ไขเป็น sssi

// ตรวจสอบผลการบันทึกข้อมูล
if ($stmt->execute()) {
    echo "<script>alert('บันทึกข้อมูลสำเร็จ'); location.href = '../pages/admin_finance.php';</script>";
} else {
    echo "<script>alert('เกิดข้อผิดพลาด: " . $stmt->error . "'); location.href = '../../pages/admin_finance.php';</script>";
}

$stmt->close();
$conn->close();
?>
