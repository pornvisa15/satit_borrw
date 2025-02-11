admin_record backup.php
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin เพิ่มข้อมูลเจ้าหน้าที่</title>
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="d-flex bg-light">

    <?php include 'sidebar.php' ?>

    <div class="flex-grow-1 p-4">
    <?php include 'short.php'; ?>
        <div class="card shadow-sm border-0" style="margin-top: 49px;">
            <div class="card-header text-white"
                style="background-color:#537bb7; color: white; padding-top: 10px; padding-bottom: 10px;">
                <h4 class="mb-0" style="font-size: 22px;">ข้อมูลเจ้าหน้าที่</h4>
            </div>

            <?php

            include "../connect/myspl_das_satit.php";

            // รับค่า officerl_Id จาก URL
            if (isset($_GET['officerl_Id'])) {
                $officerl_Id = $_GET['officerl_Id'];

                // ดึงข้อมูลเจ้าหน้าที่ที่ต้องการแก้ไข
                $sql = "SELECT * FROM das_satit.das_admin 
            INNER JOIN satit_borrow.officer_staff ON das_admin.useripass = officer_staff.useripass 
            WHERE officer_staff.officerl_Id = '$officerl_Id'";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $name = $row['praname'] . $row['name'] . " " . $row['surname'];
                    $department = $row['officer_Right'];
                } else {
                    echo "ไม่พบข้อมูลเจ้าหน้าที่ที่ต้องการแก้ไข";
                    exit();
                }
            } else {
                echo "ข้อมูลไม่ถูกต้อง";
                exit();
            }
            ?>

            <!-- ฟอร์มแก้ไขข้อมูลเจ้าหน้าที่ -->
            <div class="p-5 bg-light border rounded shadow-sm mt-5 mx-auto" style="width: 650px; margin-bottom: 60px;">

                <h5 class="text-center mb-4">แก้ไขข้อมูลเจ้าหน้าที่</h5>


                <form action="../connect/officer/update.php" method="post" onsubmit="return submitForm()">
                    <input type="hidden" name="officerl_Id" value="<?php echo $officerl_Id; ?>">

                    <div class="mb-3">
                        <label for="name" class="form-label">ชื่อ-นามสกุล</label>
                        <!-- ทำให้ไม่สามารถแก้ไขได้โดยการใช้ readonly -->
                        <input type="text" class="form-control" value="<?php echo $name; ?>" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="department" class="form-label">สิทธิการเข้าใช้:</label>
                        <select class="form-select" name="officer_Right" required>
                            <option value="3" <?php echo ($department == "แอดมิน") ? 'selected' : ''; ?>>แอดมิน</option>
                            <option value="4" <?php echo ($department == "เจ้าหน้าที่") ? 'selected' : ''; ?>>เจ้าหน้าที่
                            </option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="department" class="form-label">เจ้าหน้าที่ฝ่าย:</label>
                        <select class="form-select" name="officer_Cotton" required>
                            <option value="1" <?php echo ($department == "ฝ่ายคอมพิวเตอร์") ? 'selected' : ''; ?>>
                                ฝ่ายคอมพิวเตอร์</option>
                            <option value="2" <?php echo ($department == "ฝ่ายวิทยาศาสตร์") ? 'selected' : ''; ?>>
                                ฝ่ายวิทยาศาสตร์</option>
                            <option value="3" <?php echo ($department == "ฝ่ายดนตรี") ? 'selected' : ''; ?>>ฝ่ายดนตรี
                            </option>
                            <option value="4" <?php echo ($department == "ฝ่ายพัสดุ") ? 'selected' : ''; ?>>ฝ่ายพัสดุ
                            </option>
                            <option value="5" <?php echo ($department == "แอดมิน") ? 'selected' : ''; ?>>แอดมิน</option>
                        </select>
                    </div>

                    <div class="text-center d-flex justify-content-center gap-3">

                        <!-- ปุ่มบันทึก -->
                        <button class="btn btn-success"
                            style="font-size: 16px; padding: 10px 20px; border-radius: 5px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);"
                            type="submit">
                            <i class="bi bi-check-circle"></i> บันทึกการแก้ไข
                        </button>
                    </div>
                </form>



            </div>
        </div>
    </div>

    <script>
        function submitForm() {
            // ตัวอย่างการดำเนินการเมื่อกด "ยืนยัน"
            alert("บันทึกการแก้ไข");
            // เปลี่ยนเส้นทางไปหน้า admin_staffinfo.php หลังจากบันทึกสำเร็จ
            window.location.href = "admin_staffinfo.php";
        }
    </script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>


</body>

</html>
cdnjs.cloudflare.com
11:21
น้องพลอยคนงาม💗🩵💎
Thanyalak Phonrit
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

include 'sidebar.php'; // Include Sidebar
include '../connect/myspl_das_satit.php';
include '../connect/mysql_studentsatit.php';
include '../connect/mysql_borrow.php';

