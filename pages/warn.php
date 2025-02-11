<?php

include 'sidebar.php';
include "../connect/mysql_borrow.php";
$user_id = $_SESSION['user_Id'] ?? null;
if (!$user_id) {
    die("<p class='text-danger text-center'>กรุณาเข้าสู่ระบบก่อนเข้าถึงหน้านี้</p>");
}

date_default_timezone_set('Asia/Bangkok');
$sql = "SELECT di.device_Name, 
               hb.history_Borrow, 
               hb.history_Return, 
               hb.history_Status_BRS, 
               hb.history_Stop,
               hb.note_Other,
              CASE 
    WHEN hb.officer_Cotton = 1 THEN 'ฝ่ายคอมพิวเตอร์'
    WHEN hb.officer_Cotton = 2 THEN 'ฝ่ายวิทยาศาสตร์'
    WHEN hb.officer_Cotton = 3 THEN 'ฝ่ายดนตรี'
    WHEN hb.officer_Cotton = 4 THEN 'ฝ่ายพัสดุ'
    ELSE 'ไม่ทราบแผนก'
END AS department_name

        FROM satit_borrow.device_information di
        INNER JOIN satit_borrow.history_brs hb ON di.device_Id = hb.device_Id
        WHERE hb.user_Id = ?";


$stmt = $conn->prepare($sql);
if (!$stmt) {
    die("ข้อผิดพลาดในการเตรียมคำสั่ง SQL: " . $conn->error);
}
$stmt->bind_param('s', $user_id);
$stmt->execute();
$result = $stmt->get_result();

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
                            while ($row = $result->fetch_assoc()):
                                $historyBorrow = $row['history_Borrow'];
                                $historyReturn = $row['history_Return'];
                                $historyStatus = $row['history_Status_BRS'];
                                $historyStop = $row['history_Stop'];

                                $historyBorrowTimestamp = strtotime($historyBorrow);
                                $historyStopTimestamp = strtotime($historyStop);
                                $currentDateTimestamp = time(); // เวลาปัจจุบัน
                            
                                $statusText = '';
                                $statusClass = '';
                                $statusIcon = '';
                                $badgeText = '';
                                $durationText = '';

                                // ตรวจสอบค่าของ $historyReturn ก่อน
                                if ($historyBorrowTimestamp !== false && $historyReturn !== false) {
                                    $historyReturnTimestamp = strtotime($historyReturn);
                                    if ($historyReturnTimestamp !== false) {
                                        $durationInSeconds = $historyReturnTimestamp - $historyBorrowTimestamp;
                                        $days = floor($durationInSeconds / 86400);  // คำนวณเป็นวัน
                                        $durationText = "$days วัน";
                                    } else {
                                        $durationText = "ข้อมูลวันที่คืนผิดพลาด";
                                    }
                                } else {
                                    $durationText = "ข้อมูลการยืมผิดพลาด";
                                }

                                // ตรวจสอบวันที่คืนและเวลาหมดอายุ
                                $currentDateTime = new DateTime(); // เวลาปัจจุบัน
                            
                                // ดึงค่า history_Return (วันที่คืน) และ history_Stop (เวลาคืน) จากฐานข้อมูล
                                $historyReturnDate = isset($row['history_Return']) ? $row['history_Return'] : null;
                                $historyStopTime = isset($row['history_Stop']) ? $row['history_Stop'] : null;

                                if ($historyReturnDate && $historyStopTime) {
                                    // รวมวันที่คืน + เวลาคืน ให้เป็น DateTime ที่สมบูรณ์
                                    $historyStopDateTime = new DateTime($historyReturnDate . " " . $historyStopTime);

                                    // คำนวณเวลาที่เหลือ
                                    $interval = $currentDateTime->diff($historyStopDateTime);

                                    if ($currentDateTime < $historyStopDateTime) {
                                        // ถ้าเวลายังไม่หมด
                                        $timeRemaining = "" . $interval->h . " ชม. " . $interval->i . " นาที" . "";
                                    } else {
                                        // ถ้าเลยกำหนดคืนแล้ว
                                        $timeRemaining = "หมดเวลาแล้ว";
                                    }
                                } else {
                                    $timeRemaining = "ไม่มีข้อมูลเวลาคืนหรือเวลาหมดอายุ";
                                }

                                // ตั้งค่าสถานะการยืม
                                if ($historyStatus == 0) {
                                    $statusText = "รอการอนุมัติ";
                                    $statusClass = "bg-warning";
                                    $statusIcon = "bi-hourglass-split";
                                } elseif ($historyStatus == 2) {
                                    $statusText = "ไม่อนุมัติ";
                                    $statusClass = "bg-danger";
                                    $statusIcon = "bi-x-circle-fill";
                                } elseif ($historyStatus == 1) {
                                    $statusText = $durationText;
                                    $statusClass = "bg-success";
                                    $statusIcon = "bi-check-circle-fill";
                                } else {
                                    continue; // ถ้าสถานะไม่ตรงกับเงื่อนไขใด ๆ ให้ข้ามไป
                                }
                                ?>
                                <li class="list-group-item d-flex justify-content-between align-items-center"
                                    style="transition: all 0.3s ease; background-color: #f8f9fa; border-radius: 10px;"
                                    onmouseover="this.style.backgroundColor='#e9f7ef'; this.style.transform='scale(1.02)';"
                                    onmouseout="this.style.backgroundColor='#f8f9fa'; this.style.transform='scale(1)';">

                                    <div>
                                        <span class="fw-bold" style="font-size: 14px; color: #007468;">
                                            <?= htmlspecialchars($row['device_Name']) ?>
                                        </span>
                                        <div style="font-size: 12px; color: #6c757d;">
                                            วันที่ยืม: <?= date("d-m-Y", strtotime($row['history_Borrow'])); ?> - วันที่คืน:
                                            <?= date("d-m-Y", strtotime($row['history_Return'])); ?><br>

                                            <?php if ($historyStatus != 0): // ถ้าสถานะไม่ใช่ "รอการอนุมัติ" ?>
                                                <?php if ($historyStatus != 2): // ถ้าสถานะไม่ใช่ "ไม่อนุมัติ" ?>
                                                    <span>ระยะเวลาในการยืม: <?= $durationText; ?>             <?= $timeRemaining; ?></span><br>
                                                    สถานะที่รับ: <?= htmlspecialchars($row['note_Other'] ?? 'ไม่มีข้อมูล'); ?>
                                                <?php else: // เมื่อสถานะเป็น "ไม่อนุมัติ" ?>
                                                    สถานะที่รับ: <?= htmlspecialchars($row['note_Other'] ?? 'ไม่มีข้อมูล'); ?>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        </div>
                                    </div>


                                    <span class="badge <?= $statusClass; ?> d-flex align-items-center"
                                        style="transition: background-color 0.3s ease; font-size: 12px;">
                                        <i class="bi <?= $statusIcon; ?> me-1"></i>
                                        <?php if ($historyStatus == 0): ?>
                                            รอการอนุมัติ
                                        <?php elseif ($historyStatus == 2): ?>
                                            <span class="fw-bold">ไม่อนุมัติ</span>
                                            <!-- Display "ไม่อนุมัติ" when status is 2 -->
                                        <?php else: ?>
                                            <span class="fw-bold"><?= htmlspecialchars($row['department_name']); ?></span>
                                        <?php endif; ?>
                                    </span>

                                </li>


                            <?php endwhile; ?>
                        </ul>

                    </form>
                </div>
            </div>
        </div>
        <br> <br> <br> <br> <br> <br> <br><br> <br>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-zZ1AI1RrP2aSxvrA8mpzVUr3js6qTgnsC8RUV6hxX7t8hzl0TjtRktGhAKGwd5nL"
        crossorigin="anonymous"></script>
</body>

<footer style="background-color: #495057;" class="text-light py-3 mt-4">
    <div class="container text-center">
        <p class="mb-0">&copy; 2024 S.TSU Application V 2.0 | พัฒนาโดย ทีมงาน S.TSU</p>
    </div>
</footer>

</html>