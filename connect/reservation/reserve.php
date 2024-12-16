<?php
// เชื่อมต่อกับฐานข้อมูล

include "../mysql_borrow.php";
// ตรวจสอบว่า form ได้รับการ submit หรือยัง
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // รับข้อมูลจากฟอร์ม
    $deviceName = $_POST['deviceName'];
    $purpose = $_POST['purpose'];
    $location = $_POST['location'];
    $startDate = $_POST['startDate'];
    $endDate = $_POST['endDate'];
    $timeReturn = $_POST['timeReturn'];

    // SQL Query สำหรับการบันทึกข้อมูลลงในฐานข้อมูล
    $sql = "INSERT INTO reservations (device_name, purpose, location, start_date, end_date, time_return) 
            VALUES ('$deviceName', '$purpose', '$location', '$startDate', '$endDate', '$timeReturn')";

    if (mysqli_query($conn, $sql)) {
        // ถ้าบันทึกสำเร็จ
        $message = "การจองของคุณเสร็จสมบูรณ์";
        $status = "success";
    } else {
        // ถ้าบันทึกไม่สำเร็จ
        $message = "เกิดข้อผิดพลาดในการบันทึกการจอง";
        $status = "error";
    }
}
?>
