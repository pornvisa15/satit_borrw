<?php
include '../mysql_borrow.php';
header('Content-Type: application/json'); // บอกเซิร์ฟเวอร์ว่าเราส่ง JSON กลับไป

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // อ่านข้อมูล JSON ที่ส่งมา
    $data = json_decode(file_get_contents('php://input'), true);

    if (isset($data['device_Id']) && isset($data['new_status'])) {
        $device_Id = $data['device_Id'];
        $new_status = $data['new_status'];

        // ตรวจสอบว่า device_Id มีอยู่ในฐานข้อมูล
        $sql = "SELECT * FROM satit_borrow.history_brs WHERE device_Id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $device_Id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // อัปเดตสถานะ
            $update_sql = "UPDATE satit_borrow.history_brs SET hreturn_Status = ? WHERE device_Id = ?";
            $update_stmt = $conn->prepare($update_sql);
            $update_stmt->bind_param("is", $new_status, $device_Id);

            if ($update_stmt->execute()) {
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false, 'message' => 'ไม่สามารถอัปเดตสถานะได้']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'ไม่พบ device_Id ที่ระบุ']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'ข้อมูลไม่ครบถ้วน']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'รองรับเฉพาะคำขอ POST']);
}
?>
