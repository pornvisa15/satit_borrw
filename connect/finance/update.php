<?php
include '../../connect/myspl_das_satit.php';
include '../../connect/mysql_borrow.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $finance_Id = $_POST['finance_Id'];
    $cotton_Id = $_POST['cotton_Id'];
    $useripass = $_POST['useripass'] ?? '';  // User IP pass
    
    // Check if an old image exists, else empty string
    $device_Image = isset($_POST['finance_Image_hidden']) ? $_POST['finance_Image_hidden'] : '';

    // If a new image is uploaded, replace the old image
    if ($_FILES['finance_Image']['error'] == 0) {
        // Get the new image name
        $device_Image = $_FILES['finance_Image']['name'];
        $target_dir = "../../connect/finance/finance/img/";

        // Get the file extension to ensure proper file type
        $file_extension = pathinfo($device_Image, PATHINFO_EXTENSION);
        $allowedTypes = ['jpeg', 'jpg', 'png', 'gif'];

        // Check file type and move the uploaded file to the target directory
        if (in_array(strtolower($file_extension), $allowedTypes)) {
            $target_file = $target_dir . basename($device_Image);
            if (move_uploaded_file($_FILES['finance_Image']['tmp_name'], $target_file)) {
                echo "File uploaded successfully.";
            } else {
                echo "<script>alert('ไม่สามารถอัปโหลดไฟล์'); location.href = '../../pages/admin_finance.php';</script>";
                exit;
            }
        } else {
            echo "<script>alert('ประเภทไฟล์ไม่ถูกต้อง'); location.href = '../../pages/admin_finance.php';</script>";
            exit;
        }
    }

    // Prepare the SQL query to update the finance record
    $sql = "UPDATE borrow.finance SET cotton_Id = ?, finance_Image = ?, useripass = ? WHERE finance_Id = ?";
    $stmt = $conn->prepare($sql);

    // Ensure useripass and other data are properly passed
    $stmt->bind_param('sssi', $cotton_Id, $device_Image, $useripass, $finance_Id);

    // Execute the query and check for success
    if ($stmt->execute()) {
        echo "<script>alert('บันทึกการแก้ไขเรียบร้อย'); location.href = '../../pages/admin_finance.php';</script>";
    } else {
        echo "<script>alert('เกิดข้อผิดพลาด: " . $stmt->error . "'); location.href = '../../pages/admin_finance.php';</script>";
    }

    // Close the prepared statement
    $stmt->close();
}
?>
