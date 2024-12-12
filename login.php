<?php
// เริ่ม session เพื่อเก็บข้อมูลการ login
ob_start(); // เปิดการใช้งาน output buffering
session_start();

include 'connect/mysql_studentsatit.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // รับค่าจากฟอร์ม
    $user = trim($_POST['username']);
    $pass = trim($_POST['password']);

    // ตรวจสอบว่าค่าที่ได้รับไม่ว่าง
    if (empty($user) || empty($pass)) {
        echo "<script>alert('กรุณาใส่ Username และ Password'); window.location.href = 'index.php';</script>";
        exit;
    }

    // ป้องกัน SQL Injection
    $user = $conn->real_escape_string($user);
    $pass = $conn->real_escape_string($pass);

    // สอบถามข้อมูลจากฐานข้อมูล นักเรียน
    $sql1 = "SELECT * FROM studentsatit.detail_std WHERE std_id = '$user' AND std_ipasspass = '$pass'";
    $result1 = $conn->query($sql1); 

    if ($result1 && $result1->num_rows == 1) {
        $row = $result1->fetch_assoc();

        // ตั้งค่า session สำหรับนักเรียน
        $_SESSION['std_name'] = $row['std_name'];
        $_SESSION['std_surname'] = $row['std_ipasspass'];
        $_SESSION['officer_Right'] = 1;  // สิทธิ์นักเรียน

        header("Location: pages/homepages.php");
        ob_end_flush();
        exit;
    }
    
    // สอบถามข้อมูลจากฐานข้อมูล แอดมิน
    $sql3 = "SELECT * FROM das_satit.das_admin INNER JOIN borrow.officer_staff on das_admin.useripass = officer_staff.useripass WHERE useripass = '$user' AND md5 = '$pass'";
    $result3 = $conn->query($sql3);

    if ($result3 && $result3->num_rows == 1) {
        $row = $result3->fetch_assoc();

        // ตั้งค่า session สำหรับแอดมิน
        $_SESSION['name'] = $row['name'];
        $_SESSION['surname'] = $row['md5'];
        $_SESSION['officer_Right'] = $row['officer_Right'];;  // สิทธิ์แอดมิน

        // เปลี่ยนเส้นทางไปยังหน้า admin_equipment สำหรับแอดมิน 
        header("Location: pages/admin_equipment.php");
        ob_end_flush();
        exit;
    }


    // สอบถามข้อมูลจากฐานข้อมูล บุคลากร
    $sql2 = "SELECT * FROM das_satit.das_admin WHERE useripass = '$user' AND md5 = '$pass'";
    $result2 = $conn->query($sql2);

    if ($result2 && $result2->num_rows == 1) {
        $row = $result2->fetch_assoc();

        // ตั้งค่า session สำหรับบุคลากร
        $_SESSION['name'] = $row['name'];
        $_SESSION['surname'] = $row['md5'];
        $_SESSION['officer_Right'] = 2;  // สิทธิ์บุคลากร

        // เปลี่ยนเส้นทางไปยังหน้า homepages ของบุคลากร
        header("Location: pages/homepages.php");
        ob_end_flush();
        exit;
    }

    // หากไม่พบข้อมูล
    echo "<script>alert('Username หรือ Password ไม่ถูกต้อง'); window.location.href = 'index.php';</script>";
    exit;
}

    // ปิดการเชื่อมต่อฐานข้อมูล
$conn->close();
?>

