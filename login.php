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
        echo "กรุณาใส่ Username และ Password";
        exit;
    }

    // ป้องกัน SQL Injection
    $user = $conn->real_escape_string($user);
    $pass = $conn->real_escape_string($pass);

    // สอบถามข้อมูลจากฐานข้อมูล
    $sql1 = "SELECT * FROM studentsatit.detail_std WHERE std_id = '$user' AND std_ipasspass = '$pass'";
    $result1 = $conn->query($sql1);

    // ตรวจสอบผลลัพธ์
    if ($result1 && $result1->num_rows == 1) {
        $row = $result1->fetch_assoc();  // ใช้ $result1 แทน $result

        // ตั้งค่า session
        $_SESSION['std_name'] = $row['std_name'];       
        $_SESSION['std_surname'] = $row['std_ipasspass']; // ใช้ข้อมูลจาก std_ipasspass
        $_SESSION['priv'] = 2;                          // ตั้งค่าสิทธิ์

        // เปลี่ยนหน้าไปยัง homepages.php
        header("Location: pages/homepages.php");
        ob_end_flush(); // ปิด output buffering
        exit;
    
}


    $sql2 = "SELECT * FROM das_satit.das_admin WHERE useripass = '$user'";
    $result2 = $conn->query($sql2);

    if ($result2 && $result2->num_rows == 1) {  // แก้ไขตรวจสอบ num_rows == 1
        $row2 = $result2->fetch_assoc();  // ใช้ $result2 แทน $result

        // ตั้งค่า session
        $_SESSION['name'] = $row2['name'];  // ใช้ $row2
        $_SESSION['surname'] = $row2['surname'];  // ใช้ $row2
        $_SESSION['priv'] = 1;

        // เปลี่ยนหน้าไปยัง homepages.php
        header("Location: pages/homepages.php");
        ob_end_flush(); // ปิด output buffering
        exit;
    }

    
    $sql3 = "SELECT * FROM borrow.officer_staff WHERE useripass = '$user' AND officer_staff = '$pass'";
    $result3 = $conn->query($sql3);

    // ตรวจสอบผลลัพธ์
    if ($result3 && $result3->num_rows == 1) {
        $row = $result3->fetch_assoc();

        // ตั้งค่า session
        $_SESSION['useripass'] = $row['useripass'];
        $_SESSION['useripas'] = $row['useripas'];
        $_SESSION['priv'] = 3;

        header("Location: pages/admin_homepages.php");
        ob_end_flush(); // ปิด output buffering
        exit;
    }

    

    // หากไม่พบข้อมูล
    echo "<script>alert('Username หรือ Password ไม่ถูกต้อง'); window.location.href = 'index.php';</script>";
    exit;

    // ปิดการเชื่อมต่อฐานข้อมูล








}
?>