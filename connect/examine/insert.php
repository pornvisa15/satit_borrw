<?php
include '../mysql_borrow.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $history_Id = $_POST['history_Id'] ?? null;
    $history_Status_BRS = $_POST['history_Status_BRS'] ?? null;
    $device_Con = $_POST['device_Con'] ?? null;
    $note_Other = $_POST['note_Other'] ?? null;
    $borrowDate = $_POST['htime_Borrow'] ?? null;
    $returnDate = $_POST['htime_Return'] ?? null;
    $history_Status = $_POST['history_Status'] ?? null; // แก้ไขเพิ่มส่วนนี้

    // ตรวจสอบข้อมูลที่จำเป็น
    if (!$history_Id || !$history_Status_BRS || !$device_Con) {
        echo "<script>alert('ข้อมูลไม่ครบถ้วน'); window.history.back();</script>";
        exit;
    }

    // คำสั่ง SQL
    $sql = "UPDATE borrow.history_brs 
            SET device_Con = ?, 
                note_Other = ?, 
                history_Borrow = ?, 
                history_Return = ?, 
                history_Status = ? 
            WHERE history_Id = ?";

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("ssssii", $device_Con, $note_Other, $borrowDate, $returnDate, $history_Status, $history_Id);

        if ($stmt->execute()) {
            echo "<script>alert('บันทึกข้อมูลสำเร็จ'); window.location.href = '/satit_borrw/pages/admin_homepages.php';</script>";
        } else {
            echo "<script>alert('เกิดข้อผิดพลาด: " . $stmt->error . "'); window.history.back();</script>";
        }
        $stmt->close();
    } else {
        echo "<script>alert('เกิดข้อผิดพลาดในการเตรียมคำสั่ง SQL'); window.history.back();</script>";
    }

    $conn->close();
}
?>