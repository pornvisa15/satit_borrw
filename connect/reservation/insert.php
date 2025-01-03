<?php
include '../mysql_borrow.php';
session_start();

// ตรวจสอบค่าจาก POST และ SESSION
$history_Borrow = isset($_POST['history_Borrow']) ? $_POST['history_Borrow'] : '';
$history_Return = isset($_POST['history_Return']) ? $_POST['history_Return'] : '';
$history_Stop = isset($_POST['history_Stop']) ? $_POST['history_Stop'] : '';
$history_Other = isset($_POST['history_Other']) ? $_POST['history_Other'] : '';
$history_Another = isset($_POST['history_Another']) ? $_POST['history_Another'] : '';


// ตรวจสอบค่าผู้ใช้
if (isset($_SESSION['std_name']) && isset($_SESSION['std_surname'])) {
    $user_Id = $_SESSION['std_name'] . " " . $_SESSION['std_surname'];
} elseif (isset($_SESSION['name']) && isset($_SESSION['surname'])) {
    $user_Id = $_SESSION['name'] . " " . $_SESSION['surname'];
} else {
    $user_Id = ''; // ถ้าไม่มีข้อมูลผู้ใช้
}

echo "User ID: " . $user_Id;



$history_device = isset($_POST['device_Name']) ? $_POST['device_Name'] : '';
$parcel_Numder = isset($_POST['device_Numder']) ? $_POST['device_Numder'] : '';





// ใช้ Prepared Statement เพื่อป้องกัน SQL Injection
$stmt = $conn->prepare("INSERT INTO history_brs 
    (history_Borrow, history_Return, history_Stop, history_Other, history_Another, user_Id, history_device,parcel_Numder) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

// ผูกตัวแปรกับคำสั่ง SQL
$stmt->bind_param(
    "ssssssss",
    $history_Borrow,
    $history_Return,
    $history_Stop,
    $history_Other,
    $history_Another,
    $user_Id,
    $history_device,
    $parcel_Numder
    
);

// รันคำสั่ง SQL
if ($stmt->execute()) {
    echo "<script>alert('บันทึกข้อมูลสำเร็จ'); location.href = '../../pages/homepages.php';</script>";
} else {
    echo "<script>alert('เกิดข้อผิดพลาด: " . $stmt->error . "'); location.href = '../../pages/reservation1_book_com.php';</script>";
}

// ปิด statement และการเชื่อมต่อ
$stmt->close();
$conn->close();
?>
