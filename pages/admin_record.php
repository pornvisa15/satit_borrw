<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin</title>
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="d-flex bg-light">
<?php
session_start();
include 'sidebar.php'; // Include Sidebar
include '../connect/myspl_das_satit.php';
include '../connect/mysql_studentsatit.php';
include '../connect/mysql_borrow.php';

// Retrieve session value
$user_department_id = $_SESSION['officer_Cotton'] ?? 0;

// Dropdown filter value
$cottonFilter = isset($_GET['cotton_Id']) ? intval($_GET['cotton_Id']) : 0;

// Header configuration based on department
$headerOptions = [
    1 => ["ประวัติการใช้อุปกรณ์คอมพิวเตอร์", "#537bb7"],
    2 => ["ประวัติการใช้อุปกรณ์วิทยาศาสตร์", "#537bb7"],
    3 => ["ประวัติการใช้อุปกรณ์ดนตรี", "#537bb7"],
    4 => ["ประวัติการใช้อุปกรณ์พัสดุ", "#537bb7"],
    5 => ["ประวัติการใช้อุปกรณ์ทั้งหมด", "#537bb7"],
];

$headerText = $headerOptions[$user_department_id][0] ?? "อุปกรณ์";
$bgColor = $headerOptions[$user_department_id][1] ?? "#333333";
?>

<div class="flex-grow-1 p-4">
    <?php include 'short.php'; ?>

    <div class="card shadow-sm mt-5">
        <div class="card-header text-white" style="background-color: <?= $bgColor ?>;">
            <h5 class="mb-0"><?= htmlspecialchars($headerText) ?></h5>
        </div>
        <div class="card-body">
        <?php include 'admin2.php'; ?> 
       
            <div class="input-group mb-3" style="margin-top: 15px; margin-left: 1px; margin-right: 5px;">
                <input type="text" id="searchEquipment" class="form-control" placeholder="ค้นหารายชื่ออุปกรณ์"
                    aria-label="Search" aria-describedby="button-search"
                    style="font-size: 14px; padding: 9px 12px;">
                <button class="btn text-light" type="button" id="button-search"
                    style="background-color: #537bb7; border-color: #537bb7; font-size: 14px; padding: 9px 12px;">
                    ค้นหา
                </button>
            </div>

            <table class="table table-bordered table-striped text-center" style="font-size: 14px;">
                <thead class="table-light">
                    <tr>
                        <th>ลำดับ</th>
                        <th>เลขพัสดุ /ครุภัณฑ์</th>
                        <th>ชื่ออุปกรณ์</th>
                        <th>จำนวนครั้ง/ยืม</th>
                        <th>สถานะอุปกรณ์</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $showAll = isset($_GET['show_all']) ? true : false;
                    $cottonId = isset($_GET['cottonId']) ? $_GET['cottonId'] : '';

                    // เริ่มต้น query ด้วย WHERE 1=1 เพื่อรองรับเงื่อนไขกรอง
                    $sql = "SELECT * FROM borrow.history_brs WHERE 1=1";

                    if ($user_department_id != 5) {
                        // หากไม่ใช่ฝ่ายทั้งหมด (ฝ่าย 5) ให้กรองตาม cotton_Id ของผู้ใช้งาน
                        $sql .= " AND history_brs.cotton_Id = $user_department_id";
                    } elseif ($cottonFilter > 0) {
                        // หาก cottonId ถูกกรองจาก URL ก็ใช้ค่า cottonId นั้น
                        $sql .= " AND history_brs.cotton_Id = $cottonFilter";
                    }

                    // ดึงข้อมูลการยืมล่าสุดตาม device_Id โดยใช้ MAX(history_Numder)
                    $sql .= " AND history_brs.history_Numder = (SELECT MAX(history_Numder) 
                                FROM borrow.history_brs h WHERE h.device_Id = history_brs.device_Id) 
                                ORDER BY history_brs.device_Id DESC";

                    $result = $conn->query($sql);

                    // ตรวจสอบว่ามีข้อมูลหรือไม่
                    $i = 1;
                    if ($result->num_rows > 0) {
                        // แสดงข้อมูลในตาราง
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>{$i}</td>"; // ลำดับ
                            echo "<td>" . htmlspecialchars($row['parcel_Numder']) . "</td>"; // เลขพัสดุ/ครุภัณฑ์
                            echo "<td>" . htmlspecialchars($row['history_device']) . "</td>"; // ชื่ออุปกรณ์
                            echo "<td>" . htmlspecialchars($row['history_Numder']) . "</td>"; // จำนวนครั้ง/ยืม
                            echo "<td>";

                            // สถานะของอุปกรณ์
                            if ($row['device_Con'] == 0) {
                                echo "<span class='badge rounded-pill bg-warning text-dark' style='font-size: 12px; padding: 8px 20px;'> 
                                    <i class='bi bi-clock-history'></i> รออนุมัติ</span>";
                            } elseif ($row['device_Con'] == 1) {
                                echo "<span class='badge rounded-pill bg-success' style='font-size: 12px; padding: 8px 20px;'> 
                                    <i class='bi bi-check-circle'></i> ปกติ</span>";
                            } elseif ($row['device_Con'] == 2) {
                                // ใช้ JavaScript เพื่อเรียกฟังก์ชัน
                                echo "<a href='#' onclick='showDamageDetails(\"" . htmlspecialchars($row['user_Id']) . "\")' 
                                    class='badge rounded-pill bg-danger text-decoration-none text-light' 
                                    style='cursor: pointer; font-size: 12px; padding: 8px 20px;'>
                                    <i class='bi bi-exclamation-circle'></i> ชำรุด</a>";
                            } else {
                                echo "<span class='badge rounded-pill bg-secondary' style='font-size: 16px; padding: 8px 20px;'> 
                                    <i class='bi bi-question-circle'></i> ไม่ทราบสถานะ</span>";
                            }
                            
                            echo "</td>";
                            echo "</tr>";
                            $i++;
                        }
                    } else {
                        echo "<tr><td colspan='9'>ไม่พบข้อมูล</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- โหลด SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
function showDamageDetails(userId) {
    // ใช้ sweetalert2 เพื่อแสดงชื่อผู้ทำชำรุด
    Swal.fire({
        title: 'ชื่อผู้ทำชำรุด:',
        text: userId, // แสดง userId เป็นชื่อผู้ทำชำรุด
        icon: 'info', // ใช้ไอคอนแสดงข้อมูล
        confirmButtonText: 'ตกลง'
    });
}

// Search function for table data
document.getElementById('searchEquipment').addEventListener('keyup', function() {
    let searchValue = this.value.toLowerCase();
    let rows = document.querySelectorAll('table tbody tr');
    rows.forEach(function(row) {
        let text = row.innerText.toLowerCase();
        row.style.display = text.includes(searchValue) ? '' : 'none';
    });
});-
// Filter function based on cotton filter dropdown
document.getElementById('cottonFilter').addEventListener('change', function() {
    let cottonId = this.value;  // Value from cotton filter dropdown
    let url = window.location.href.split('?')[0]; // Get current URL
    if (cottonId) {
        url += '?cottonId=' + cottonId; // Append cottonId to URL
    }
    window.location.href = url; // Reload page with selecte d filter
});
</script>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>

</body>

</html>
