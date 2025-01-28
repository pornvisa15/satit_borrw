<?php
include '../mysql_borrow.php';
session_start();

$device_Id = isset($_POST['device_Id']) ? $_POST['device_Id'] : '';
$history_Borrow = isset($_POST['history_Borrow']) ? $_POST['history_Borrow'] : '';
$history_Return = isset($_POST['history_Return']) ? $_POST['history_Return'] : '';
$history_Stop = isset($_POST['history_Stop']) ? $_POST['history_Stop'] : '';
$history_Other = isset($_POST['history_Other']) ? $_POST['history_Other'] : '';
$history_Another = isset($_POST['history_Another']) ? $_POST['history_Another'] : '';
$history_device = isset($_POST['device_Name']) ? $_POST['device_Name'] : '';
$parcel_Numder = isset($_POST['device_Numder']) ? $_POST['device_Numder'] : '';
$history_Status = isset($_POST['history_Status']) ? $_POST['history_Status'] : '';
$officer_Cotton = isset($_POST['officer_Cotton']) ? $_POST['officer_Cotton'] : '';
$history_Status_BRS = isset($_POST['history_Status_BRS']) ? $_POST['history_Status_BRS'] : '';
$hreturn_Status = isset($_POST['hreturn_Status']) ? $_POST['hreturn_Status'] : '';

// ตรวจสอบว่าผู้ใช้ล็อกอินแล้วหรือยัง และกำหนดค่า user_Id
if (isset($_SESSION['std_name']) && isset($_SESSION['std_surname'])) {
    $user_Id = $_SESSION['std_name'] . " " . $_SESSION['std_surname'];
} elseif (isset($_SESSION['name']) && isset($_SESSION['surname'])) {
    $user_Id = $_SESSION['name'] . " " . $_SESSION['surname'];
} else {
    $user_Id = '';
}

// ตรวจสอบว่ามีการส่งชื่ออุปกรณ์มา
if (empty($history_device)) {
    echo "<script>alert('Error: Missing device name.'); history.back();</script>";
    exit;
}

// ตรวจสอบจำนวนครั้งที่ยืมอุปกรณ์นี้
$sql_check = "SELECT COUNT(*) AS borrow_count FROM history_brs WHERE history_device = ?";
$stmt_check = $conn->prepare($sql_check);
$stmt_check->bind_param("s", $history_device);
$stmt_check->execute();
$result_check = $stmt_check->get_result();

if ($result_check) {
    $row = $result_check->fetch_assoc();
    $history_Numder = $row['borrow_count'] + 1;
} else {
    $history_Numder = 1;
}
$stmt_check->close();

// ตรวจสอบว่ามีการยืมในวันที่ซ้ำกันหรือไม่
$sql_date_check = "
    SELECT COUNT(*) AS date_count 
    FROM history_brs 
    WHERE device_Id = ? AND history_Borrow = ? AND history_Return = ?";
$stmt_date_check = $conn->prepare($sql_date_check);
$stmt_date_check->bind_param("sss", $device_Id, $history_Borrow, $history_Return);
$stmt_date_check->execute();
$result_date_check = $stmt_date_check->get_result();

if ($result_date_check) {
    $row_date_check = $result_date_check->fetch_assoc();
    if ($row_date_check['date_count'] > 0) {
        echo "<script>alert('Error: This device is already borrowed on the specified dates.'); history.back();</script>";
        exit;
    }
}
$stmt_date_check->close();

// กำหนดสถานะการยืม/คืน
if ($history_Status === '1') {
    $device_Con = '1'; // ยืม
} elseif ($history_Status === '2') {
    $device_Con = '2'; // คืน
} else {
    $device_Con = '0'; // ค่าเริ่มต้น (สถานะไม่มีการยืม/คืน)
}

// บันทึกข้อมูลลงฐานข้อมูล
$stmt = $conn->prepare("INSERT INTO history_brs 
    (device_Id, history_Borrow, history_Return, history_Stop, history_Other, history_Another, user_Id, history_device, parcel_Numder, history_Numder, history_Status, officer_Cotton, device_Con, hreturn_Status,history_Status_BRS) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?, ?, 0)");

$stmt->bind_param(
    "ssssssssssiiii",  // เปลี่ยนเป็น "i" สำหรับตัวแปรที่เป็นตัวเลข
    $device_Id,
    $history_Borrow,
    $history_Return,
    $history_Stop,
    $history_Other,
    $history_Another,
    $user_Id,
    $history_device,
    $parcel_Numder,
    $history_Numder,
    $history_Status,
    $hreturn_Status,
    $officer_Cotton, // แก้ลำดับให้ถูกต้อง
    $device_Con
);

if ($stmt->execute()) {
    echo "<script>alert('บันทึกข้อมูลสำเร็จ'); location.href = '../../pages/homepages.php';</script>";
} else {
    echo "<script>alert('เกิดข้อผิดพลาด: " . $stmt->error . "'); location.href = '../../pages/reservation1_book_com.php';</script>";
}

$stmt->close();
$conn->close();
?>