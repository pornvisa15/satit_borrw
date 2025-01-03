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

// Header configuration based on department
$headerOptions = [
    1 => ["รายการอุปกรณ์คอมพิวเตอร์", "#537bb7"],
    2 => ["รายการอุปกรณ์วิทยาศาสตร์", "#537bb7"],
    3 => ["รายการอุปกรณ์ดนตรี", "#537bb7"],
    4 => ["รายการอุปกรณ์พัสดุ", "#537bb7"],
    5 => ["รายการอุปกรณ์ทั้งหมด", "#537bb7"],
];

$headerText = $headerOptions[$user_department_id][0] ?? "อุปกรณ์";
$bgColor = $headerOptions[$user_department_id][1] ?? "#333333";
?>
    <div class="flex-grow-1 p-4">
    
    <?php include 'short.php'; ?>

        <div class="card shadow-sm mt-5">
        <div class="card-header text-white" style="background-color: <?= $bgColor ?>;">
            <h4 class="mb-0"><?= htmlspecialchars($headerText) ?></h4>
        </div>

 <div class="card-body">
    <div class="me-3">
            <select id="equipmentType" class="form-select" style="width: 220px; font-size: 14px;">
                <option value="" selected disabled>กรุณาเลือกสถานะ</option>
                <option value="">ทั้งหมด</option>
                <option value="รอตรวจสอบ">รอตรวจสอบ</option>
                <option value="อนุมัติ">อนุมัติ</option>
                <option value="ไม่อนุมัติ">ไม่อนุมัติ</option>
                <option value="กำลังยืม">กำลังยืม</option>
                <option value="คืนแล้ว">คืนแล้ว</option>
                <option value="ชำรุด">ชำรุด</option>
                 <option value="ผู้ยืมซ่อมแซม ">ผู้ยืมซ่อมแซม </option>
                 <option value="ชำระค่าเสียหาย">ชำระค่าเสียหาย</option>
                <option value="ชำรุด">ชดใช้เป็นพัสดุ</option>
               
            </select>
        </div>
    <!-- กล่องค้นหา -->
   
        <div class="input-group mb-3" style="margin-top: 15px; margin-left: 1px; margin-right: 5px;">
            <input type="text" id="searchEquipment" class="form-control" placeholder="ค้นหารายชื่ออุปกรณ์"
                aria-label="Search" aria-describedby="button-search" style="font-size: 14px; padding: 9px 12px;">
            <button class="btn text-light" type="button" id="button-search"
                style="background-color: #537bb7; border-color: #537bb7; font-size: 14px; padding: 9px 12px;">
                ค้นหา
            </button>
        </div>

        <table class="table table-bordered table-striped text-center table-responsive" style="font-size: 14px;">
    <thead class="table-light">
        <tr>
            <th style="width: 5%;">ลำดับ</th>
            <th style="width: 13%;">เลขพัสดุ /ครุภัณฑ์</th>
            <th style="width: 11%;">ชื่ออุปกรณ์</th>
            <th style="width: 10%;">วันที่ยืม</th>
            <th style="width: 10%;">วันที่คืน</th>
            <th style="width: 10%;">ผู้ยืม</th>
            <th style="width: 5%;">สถานะ</th>
            <th style="width: 25%;">หมายเหตุ</th>
            <th style="width: 25%;">รายละเอียด</th>
        </tr>
    </thead>
    <tbody>
    <?php
// เชื่อมต่อกับฐานข้อมูล
include '../connect/mysql_borrow.php';

// ดึงข้อมูลจากฐานข้อมูล
$sql = "SELECT * FROM borrow.history_brs";
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
        echo "<td>" . htmlspecialchars($row['history_Borrow']) . "</td>"; // วันที่ยืม
        echo "<td>" . htmlspecialchars($row['history_Return']) . "</td>"; // วันที่คืน
        echo "<td>" . htmlspecialchars($row['user_Id']) . "</td>"; // ผู้ยืม
        echo "<td><span class='badge bg-warning text-dark' style='border-radius: 12px; padding: 5px 10px;'>" . htmlspecialchars($row['history_device']) . "</span></td>"; // สถานะ
        echo "<td>" . htmlspecialchars($row['history_Other']) . "</td>"; // หมายเหตุ
        echo "<td><a href='adminhome_details.php?id=" . urlencode($row['history_Id']) . "' class='btn btn-sm' style='background-color: #4fb05a; color: white; border-radius: 8px;'>รายละเอียด</a></td>";
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

<script>
// การค้นหาข้อมูลในตาราง
document.getElementById('searchEquipment').addEventListener('keyup', function() {
    let searchValue = this.value.toLowerCase();
    let rows = document.querySelectorAll('table tbody tr');
    rows.forEach(function(row) {
        let text = row.innerText.toLowerCase();
        row.style.display = text.includes(searchValue) ? '' : 'none';
    });
});

// การกรองข้อมูลตามสถานะ
document.getElementById('equipmentType').addEventListener('change', function() {
    let statusValue = this.value.toLowerCase();
    let rows = document.querySelectorAll('table tbody tr');
    rows.forEach(function(row) {
        let statusCell = row.querySelector('td:nth-child(7)');
        let statusText = statusCell ? statusCell.innerText.toLowerCase() : '';
        if (statusValue === "" || statusText.includes(statusValue)) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
});
</script>


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>


</body>

</html>