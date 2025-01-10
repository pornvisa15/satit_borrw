<?php
include '../mysql_borrow.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // รับค่าจากฟอร์ม
    $device_Con = isset($_POST['device_Con']) ? intval($_POST['device_Con']) : null;
    $note_Other = isset($_POST['note_Other']) ? trim($_POST['note_Other']) : null;
    $history_Status_BRS = isset($_POST['history_Status_BRS']) ? $_POST['history_Status_BRS'] : null;
    $history_Id = isset($_POST['history_Id']) ? intval($_POST['history_Id']) : null;
    $borrowDate = isset($_POST['htime_Borrow']) ? $_POST['htime_Borrow'] : null;
    $returnDate = isset($_POST['htime_Return']) ? $_POST['htime_Return'] : null;

    // ตรวจสอบค่าที่จำเป็น
    if ($history_Id === null || !in_array($device_Con, [1, 2], true) || $history_Status_BRS === null) {
        echo "<script>alert('ข้อมูลไม่ครบถ้วนหรือไม่ถูกต้อง'); window.history.back();</script>";
        exit;
    }

    // คำสั่ง SQL สำหรับการบันทึกข้อมูลที่ได้มาจากฟอร์ม
    $sql = "UPDATE borrow.history_brs 
            SET history_Status_BRS = ?, 
                note_Other = ?, 
                htime_Borrow = IF(? = 'borrow', ?, NULL), 
                htime_Return = IF(? = 'return', ?, NULL) 
            WHERE history_Id = ?";

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("ssssssi", $history_Status_BRS, $note_Other, $history_Status_BRS, $borrowDate, $history_Status_BRS, $returnDate, $history_Id);

        if ($stmt->execute()) {
            echo "<script>alert('บันทึกข้อมูลสำเร็จ'); window.history.back();</script>";
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