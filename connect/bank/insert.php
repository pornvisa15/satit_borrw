<?php
include "../mysql_borrow.php";

// ตรวจสอบว่ามีการส่งค่าผ่านฟอร์ม
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // รับค่าจากฟอร์ม
    $bank_Name = $_POST['bank_name'] ?? '';
    $account_Number = $_POST['account_number'] ?? '';
    $account_Name = $_POST['account_name'] ?? '';
    $bank_Details = $_POST['account_detail'] ?? '';

    // ตรวจสอบค่าที่ได้รับมาจากฟอร์ม
    if (empty($bank_Name) || empty($account_Number) || empty($account_Name) || empty($bank_Details)) {
        echo "กรุณากรอกข้อมูลให้ครบถ้วน";
        exit();
    }

    // เตรียมคำสั่ง SQL ด้วย prepared statement
    $stmt = $conn->prepare("INSERT INTO `bank` (`bank_Name`, `account_Number`, `account_Name`, `bank_Details`) 
    VALUES (?, ?, ?, ?)");

    // ผูกค่าตัวแปรกับ prepared statement
    $stmt->bind_param("ssss", $bank_Name, $account_Number, $account_Name, $bank_Details);

    // ตรวจสอบการดำเนินการ
    if ($stmt->execute()) {
        echo "success";
    } else {
        echo "เกิดข้อผิดพลาด: " . $stmt->error;
    }

    // ปิดการเชื่อมต่อ
    $stmt->close();
    $conn->close();
}
?>
