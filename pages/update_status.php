<?php
// เชื่อมต่อกับฐานข้อมูล
include "../connect/myspl_das_satit.php";


if (isset($_POST['device_Id'])) {
    $deviceId = $_POST['device_Id'];

    // ตรวจสอบว่า device_Id ถูกส่งมาหรือไม่
    if (empty($deviceId)) {
        echo "device_Id ไม่ถูกส่งมา";
        exit;
    }

    // คำสั่ง SQL เพื่ออัปเดตสถานะจาก 7 เป็น 0
    $sqlUpdate = "UPDATE satit_borrow.history_brs SET hreturn_Status = 0 WHERE device_Id = ? AND hreturn_Status = 7";

    // เตรียมคำสั่ง SQL
    if ($stmt = $conn->prepare($sqlUpdate)) {
        $stmt->bind_param("s", $deviceId); // ใช้ s สำหรับ string ถ้า device_Id เป็นข้อความ

        if ($stmt->execute()) {
            // หากการอัปเดตสำเร็จ ให้ลบข้อมูลที่มี hreturn_Status = 0
            $sqlDelete = "DELETE FROM satit_borrow.history_brs WHERE device_Id = ? AND hreturn_Status = 0";
            if ($deleteStmt = $conn->prepare($sqlDelete)) {
                $deleteStmt->bind_param("s", $deviceId);

                if ($deleteStmt->execute()) {
                    echo "ข้อมูลถูกลบเรียบร้อยแล้ว";
                } else {
                    echo "เกิดข้อผิดพลาดในการลบข้อมูล: " . $deleteStmt->error;
                }
                $deleteStmt->close();
            }
        } else {
            echo "เกิดข้อผิดพลาดในการเปลี่ยนสถานะ: " . $stmt->error;
        }

        // ปิดคำสั่ง SQL
        $stmt->close();
    } else {
        echo "เตรียมคำสั่ง SQL ไม่สำเร็จ";
    }
}

// ปิดการเชื่อมต่อ
$conn->close();
?>
