<?php
include '../connect/mysql_borrow.php';

if (isset($_POST['device_Numder']) && isset($_POST['device_Name']) && isset($_POST['cotton_Name']) && isset($_POST['device_Access']) && isset($_POST['device_Date']) && isset($_POST['device_Price']) && isset($_POST['device_Other']) && isset($_SESSION['Image'])) {
    $device_Numder = $_POST['device_Numder'];
    $device_Name = $_POST['device_Name'];
    $cotton_Name = $_POST['cotton_Name'];
    $device_Access = $_POST['device_Access'];
    $device_Date = $_POST['device_Date'];
    $device_Price = $_POST['device_Price'];
    $device_Other = $_POST['device_Other'];
    $device_Image = $_POST['device_Image'];
    // $device_Con = $_POST['device_Con'];
    // $useripass = $_SESSION['useripass'];
    // $cotton_Id = $_POST['cotton_Id'];

    if (empty($device_Numder) || empty($device_Name) || empty($cotton_Name) || empty($device_Access) || empty($device_Date) || empty($device_Price) || empty($device_Other) || empty($device_Image)) {
        echo "<script>alert('กรุณากรอกข้อมูลให้ครบถ้วน'); window.history.back();</script>";
        exit();
    }

    $sql = "UPDATE `device_information` SET  `device_Name`= ?, `cotton_Name`= ?, `device_Access`= ?, `device_Date`= ?, `device_Price`= ?, `device_Other`= ?, `device_Image`= ?,WHERE `device_Numder` = ?";
    $stmt = $conn->prepare($sql);

    // if (!empty($_FILES['device_Image']['name'])) {
    //     $targetDir = "../connect/equipment/equipment/img/";
    //     $device_Image = time() . "_" . basename($_FILES['device_Image']['name']);
    //     $targetFilePath = $targetDir . $device_Image;

    //     if (!move_uploaded_file($_FILES['device_Image']['tmp_name'], $targetFilePath)) {
    //         echo "<script>alert('เกิดข้อผิดพลาดในการอัปโหลดไฟล์รูปภาพ'); window.history.back();</script>";
    //         exit();
    //     }
    // } else {

    //     $device_Image = isset($_POST['current_Image']) ? $_POST['current_Image'] : '';
    // }


    if ($stmt) {

        $stmt->bind_param("ssssssisii", $device_Name, $device_Date, $device_Price, $device_Other, $device_Image, $device_Access, $device_Con, $useripass, $cotton_Id, $device_Numder);

        if ($stmt->execute()) {
            // หากการอัปเดตสำเร็จ
            echo "<script>alert('อัปเดตข้อมูลสำเร็จ'); location.href = '../../pages/admin_equipment.php';</script>";
        } else {
            // หากเกิดข้อผิดพลาดในการอัปเดต
            echo "<script>alert('เกิดข้อผิดพลาด: {$stmt->error}'); window.history.back();</script>";
        }
        $stmt->close();
    } else {
        // หากไม่สามารถเตรียมคำสั่ง SQL ได้
        echo "<script>alert('เกิดข้อผิดพลาดในการเตรียมคำสั่ง: {$conn->error}'); window.history.back();</script>";
    }
} else {
    // หากข้อมูลที่ส่งมาครบไม่ถูกต้อง
    echo "<script>alert('ข้อมูลไม่ครบถ้วน'); window.history.back();</script>";
}

$conn->close();
?>