<?php
include '../../connect/myspl_das_satit.php';
include '../../connect/mysql_borrow.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $finance_Id = $_POST['finance_Id'];
    $cotton_Id = $_POST['cotton_Id'];
    $device_Image = isset($_POST['finance_Image_hidden']) ? $_POST['finance_Image_hidden'] : '';

    if ($_FILES['finance_Image']['error'] == 0) {
        $device_Image = $_FILES['finance_Image']['name'];
        $target_dir = "../../connect/finance/finance/img/";
        $target_file = $target_dir . basename($device_Image);
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];

        if (in_array($_FILES['finance_Image']['type'], $allowedTypes)) {
            move_uploaded_file($_FILES['finance_Image']['tmp_name'], $target_file);
        } else {
            echo "<script>alert('ประเภทไฟล์ไม่ถูกต้อง'); location.href = '../../pages/admin_finance.php';</script>";
            exit;
        }
    }

    $sql = "UPDATE borrow.finance SET cotton_Id = ?, finance_Image = ? WHERE finance_Id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ssi', $cotton_Id, $device_Image, $finance_Id);

    if ($stmt->execute()) {
        echo "<script>alert('บันทึกการแก้ไขเรียบร้อย'); location.href = '../../pages/admin_finance.php';</script>";
    } else {
        echo "<script>alert('เกิดข้อผิดพลาด: " . $stmt->error . "'); location.href = '../../pages/admin_finance.php';</script>";
    }

    $stmt->close();
}
?>
