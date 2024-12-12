<?php
include "../mysql_borrow.php";

// รับค่าจากแบบฟอร์ม
$useripass = $_REQUEST['useripass'];
$officer_Right = $_REQUEST['officer_Right'];
$officer_Cotton = $_REQUEST['officer_Cotton'];

// เพิ่ม officer_Cotton ลงในคำสั่ง SQL
$sql = "INSERT INTO `officer_staff` (`useripass`, `officer_Right`, `officer_Cotton`) 
VALUES ('$useripass', '$officer_Right', '$officer_Cotton')";

if ($conn->query($sql) === TRUE) {
  echo "<script>alert('เพิ่มรายชื่อเจ้าหน้าที่สำเร็จ'); location.href = '../../pages/admin_staffinfo.php';</script>";
} else {
  echo "<script>alert('เกิดข้อผิดพลาด: " . $conn->error . "');</script>";
}

$conn->close();
?>
