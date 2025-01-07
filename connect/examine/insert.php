<?php
include "../mysql_borrow.php";  // เชื่อมต่อฐานข้อมูล

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // รับค่าจากฟอร์ม
    $approval = isset($_POST['approval']) ? $_POST['approval'] : null;
    $note_Other = isset($_POST['note_Other']) ? $_POST['note_Other'] : '';

    // ตรวจสอบค่าที่ได้รับ
    if ($approval === '1') {
        $history_Status_BRS = 1; // สถานะอนุมัติ
        echo "อนุมัติ (1) พร้อมหมายเหตุ: " . htmlspecialchars($note_Other);
    } elseif ($approval === '2') {
        $history_Status_BRS = 2; // สถานะไม่อนุมัติ
        echo "ไม่อนุมัติ (2) พร้อมหมายเหตุ: " . htmlspecialchars($note_Other);
    } else {
        echo "กรุณาเลือกการอนุมัติหรือไม่อนุมัติ";
        exit;
    }

    // การเตรียมการ SQL statement สำหรับบันทึกลงในฐานข้อมูล
    $sql = "INSERT INTO history_brs (approval_status, note_Other, history_Status_BRS) VALUES (?, ?, ?)";
    if ($stmt = $conn->prepare($sql)) {
        // ผูกค่ากับตัวแปร
        $stmt->bind_param("isi", $approval, $note_Other, $history_Status_BRS);

        // Execute the query
        if ($stmt->execute()) {
            echo "บันทึกข้อมูลเรียบร้อย";
        } else {
            echo "เกิดข้อผิดพลาดในการบันทึกข้อมูล: " . $stmt->error;
        }

        // ปิดคำสั่ง
        $stmt->close();
    } else {
        echo "เกิดข้อผิดพลาดในการเตรียมคำสั่ง SQL: " . $conn->error;
    }
}

$conn->close();  // ปิดการเชื่อมต่อฐานข้อมูล
?>