// Retrieve session value
$user_department_id = $_SESSION['officer_Cotton'] ?? 0;

// Dropdown filter value
$cottonFilter = isset($_GET['officer_Cotton']) ? intval($_GET['officer_Cotton']) : 0;

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
       <div class="d-flex justify-content-between" style="gap: 20px; margin-top: 15px;">
                    <?php include 'admin3.php'; ?>
                    <form method="get" action="" style="flex: 1;">
    <div class="mb-3" style="display: inline-flex; justify-content: space-between; width: 100%;">
        <!-- เลือกสถานะรวม -->
        <form method="GET" action="" style="flex: 1;">
    <div class="mb-3" style="display: inline-flex; justify-content: space-between; width: 100%;">
        <!-- เลือกสถานะรวม -->
        <select id="combined_status" name="combined_status" class="form-select" style="width: 180px; font-size: 14px; font-weight: normal;" onchange="this.form.submit()">
    <option value="" selected disabled>กรุณาเลือกสถานะ</option>
    <option value="all" <?= (isset($_GET['combined_status']) && $_GET['combined_status'] === 'all') ? 'selected' : '' ?>>ทั้งหมด</option> <!-- เพิ่มตัวเลือก "ทั้งหมด" -->
    <!-- history_Status_BRS options -->
   
    <option value="history_1" <?= (isset($_GET['combined_status']) && $_GET['combined_status'] === 'history_1') ? 'selected' : '' ?>>รอคืน</option>
    <!-- hreturn_Status options -->
    <option value="hreturn_1" <?= (isset($_GET['combined_status']) && $_GET['combined_status'] === 'hreturn_1') ? 'selected' : '' ?>>สภาพปกติ</option>
    <option value="hreturn_2" <?= (isset($_GET['combined_status']) && $_GET['combined_status'] === 'hreturn_2') ? 'selected' : '' ?>>สภาพไม่สมบูรณ์</option>
    <option value="hreturn_3" <?= (isset($_GET['combined_status']) && $_GET['combined_status'] === 'hreturn_3') ? 'selected' : '' ?>>ผู้ยืมซ่อมแซม</option>
    <option value="hreturn_4" <?= (isset($_GET['combined_status']) && $_GET['combined_status'] === 'hreturn_4') ? 'selected' : '' ?>>ชดใช้เป็นพัสดุ</option>
    <option value="hreturn_7" <?= (isset($_GET['combined_status']) && $_GET['combined_status'] === 'hreturn_7') ? 'selected' : '' ?>>แนบไฟล์ค่าเสียหาย</option>
</select>

    </div>
</form>


    </div>
</form>
              
     </div>
     <div class="input-group mb-3" style="margin-top: -12px; margin-left: 1px; margin-right: 5px;">
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
            <th style="width: 1%;">ลำดับ</th>
            <th style="width: 5%;">เลขพัสดุ /ครุภัณฑ์</th>
            <th style="width: 5%;">ชื่ออุปกรณ์</th>
            <th style="width: 4%;">จำนวนครั้ง/ยืม</th>
            <th style="width: 5%;">ชื่อ/นามสกุล ยืม</th>
            <th style="width: 4%;">สถานะอุปกรณ์</th>
            <th style="width: 5%;">ไฟล์รูป</th>
        </tr>
    </thead>
    <tbody>
    <?php
    $showAll = isset($_GET['show_all']) ? true : false;
    $cottonId = isset($_GET['cottonId']) ? $_GET['cottonId'] : '';

    $sql = "SELECT * FROM satit_borrow.history_brs WHERE 1=1";
    
    if (isset($_GET['combined_status']) && $_GET['combined_status'] !== '') {
        $combinedStatus = $_GET['combined_status'];
    
        // ตรวจสอบถ้าเลือก "ดูทั้งหมด"
        if ($combinedStatus === 'all') {
            // ไม่เพิ่มเงื่อนไขใด ๆ เพื่อดึงข้อมูลทั้งหมด
        } elseif (str_starts_with($combinedStatus, 'history_')) {
            $historyStatusBRS = explode('_', $combinedStatus)[1];
            $sql .= " AND history_Status_BRS = $historyStatusBRS";
        } elseif (str_starts_with($combinedStatus, 'hreturn_')) {
            $hreturnStatus = explode('_', $combinedStatus)[1];
            $sql .= " AND hreturn_Status = $hreturnStatus";
        }
    }
    
    

// เรียกข้อมูลจากฐานข้อมูล
$result = $conn->query($sql);

    if ($user_department_id != 5) {
        $sql .= " AND history_brs.officer_Cotton = $user_department_id";
    } elseif ($cottonFilter > 0) {
        $sql .= " AND history_brs.officer_Cotton = $cottonFilter";
    }

    $sql .= " AND history_brs.history_Numder = (
        SELECT MAX(history_Numder) 
        FROM satit_borrow.history_brs h 
        WHERE h.device_Id = history_brs.device_Id
    ) 
    AND history_brs.history_Status_BRS != 2
   
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

            echo "<td>"; // สถานะอุปกรณ์

