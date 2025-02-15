<?php

include 'sidebar.php';
include "../connect/mysql_borrow.php";

// ตรวจสอบว่า user_Id มีค่าหรือไม่
$user_id = $_SESSION['user_Id'] ?? null;
if (!$user_id) {
    die("<p class='text-danger text-center'>กรุณาเข้าสู่ระบบก่อนเข้าถึงหน้านี้</p>");
}

// ใช้ Prepared Statement
$stmt = $conn->prepare(
    "SELECT di.device_Name, hb.history_Borrow, hb.history_Return, hb.history_Status, 
                hb.user_Id, hb.device_Con, hb.note_Other, 
                CASE 
                    WHEN hb.officer_Cotton = 1 THEN 'คอมพิวเตอร์'
                    WHEN hb.officer_Cotton = 2 THEN 'วิทยาศาสตร์'
                    WHEN hb.officer_Cotton = 3 THEN 'ดนตรี'
                    WHEN hb.officer_Cotton = 4 THEN 'พัสดุ'
                    ELSE 'ไม่ทราบข้อมูล'
                END AS officer_Cotton_name
         FROM history_brs hb
         INNER JOIN device_information di ON hb.device_Id = di.device_Id 
         WHERE hb.user_Id = ?
          ORDER BY hb.history_Borrow DESC"
);
if (!$stmt) {
    die("ข้อผิดพลาดในการเตรียมคำสั่ง SQL: " . $conn->error);
}

// ผูกค่ากับตัวแปร Prepared Statement
$stmt->bind_param('i', $user_id);
$stmt->execute();
$result = $stmt->get_result();

// ตรวจสอบข้อผิดพลาด
if (!$result) {
    die("ข้อผิดพลาดในการดึงข้อมูล: " . $stmt->error);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ประวัติการยืม-คืน</title>
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
                    <h1 class="text-center mb-4" style="color: #007468; font-size: 20px; font-weight: bold;">
                        ประวัติการยืม-คืน</h1>
                    <form>
                        <ul class="list-group list-group-flush">
                            <?php while ($row = $result->fetch_assoc()): ?>
                                <?php if ($row['device_Con'] != 0): ?>
                                    <li class="list-group-item d-flex justify-content-between align-items-center"
                                        style="transition: all 0.3s ease; background-color: #f8f9fa; border-radius: 10px;"
                                        onmouseover="this.style.backgroundColor='#e9f7ef'; this.style.transform='scale(1.02)';"
                                        onmouseout="this.style.backgroundColor='#f8f9fa'; this.style.transform='scale(1)';">
                                        <div>
                                            <span class="fw-bold" style="font-size: 14px; color: #007468;">
                                                <?= htmlspecialchars($row['device_Name']) ?>
                                            </span>
                                            <div style="font-size: 12px; color: #6c757d;">
                                                วันที่ยืม <?= htmlspecialchars($row['history_Borrow']) ?> - วันที่คืน
                                                <?= htmlspecialchars($row['history_Return']) ?>
                                            </div>

                                            <div style="font-size: 12px; color: #6c757d;">
                                                ฝ่าย: <?= htmlspecialchars($row['officer_Cotton_name'] ?? 'ไม่ระบุ') ?>
                                            </div>
                                        </div>
                                        <span
                                            class="badge <?= ($row['device_Con'] == 2) ? 'bg-danger' : ($row['history_Status'] == 2 ? 'bg-info' : 'bg-success') ?> d-flex align-items-center"
                                            style="transition: background-color 0.3s ease; font-size: 12px;">
                                            <i
                                                class="bi <?= ($row['device_Con'] == 2) ? 'bi-x-circle-fill' : ($row['history_Status'] == 2 ? 'bi-check-circle-fill' : 'bi-exclamation-circle-fill') ?> me-1"></i>
                                            <?= ($row['device_Con'] == 2) ? 'ไม่อนุมัติ' : ($row['history_Status'] == 2 ? 'คืนแล้ว' : 'กำลังยืม') ?>
                                        </span>
                                    </li>
                                <?php endif; ?>
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