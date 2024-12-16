<?php
// เริ่ม session เพื่อเก็บข้อมูลการ login
session_start();
ob_start(); // เปิดการใช้งาน output buffering

// รวมไฟล์เชื่อมต่อฐานข้อมูล
include 'connect/mysql_studentsatit.php';
include 'connect/mysql_borrow.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // รับค่าจากฟอร์ม
    $user = trim($_POST['username']);
    $pass = trim($_POST['password']);

    // ตรวจสอบว่าค่าที่ได้รับไม่ว่าง
    if (empty($user) || empty($pass)) {
        echo "<script>alert('กรุณาใส่ Username และ Password'); window.location.href = 'index.php';</script>";
        exit;
    }

    // นักเรียน
    $stmt1 = $conn->prepare("SELECT * FROM studentsatit.detail_std WHERE std_id = ? AND std_ipasspass = ?");
    $stmt1->bind_param("ss", $user, $pass);
    $stmt1->execute();
    $result1 = $stmt1->get_result();

    if ($result1 && $result1->num_rows == 1) {
        $row = $result1->fetch_assoc();
        $_SESSION['std_name'] = $row['std_name'];
        $_SESSION['std_surname'] = $row['std_ipasspass'];
        $_SESSION['officer_Right'] = 'student';

        header("Location: pages/homepages.php");
        exit;
    }

    // แอดมิน
    $stmt3 = $conn->prepare(
        "SELECT * FROM das_satit.das_admin 
         INNER JOIN borrow.officer_staff 
         ON das_admin.useripass = officer_staff.useripass 
         WHERE das_admin.useripass = ? AND das_admin.md5 = ?"
    );
    $stmt3->bind_param("ss", $user, $pass);
    $stmt3->execute();
    $result3 = $stmt3->get_result();

    if ($result3 && $result3->num_rows == 1) {
        $row = $result3->fetch_assoc();
        $_SESSION['name'] = $row['name'];
        $_SESSION['surname'] = $row['md5'];
        $_SESSION['officer_Right'] = 'officer_Right';

        header("Location: pages/admin_homepages.php");
        exit;
    }

    // บุคลากร
    $stmt2 = $conn->prepare("SELECT * FROM das_satit.das_admin WHERE useripass = ? AND md5 = ?");
    $stmt2->bind_param("ss", $user, $pass);
    $stmt2->execute();
    $result2 = $stmt2->get_result();

    if ($result2 && $result2->num_rows == 1) {
        $row = $result2->fetch_assoc();
        $_SESSION['name'] = $row['name'];
        $_SESSION['surname'] = $row['md5'];
        $_SESSION['officer_Right'] = 'staff';

        header("Location: pages/homepages.php");
        exit;
    }
     // เจ้าหน้าที่
     $stmt4 = $conn->prepare(
        "SELECT * FROM das_satit.das_admin 
         INNER JOIN borrow.officer_staff 
         ON das_admin.useripass = officer_staff.useripass 
         WHERE das_admin.useripass = ? AND das_admin.md5 = ?"
    );
    $stmt4->bind_param("ss", $user, $pass);
    $stmt4->execute();
    $result4 = $stmt4->get_result();

    if ($result4 && $result4->num_rows == 1) {   
        $row = $result4->fetch_assoc();
        $_SESSION['name'] = $row['name'];
        $_SESSION['surname'] = $row['md5'];
        $_SESSION['officer_Right'] = 'officer_Cotton';

        header("Location: pages/admin_homepages.php");
        exit;
    }

    // หากไม่พบข้อมูล
    echo "<script>alert('Username หรือ Password ไม่ถูกต้อง'); window.location.href = 'index.php';</script>";
    exit;
}

// ปิดการเชื่อมต่อฐานข้อมูล
$conn->close();
?> 