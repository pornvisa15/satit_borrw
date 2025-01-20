<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $promptpay = $_POST['promptpay'];
    $pay = $_POST['pay'];

    // สร้าง URL สำหรับ PromptPay QR Code
    $qrUrl = "https://promptpay.io/$promptpay/$pay.png";  // เพิ่ม .png เพื่อให้แสดงเป็นรูป

    // ไม่บันทึกข้อมูลลงในไฟล์ CSV

    echo json_encode(['status' => 'success', 'qrUrl' => $qrUrl]);
    exit;
}
?>



<!DOCTYPE html>
<html lang="th">
<head>
  
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>QRCODE PromptPay</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.4.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        @import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css');
       

    </style>
</head>
<body class="d-flex bg-light">
<?php
session_start();
include 'sidebar.php'; // Include Sidebar
include '../connect/myspl_das_satit.php';
include '../connect/mysql_studentsatit.php';
include '../connect/mysql_borrow.php';


// Set search term from GET parameter or default to an empty string
$searchTerm = $_GET['search'] ?? '';
$selectedCottonId = $_GET['useripass'] ?? 0;
?>
<div class="flex-grow-1 p-4">
    <?php include 'short.php'; ?>
 
            
    <div class="card shadow-sm mt-5">
        <div class="card-header text-white" style="background-color:#537bb7; color: white; padding-top: 10px; padding-bottom: 10px;">
                <h4 class="mb-0" style="font-size: 22px;">สร้างคิวอาร์โค้ด</h4>
</div>
<div class="container mb-5 mt-5">
    <div class="col-md-6 mx-auto">
        <!-- กล่องคลุมฟอร์ม -->
        <div class="card" style="border-radius: 10px; border: 1px solid #ddd; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
            <div class="card-header" style="background-color: #537bb7; color: white; border-radius: 10px 10px 0 0;">
                <h5 class="mb-0"> QRCODE PromptPay</h5>
            </div>
            <div class="card-body">
            <form action="../connect/addqr/insert.php" method="post" enctype="multipart/form-data" id="equipmentForm">
    <div class="col-md-12 mb-4">
        <label style="color: #3b5681;">ชื่อ-นามสกุล</label>
        <select id="useripass" class="form-control" name="useripass" required onchange="loadOfficerCotton(this.value)" style="border-color: #3b5681;">
            <option value="" selected disabled style="color: #b0b0b0;">กรุณาเลือกชื่อ-นามสกุล</option>

            <?php
            include "../connect/myspl_das_satit.php";

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $sql = "
                SELECT officer_staff.useripass, das_admin.praname, das_admin.name, das_admin.surname, officer_staff.officer_Cotton, officer_staff.officerl_Id
                FROM borrow.officer_staff
                INNER JOIN das_satit.das_admin
                ON officer_staff.useripass = das_admin.useripass
                WHERE das_admin.statuson = 1
            ";

            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $fullname = $row['praname'] . $row['name'] . " " . $row['surname'];
                    echo "<option value='{$row['useripass']}' data-officerid='{$row['officerl_Id']}'>{$fullname}</option>";
                }
            } else {
                echo "<option value='' style='color: #b0b0b0;'>ไม่มีข้อมูล</option>";
            }

            $conn->close();
            ?>
        </select>
    </div>

    <input type="hidden" id="officerl_Id" name="officerl_Id">

    <div class="form-group mb-4" style="font-size: 16px; color: black;">
        <label for="officer_Cotton" class="font-weight-bold" style="font-size: 16px; color: #3b5681;">ผู้รับผิดชอบ :</label>
        <select id="officer_Cotton" class="form-select no-dropdown" name="officer_Cotton" required
            style="margin-top: 5px; font-size: 16px; padding: 10px; border-radius: 5px; border: 1px solid #ced4da; background-color: #e9ecef;" disabled>
            <option value="" selected disabled>กรุณาเลือกฝ่าย</option>
            <option value="1">ฝ่ายคอมพิวเตอร์</option>
            <option value="2">ฝ่ายวิทยาศาสตร์</option>
            <option value="3">ฝ่ายดนตรี</option>
            <option value="4">ฝ่ายพัสดุ</option>
            <option value="5">แอดมิน</option>
        </select>
    </div>

    <div class="col-md-12 mb-4">
        <label style="color: #3b5681;">หมายเลข PromptPay</label>
        <input class="form-control" name="promptpay" id="promptpay" placeholder="0XXXXXXXXX" required style="border-color: #3b5681;">
    </div>

    <div class="col-md-12 mt-3">
        <input type="hidden" name="finance_Image" id="finance_Image">
        <button type="submit" class="btn" style="background-color: #537bb7; color: white; width: 100%;" id="btn1">
            <i class="fa-solid fa-floppy-disk"></i> สร้าง QRCODE
        </button>
    </div>

    <div class="text-center mt-1">
        <img id="qrImage" width="50%" style="display:none;" />
        <div class="col-md-12 mt-2" id="saveBtn" style="display:none;">
            <button type="submit" class="btn btn-success">
                <i class="bi bi-check-circle"></i> บันทึกข้อมูล
            </button>
        </div>
    </div>
</form>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function loadOfficerCotton(useripass) {
        let officerId = $('#useripass option:selected').data('officerid');
        $('#officerl_Id').val(officerId);

        $.ajax({
            url: 'get_officer_cotton.php',
            type: 'POST',
            data: { useripass: useripass },
            success: function(response) {
                $('#officer_Cotton').val(response).prop('disabled', false);
            },
            error: function() {
                alert('เกิดข้อผิดพลาดในการโหลดข้อมูล');
            }
        });
    }

    $(document).ready(function () {
        $('#equipmentForm').submit(function (e) {
            e.preventDefault();

            let promptpay = $('#promptpay').val();

            if (promptpay.length === 10 && !isNaN(promptpay)) {
                $('#btn1').hide();

                let qrUrl = "https://promptpay.io/" + promptpay + ".png";
                $('#qrImage').attr('src', qrUrl).show();
                $('#saveBtn').show();

                Swal.fire({
                    icon: 'success',
                    title: 'สร้าง QR Code สำเร็จ!',
                    timer: 1500
                });

                $('#btn1').show();
            } else {
                Swal.fire({
                    icon: 'warning',
                    title: 'กรุณากรอกหมายเลข PromptPay ให้ครบ 10 หลัก'
                });
            }
        });

        $('#saveBtn button[type="submit"]').click(function (e) {
            e.preventDefault();

            $('#finance_Image').val($('#qrImage').attr('src'));

            $.ajax({
                url: '../connect/addqr/insert.php',
                method: 'POST',
                data: $('#equipmentForm').serialize(),
                success: function () {
                    Swal.fire({
                        icon: 'success',
                        title: 'บันทึกข้อมูลสำเร็จ!',
                        timer: 1500
                    });

                    $('#equipmentForm')[0].reset();
                    $('#qrImage').hide();
                    $('#saveBtn').hide();

                    setTimeout(function () {
                        window.location.href = "../pages/admin_finance.php";
                    }, 1500);
                }
            });
        });
    });
</script>




<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>

</body>


</html>
