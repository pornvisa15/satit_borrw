<?php
include '../../connect/myspl_das_satit.php';  // แก้ไขเส้นทางให้ถูกต้อง
include '../../connect/mysql_borrow.php';    // แก้ไขเส้นทางให้ถูกต้อง

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $device_Id = $_POST['device_Id'];
    $device_Name = $_POST['device_Name'];
    $cotton_Id = $_POST['cotton_Id'];
    $device_Date = $_POST['device_Date'];
    $device_Price = $_POST['device_Price'];
    $device_Other = $_POST['device_Other'];
    $device_Access = $_POST['device_Access'];

    // กำหนดค่าของ device_Image เริ่มต้นเป็นค่าว่าง
    $device_Image = '';

    // ตรวจสอบการอัปโหลดไฟล์
    if (isset($_FILES['device_Image']) && $_FILES['device_Image']['error'] === UPLOAD_ERR_OK) {
        $device_Image = time() . "_" . basename($_FILES['device_Image']['name']);
        $target_dir = "../../connect/equipment/equipment/img/";
        $target_file = $target_dir . $device_Image;

        // ตรวจสอบและสร้างโฟลเดอร์ถ้ายังไม่มี
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        // ตรวจสอบประเภทไฟล์
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        if (!in_array($_FILES['device_Image']['type'], $allowedTypes)) {
            $error_message = 'ประเภทไฟล์ไม่ถูกต้อง';
        } else {
            // อัปโหลดไฟล์
            if (move_uploaded_file($_FILES['device_Image']['tmp_name'], $target_file)) {
                $error_message = ''; // ไม่มีข้อผิดพลาดในการอัปโหลด
            } else {
                $error_message = 'อัปโหลดรูปภาพไม่สำเร็จ';
            }
        }
    }

    // หากไม่มีข้อผิดพลาดในการอัปโหลดไฟล์
    if (empty($error_message)) {
        // SQL สำหรับอัปเดตข้อมูล
        $sql = "UPDATE borrow.device_information SET 
                device_Name = ?, device_Date = ?, device_Price = ?, 
                device_Other = ?, device_Access = ?, device_Image = ?, cotton_Id = ? 
                WHERE device_Id = ?";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param('sssssssi', $device_Name, $device_Date, $device_Price, 
                          $device_Other, $device_Access, $device_Image, $cotton_Id, $device_Id);

        if ($stmt->execute()) {
            echo "<script>alert('บันทึกการแก้ไขเรียบร้อย'); location.href = '../../pages/admin_equipment.php';</script>";
        } else {
            echo "<script>alert('เกิดข้อผิดพลาด: " . $stmt->error . "'); location.href = '../../pages/admin_equipment.php';</script>";
        }

        $stmt->close();
    } else {
        // แสดงข้อความข้อผิดพลาดในการอัปโหลดไฟล์
        echo "<script>alert('$error_message'); location.href = '../../pages/admin_equipment.php';</script>";
    }
}
?>
