<?php
include '../mysql_borrow.php';

// รับค่า officerl_Id จาก URL
if (isset($_POST['device_Id'])) {
    $device_Id = $_POST['device_Id'];
    $device_Numder = $_POST['device_Numder'];
    $device_Name = $_POST['device_Name'];
    $device_Type = $_POST['device_Type'];
    $device_Type = $_POST['device_Date'];
    $device_Price = $_POST['device_Price'];
    $device_Other = $_POST['device_Other'];
    $device_Image = $_POST['device_Image'];
    $device_Access = $_POST['device_Access'];
    $useripass = $_REQUEST['useripass'];
    $device_Duty = $_POST['device_Duty'];

    // ตรวจสอบค่าที่ได้รับ
    // if (empty($officerl_Id) || empty($name) || empty($department)) {
    //     echo "ข้อมูลไม่ครบถ้วน!";
    //     exit();
    // }
    // อัปเดตข้อมูล
    $sql = "UPDATE borrow.device_information WHERE device_information.device_Id WHERE = ?";
    $sql = "UPDATE `officer_staff` SET `officer_Right`='$officer_Right' WHERE officer_staff.officerl_Id = $officerl_Id";

    if ($conn->query($sql) === TRUE) {
        header("Location: ../../pages/admin_staffinfo.php");
    } else {
        echo "เกิดข้อผิดพลาดในการเตรียมคำสั่ง SQL";
    }
}

// ปิดการเชื่อมต่อ
$conn->close();
?>