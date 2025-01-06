<?php
include '../mysql_borrow.php';
session_start();

$history_Borrow = isset($_POST['history_Borrow']) ? $_POST['history_Borrow'] : '';
$history_Return = isset($_POST['history_Return']) ? $_POST['history_Return'] : '';
$history_Stop = isset($_POST['history_Stop']) ? $_POST['history_Stop'] : '';
$history_Other = isset($_POST['history_Other']) ? $_POST['history_Other'] : '';
$history_Another = isset($_POST['history_Another']) ? $_POST['history_Another'] : '';
$history_device = isset($_POST['device_Name']) ? $_POST['device_Name'] : '';
$parcel_Numder = isset($_POST['device_Numder']) ? $_POST['device_Numder'] : '';
$history_Status = isset($_POST['history_Status']) ? $_POST['history_Status'] : '';
$cotton_Id = isset($_POST['cotton_Id']) ? $_POST['cotton_Id'] : '';

// ตรวจสอบค่าผู้ใช้
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

// ดึงค่า device_Con จากตาราง device_information
$sql_device_con = "SELECT device_Con FROM borrow.device_information WHERE device_Name = ?";
$stmt_device_con = $conn->prepare($sql_device_con);
$stmt_device_con->bind_param("s", $history_device);
$stmt_device_con->execute();
$result_device_con = $stmt_device_con->get_result();

if ($result_device_con->num_rows > 0) {
    $row = $result_device_con->fetch_assoc();
    $device_Con = $row['device_Con'];
} else {
    $device_Con = ''; // กรณีไม่พบข้อมูล
}
$stmt_device_con->close();

// ตรวจสอบจำนวนการยืม
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

// หากสถานะการยืม คือ 1 (ยืม) เราจะต้องอัปเดตสถานะของอุปกรณ์ในตาราง device_information ให้เป็น 1 (ไม่ว่าง)
if ($history_Status == '1') {
    $sql_update_status = "UPDATE device_information SET device_Status = '1' WHERE device_Name = ?";
    $stmt_update_status = $conn->prepare($sql_update_status);
    $stmt_update_status->bind_param("s", $history_device);
    $stmt_update_status->execute();
    $stmt_update_status->close();
}

// หากสถานะการยืม คือ 2 (คืน) เราจะต้องอัปเดตสถานะของอุปกรณ์ในตาราง device_information ให้เป็น 2 (ว่าง)
if ($history_Status == '2') {
    $sql_update_status = "UPDATE device_information SET device_Status = '2' WHERE device_Name = ?";
    $stmt_update_status = $conn->prepare($sql_update_status);
    $stmt_update_status->bind_param("s", $history_device);
    $stmt_update_status->execute();
    $stmt_update_status->close();
}

// บันทึกข้อมูลลงใน history_brs รวมทั้ง device_Con
$stmt = $conn->prepare("INSERT INTO history_brs 
    (history_Borrow, history_Return, history_Stop, history_Other, history_Another, user_Id, history_device, parcel_Numder, history_Numder, history_Status, device_Con, cotton_Id) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

$stmt->bind_param(
    "ssssssssssss", // ปรับการ bind param ให้ตรงกับจำนวนคอลัมน์
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
    $device_Con,
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
