<?php
include '../mysql_borrow.php';

// ตรวจสอบการรับข้อมูลจาก URL
if (isset($_REQUEST['officerl_Id'])) {
    $officerl_Id = $_REQUEST['officerl_Id'];

    // เตรียมคำสั่ง SQL สำหรับลบข้อมูล
    $sql = "DELETE FROM `officer_staff` WHERE officerl_Id = ?";

    // เตรียมคำสั่ง SQL
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        echo "เกิดข้อผิดพลาดในการเตรียมคำสั่ง SQL: " . $conn->error;
        exit;
    }

    // ผูกค่าตัวแปรกับคำสั่ง SQL
    $stmt->bind_param("s", $officerl_Id);

    // ลบข้อมูลจากฐานข้อมูล
    if ($stmt->execute()) {
        echo "success"; // ส่งข้อความ 'success' กลับไปยัง JavaScript
    } else {
        echo "เกิดข้อผิดพลาด: " . addslashes($conn->error); // ส่งข้อความข้อผิดพลาด
    }

    // ปิดการเชื่อมต่อ
    $stmt->close();
}

// ปิดการเชื่อมต่อกับฐานข้อมูล
$conn->close();
?>
