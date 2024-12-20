<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>การจอง</title>  
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body class="d-flex flex-column min-vh-100">

<?php
session_start();
include 'sidebar.php';
include "../connect/mysql_borrow.php";

// รับข้อมูลที่ส่งมาจากหน้า homepages.php
$deviceID = isset($_GET['id']) ? $_GET['id'] : 'ข้อมูลไม่ถูกส่ง';

// ดึงข้อมูลจากฐานข้อมูล
$sql = "SELECT * FROM borrow.device_information WHERE device_Numder = '$deviceID'"; // ใช้ device_Numder เป็นเงื่อนไข
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // ถ้ามีข้อมูล
    $row = $result->fetch_assoc();
    $deviceName = $row['device_Name'];
    $deviceStatus = $row['device_Con'];
    $deviceImage = '../connect/equipment/equipment/img/' . $row['device_Image']; // ปรับ path ให้เหมาะสม
    $deviceOther = $row['device_Other']; // ดึงข้อมูล device_Other จากฐานข้อมูล
    $cottonId = $row['cotton_Id'];
} else {
    // ถ้าไม่มีข้อมูล
    $deviceName = 'ข้อมูลไม่ถูกส่ง';
    $deviceStatus = 'ข้อมูลไม่ถูกส่ง';
    $deviceImage = 'ข้อมูลไม่ถูกส่ง';
    $deviceOther = 'ข้อมูลไม่ถูกส่ง';
    $cottonId = 'ข้อมูลไม่ถูกส่ง';
}
?>


<!-- กล่องเนื้อหา -->
<div class="col-md-9 col-lg-10">
    <div class="p-3 bg-light border rounded shadow-sm">
        <div class="row">
            <div class="col-2 text-end mt-3">
            <?php
// ตรวจสอบค่า cotton_Id และกำหนดข้อความที่เหมาะสม
$departmentName = '';
switch ($cottonId) {
    case 1:
        $departmentName = 'อุปกรณ์คอมพิวเตอร์';
        break;
    case 2:
        $departmentName = 'อุปกรณ์วิทยาศาสตร์';
        break;
    case 3:
        $departmentName = 'อุปกรณ์ดนตรี';
        break;
    default:
        $departmentName = 'ข้อมูลไม่ระบุ';
}
?>
<h5 class="card-title text-start ms-4" 
    style="font-size: 18px; font-weight: bold; text-transform: uppercase; color: #007468; text-align: left; margin-left: 10px; white-space: nowrap; margin-top: 10px;"
    onmouseover="this.style.color='#006043';" onmouseout="this.style.color='#007468';">
    <?= $departmentName; ?>
</h5>





            </div>
            
            <div class="d-flex justify-content-center mt-5 mb-5">
    <div class="p-5 bg-light border rounded shadow-sm" style="max-width: 800px; width: 100%;">
        <div class="d-flex align-items-center">
            <!-- รูปภาพ -->
            <img src="<?= $deviceImage; ?>" class="img-fluid me-3" alt="Image Placeholder" 
     style="max-width: 250px; height: 250px; object-fit: cover; 
            transition: transform 0.3s ease; cursor: pointer;" 
     data-bs-toggle="modal" data-bs-target="#zoomModal"
     onmouseover="this.style.transform='scale(1.1)';" 
     onmouseout="this.style.transform='scale(1)';">


           <!-- Modal สำหรับแสดงภาพขนาดใหญ่ -->
<div class="modal fade" id="zoomModal" tabindex="-1" aria-labelledby="zoomModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <img src="<?= $deviceImage; ?>" class="img-fluid" alt="Zoomed Image" 
                     style="max-width: 80%; max-height: 400px; height: auto;">
            </div>
        </div>
    </div>
</div>

