<?php
session_start();
include 'sidebar.php';
include "../connect/mysql_borrow.php";


$user_id = $_SESSION['user_Id'] ?? null;
if (!$user_id) {
    die("<p class='text-danger text-center'>กรุณาเข้าสู่ระบบก่อนเข้าถึงหน้านี้</p>");
}
// ตรวจสอบค่าของ user_Id

// ใช้ Prepared Statement
$sql = "SELECT di.device_Name, hb.history_Borrow, hb.history_Return, hb.history_Status_BRS ,hb.history_Stop
        FROM borrow.device_information di
        INNER JOIN borrow.history_brs hb ON di.device_Id = hb.device_Id
        WHERE hb.user_Id = ?";

$stmt = $conn->prepare($sql);
if (!$stmt) {
    die("ข้อผิดพลาดในการเตรียมคำสั่ง SQL: " . $conn->error);
}

$stmt->bind_param('s', $user_id); // ผูกค่า user_id เป็น parameter
$stmt->execute();
$result = $stmt->get_result();

// ตรวจสอบข้อผิดพลาด
if (!$result) {
    die("ข้อผิดพลาดในการดึงข้อมูล: " . $stmt->error);
}

$currentDate = date('Y-m-d H:i:s');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>แจ้งเตือน</title>
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body class="d-flex flex-column min-vh-100">
    <div class="col-md-9 col-lg-10 mb-5">
        <div class="p-3 bg-light border rounded shadow-sm">
            <div class="row">
                <div class="p-5 bg-white border rounded shadow-sm mt-5 mx-auto"
                    style="max-width: 800px; margin-bottom: 30px;">
                    <h1 class="text-center mb-4" style="color: #007468; font-size: 20px; font-weight: bold;">แจ้งเตือน
                    </h1>
                    <form>
                        <ul class="list-group list-group-flush">
                            <?php
                            date_default_timezone_set('Asia/Bangkok'); // ตั้งโซนเวลา
                            $currentDate = date('Y-m-d H:i:s');

                            while ($row = $result->fetch_assoc()):

                                $historyBorrow = $row['history_Borrow']; // วันที่ยืม
                                $historyReturn = $row['history_Return']; // วันที่คืน
                                $historyBorrowTimestamp = strtotime($historyBorrow); // แปลงเวลาเป็น timestamp
                                $historyReturnTimestamp = strtotime($historyReturn); // แปลงเวลาคืนเป็น timestamp
                                $currentDateTimestamp = strtotime($currentDate); // เวลาปัจจุบัน
                                $historyStatus = $row['history_Status_BRS']; // สถานะการยืม
                                $statusText = '';
                                $statusClass = '';
                                $statusIcon = '';
                                $badgeText = '';  // กำหนดค่าเริ่มต้นให้กับตัวแปร $badgeText
                                $durationText = ''; // ตัวแปรเก็บระยะเวลาในการยืม
                            
                                // คำนวณระยะเวลาในการยืม (ระหว่าง history_Borrow และ history_Return)
                                if ($historyBorrowTimestamp !== false && $historyReturnTimestamp !== false) {
                                    $durationInSeconds = $historyReturnTimestamp - $historyBorrowTimestamp;

                                    // คำนวณวัน
                                    $days = floor($durationInSeconds / 86400); // 86400 วินาทีใน 1 วัน
                                    // คำนวณชั่วโมง
                                    $hours = floor(($durationInSeconds % 86400) / 3600); // 3600 วินาทีใน 1 ชั่วโมง
                                    // คำนวณนาที
                                    $minutes = floor(($durationInSeconds % 3600) / 60); // 60 วินาทีใน 1 นาที
                            
                                    // จัดรูปแบบการแสดงผล
                                    if ($days > 0) {
                                        $durationText .= "$days วัน ";
                                    }
                                    if ($hours > 0) {
                                        $durationText .= "$hours ชั่วโมง ";
                                    }
                                    if ($minutes > 0) {
                                        $durationText .= "$minutes นาที";
                                    }
                                } else {
                                    $durationText = "ข้อมูลผิดพลาด"; // หากไม่สามารถคำนวณได้
                                }

                                // คำนวณเวลาที่เหลือ (หากสถานะเป็น "กำลังใช้งาน")
                                if ($historyStatus == 1 && $historyReturnTimestamp !== false && $currentDateTimestamp !== false) {
                                    $timeLeftInSeconds = $historyReturnTimestamp - $currentDateTimestamp;

                                    // คำนวณจำนวนชั่วโมงและนาทีที่เหลือ
                                    $hoursLeft = floor($timeLeftInSeconds / 3600);
                                    $minutesLeft = floor(($timeLeftInSeconds % 3600) / 60);

                                    // รวมระยะเวลาการยืมและเวลาที่เหลือ
                                    $durationText .= " กำลังใช้งาน $hoursLeft ชม. $minutesLeft นาที";
                                }

                                // ตรวจสอบสถานะตามที่มีอยู่
                                if ($historyStatus == 0) {
                                    $statusText = "รอการอนุมัติ";
                                    $statusClass = "bg-warning text-dark";
                                    $statusIcon = "bi-hourglass-split";
                                } elseif ($historyStatus == 2) {
                                    $statusText = "ไม่อนุมัติ";
                                    $statusClass = "bg-danger";
                                    $statusIcon = "bi-x-circle-fill";
                                } elseif ($historyStatus == 1) { // สถานะอนุมัติแล้ว
                                    $statusText = $durationText; // ใช้ค่าที่คำนวณระยะเวลาและเวลาที่เหลือ
                                    $statusClass = "bg-success"; // สถานะสำหรับกำลังใช้งาน
                                    $statusIcon = "bi-check-circle-fill";
                                } else {
                                    // หากสถานะไม่ใช่ 0, 1 หรือ 2 จะข้ามไป
                                    continue;
                                }
                                ?>

                                <li class="list-group-item d-flex justify-content-between align-items-center"
                                    style="transition: all 0.3s ease; background-color: #f8f9fa; border-radius: 10px;"
                                    onmouseover="this.style.backgroundColor='#e9f7ef'; this.style.transform='scale(1.02)';"
                                    onmouseout="this.style.backgroundColor='#f8f9fa'; this.style.transform='scale(1)';">
                                    <div>
                                        <span class="fw-bold" style="font-size: 14px; color: #007468;">
                                            <?= htmlspecialchars($row['device_Name']); ?>
                                        </span>
                                        <div style="font-size: 12px; color: #6c757d;">
                                            วันที่ยืม: <?= htmlspecialchars($row['history_Borrow']); ?> - วันที่คืน:
                                            <?= htmlspecialchars($row['history_Return']); ?><br>
                                            ระยะเวลาในการยืม: <?= $durationText; ?><br>
                                            <?= $badgeText; ?>
                                        </div>
                                    </div>
                                    <span class="badge <?= $statusClass; ?> d-flex align-items-center"
                                        style="transition: background-color 0.3s ease; font-size: 12px;">
                                        <i class="bi <?= $statusIcon; ?> me-1"></i> <?= $statusText; ?>
                                    </span>
                                </li>
                            <?php endwhile; ?>


                        </ul>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

<footer style="background-color: #495057;" class="text-light py-3 mt-4">
    <div class="container text-center">
        <p class="mb-0">&copy; 2024 S.TSU Application V 2.0 | พัฒนาโดย ทีมงาน S.TSU</p>
    </div>
</footer>

</body>

</html>