<?php
include '../mysql_borrow.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $history_Id = $_POST['history_Id'] ?? null;
    $history_Status_BRS = $_POST['history_Status_BRS'] ?? null; // สถานภาพยืม/คืน 0=รออนุมัติ 1=อนุมัติ 2=ไม่อนุมัติ
    $device_Con = $_POST['device_Con'] ?? null; // ค่าสภาพให้เก็บไว้
    $note_Other = $_POST['note_Other'] ?? null; // รายละเอียด อนุมัติและไม่อนุมัติ
    $history_Status = $_POST['history_Status'] ?? null; // สถานภาพคืน 1=ยืม 2=คืน

    // ตรวจสอบข้อมูลที่จำเป็น
    if (!$history_Id) {
        echo "<script>alert('ข้อมูลไม่ครบถ้วน'); window.history.back();</script>";
        exit;
    }

    // คำสั่ง SQL
    $sql = "UPDATE borrow.history_brs 
            SET device_Con = ?, 
                note_Other = ?, 
                history_Status_BRS = ?, 
                history_Status = ? 
            WHERE history_Id = ?";

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("ssssi", $device_Con, $note_Other, $history_Status_BRS, $history_Status, $history_Id);
        
        if ($stmt->execute()) {
            header("Location: /satit_borrw/pages/admin_homepages.php");
            exit;
        } else {
            echo "<script>alert('เกิดข้อผิดพลาด: " . htmlspecialchars($stmt->error, ENT_QUOTES, 'UTF-8') . "'); window.history.back();</script>";
            exit;
        }

        $stmt->close();
    } else {
        echo "<script>alert('เกิดข้อผิดพลาดในการเตรียมคำสั่ง SQL'); window.history.back();</script>";
        exit;
    }

    $conn->close();
}
?>