<!-- เนื้อหา -->
<div class="ms-5">  <!-- ปรับค่า ms-0 เพื่อลดระยะห่างจากขวา -->
    <h5 class="mb-2 text-dark" style="font-size: 1.1rem;">ชื่ออุปกรณ์: <?= $deviceName; ?></h5>
    <div class="mb-2">
        <p class="mb-1 text-muted" style="font-size: 0.9rem;">
            <strong>เลขพัสดุ/ครุภัณฑ์:</strong> <?= $deviceID; ?>
        </p>
        <p class="mb-1 text-muted" style="font-size: 0.9rem;">
            <strong>รายละเอียด:</strong> <?= $deviceOther; ?>
        </p>
        <p class="mb-1 text-muted" style="font-size: 0.9rem;">
    <strong>สถานที่รับ:</strong> 
    <?php
    switch ($cottonId) {
        case 1:
            echo 'ฝ่ายคอมพิวเตอร์';
            break;
        case 2:
            echo 'ฝ่ายวิทยาศาสตร์';
            break;
        case 3:
            echo 'ฝ่ายดนตรี';
            break;
        default:
            echo 'ข้อมูลไม่ระบุ';
    }
    ?>
</p>
        <p class="mb-1 text-muted" style="font-size: 0.9rem;">
            <strong>สถานะการใช้งาน:</strong> 
            <span style="color: <?= $deviceStatus == 1 ? '#78C756' : '#FF090D'; ?>; font-weight: bold;">
                <?= $deviceStatus == 1 ? 'ว่าง' : 'ไม่ว่าง'; ?>
            </span>
        </p>
    </div>

    <!-- ปุ่มจอง -->


</div>


        </div>
        <div class="d-flex justify-content-end" style="width: 100%;">
    <!-- ปุ่มจอง -->
    <a href="reservation1_book_com.php?id=<?php echo $deviceID; ?>">
        <button class="btn btn-sm" 
                style="background-color: <?php echo ($deviceStatus == 1) ? '#78C756' : '#FFC721'; ?>; color: white; transition: transform 0.3s ease; border: none;"
                onmouseover="this.style.transform='scale(1.3)';" 
                onmouseout="this.style.transform='scale(1)';">
            จอง
        </button>
    </a>
</div>


<?php if ($deviceStatus != 1): // แสดงประวัติการยืมเฉพาะเมื่อสถานะไม่ว่าง ?>
    <div class="p-5 bg-white border rounded shadow-sm mt-5 mx-auto" style="max-width: 800px;">
        <!-- Title Section -->
        <h5 class="text-center mb-4 text-white p-2" style="background-color: #007468; border-radius: 4px;">ประวัติการยืม</h5>

        <!-- Table Section -->
        <table class="table table-hover table-bordered">
            <thead class="text-white" style="background-color: #007468; font-size: 0.85rem;">
                <tr>
                    <th scope="col">ผู้ยืม</th>
                    <th scope="col">วันที่ยืม</th>
                    <th scope="col">วันที่คืน</th>
                    <th scope="col">เวลาคืน</th>
                </tr>
            </thead>
            <tbody style="font-size: 0.8rem;">
                <tr>
                    <td>นางสาวพรวิสาข์ ปรีชา</td>
                    <td>2024-11-18</td>
                    <td>2024-11-25</td>
                    <td>15:30</td>
                </tr>
                <tr>
                    <td>นายอภิชาติ จิตรานนท์</td>
                    <td>2024-11-10</td>
                    <td>2024-11-15</td>
                    <td>14:45</td>
                </tr>
                <tr>
                    <td>นางสาวจุฬาภรณ์ สุขกิจ</td>
                    <td>2024-11-05</td>
                    <td>2024-11-12</td>
                    <td>09:00</td>
                </tr>
            </tbody>
        </table>
    </div>
<?php endif; ?>





    </div>
</div>


        </div>
    </div>
</div>





<!-- Footer -->
<footer style="background-color: #495057;" class="text-light py-3 mt-4">
    <div class="container text-center">
        <p class="mb-0">&copy; 2024 S.TSU Application V 2.0 | พัฒนาโดย ทีมงาน S.TSU</p>
    </div>
</footer>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-zZ1AI1RrP2aSxvrA8mpzVUr3js6qTgnsC8RUV6hxX7t8hzl0TjtRktGhAKGwd5nL" crossorigin="anonymous"></script>
</body>
</html>
