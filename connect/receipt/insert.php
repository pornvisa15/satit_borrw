<?php
include '../mysql_borrow.php';
session_start();

// ตรวจสอบการเชื่อมต่อฐานข้อมูล
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// ตรวจสอบการอัปโหลดไฟล์
if (isset($_FILES['money_Image']) && $_FILES['money_Image']['error'] === UPLOAD_ERR_OK) {
    $device_Id = $_POST['device_Id'] ?? null;
    if (!$device_Id) {
        echo json_encode(["status" => "error", "message" => "ไม่พบ device_Id"]);
        exit;
    }

    // ตรวจสอบว่า device_Id มีอยู่ในฐานข้อมูลหรือไม่
    $sql = "SELECT * FROM borrow.history_brs WHERE device_Id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $device_Id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows === 0) {
        echo json_encode(["status" => "error", "message" => "ไม่พบข้อมูลของ device_Id"]);
        exit;
    }

    // ตั้งชื่อไฟล์ใหม่
    $money_Image = time() . "_" . basename($_FILES['money_Image']['name']);
    $target_dir = "../receipt/img/";
    $target_file = $target_dir . $money_Image;
    $allowedTypes = ['image/jpeg', 'image/png'];

    // ตรวจสอบประเภทไฟล์
    $imageSize = getimagesize($_FILES['money_Image']['tmp_name']);
    if ($imageSize === false || !in_array($_FILES['money_Image']['type'], $allowedTypes)) {
        echo json_encode(["status" => "error", "message" => "ไฟล์ไม่ถูกต้อง"]);
        exit;
    }

    // ตรวจสอบขนาดไฟล์ (สูงสุด 5MB)
    if ($_FILES['money_Image']['size'] > 5000000) {
        echo json_encode(["status" => "error", "message" => "ไฟล์ใหญ่เกินไป"]);
        exit;
    }

    // ย้ายไฟล์และอัปเดตฐานข้อมูล
    if (move_uploaded_file($_FILES['money_Image']['tmp_name'], $target_file)) {
        $stmt = $conn->prepare("UPDATE borrow.history_brs SET money_Image = ? WHERE device_Id = ?");
        $stmt->bind_param("ss", $money_Image, $device_Id);
        if ($stmt->execute()) {
            echo json_encode(["status" => "success", "message" => "บันทึกข้อมูลสำเร็จ"]);
        } else {
            echo json_encode(["status" => "error", "message" => "เกิดข้อผิดพลาดในการอัปเดตฐานข้อมูล"]);
        }
    } else {
        echo json_encode(["status" => "error", "message" => "อัปโหลดรูปภาพไม่สำเร็จ"]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "ไม่พบไฟล์ที่อัปโหลด"]);
}
?>