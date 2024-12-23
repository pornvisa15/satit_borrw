<?php

include '../mysql_borrow.php';
session_start();

// $device_Id = $_POST['device_Id'];
$history_Borrow = $_POST['history_Borrow'];
$history_Return = $_POST['history_Return'];
$history_Stop = $_POST['history_Stop'];
$history_Other = $_POST['history_Other'];
$history_Another = $_POST['history_Another'];

$sql = "INSERT INTO history_brs (history_Borrow, history_Return, history_Stop, history_Other, history_Another) 
        VALUES ('$history_Borrow', '$history_Return', '$history_Stop', '$history_Other', '$history_Another')";

if ($conn->query($sql) === TRUE) {
    echo "<script>alert('บันทึกข้อมูลสำเร็จ'); location.href = '../../pages/homepages.php';</script>";
} else {
    echo "<script>alert('เกิดข้อผิดพลาด: " . $conn->error . " คำสั่ง SQL: $sql'); location.href = '../../pages/reservation1_book_com.php';</script>";
}
$conn->close();
?>