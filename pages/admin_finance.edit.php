<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin เพิ่มข้อมูลเจ้าหน้าที่</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body class="d-flex bg-light">
    <?php
   
    include 'sidebar.php';
    include '../connect/myspl_das_satit.php';
    include '../connect/mysql_borrow.php';

    // รับค่า device_Id จาก URL
    if (isset($_GET['finance_Id'])) {
        $finance_Id = $_GET['finance_Id'];

        // ดึงข้อมูลอุปกรณ์ที่ต้องการแก้ไข
        $sql = "SELECT * FROM borrow.finance 
                WHERE finance.finance_Id = '$finance_Id'";  
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            // กำหนดค่าตัวแปร
    
            $officer_Cotton = $row['officer_Cotton']; 
   
        } else {
            echo "ไม่พบข้อมูลอุปกรณ์ที่ต้องการแก้ไข";
            exit();
        }
    } else {
        echo "ข้อมูลไม่ถูกต้อง";
        exit();
    }
    ?>
 
   <div class="flex-grow-1 p-4">
    <?php include 'short.php'; ?>

    <div class="card shadow-sm border-0" style="margin-top: 49px;">
        <div class="card-header text-white" style="background-color:#537bb7; color: white; padding-top: 10px; padding-bottom: 10px;">
            <h4 class="mb-0" style="font-size: 22px;">ตั้งค่าการเงิน</h4>
        </div>

        <div class="p-5 bg-light border rounded shadow-sm mt-5 mx-auto" style="width: 650px; margin-bottom: 60px;">
            <h5 class="text-center mb-4">แก้ไขข้อมูลการเงิน</h5>
            <form action="../connect/finance/update.php" method="post" enctype="multipart/form-data" id="updateForm">

                <input type="hidden" name="finance_Id" value="<?php echo htmlspecialchars($finance_Id); ?>">

                <div class="mb-4">
    <label for="useripass_display" class="form-label">ชื่อ-นามสกุล:</label>
    <?php
    // ดึงข้อมูล useripass ตาม finance_Id
    $sql_officer = "
    SELECT 
        officer_staff.useripass, 
        das_admin.praname, 
        das_admin.name, 
        das_admin.surname
    FROM borrow.finance
    INNER JOIN borrow.officer_staff ON borrow.finance.useripass = officer_staff.useripass
    INNER JOIN das_satit.das_admin ON officer_staff.useripass = das_admin.useripass
    WHERE borrow.finance.finance_Id = ?";

    // เตรียมคำสั่ง SQL
    $stmt_officer = $conn->prepare($sql_officer);
    $stmt_officer->bind_param("i", $finance_Id);  // ผูก finance_Id เข้ากับ SQL
    $stmt_officer->execute();
    $result_officer = $stmt_officer->get_result();

    if ($result_officer->num_rows > 0) {
        $officer = $result_officer->fetch_assoc();
        $fullname = htmlspecialchars($officer['praname'] . $officer['name'] . " " . $officer['surname']);
        $useripass = htmlspecialchars($officer['useripass']);  // เก็บ useripass ไว้ใช้ใน input hidden

        // แสดงชื่อแบบข้อความที่แก้ไขไม่ได้
        echo "<input type='text' id='useripass_display' class='form-control' value='$fullname' disabled>";

        // ส่งค่า useripass ผ่าน input hidden
        echo "<input type='hidden' id='useripass' name='useripass' value='$useripass'>";
    } else {
        echo "<input type='text' class='form-control' value='ไม่พบข้อมูลเจ้าหน้าที่' disabled>";
    }
    ?>
</div>

<div class="form-group mb-4" style="font-size: 16px; color: black;">
    <label for="officer_Cotton" class="font-weight-bold" style="font-size: 16px; color: black;">ผู้รับผิดชอบ :</label>
    <select id="officer_Cotton" class="form-select no-dropdown" name="officer_Cotton" required
        style="margin-top: 5px; font-size: 16px; padding: 10px; border-radius: 5px; border: 1px solid #ced4da; -webkit-appearance: none; -moz-appearance: none; appearance: none; background-image: none; pointer-events: none; background-color: #e9ecef;">
        <option value="" selected disabled>กรุณาเลือกฝ่าย</option>
        <option value="1" <?php echo ($officer_Cotton == 1 ? 'selected' : ''); ?>>ฝ่ายคอมพิวเตอร์</option>
        <option value="2" <?php echo ($officer_Cotton == 2 ? 'selected' : ''); ?>>ฝ่ายวิทยาศาสตร์</option>
        <option value="3" <?php echo ($officer_Cotton == 3 ? 'selected' : ''); ?>>ฝ่ายดนตรี</option>
        <option value="4" <?php echo ($officer_Cotton == 4 ? 'selected' : ''); ?>>ฝ่ายพัสดุ</option>
        <option value="5" <?php echo ($officer_Cotton == 5 ? 'selected' : ''); ?>>แอดมิน</option>
    </select>
