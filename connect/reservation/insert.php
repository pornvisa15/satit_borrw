<?php
include '../mysql_borrow.php';
session_start();

// ตรวจสอบค่าจาก POST และ SESSION
$history_Borrow = isset($_POST['history_Borrow']) ? $_POST['history_Borrow'] : '';
$history_Return = isset($_POST['history_Return']) ? $_POST['history_Return'] : '';
$history_Stop = isset($_POST['history_Stop']) ? $_POST['history_Stop'] : '';
$history_Other = isset($_POST['history_Other']) ? $_POST['history_Other'] : '';
$history_Another = isset($_POST['history_Another']) ? $_POST['history_Another'] : '';
$user_Id = isset($_SESSION['useripass']) ? $_SESSION['useripass'] : '';
$history_device = isset($_POST['history_device']) ? $_POST['history_device'] : '';


// ปรับคำสั่ง SQL
$sql = "INSERT INTO history_brs (history_Borrow, history_Return, history_Stop, history_Other, history_Another, user_Id,history_device) 
        VALUES ('$history_Borrow', '$history_Return', '$history_Stop', '$history_Other', '$history_Another', '$user_Id','$history_device')";

// รันคำสั่ง SQL
if ($conn->query($sql) === TRUE) {
    echo "<script>alert('บันทึกข้อมูลสำเร็จ'); location.href = '../../pages/homepages.php';</script>";
} else {
    echo "<script>alert('เกิดข้อผิดพลาด: " . $conn->error . " คำสั่ง SQL: $sql'); location.href = '../../pages/reservation1_book_com.php';</script>";
}

$conn->close();
?>
