<?php
// เริ่ม session เพื่อเก็บข้อมูลการ login
ob_start(); // เปิดการใช้งาน output buffering
session_start();



// ตรวจสอบว่ามีการเชื่อมต่อฐานข้อมูลหรือไม่
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
    // $sql = "SELECT * FROM studentsatit.detail_std WHERE std_id = '$user' AND std_ipasspass = '$pass'";
     $sql = "SELECT * FROM studentsatit.detail_std WHERE std_id = '$user'";
    $result = $conn->query($sql);

    // ตรวจสอบผลลัพธ์
    if ($result && $result->num_rows == 1) {
        $row = $result->fetch_assoc();

        // ตั้งค่า session
        $_SESSION['std_name'] = $row['std_name'];
        $_SESSION['std_surname'] = $row['std_surname'];
        $_SESSION['priv'] = 2;

        // เปลี่ยนหน้าไปยัง homepages.php
        header("Location: pages/homepages.php");
        ob_end_flush(); // ปิด output buffering
        exit;
        
    } else {
        echo "<script>alert('Username หรือ Password ไม่ถูกต้อง'); window.location.href = 'login.html';</script>";
        exit;
    }

    // ปิดการเชื่อมต่อฐานข้อมูล








}
?>
