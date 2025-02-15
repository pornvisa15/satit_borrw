<?php
include '../mysql_borrow.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // รับค่าที่ส่งมาจากฟอร์ม
    $history_Id = $_POST['history_Id'] ?? null;
    $device_Con = $_POST['device_Con'] ?? null; // ค่าสภาพ
    $htime_Return = $_POST['htime_Return'] ?? null; // วันที่คืนของ
    $history_Status = $_POST['history_Status'] ?? null; // สถานภาพคืน 1=ยืม 2=คืน
    $tool_Other = $_POST['tool_Other'] ?? null; // รายละเอียดสถานะการชำรุด
    $history_Status_BRS = $_POST['history_Status_BRS'] ?? null; // สถานภาพยืม/คืน
    $money = $_POST['money'] ?? 0; // จำนวนเงิน
    $money_time = $_POST['money_time'] ?? 0; // จำนวนเงินค่าปรับ
    $hreturn_Status = $_POST['hreturn_Status'] ?? null; // สถานภาพคืน

    // ตรวจสอบข้อมูลที่จำเป็น
    if (!$history_Id) {
        echo "<script>alert('ข้อมูลไม่ครบถ้วน กรุณาตรวจสอบอีกครั้ง'); window.history.back();</script>";
        exit;
    }

    // สร้างคำสั่ง SQL
    $sql = "UPDATE satit_borrow.history_brs 
            SET device_Con = ?, 
                htime_Return = ?, 
                history_Status = ?, 
                tool_Other = ?, 
                history_Status_BRS = ?, 
                money = ?, 
                money_time = ?, 
                hreturn_Status = ? 
            WHERE history_Id = ?";

    // เตรียมการดำเนินการ SQL
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param(
            "sssiiissi",
            $device_Con,
            $htime_Return,
            $history_Status,
            $tool_Other,
            $history_Status_BRS,
            $money,
            $money_time,
            $hreturn_Status,
            $history_Id
        );

        if ($stmt->execute()) {
            // ค้นหา finance_Image จาก officer_Cotton
            $sql2 = "SELECT f.finance_Image
                     FROM satit_borrow.finance f
                     JOIN satit_borrow.history_brs h ON f.officer_Cotton = h.officer_Cotton
                     WHERE h.history_Id = ?";
            $stmt2 = $conn->prepare($sql2);
            $stmt2->bind_param("i", $history_Id);
            $stmt2->execute();
            $result2 = $stmt2->get_result();

            if ($result2->num_rows > 0) {
                $row2 = $result2->fetch_assoc();
                $finance_Image = $row2['finance_Image'];

                echo "<td colspan='2' class='text-center' style='padding-top: 10px;'>";
                echo "<img src='../connect/addqr/img/" . htmlspecialchars($finance_Image) . "' 
                     alt='Finance Image' class='img-fluid shadow rounded-3 border border-primary' 
                     style='width: 200px; height: auto; margin-top: 8px;'>";
                echo "</td>";
            }

            $stmt2->close();
            echo "<script>window.location.href = '../../pages/admin_homepages.php';</script>";
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