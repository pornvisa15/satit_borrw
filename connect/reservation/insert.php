<?php
include '../mysql_borrow.php';
session_start();

$user_Id = isset($_POST['user_Id']) ? $_POST['user_Id'] : '';
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
$htime_Return = isset($_POST['htime_Return']) ? $_POST['htime_Return'] : '';

if (isset($_SESSION['std_name']) && isset($_SESSION['std_surname'])) {
    $user_Id = $_SESSION['std_name'] . " " . $_SESSION['std_surname'];
} elseif (isset($_SESSION['name']) && isset($_SESSION['surname'])) {
    $user_Id = $_SESSION['name'] . " " . $_SESSION['surname'];
} else {
    $user_Id = '';
}






// ตรวจสอบการเชื่อมต่อฐานข้อมูล
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (empty($history_device)) {
    echo "<script>alert('Error: Missing device name.'); history.back();</script>";
    exit;
}

// คำสั่ง SQL เช็คว่ามีการจองช่วงเวลานี้หรือไม่ (ยกเว้นกรณีที่ `history_Status = 2`)
$sql_check = "SELECT COUNT(*) AS borrow_count FROM history_brs  
    WHERE device_Id = ?  
    AND history_Status != 2  /* ✅ ถ้า status = 2 ให้ข้าม ไม่ถือว่าถูกจอง */
    AND (
         STR_TO_DATE(CONCAT(?, ' 00:00:00'), '%Y-%m-%d %H:%i:%s') <= STR_TO_DATE(CONCAT(history_Return, ' ', history_Stop), '%Y-%m-%d %H:%i:%s')
         AND STR_TO_DATE(history_Borrow, '%Y-%m-%d') <= STR_TO_DATE(CONCAT(?, ' ', ?), '%Y-%m-%d %H:%i:%s')
    )";

$stmt_check = $conn->prepare($sql_check);

if (!$stmt_check) {
    die("Prepare failed: " . $conn->error);
}

$stmt_check->bind_param("isss", $device_Id, $history_Borrow, $history_Return, $history_Stop);
$stmt_check->execute();
$result_check = $stmt_check->get_result();
$row = $result_check->fetch_assoc();

if ($row['borrow_count'] > 0) {
    echo "<script>alert('ข้อผิดพลาด: อุปกรณ์นี้ถูกยืมในช่วงเวลาที่ต้องการยืม'); history.back();</script>";
    exit;
}

$stmt_check->close();










// ตรวจสอบการเชื่อมต่อฐานข้อมูล
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (empty($history_device)) {
    echo "<script>alert('Error: Missing device name.'); history.back();</script>";
    exit;
}

$sql_check = "SELECT COUNT(*) AS borrow_count FROM history_brs  
    WHERE device_Id = ?  
    AND history_Status = '1' /* ✅ เพิ่มเงื่อนไข เช็คว่ากำลังถูกยืมอยู่ */
    AND (
         STR_TO_DATE(history_Borrow, '%Y-%m-%d %H:%i:%s') <= STR_TO_DATE(?, '%Y-%m-%d %H:%i:%s')
         AND STR_TO_DATE(history_Return, '%Y-%m-%d %H:%i:%s') >= STR_TO_DATE(?, '%Y-%m-%d %H:%i:%s')
    )";

$stmt_check = $conn->prepare($sql_check);

if (!$stmt_check) {
    die("Prepare failed: " . $conn->error);
}

$stmt_check->bind_param("iss", $device_Id, $history_Borrow, $history_Return);
$stmt_check->execute();
$result_check = $stmt_check->get_result();

if (!$result_check) {
    die("Query Error: " . $stmt_check->error);
}

$row = $result_check->fetch_assoc();

if ($row && $row['borrow_count'] > 0) {
    echo "<script>alert('ข้อผิดพลาด: อุปกรณ์นี้ถูกยืมในช่วงเวลาที่ต้องการยืม'); history.back();</script>";
    exit;
}

$stmt_check->close();




$sql = "SELECT COUNT(*) AS borrow_count FROM history_brs WHERE history_device = ?";
$stmt_check = $conn->prepare($sql);
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
    $device_Con = '1';
} elseif ($history_Status === '2') {
    $device_Con = '2';
} else {
    $device_Con = '0';
}


$stmt = $conn->prepare("INSERT INTO history_brs 
    (device_Id, history_Borrow, history_Return, history_Stop, history_Other, history_Another, user_Id, history_device, parcel_Numder, history_Numder, history_Status, officer_Cotton, device_Con, hreturn_Status, history_Status_BRS, htime_Return) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 0, ?)");

if (!$stmt) {
    die("Failed to prepare statement: " . $conn->error);
}

$stmt->bind_param(
    "ssssssssssissss",
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
    $officer_Cotton,
    $device_Con,
    $hreturn_Status,
    $htime_Return
);


// Execute the insert query
if ($stmt->execute()) {
    // Function to send Telegram message
    function sendTelegramMessage($message)
    {
        $token = "7099844724:AAFEtULObEjF_AbwXSPpkZvPZVJvD9Z3l9A";
        $chatId = "-4655924019";

        $url = "https://api.telegram.org/bot$token/sendMessage?chat_id=$chatId&text=" . urlencode($message) . "&parse_mode=Markdown";

        $result = file_get_contents($url);

        if ($result === FALSE) {
            die('Error occurred while sending message');
        }

        return $result;
    }

    // Format message to send via Telegram
    $message = "รายละเอียดการยืมอุปกรณ์\n";
    $message .= "ผู้ยืม: $user_Id\n";
    $message .= "ชื่ออุปกรณ์: $history_device\n";
    $message .= "สถานที่นำไปใช้: $history_Other\n";
    $message .= "สถานที่: $history_Another\n";
    $message .= "วันที่ยืม: $history_Borrow\n";
    $message .= "วันที่คืน: $history_Return\n";
    $message .= "เวลาคืน: $history_Stop\n";

    sendTelegramMessage($message);

    // แสดงการแจ้งเตือน "จองเสร็จสิ้นแล้ว" 
    echo "<script>
        alert('จองเสร็จสิ้นแล้ว');
        window.location.href = '../../pages/homepages.php';
    </script>";
    exit;

} else {
    echo "Error: " . $stmt->error;
    exit;
}

// ปิดการเชื่อมต่อ
$stmt->close();
$conn->close();

?>