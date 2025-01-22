<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin การเงิน</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
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
    1 => ["ตั้งค่าการเงินอุปกรณ์คอมพิวเตอร์", "#537bb7"],
    2 => ["ตั้งค่าการเงินอุปกรณ์วิทยาศาสตร์", "#537bb7"],
    3 => ["ตั้งค่าการเงินอุปกรณ์ดนตรี", "#537bb7"],
    4 => ["ตั้งค่าการเงินอุปกรณ์พัสดุ", "#537bb7"],
    5 => ["ตั้งค่าการเงินอุปกรณ์ทั้งหมด", "#537bb7"],
];

$headerText = $headerOptions[$user_department_id][0] ?? "อุปกรณ์";
$bgColor = $headerOptions[$user_department_id][1] ?? "#333333";

// Set search term from GET parameter or default to an empty string
$searchTerm = $_GET['search'] ?? '';
$selectedCottonId = $_GET['useripass'] ?? 0;
?>

<div class="flex-grow-1 p-4">
    <?php include 'short.php'; ?>

    <div class="card shadow-sm mt-5">
        <div class="card-header text-white" style="background-color: <?= $bgColor ?>;">
            <h5 class="mb-0"><?= htmlspecialchars($headerText) ?></h5>
        </div>

        <div class="card-body">
       
        <div class="d-flex justify-content-between align-items-center mb-4">
            <!-- <?php include 'admin3.php'; ?>  ปิดไว้ก่อน--> 
           
            <div class="container">
  <div class="d-flex justify-content-end">
    <button class="btn text-white me-2" style="background-color: #4CAF50; font-weight: normal; font-size: 14px;" onclick="window.location.href='admin_finance.in.php';">
      <i class="bi bi-person-plus"></i> เพิ่มคิวอาร์โค้ด
    </button>

    <button class="btn text-white" style="background-color:#ffc107; font-weight: normal; font-size: 14px;" onclick="window.location.href='admin_finance_qrcode.php';">
      <i class="bi bi-person-plus"></i> สร้างคิวอาร์โค้ด
    </button>
  </div>
</div>

        </div>
       
       <!-- กล่องค้นหาพร้อมปุ่ม -->
<!-- กล่องค้นหาพร้อมปุ่ม -->
<div class="input-group mb-3">
    <input type="text" id="searchEquipment" class="form-control" placeholder="ค้นหา" aria-label="Search" aria-describedby="button-search" style="font-size: 14px; padding: 9px 12px;" onkeyup="searchTable()">
    <button class="btn text-light" type="button" id="button-search" style="background-color: #537bb7; border-color: #537bb7; font-size: 14px; padding: 9px 12px;">
        ค้นหา
    </button>
</div>

