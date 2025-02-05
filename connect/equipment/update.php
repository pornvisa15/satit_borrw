<?php
header('Content-Type: text/plain');
error_reporting(E_ALL);
ini_set('display_errors', 1);

include '../../connect/myspl_das_satit.php';  // แก้ไขเส้นทางให้ถูกต้อง
include '../../connect/mysql_borrow.php';    // แก้ไขเส้นทางให้ถูกต้อง

// ตรวจสอบว่าเป็น POST หรือไม่
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // รับค่าจากฟอร์ม
    $device_Id = mysqli_real_escape_string($conn, $_POST['device_Id']);
    $device_Name = mysqli_real_escape_string($conn, $_POST['device_Name']);
    $officer_Cotton = mysqli_real_escape_string($conn, $_POST['officer_Cotton']);
    $device_Date = mysqli_real_escape_string($conn, $_POST['device_Date']);
    $device_Price = mysqli_real_escape_string($conn, $_POST['device_Price']);
    $device_Other = mysqli_real_escape_string($conn, $_POST['device_Other']);
    $device_Access = mysqli_real_escape_string($conn, $_POST['device_Access']);

    // ตรวจสอบว่าค่าจากฟอร์มครบหรือไม่
    if (empty($device_Id) || empty($device_Name) || empty($device_Date)) {
        echo json_encode(["status" => "error", "message" => "ข้อมูลที่จำเป็นบางอย่างหายไป"]);
        exit();
    }

    // ใช้ค่าเดิมถ้าไม่มีไฟล์ใหม่
    $deviceImage = isset($_POST['device_Image_hidden']) ? $_POST['device_Image_hidden'] : '';

    // ตรวจสอบว่าไฟล์ถูกอัปโหลดหรือไม่
    if (isset($_FILES['device_Image']) && $_FILES['device_Image']['error'] == 0) {
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        $fileType = $_FILES['device_Image']['type'];

        // ตรวจสอบประเภทไฟล์
        if (in_array($fileType, $allowedTypes)) {
            // กำหนดเส้นทางและชื่อไฟล์
            $target_dir = "../../connect/equipment/equipment/img/";
            $fileExt = pathinfo($_FILES['device_Image']['name'], PATHINFO_EXTENSION);
            $deviceImage = uniqid() . "." . $fileExt;
            $target_file = $target_dir . $deviceImage;

            // อัปโหลดไฟล์
            if (!move_uploaded_file($_FILES['device_Image']['tmp_name'], $target_file)) {
                echo json_encode(["status" => "error", "message" => "การอัปโหลดไฟล์ล้มเหลว"]);
                exit();
            }
        } else {
            echo json_encode(["status" => "error", "message" => "ประเภทไฟล์ไม่ถูกต้อง"]);
            exit();
        }
    }

    // SQL อัปเดตข้อมูล
    $sql = "UPDATE borrow.device_information SET 
            device_Name = ?, device_Date = ?, device_Price = ?, 
            device_Other = ?, device_Access = ?, device_Image = ?, officer_Cotton = ? 
            WHERE device_Id = ?";

    // ตรวจสอบการเชื่อมต่อฐานข้อมูล
    if ($conn->connect_error) {
        echo json_encode(["status" => "error", "message" => "การเชื่อมต่อฐานข้อมูลล้มเหลว: " . $conn->connect_error]);
        exit();
    }

    // เตรียมคำสั่ง SQL
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        echo json_encode(["status" => "error", "message" => "การเตรียมคำสั่ง SQL ล้มเหลว: " . $conn->error]);
        exit();
    }

    // ผูกพารามิเตอร์
    $stmt->bind_param('sssssssi', $device_Name, $device_Date, $device_Price, 
                      $device_Other, $device_Access, $deviceImage, $officer_Cotton, $device_Id);
    
    // ตรวจสอบการดำเนินการ
    if ($stmt->execute()) {
        echo json_encode(["status" => "success", "message" => "อัปเดตข้อมูลสำเร็จ"]);
    } else {
        echo json_encode(["status" => "error", "message" => $stmt->error]);
    }

    // ปิดการเชื่อมต่อ
    $stmt->close();
    $conn->close();
} else {
    echo json_encode(["status" => "error", "message" => "Method not allowed"]);
}
?>
