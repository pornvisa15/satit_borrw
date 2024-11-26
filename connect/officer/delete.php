<?php
include '../mysql_borrow.php';

$officerl_Id = $_REQUEST['officerl_Id'];

// SQL สำหรับลบข้อมูล
$sql = "DELETE FROM `officer_staff` WHERE officerl_Id = '$officerl_Id'";

// ตรวจสอบผลลัพธ์
if ($conn->query($sql) === TRUE) {
    // ใช้ JavaScript เพื่อเปลี่ยนเส้นทาง
    echo "<script>
        alert('ลบข้อมูลสำเร็จ');
        window.location.href = '../../../satit_borrw/pages/admin_staffinfo.php';
    </script>";
} else {
    // แสดงข้อผิดพลาดในกรณีที่ลบไม่สำเร็จ
    echo "<script>
        alert('เกิดข้อผิดพลาด: " . $conn->error . "');
        window.location.href = '../../../satit_borrw/pages/admin_staffinfo.php';
    </script>";
}

// ปิดการเชื่อมต่อ
$conn->close();
?>
