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
$cotton_Id = isset($_POST['cotton_Id']) ? $_POST['cotton_Id'] : '';

if (isset($_SESSION['std_name']) && isset($_SESSION['std_surname'])) {
    $user_Id = $_SESSION['std_name'] . " " . $_SESSION['std_surname'];
} elseif (isset($_SESSION['name']) && isset($_SESSION['surname'])) {
    $user_Id = $_SESSION['name'] . " " . $_SESSION['surname'];
} else {
    $user_Id = '';
}

if (empty($history_device)) {
    echo "Error: Missing device name.";
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


if ($history_Status === '1') {
    $device_Con = '1'; // ยืม
} elseif ($history_Status === '2') {
    $device_Con = '2'; // คืน
} else {
    $device_Con = '0'; // ค่าเริ่มต้น (สถานะไม่มีการยืม/คืน)
}

$stmt = $conn->prepare("INSERT INTO history_brs 
    (device_Id, history_Borrow, history_Return, history_Stop, history_Other, history_Another, user_Id, history_device, parcel_Numder, history_Numder, history_Status, cotton_Id,device_Con) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,0)");

$stmt->bind_param(
    "ssssssssssss",
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

    $cotton_Id
);

if ($stmt->execute()) {
    echo "<script>alert('บันทึกข้อมูลสำเร็จ'); location.href = '../../pages/homepages.php';</script>";
} else {
    echo "<script>alert('เกิดข้อผิดพลาด: " . $stmt->error . "'); location.href = '../../pages/reservation1_book_com.php';</script>";
}

$stmt->close();
$conn->close();
?>