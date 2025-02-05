<?php
include '../mysql_borrow.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $finance_Id = isset($_POST['finance_Id']) ? intval($_POST['finance_Id']) : 0;

    if ($finance_Id > 0) {
        $stmt = $conn->prepare("DELETE FROM `finance` WHERE finance_Id = ?");
        $stmt->bind_param("i", $finance_Id);

        if ($stmt->execute()) {
            echo json_encode(["status" => "success", "message" => "ลบข้อมูลสำเร็จ"]);
        } else {
            echo json_encode(["status" => "error", "message" => "เกิดข้อผิดพลาดในการลบ"]);
        }

        $stmt->close();
    } else {
        echo json_encode(["status" => "error", "message" => "finance_Id ไม่ถูกต้อง"]);
    }

    $conn->close();
} else {
    echo json_encode(["status" => "error", "message" => "Method ไม่ถูกต้อง"]);
}
?>
