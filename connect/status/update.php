<?php
include '../mysql_borrow.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['device_Id'])) {
    $device_Id = $_POST['device_Id'];

    // เปลี่ยนสถานะจาก 7 เป็น 1 (สภาพปกติ)
    $sql = "UPDATE borrow.history_brs SET hreturn_Status = 1 WHERE device_Id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $device_Id);

    if ($stmt->execute()) {
        echo "success"; // ส่งข้อความกลับไปที่ JavaScript
    } else {
        echo "error"; // แจ้งว่าการอัปเดตล้มเหลว
    }

    $stmt->close();
    $conn->close();
}
?>