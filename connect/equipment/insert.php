<?php
// เชื่อมต่อฐานข้อมูล
include '../mysql_borrow.php';

// รับค่าจากฟอร์ม

$device_Numder = $_POST['device_Numder']; //	เลขพัสดุ/ครุภัณฑ์
$device_Name = $_POST['device_Name'];   //	ชื่ออุปกรณ์
$device_Type = $_POST['device_Type'];   //	ประเภท 1=คอมพิวเตอร์ 2=วิทยาศาสตร์ 3=ดนตรี
$device_Date = $_POST['device_Date'];  //	วันที่เดือนปีซื้อ
$device_Price = $_POST['device_Price'];  //	ราคา
$device_Duty = $_POST['device_Duty'];  //	หน้าที่1=คอมพิวเตอร์ 2=วิทยาศาสตร์ 3=ดนตรี 4=พัสดุ	
$device_Other = $_POST['device_Other']; //รายละเอียดเพิ่มเติมจ้ะ
$device_Image = time() . "_" . basename($_FILES['device_Image']['name']);
$device_Access = $_POST['device_Access']; //การเข้าถึง 1=บุคลากร 2=นักเรียน
$device_Con = 1; // ค่าเริ่มต้น = ปกติ

$officerl_Id = 'ploy'; //ข้อมูลเจ้าหน้าที่นะ

$target_dir = "equipment/img/";
$target_file = $target_dir . basename($device_Image);

if (!is_dir($target_dir)) {
    mkdir($target_dir, 0777, true);
}

if (move_uploaded_file($_FILES['device_Image']['tmp_name'], $target_file)) {
    // เพิ่มข้อมูลลงในฐานข้อมูล
    $sql = "INSERT INTO device_information (device_Numder, device_Name, device_Type, device_Date, device_Price, device_Other, device_Image, device_Access, device_Con, officerl_Id, device_Duty)
            VALUES ('$device_Numder', '$device_Name', '$device_Type', '$device_Date', '$device_Price', '$device_Other', '$device_Image', '$device_Access', '$device_Con', '$officerl_Id', '$device_Duty')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('บันทึกข้อมูลสำเร็จ'); location.href = '../../pages/admin_equipment.php';</script>";
    } else {
        echo "<script>alert('เกิดข้อผิดพลาด: " . $conn->error . "'); location.href = '../../pages/admin_equipment.php';</script>";
    }
} else {
    echo "<script>alert('อัปโหลดรูปภาพไม่สำเร็จ'); location.href = '../../pages/admin_equipment.php';</script>";
}


?>