</div>



<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
function loadOfficerCotton(useripass) {
    if (useripass === "") {
        $('#officer_Cotton').val('').prop('disabled', false); // ยกเลิกการล็อกให้เลือกได้
        return;
    }

    $.ajax({
        url: 'get_officer_cotton.php',
        type: 'POST',
        data: { useripass: useripass },
        success: function(response) {
            $('#officer_Cotton').val(response).prop('disabled', false); // ล็อก dropdown หลังจากเลือก
        },
        error: function() {
            alert('เกิดข้อผิดพลาดในการโหลดข้อมูล');
        }
    });
}


</script>



    <!-- Upload Image Section -->
                <div class="mb-4">
                    <label for="finance_Image" class="font-weight-bold" style="font-size: 16px; color: #333;">อัปโหลดไฟล์รูปภาพ:</label>
                    <?php
                    $finance_Image = isset($row['finance_Image']) ? $row['finance_Image'] : '';
                    $filePath = "../connect/finance/finance/img/" . $finance_Image;
                    ?>
                    <div style="margin-top: 10px;">
                        <?php if (!empty($finance_Image) && file_exists($filePath)) { ?>
                            <img src="<?php echo htmlspecialchars($filePath); ?>" 
                                 alt="Current Image" style="width: 100px; height: 100px; object-fit: cover; border-radius: 8px;">
                           
                        
                        <?php } ?>
                    </div>

                    <input type="file" id="finance_Image" name="finance_Image" class="form-control" accept="image/*" style="margin-top: 10px;">
                    <input type="hidden" name="finance_Image_hidden" value="<?php echo htmlspecialchars($finance_Image); ?>">
                </div>

                <!-- Submit Button -->
                <div class="text-center d-flex justify-content-center gap-3">
                    <button class="btn btn-success" type="submit">
                        <i class="bi bi-check-circle"></i> บันทึกการแก้ไข
                    </button>
                </div>
                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function() {
    $('#updateForm').submit(function(e) {
        e.preventDefault();  // ป้องกันการรีโหลดหน้า

        let formData = new FormData(this); // เก็บข้อมูลจากฟอร์มทั้งหมด

        // ตรวจสอบว่าไฟล์รูปภาพถูกเลือกหรือยัง
        if ($('#finance_Image').val() === "") {
            Swal.fire({
                icon: 'warning',
                title: 'กรุณาเลือกภาพก่อน',
                confirmButtonText: 'OK'
            });
            return; // หยุดการทำงานถ้ายังไม่ได้เลือกไฟล์
        }

        $.ajax({
            url: '../connect/finance/update.php',  // URL ของไฟล์ PHP ที่จะทำงาน
            type: 'POST',
            data: formData,
            contentType: false,  // เพื่อไม่ให้ส่งข้อมูล content-type
            processData: false,  // ป้องกันการแปลงข้อมูลแบบ default ของ jQuery
            success: function(response) {
                if (response.trim() === "success") {
                    Swal.fire({
                        icon: 'success',
                        title: 'บันทึกข้อมูลสำเร็จ',
                        text: 'ข้อมูลถูกอัปเดตเรียบร้อยแล้ว',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        window.location.href = 'admin_finance.php';  // เปลี่ยนหน้าเมื่อเสร็จสิ้น
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'เกิดข้อผิดพลาด',
                        text: response
                    });
                }
            },
            error: function() {
                Swal.fire({
                    icon: 'error',
                    title: 'เกิดข้อผิดพลาด',
                    text: 'ไม่สามารถเชื่อมต่อเซิร์ฟเวอร์ได้'
                });
            }
        });
    });
});


</script>


            </form>
        </div>
    </div>
</div>

    <script>
            <?php
  
    if (isset($_SESSION['message'])) {
        echo "<script>alert('" . $_SESSION['message'] . "');</script>";
        unset($_SESSION['message']); // ลบข้อความหลังจากแสดง
    }
    ?>

        function submitForm() {
            const deviceName = document.getElementById('device_Name').value;
            const devicePrice = document.getElementById('device_Price').value;
            if (deviceName === "" || devicePrice === "") {
                alert("กรุณากรอกข้อมูลให้ครบถ้วน");
                return false;
            }
            alert("บันทึกการแก้ไขเรียบร้อย");
            return true; // ส่งฟอร์มเมื่อทุกอย่างถูกต้อง
        }
    </script>
</body>

</html>
