<?php
// เชื่อมต่อฐานข้อมูล
include '../connect/mysql_borrow.php';

// รับค่าจากฟอร์ม
$device_Id = $_POST['device_Id'];
$device_Numder = $_POST['device_Numder'];
$device_Name = $_POST['device_Name'];
$device_Type = $_POST['device_Type'];
$device_Date = $_POST['device_Date'];
$device_Price = $_POST['device_Price'];
$device_Other = $_POST['device_Other'];
$device_Image = $_FILES['device_Image']['name'];
$device_Access = isset($_POST['device_Access']) ? implode(',', $_POST['device_Access']) : '';
$device_Con = 1; // ค่าเริ่มต้น = ปกติ
$device_Time = date("Y-m-d H:i:s"); // เวลาปัจจุบัน
$officerl_Id = $_POST['officerl_Id'];

// อัปโหลดไฟล์รูปภาพ
$target_dir = "../borrw/uploads/";
$target_file = $target_dir . basename($device_Image);

if (move_uploaded_file($_FILES['device_Image']['tmp_name'], $target_file)) {
    // เพิ่มข้อมูลลงในฐานข้อมูล
    $sql = "INSERT INTO device_information (device_Id, device_Numder, device_Name, device_Type, device_Date, device_Price, device_Other, device_Image, device_Access, device_Con, device_Time, officerl_Id)
            VALUES ('$device_Id', '$device_Numder', '$device_Name', '$device_Type', '$device_Date', '$device_Price', '$device_Other', '$device_Image', '$device_Access', '$device_Con', '$device_Time', '$officerl_Id')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('บันทึกข้อมูลสำเร็จ'); location.href = 'admin_equipment.php';</script>";
    } else {
        echo "<script>alert('เกิดข้อผิดพลาด: " . $conn->error . "'); location.href = 'admin_equipment.php';</script>";
    }
} else {
    echo "<script>alert('อัปโหลดรูปภาพไม่สำเร็จ'); location.href = 'admin_equipment.php';</script>";
}

$conn->close();
?>