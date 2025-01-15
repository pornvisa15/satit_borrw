<?php
include '../mysql_borrow.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $history_Id = $_POST['history_Id'] ?? null;
    $history_Status_BRS = $_POST['history_Status_BRS'] ?? null;
    $device_Con = $_POST['device_Con'] ?? null;
    $note_Other = $_POST['note_Other'] ?? null;
    $htime_Return = $_POST['htime_Return'] ?? null;
    $history_Status = $_POST['history_Status'] ?? null;
    $tool_Other = $_POST['tool_Other'] ?? null;

    // ตรวจสอบข้อมูลที่จำเป็น
    if (!$history_Id) {
        echo "<script>alert('ข้อมูลไม่ครบถ้วน'); window.history.back();</script>";
        exit;
    }

    // คำสั่ง SQL
    $sql = "UPDATE borrow.history_brs 
            SET device_Con = ?, 
                note_Other = ?, 
                htime_Return = ?, 
                history_Status = ?, 
                tool_Other = ? 
            WHERE history_Id = ?"; // แก้ไขที่ตรงนี้

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("sssssi", $device_Con, $note_Other, $htime_Return, $history_Status, $tool_Other, $history_Id);

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