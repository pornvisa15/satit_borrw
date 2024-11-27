<?php
// Include your database connection
include 'mysql_borrow.php';
$device_Id = $_REQUEST['device_Id'];
$device_Name = $_REQUEST['device_Name'];
$device_Numder = $_REQUEST['device_Numder'];
$device_Type = $_REQUEST['device_Type'];
$device_Date = $_REQUEST['device_Date'];
$device_Price = $_REQUEST['device_Price'];
$device_Other = $_REQUEST['device_Other'];
$device_Image = $_REQUEST['device_Image'];
$device_Access = $_REQUEST['device_Access'];

$sql = "INSERT INTO `device_information`(`device_Id`,`device_Name`, `device_Numder`, `device_Type`,`device_Date`, `device_Price`, `device_Other`,`device_Image`, `device_Access`,) 
VALUES ('$device_Id','$device_Name','$device_Numder','$device_Type','$device_Date','$device_Price','$device_Other,'$device_Image','$device_Access')";

if ($conn->query($sql) === TRUE) {
    echo "<script>alert('เพิ่มข้อมูลอุปกรณ์สำเร็จ'); location.href = '../../pages/admin_equipment_in_com.php';</script>";
} else {
    echo "<script>alert('เกิดข้อผิดพลาด: " . $conn->error . "');</script>";
}

$conn->close();
?>


?>