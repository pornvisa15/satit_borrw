<?php
include '../mysql_borrow.php';

$device_Numder = $_REQUEST['device_Numder'];

// SQL สำหรับลบข้อมูล
$sql = "DELETE FROM `device_information` WHERE officerl_Id = '$device_Numder'";

// ตรวจสอบผลลัพธ์
if ($conn->query($sql) === TRUE) {
    // ใช้ JavaScript เพื่อเปลี่ยนเส้นทาง
    echo "<script>
        alert('ลบข้อมูลสำเร็จ');
        window.location.href = '../../../satit_borrw/pages/admin_equipment.php';
    </script>";
} else {
    // แสดงข้อผิดพลาดในกรณีที่ลบไม่สำเร็จ
    echo "<script>
        alert('เกิดข้อผิดพลาด: " . $conn->error . "');
        window.location.href = '../../../satit_borrw/pages/admin_equipment.php';
    </script>";
}

// ปิดการเชื่อมต่อ
$conn->close();
?>