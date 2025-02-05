<?php
include '../mysql_borrow.php';

// รับค่า officerl_Id จาก POST
if (isset($_POST['officerl_Id']) && isset($_POST['officer_Right']) && isset($_POST['officer_Cotton'])) {
    $officerl_Id = $_POST['officerl_Id'];
    $officer_Right = $_POST['officer_Right'];
    $officer_Cotton = $_POST['officer_Cotton'];

    // ตรวจสอบข้อมูลที่ได้รับ
    if (empty($officerl_Id) || empty($officer_Right) || empty($officer_Cotton)) {
        echo "<script>alert('กรุณากรอกข้อมูลให้ครบถ้วน'); window.history.back();</script>";
        exit();
    }

    // ใช้ Prepared Statement เพื่อป้องกัน SQL Injection
    $sql = "UPDATE `officer_staff` SET `officer_Right` = ?, `officer_Cotton` = ? WHERE `officerl_Id` = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        // ผูกค่ากับคำสั่ง SQL
        $stmt->bind_param("ssi", $officer_Right, $officer_Cotton, $officerl_Id);

        // ดำเนินการอัปเดต
       
if ($stmt->execute()) {
    echo "success"; // ส่งค่ากลับให้ AJAX
} else {
    echo "เกิดข้อผิดพลาด: " . $stmt->error;
}

        // ปิดการเตรียมคำสั่ง
        $stmt->close();
    } else {
        echo "<script>alert('เกิดข้อผิดพลาดในการเตรียมคำสั่ง SQL: {$conn->error}'); window.history.back();</script>";
    }
} else {
    echo "<script>alert('ไม่พบข้อมูลที่ต้องการอัปเดต'); window.history.back();</script>";
}

// ปิดการเชื่อมต่อ
$conn->close();
?>