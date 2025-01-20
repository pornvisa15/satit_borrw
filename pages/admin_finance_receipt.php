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
    1 => ["ใบเสร็จอุปกรณ์คอมพิวเตอร์", "#537bb7"],
    2 => ["ใบเสร็จอุปกรณ์วิทยาศาสตร์", "#537bb7"],
    3 => ["ใบเสร็จอุปกรณ์ดนตรี", "#537bb7"],
    4 => ["ใบเสร็จนอุปกรณ์พัสดุ", "#537bb7"],
    5 => ["ใบเสร็จอุปกรณ์ทั้งหมด", "#537bb7"],
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
   
    <button class="btn text-white" style="background-color: #007bff; font-weight: normal; font-size: 14px; margin-left: 10px;" onclick="window.location.href='addreceipt.php';">
  <i class="bi bi-person-plus"></i> เพิ่มใบเสร็จ
</button>

  </div>
</div>

        </div>
       
       <!-- กล่องค้นหาพร้อมปุ่ม -->
<!-- กล่องค้นหาพร้อมปุ่ม -->
<div class="input-group mb-3">
    <input type="text" id="searchEquipment" class="form-control" placeholder="ค้นหารายชื่อ" aria-label="Search" aria-describedby="button-search" style="font-size: 14px; padding: 9px 12px;" onkeyup="searchTable()">
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
                        <th style="width: 26;">คิวอาร์โค้ด</th>
                       
                        <th style="width: 15%;">ลบ</th>
                    </tr>
                </thead>
                <tbody>
                
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
