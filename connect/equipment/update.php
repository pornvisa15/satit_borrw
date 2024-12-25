<?php
include '../../connect/myspl_das_satit.php';  // แก้ไขเส้นทางให้ถูกต้อง
include '../../connect/mysql_borrow.php';    // แก้ไขเส้นทางให้ถูกต้อง

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // รับค่าจากฟอร์ม
    $device_Id = $_POST['device_Id'];
    $device_Name = $_POST['device_Name'];
    $cotton_Id = $_POST['cotton_Id'];
    $device_Date = $_POST['device_Date'];
    $device_Price = $_POST['device_Price'];
    $device_Other = $_POST['device_Other'];
    $device_Access = $_POST['device_Access'];

    // ตรวจสอบว่าเลือกไฟล์ใหม่หรือไม่
    // หากไม่เลือกไฟล์ใหม่ให้ใช้ไฟล์เดิมจาก hidden field
    $deviceImage = isset($_POST['device_Image_hidden']) ? $_POST['device_Image_hidden'] : '';

    if ($_FILES['device_Image']['error'] == 0) {
        // รับชื่อไฟล์ใหม่
        $deviceImage = $_FILES['device_Image']['name'];

        // อัปโหลดไฟล์ใหม่ไปยังเซิร์ฟเวอร์
        $target_dir = "../../connect/equipment/equipment/img/";
        $target_file = $target_dir . basename($deviceImage);

        // ตรวจสอบประเภทไฟล์
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        if (in_array($_FILES['device_Image']['type'], $allowedTypes)) {
            // อัปโหลดไฟล์
            move_uploaded_file($_FILES['device_Image']['tmp_name'], $target_file);
        } else {
            echo "<script>alert('ประเภทไฟล์ไม่ถูกต้อง'); location.href = '../../pages/admin_equipment.php';</script>";
            exit;
        }
    }

    // SQL สำหรับอัปเดตข้อมูล
    $sql = "UPDATE borrow.device_information SET 
            device_Name = ?, device_Date = ?, device_Price = ?, 
            device_Other = ?, device_Access = ?, device_Image = ?, cotton_Id = ? 
            WHERE device_Id = ?";

    // เตรียมคำสั่ง SQL
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sssssssi', $device_Name, $device_Date, $device_Price, 
                      $device_Other, $device_Access, $deviceImage, $cotton_Id, $device_Id);

    // ตรวจสอบการดำเนินการ
    if ($stmt->execute()) {
        echo "<script>alert('บันทึกการแก้ไขเรียบร้อย'); location.href = '../../pages/admin_equipment.php';</script>";
    } else {
        echo "<script>alert('เกิดข้อผิดพลาด: " . $stmt->error . "'); location.href = '../../pages/admin_equipment.php';</script>";
    }

    // ปิดคำสั่ง SQL
    $stmt->close();
}
?>
