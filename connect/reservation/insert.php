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

if (isset($_SESSION['std_name']) && isset($_SESSION['std_surname'])) {
    $user_Id = $_SESSION['std_name'] . " " . $_SESSION['std_surname'];
} elseif (isset($_SESSION['name']) && isset($_SESSION['surname'])) {
    $user_Id = $_SESSION['name'] . " " . $_SESSION['surname'];
} else {
    $user_Id = '';
}

if (empty($history_device)) {
    echo "<script>alert('Error: Missing device name.'); history.back();</script>";
    exit;
}

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

$sql_date_check = "
    SELECT COUNT(*) AS date_count 
    FROM history_brs 
    WHERE device_Id = ? 
    AND ((history_Borrow <= ? AND history_Return >= ?) 
    OR (history_Borrow <= ? AND history_Return >= ?))";
$stmt_date_check = $conn->prepare($sql_date_check);
$stmt_date_check->bind_param("sssss", $device_Id, $history_Borrow, $history_Borrow, $history_Return, $history_Return);
$stmt_date_check->execute();
$result_date_check = $stmt_date_check->get_result();

if ($result_date_check) {
    $row_date_check = $result_date_check->fetch_assoc();
    if ($row_date_check['date_count'] > 0) {
        echo "<script>alert('ข้อผิดพลาด: อุปกรณ์นี้ถูกยืมในวันที่ที่ระบุแล้ว'); history.back();</script>";

        exit;
    }
}
$stmt_date_check->close();

if ($history_Status === '1') {
    $device_Con = '1'; 
} elseif ($history_Status === '2') {
    $device_Con = '2'; 
} else {
    $device_Con = '0'; 
}

$stmt = $conn->prepare("INSERT INTO history_brs 
    (device_Id, history_Borrow, history_Return, history_Stop, history_Other, history_Another, user_Id, history_device, parcel_Numder, history_Numder, history_Status, officer_Cotton, device_Con, hreturn_Status, history_Status_BRS) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 0)");

$stmt->bind_param(
    "ssssssssssisss", // แก้ไขให้ตรงกับจำนวนพารามิเตอร์
    $device_Id,        // s
    $history_Borrow,   // s
    $history_Return,   // s
    $history_Stop,     // s
    $history_Other,    // s
    $history_Another,  // s
    $user_Id,          // s
    $history_device,   // s
    $parcel_Numder,    // s
    $history_Numder,   // i (จำนวนครั้งที่ยืม)
    $history_Status,   // i
    $officer_Cotton,   // s
    $device_Con,       // s
    $hreturn_Status    // s
);

if ($stmt->execute()) {
    echo "<script>alert('บันทึกข้อมูลสำเร็จ'); location.href = '../../pages/homepages.php';</script>";
} else {
    echo "<script>alert('เกิดข้อผิดพลาด: " . $stmt->error . "'); location.href = '../../pages/reservation1_book_com.php';</script>";
}

$stmt->close();
$conn->close();
?>
