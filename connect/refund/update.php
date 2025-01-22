<?php
include '../mysql_borrow.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $history_Id = $_POST['history_Id'] ?? null;
    $device_Con = $_POST['device_Con'] ?? null; // ค่าสภาพ
    $htime_Return = $_POST['htime_Return'] ?? null; // วันที่คืนของ
    $history_Status = $_POST['history_Status'] ?? null; // สถานภาพคืน 1=ยืม 2=คืน
    $tool_Other = $_POST['tool_Other'] ?? null; // รายละเอียดสถานะการชำรุด
    $history_Status_BRS = $_POST['history_Status_BRS'] ?? null; // สถานภาพยืม/คืน
    $money = $_POST['money'] ?? null;
    $hreturn_Status = $_POST['hreturn_Status'] ?? null;

    // ตรวจสอบข้อมูลที่จำเป็น
    if (!$history_Id) {
        echo "<script>alert('ข้อมูลไม่ครบถ้วน'); window.history.back();</script>";
        exit;
    }

    // คำสั่ง SQL
    $sql = "UPDATE borrow.history_brs 
            SET device_Con = ?, 
                htime_Return = ?, 
                history_Status = ?, 
                tool_Other = ?, 
                history_Status_BRS = ?, 
                money = ?, 
                hreturn_Status = ? 
            WHERE history_Id = ?";

    if ($stmt = $conn->prepare($sql)) {
        // ตรวจสอบจำนวนตัวแปรใน bind_param ให้ตรงกับ SQL
        $stmt->bind_param(
            "ssssiisi", 
            $device_Con, 
            $htime_Return, 
            $history_Status, 
            $tool_Other, 
            $history_Status_BRS, 
            $money, 
            $hreturn_Status, 
            $history_Id
        );

        if ($stmt->execute()) {
            echo "<script>alert('บันทึกข้อมูลสำเร็จ'); window.location.href = '/satit_borrw/pages/admin_homepages.php';</script>";
        } else {
            echo "<script>alert('เกิดข้อผิดพลาด: " . $stmt->error . "'); window.history.back();</script>";
        }
        $stmt->close();
    } else {
        echo "<script>alert('เกิดข้อผิดพลาดในการเตรียมคำสั่ง SQL: " . $conn->error . "'); window.history.back();</script>";
    }

    $conn->close();
}
?>
