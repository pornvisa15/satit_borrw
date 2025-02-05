<?php
include '../mysql_borrow.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['device_Id'])) {
    $device_Id = $_POST['device_Id'];

    // ใช้ Prepared Statement เพื่อป้องกัน SQL Injection
    $sql = "DELETE FROM `device_information` WHERE device_Id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $device_Id);

    if ($stmt->execute()) {
        echo "success"; // ส่งข้อความ 'success' กลับไปยัง JavaScript
    } else {
        echo "เกิดข้อผิดพลาด: " . addslashes($conn->error);
    }

    $stmt->close();
    $conn->close();
} else {
    echo "ไม่ได้รับค่า device_Id";
}
?>
