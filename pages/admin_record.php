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
                <input type="text" id="searchEquipment" class="form-control" placeholder="ค้นหา"
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
                        <th>ชื่อ/นามสกุล ยืม</th>
                        <th>สถานะอุปกรณ์</th>
                        <th>ไฟล์รูป</th>
                        
                    </tr>
                </thead>
                <tbody>
                <tbody>
    <?php
    $showAll = isset($_GET['show_all']) ? true : false;
    $cottonId = isset($_GET['cottonId']) ? $_GET['cottonId'] : '';

    $sql = "SELECT * FROM borrow.history_brs WHERE 1=1";

    if ($user_department_id != 5) {
        $sql .= " AND history_brs.cotton_Id = $user_department_id";
    } elseif ($cottonFilter > 0) {
        $sql .= " AND history_brs.cotton_Id = $cottonFilter";
    }

    $sql .= " AND history_brs.history_Numder = (SELECT MAX(history_Numder) 
                            FROM borrow.history_brs h WHERE h.device_Id = history_brs.device_Id) 
                            ORDER BY history_brs.device_Id DESC";

    $result = $conn->query($sql);
    $i = 1;
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>{$i}</td>"; // ลำดับ
            
            echo "<td>" . htmlspecialchars($row['parcel_Numder']) . "</td>"; // เลขพัสดุ/ครุภัณฑ์
            echo "<td>" . htmlspecialchars($row['history_device']) . "</td>"; // ชื่ออุปกรณ์
            echo "<td>" . htmlspecialchars($row['history_Numder']) . "</td>"; // จำนวนครั้ง/ยืม
            echo "<td>" . htmlspecialchars($row['user_Id']) . "</td>"; 
            echo "<td>";
            
            // สถานะของอุปกรณ์
            if ($row['device_Con'] == 0) {
                echo "<span class='badge rounded-pill bg-warning text-dark' style='font-size: 12px;'> 
                    <i class='bi bi-clock-history'></i> รออนุมัติ</span>";
            } elseif ($row['device_Con'] == 1) {
                echo "<span class='badge rounded-pill bg-success' style='font-size: 12px;'> 
                    <i class='bi bi-check-circle'></i> ปกติ</span>";
            } elseif ($row['device_Con'] == 2) {
                echo "<a href='#' onclick='showDamageDetails(\"" . htmlspecialchars($row['device_Id']) . "\")' 
                        class='badge rounded-pill bg-danger text-decoration-none text-light' 
                        style='cursor: pointer; font-size: 12px;'>
                        <i class='bi bi-exclamation-circle'></i> ชำรุด</a>"; 
            } else {
                echo "<span class='badge rounded-pill bg-secondary' style='font-size: 12px;'> 
                    <i class='bi bi-question-circle'></i> ไม่ทราบสถานะ</span>";
            }
            echo "</td>";
        
           
            
            $money_Image = isset($row['money_Image']) ? $row['money_Image'] : ''; 
            $imagePath = '../connect/receipt/img/' . $money_Image;
            
            // ตรวจสอบว่าอุปกรณ์เป็น "ชำรุด" และมีรูปภาพ
            if ($row['device_Con'] == 2 && !empty($money_Image) && file_exists($imagePath)) {
                // แสดงปุ่มที่สามารถคลิกเพื่อดูรูปภาพใน modal (ขนาดเล็ก)
                echo "<td><a href='#' class='btn btn-secondary btn-sm' data-bs-toggle='modal' data-bs-target='#imageModal' data-bs-image='" . htmlspecialchars($imagePath) . "' title='ดูรูปภาพ'><i class='bi bi-image-fill'></i> ดูรูปภาพ</a></td>";
            } elseif ($row['device_Con'] == 2) {
                // หากสถานะเป็น "ชำรุด" แต่ไม่มีรูปภาพ
                echo "<td style='background-color: #f8d7da; color: #721c24; font-weight: bold; text-align: center;'>ยังไม่แนบไฟล์</td>";


            } else {
                // หากไม่ใช่ "ชำรุด" ไม่มีข้อความใดๆ
                echo "<td></td>";
            }
            
            
            

    
    
    

            echo "</tr>";
            $i++;
        }
    } else {
        echo "<tr><td colspan='9'>ไม่พบข้อมูล</td></tr>";
    }
    ?>
</tbody>


<!-- Modal สำหรับแสดงภาพ -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="imageModalLabel">รูปภาพของอุปกรณ์</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- แสดงภาพที่คลิก -->
                <img src="" id="modalImage" class="img-fluid" alt="Image">
            </div>
        </div>
    </div>
</div>

<script>
    // เมื่อเปิด modal, เปลี่ยนแหล่งที่มาของรูปภาพ
    document.addEventListener('DOMContentLoaded', function () {
        var imageModal = document.querySelectorAll('[data-bs-toggle="modal"]');
        imageModal.forEach(function(element) {
            element.addEventListener('click', function() {
                var imagePath = element.getAttribute('data-bs-image');
                var modalImage = document.getElementById('modalImage');
                modalImage.src = imagePath;
            });
        });
    });
</script>


<form action="../connect/receipt/insert.php" method="post" enctype="multipart/form-data">
    <!-- โมดอลสำหรับการอัปโหลดไฟล์ -->
    <div class="modal fade" id="uploadImageModal" tabindex="-1" role="dialog" aria-labelledby="uploadImageModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="uploadImageModalLabel">การอัปโหลดไฟล์</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                
                <?php
// ดึงข้อมูล user_Id จาก URL
$device_Id = $_GET['device_Id'] ?? ''; // ใช้ข้อมูลจาก URL
$money_Image = ''; // ค่าเริ่มต้น
$imagePath = "../connect/receipt/img/"; // โฟลเดอร์เก็บรูปภาพ

if ($device_Id) {
    // ดึงชื่อไฟล์ money_Image จากฐานข้อมูล
    $sql = "SELECT money_Image FROM borrow.history_brs WHERE device_Id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $device_Id);
    $stmt->execute();
    $result = $stmt->get_result();

    // ถ้าพบข้อมูล
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $money_Image = $row['money_Image'];
    }
}
?>
<div class="modal-body">
    <!-- ชื่อคนทำชำรุด -->
    <!-- เปลี่ยนจาก user_Id เป็น device_Id -->
<div class="form-group mb-4" style="display: none;">
    <label for="device_Id" style="font-size: 16px; color: black;">ไอดีอุปกรณ์:</label>
    <input type="text" class="form-control" id="device_Id" name="device_Id" readonly value="<?php echo htmlspecialchars($device_Id); ?>"> 
</div>


    <!-- ฟอร์มการอัปโหลดไฟล์ -->
    <div class="form-group mb-4">
        <label for="money_Image" style="font-size: 16px; color: black;">เลือกไฟล์รูปภาพ:</label>
        <input type="file" class="form-control" id="money_Image" name="money_Image" accept="image/jpeg, image/png">
    </div>
</div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
                    <button type="submit" class="btn btn-primary">อัปโหลด</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- โหลดสคริปต์ Bootstrap และ jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>


<script>

function showDamageDetails(deviceId) {
    // ตั้งค่า device_Id ที่ถูกเลือกในฟอร์ม
    document.getElementById('device_Id').value = deviceId;
    
    // แสดงโมดอลการอัปโหลดไฟล์
    $('#uploadImageModal').modal('show');
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
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>

</body>

</html>