<script>
    function searchTable() {
        // Get the value from the search input
        var input = document.getElementById('searchEquipment');
        var filter = input.value.toLowerCase();
        var table = document.querySelector('.table');
        var rows = table.querySelectorAll('tbody tr');

        // Loop through each row and hide or show based on search
        rows.forEach(function(row) {
            var nameCell = row.querySelector('td:nth-child(2)');
            var departmentCell = row.querySelector('td:nth-child(3)');
            var nameText = nameCell ? nameCell.textContent.toLowerCase() : '';
            var departmentText = departmentCell ? departmentCell.textContent.toLowerCase() : '';

            // Check if either name or department contains the search term
            if (nameText.includes(filter) || departmentText.includes(filter)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }
</script>


        <div class="table-responsive mt-3">
            <table class="table table-bordered table-striped text-center" style="font-size: 14px;">
                <thead class="table-light">
                    <tr>
                        <th style="width: 25;">ลำดับ</th>
                        <th>ชื่อ-นามสกุล</th>
                        <th style="width: 25%;">ผู้รับผิดชอบ</th>
                        <th style="width: 26;">คิวอาร์โค้ด</th>
                        <th style="width: 15%;">แก้ไข</th>
                        <th style="width: 15%;">ลบ</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                   // SQL query setup
$sql = "SELECT * FROM borrow.finance";

// Add conditions
$conditions = [];
$params = [];

if ($user_department_id != 5) {
    $conditions[] = "finance.officer_Cotton = ?";
    $params[] = $user_department_id;
}

if ($selectedCottonId > 0) {
    $conditions[] = "finance.officer_Cotton = ?";
    $params[] = $selectedCottonId;
}

// Apply conditions to SQL
if (!empty($conditions)) {
    $sql .= " WHERE " . implode(" AND ", $conditions);
}

// Prepare the statement to prevent SQL Injection
$stmt = $conn->prepare($sql);
if ($stmt === false) {
    die("การเตรียมคำสั่ง SQL ล้มเหลว: " . $conn->error);
}

// Bind parameters
if (!empty($params)) {
    $stmt->bind_param(str_repeat('i', count($params)), ...$params);
}

$stmt->execute();
$result = $stmt->get_result();

$i = 1; // เริ่มลำดับ

if ($result->num_rows > 0) {
    // ลบข้อมูลที่ไม่มีใน das_admin ออกไป
    $sql_delete = "
        DELETE finance
        FROM borrow.finance AS finance
        LEFT JOIN borrow.officer_staff AS officer_staff ON finance.useripass = officer_staff.useripass
        LEFT JOIN das_satit.das_admin AS das_admin ON officer_staff.useripass = das_admin.useripass
        WHERE das_admin.useripass IS NULL
    ";

    // เตรียมคำสั่ง SQL สำหรับลบ
    if ($conn->query($sql_delete) === FALSE) {
        die('Error deleting data: ' . $conn->error);
    }

    // ดึงข้อมูลเจ้าหน้าที่
    $sql_officer = "
        SELECT 
            officer_staff.useripass, 
            das_admin.praname, 
            das_admin.name, 
            das_admin.surname
        FROM borrow.finance
        INNER JOIN borrow.officer_staff ON borrow.finance.useripass = officer_staff.useripass
        INNER JOIN das_satit.das_admin ON officer_staff.useripass = das_admin.useripass
        WHERE das_admin.statuson = 1
        GROUP BY officer_staff.useripass, das_admin.praname, das_admin.name, das_admin.surname
        ORDER BY das_admin.name ASC
    ";

    $stmt_officer = $conn->prepare($sql_officer);
    if ($stmt_officer === false) {
        die('Error preparing statement: ' . $conn->error);
    }

    $stmt_officer->execute();
    $result_officer = $stmt_officer->get_result();

    $officers = [];
    if ($result_officer->num_rows > 0) {
        while ($officer = $result_officer->fetch_assoc()) {
            $fullname = htmlspecialchars($officer['praname'] . $officer['name'] . ' ' . $officer['surname']);
            $officers[$officer['useripass']] = $fullname;
        }
    }

    // แสดงข้อมูลอุปกรณ์
    while ($row = $result->fetch_assoc()) {
        $device_Image = isset($row['finance_Image']) ? htmlspecialchars($row['finance_Image']) : 'default_image.jpg';
        // กำหนดชื่อฝ่ายตามหมายเลข
        $departments = [
            1 => 'ฝ่ายคอมพิวเตอร์',
            2 => 'ฝ่ายวิทยาศาสตร์',
            3 => 'ฝ่ายดนตรี',
            4 => 'ฝ่ายพัสดุ',
            5 => 'แอดมิน'
        ];

        $cotton_Id = isset($row['officer_Cotton']) ? (int)$row['officer_Cotton'] : 0;
    $cotton_Name = isset($departments[$cotton_Id]) ? htmlspecialchars($departments[$cotton_Id]) : 'ไม่ระบุ';

    $officerUseripass = isset($row['useripass']) ? $row['useripass'] : '';

    if (!isset($officers[$officerUseripass])) {
        continue; // ข้ามข้อมูลที่ไม่มีเจ้าหน้าที่
    }

    $fullname = $officers[$officerUseripass];
    
        echo "<tr class='officerRow' data-name='" . strtolower($fullname) . "' data-department='" . strtolower($cotton_Name) . "'>
                <td>" . htmlspecialchars($i) . "</td>
                <td style='text-align: center; vertical-align: top; height: 100px;' class='searchable'>
                    <div style='display: flex; align-items: flex-start; justify-content: center; height: 100%;'>
                        " . $fullname . "
                    </div>
                </td>
                <td>" . $cotton_Name . "</td>";
                $imagePath1 = '../connect/finance/finance/img/' . $device_Image;
                $imagePath2 = '../connect/addqr/img/' . $device_Image;

                if ((!empty($device_Image) && file_exists($imagePath1)) || (file_exists($imagePath2))) {
                    // แสดงปุ่มที่สามารถคลิกเพื่อดูรูปภาพใน modal (ขนาดเล็ก)
                    echo "<td><a href='#' class='btn btn-secondary btn-sm' data-bs-toggle='modal' data-bs-target='#imageModal' data-bs-image='" . htmlspecialchars(file_exists($imagePath1) ? $imagePath1 : $imagePath2) . "' title='ดูรูปภาพ'><i class='bi bi-image-fill'></i> ดูรูปภาพ</a></td>";
                } else {
                    // หากไม่มีรูปภาพ แสดงข้อความ
                    echo "<td>ไม่มีรูปภาพ</td>";
                }
                 
         echo "<td hidden>" . htmlspecialchars($row['officerl_Id']) . "</td>";       

        $finance_Id = isset($row['finance_Id']) ? urlencode($row['finance_Id']) : '';
        echo "<td><a href='admin_finance.edit.php?finance_Id=" . $finance_Id . "' class='btn btn-warning'><i class='fas fa-edit'></i></a></td>
              <td><a href='../connect/finance/delete.php?finance_Id=" . $finance_Id . "' class='btn btn-danger'><i class='fas fa-trash-alt'></i></a></td>
              </tr>";

        $i++;
    }
} else {
    echo "<tr><td colspan='6'>ไม่มีข้อมูล</td></tr>";
}
?>
                </tbody>
            </table>
        </div>
    </div>
    
</div>
<!-- Modal สำหรับแสดงรูปภาพ -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="imageModalLabel">รูปภาพ</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <img src="" id="modalImage" alt="Finance Image" style="width: 50%; height: auto; margin: 0 auto; display: block;" />
      </div>
    </div>
  </div>
</div>
<?php
// สร้างอาร์เรย์เพื่อเก็บ useripass ที่แสดงแล้ว
$seenUserIpasses = [];

while ($row = $result->fetch_assoc()) {
    $officerUseripass = isset($row['useripass']) ? $row['useripass'] : '';

    // ตรวจสอบว่า useripass นี้เคยแสดงไปแล้วหรือไม่
    if (in_array($officerUseripass, $seenUserIpasses)) {
        continue; // ข้ามการแสดงผลของแถวนี้
    }

    // เพิ่ม useripass นี้ลงในอาร์เรย์
    $seenUserIpasses[] = $officerUseripass;

    // ดึงข้อมูลเจ้าหน้าที่
    $fullname = isset($officers[$officerUseripass]) ? $officers[$officerUseripass] : 'ไม่ระบุ';

    // แสดงข้อมูลในตาราง
    echo "<tr>
            <td>" . htmlspecialchars($i) . "</td>
            <td>" . htmlspecialchars($fullname) . "</td>
            <td>" . htmlspecialchars($cotton_Name) . "</td>
            
            <td><a href='admin_finance.edit.php?finance_Id=" . urlencode($row['finance_Id']) . "' class='btn btn-warning'><i class='fas fa-edit'></i></a></td>
            <td><a href='../connect/finance/delete.php?finance_Id=" . urlencode($row['finance_Id']) . "' class='btn btn-danger'><i class='fas fa-trash-alt'></i></a></td>
          </tr>";

    $i++;
}
?>
<script>
// เมื่อคลิกที่ปุ่ม ดูรูปภาพ ให้เปลี่ยนรูปภาพใน modal
document.addEventListener('DOMContentLoaded', function () {
  var imageModal = document.getElementById('imageModal');
  imageModal.addEventListener('show.bs.modal', function (event) {
    var button = event.relatedTarget; // ปุ่มที่คลิก
    var imageUrl = button.getAttribute('data-bs-image'); // ดึง URL ของรูปภาพจาก data-bs-image
    var modalImage = imageModal.querySelector('#modalImage');
    modalImage.src = imageUrl; // เปลี่ยนแหล่งที่มาของรูปภาพใน modal
  });
});
</script>
<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>


</body>

</html>
