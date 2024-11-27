<?php
include '../mysql_borrow.php';

// รับค่า officerl_Id จาก URL
if (isset($_POST['officerl_Id'])) {
    $officerl_Id = $_POST['officerl_Id'];
    $officer_Right = $_POST['officer_Right'];

    // ตรวจสอบค่าที่ได้รับ
    // if (empty($officerl_Id) || empty($name) || empty($department)) {
    //     echo "ข้อมูลไม่ครบถ้วน!";
    //     exit();
    // }

    // อัปเดตข้อมูล
    $sql = "UPDATE borrow.officer_staff WHERE officer_staff.officerl_Id = ?";
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
