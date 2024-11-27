<?php
include "../mysql_borrow.php";
$useripass = $_REQUEST['useripass'];
$officer_Right = $_REQUEST['officer_Right'];

$sql = "INSERT INTO `officer_staff`(`useripass`, `officer_Right`) 
VALUES ('$useripass','$officer_Right')";


if ($conn->query($sql) === TRUE) {
  echo "<script>alert('เพิ่มรายชื่อเจ้าหน้าที่สำเร็จ'); location.href = '../../pages/admin_staffinfo.php';</script>";
} else {
  echo "<script>alert('เกิดข้อผิดพลาด: " . $conn->error . "');</script>";
}

$conn->close();
?>