// แสดงสถานะสำหรับ history_Status_BRS
if ($row['history_Status_BRS'] == 0) {
    echo "<span class='badge rounded-pill bg-warning text-dark' style='font-size: 12px;'> 
            <i class='bi bi-clock-history'></i> รออนุมัติ
          </span>";
} elseif ($row['history_Status_BRS'] == 1) {
    echo "<span class='badge rounded-pill bg-secondary' style='font-size: 12px;'> 
            <i class='bi bi-check-circle'></i> รอคืน
          </span>";
}

elseif ($row['history_Status_BRS'] == 2) {
    echo "<span class='badge rounded-pill bg-danger text-white' style='font-size: 12px;'> 
        <i class='bi bi-x-circle'></i> ไม่อนุมัติ
      </span>";


}

// แสดงสถานะสำหรับ hreturn_Status
if ($row['hreturn_Status'] == 1) {
    echo "<span class='badge rounded-pill bg-success' style='font-size: 12px;'> 
            <i class='bi bi-check-circle'></i> สภาพปกติ</span>";
} elseif ($row['hreturn_Status'] == 2) {
    echo "<span class='badge rounded-pill' style='font-size: 12px; background-color:hsl(14, 98.70%, 70.00%); color:rgb(59, 59, 59);'> 
            <i class='bi bi-exclamation-triangle'></i> สภาพไม่สมบูรณ์
          </span>";
} elseif ($row['hreturn_Status'] == 3) {
    echo "<span class='badge rounded-pill bg-info text-dark' style='font-size: 12px;'> 
            <i class='bi bi-tools'></i> ผู้ยืมซ่อมแซม</span>";
} elseif ($row['hreturn_Status'] == 4) {
    echo "<span class='badge rounded-pill bg-secondary' style='font-size: 12px;'> 
            <i class='bi bi-box'></i> ชดใช้เป็นพัสดุ</span>";
}if ($row['hreturn_Status'] == 7) {
    echo "<div class='d-flex justify-content-center align-items-center gap-2' style='height: 100%;'>
            <a href='#' onclick='showDamageDetails(\"" . htmlspecialchars($row['device_Id']) . "\")' 
               class='badge rounded-pill bg-danger text-decoration-none text-light' 
               style='cursor: pointer; font-size: 12px;'>
               <i class='bi bi-exclamation-circle'></i> แนบไฟล์ค่าเสียหาย
            </a>
            
            <button onclick='changeStatusToZero(\"" . htmlspecialchars($row['device_Id']) . "\")' 
               class='btn btn-success rounded-pill px-3 py-1 text-white shadow-sm' 
               style='font-size: 12px;'>
               <i class='bi bi-check-circle'></i> สถานะ
            </button>
          </div>";  
}

echo "</td>";


            // ตรวจสอบการมีรูปภาพในฐานข้อมูล
            $money_Image = isset($row['money_Image']) ? $row['money_Image'] : ''; 
            $imagePath = '../connect/receipt/img/' . $money_Image;

            if ($row['hreturn_Status'] == 7) {
                if (!empty($money_Image) && file_exists($imagePath)) {
                    echo "<td><a href='#' class='btn btn-secondary btn-sm' data-bs-toggle='modal' data-bs-target='#imageModal' data-bs-image='" . htmlspecialchars($imagePath) . "' title='ดูรูปภาพ'>
                            <i class='bi bi-image-fill'></i> ดูรูปภาพ</a></td>";
                } else {
                    echo "<td style='background-color: #f8d7da; color: #721c24; font-weight: bold; text-align: center;'>ยังไม่แนบไฟล์</td>";
                }
            }

            echo "</tr>";
            $i++;
        }
    } else {
        echo "<tr><td colspan='9'>ไม่พบข้อมูล</td></tr>";
    }
    ?>
    </tbody>
</table>

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
function changeStatusToZero(deviceId) {
    // ส่งคำขอ AJAX เพื่อเปลี่ยนสถานะจาก 7 เป็น 0
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "update_status.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    // ส่ง deviceId เพื่ออัปเดตสถานะ
    xhr.send("device_Id=" + deviceId);

    // เมื่อการอัปเดตเสร็จสิ้น ให้เปลี่ยนสถานะในหน้าเว็บทันที
    xhr.onload = function() {
        if (xhr.status === 200) {
            // เปลี่ยนสถานะของปุ่มและการแสดงผลให้เป็น 0 (ถ้าการอัปเดตสำเร็จ)
            alert("สถานะถูกเปลี่ยนเป็น 0");
            // ปรับการแสดงผลในหน้าเว็บ (อาจจะซ่อนปุ่มหรือเปลี่ยนข้อความ)
            // คุณสามารถใช้ JavaScript เพื่อปรับ DOM ตามต้องการ
        }
    };
}
</script>
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
    $sql = "SELECT money_Image FROM satit_borrow.history_brs WHERE device_Id = ?";
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