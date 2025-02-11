<?php
session_start(); // เริ่มต้นเซสชัน

// ลบข้อมูลเซสชันทั้งหมด
session_unset();

// ทำลายเซสชัน
session_destroy();

// เปลี่ยนเส้นทางไปยังหน้า login
header("Location:  ../satit_borrow/index.php"); // เปลี่ยนเส้นทางไปหน้า login
exit(); // หยุดการทำงานของสคริปต์
?>