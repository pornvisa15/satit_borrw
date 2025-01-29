<?php
session_start();
include 'sidebar.php';
include "../connect/mysql_borrow.php";
$user_id = $_SESSION['user_Id'] ?? null;
if (!$user_id) {
    die("<p class='text-danger text-center'>กรุณาเข้าสู่ระบบก่อนเข้าถึงหน้านี้</p>");
}

date_default_timezone_set('Asia/Bangkok');
echo "Current Timezone: " . date_default_timezone_get();
$sql = "SELECT di.device_Name, hb.history_Borrow, hb.history_Return, hb.history_Status_BRS ,hb.history_Stop
        FROM borrow.device_information di
        INNER JOIN borrow.history_brs hb ON di.device_Id = hb.device_Id
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
                                $historyBorrowTimestamp = strtotime($historyBorrow);
                                $historyReturnTimestamp = strtotime($historyReturn);
                                $currentDateTimestamp = strtotime($currentDate);
                                $historyStatus = $row['history_Status_BRS'];
                                $statusText = '';
                                $statusClass = '';
                                $statusIcon = '';
                                $badgeText = '';
                                $durationText = '';
                                if ($historyBorrowTimestamp !== false && $historyReturnTimestamp !== false) {
                                    $durationInSeconds = $historyReturnTimestamp - $historyBorrowTimestamp;
                                    $days = floor($durationInSeconds / 86400);
                                    $hours = floor(($durationInSeconds % 86400) / 3600);
                                    $minutes = floor(($durationInSeconds % 3600) / 60);
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
                                    $durationText = "ข้อมูลผิดพลาด";
                                }
                                if ($historyStatus == 1 && $historyReturnTimestamp !== false && $currentDateTimestamp !== false) {
                                    $timeLeftInSeconds = $historyReturnTimestamp - $currentDateTimestamp;
                                    $hoursLeft = floor($timeLeftInSeconds / 3600);
                                    $minutesLeft = floor(($timeLeftInSeconds % 3600) / 60);
                                    $durationText .= " กำลังใช้งาน $hoursLeft ชม. $minutesLeft นาที";
                                }
                                if ($historyStatus == 0) {
                                    $statusText = "รอการอนุมัติ";
                                    $statusClass = "bg-warning text-dark";
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