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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="d-flex bg-light">
    <?php

    ?>
    <?php include 'sidebar.php'; ?>

    <div class="flex-grow-1 p-4">
        <?php include 'short.php'; ?>

        <div class="card shadow-sm border-0" style="margin-top: 49px;">
            <div class="card-header text-white"
                style="background-color:#537bb7; color: white; padding-top: 10px; padding-bottom: 10px;">
                <h4 class="mb-0" style="font-size: 22px;">ข้อมูลอุปกรณ์</h4>
            </div>
            <div class="p-5 bg-light border rounded shadow-sm mt-5 mx-auto" style="width: 650px; margin-bottom: 60px;">
                <h5 class="text-center mb-4">เพิ่มข้อมูลอุปกรณ์</h5>
                <form action="../connect/equipment/insert.php" method="post" enctype="multipart/form-data" id="equipmentForm">
    <div class="form-group" style="margin-bottom: 15px;">
        <label for="device_Numder" style="margin-bottom: 7px; font-size: 16px; color: black;">เลขพัสดุ/ครุภัณฑ์ :</label>
        <input type="text" class="form-control" id="device_Numder" name="device_Numder"
            placeholder="กรอกเลขพัสดุ/ครุภัณฑ์" required style="font-size: 14px;">
    </div>

    <div class="form-group" style="margin-bottom: 15px;">
        <label for="device_Name" style="margin-bottom: 7px; font-size: 16px; color: black;">ชื่ออุปกรณ์ :</label>
        <input type="text" class="form-control" id="device_Name" name="device_Name"
            placeholder="กรอกชื่ออุปกรณ์" required style="font-size: 14px;">
    </div>

    <div class="form-group" style="margin-bottom: 15px;">
        <label for="device_Date" style="margin-bottom: 7px; font-size: 16px; color: black;">วันที่ซื้อ :</label>
        <input type="date" class="form-control" id="device_Date" name="device_Date" required style="font-size: 14px;">
    </div>

    <div class="form-group" style="margin-bottom: 15px;">
        <label for="device_Price" style="margin-bottom: 7px; font-size: 16px; color: black;">ราคา :</label>
        <input type="number" class="form-control" id="device_Price" name="device_Price"
            placeholder="กรอกราคา (บาท)" min="0" step="1" required style="font-size: 14px;">
    </div>

    <div class="form-group" style="margin-bottom: 15px;">
        <label for="officer_Cotton" style="margin-bottom: 7px; font-size: 16px; color: black;">ผู้รับผิดชอบ :</label>
        <select class="form-select" name="officer_Cotton" required style="font-size: 14px;">
            <option value="" selected disabled>กรุณาเลือกผู้รับผิดชอบ</option>
            <option value="1">ฝ่ายคอมพิวเตอร์</option>
            <option value="2">ฝ่ายวิทยาศาสตร์</option>
            <option value="3">ฝ่ายดนตรี</option>
            <option value="4">ฝ่ายพัสดุ</option>
            <option value="5">ฝ่ายแอดมิน</option>
        </select>
    </div>

    <div class="form-group" style="margin-bottom: 15px;">
        <label for="device_Other" style="margin-bottom: 7px; font-size: 16px; color: black;">รายละเอียด :</label>
        <textarea class="form-control" id="device_Other" name="device_Other"
            placeholder="กรอกรายละเอียดในอุปกรณ์" required style="font-size: 14px; height: 100px; resize: none;"></textarea>
    </div>

    <div class="form-group mb-4" style="margin-bottom: 15px;">
        <label for="device_Image" style="margin-bottom: 7px; font-size: 16px; color: black;">รูปภาพ :</label>
        <input type="file" class="form-control" id="device_Image" name="device_Image"
            accept="image/jpeg, image/png, image/webp, image/gif" style="font-size: 14px;">
    </div>

    <div class="form-group mb-4" style="margin-bottom: 15px;">
        <label for="device_Access" class="font-weight-bold" style="font-size: 16px; color: black;">ใช้สำหรับ :</label>
        <select id="device_Access" name="device_Access" class="form-select" required style="font-size: 14px;">
            <option value="" selected disabled>กรุณาเลือก</option>
            <option value="1">นักเรียนและบุคลากร</option>
            <option value="2">บุคลากร</option>
        </select>
    </div>

    <div class="text-center d-flex justify-content-center gap-3">
        <button type="button" class="btn btn-danger" style="font-size: 16px;" onclick="window.location.href='admin_equipment.php';">
            <i class="bi bi-x-circle"></i> ยกเลิก
        </button>

        <button type="submit" class="btn btn-success" style="font-size: 16px;">
            <i class="bi bi-check-circle"></i> บันทึกข้อมูล
        </button>
    </div>

  
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
$(document).ready(function() {
    $('#equipmentForm').submit(function(e) {
        e.preventDefault(); // ❌ ป้องกันการรีโหลดหน้า
        
        let formData = new FormData(this); // ✅ เก็บค่าฟอร์มทั้งหมดรวมถึงไฟล์

        $.ajax({
            url: '../connect/equipment/insert.php',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                if (response.trim() === "success") {
                    Swal.fire({
                        icon: 'success',
                        title: 'บันทึกข้อมูลสำเร็จ',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        window.location.href = 'admin_equipment.php';
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
    function checkDeviceNumder() {
        const deviceNumderInput = document.getElementById('device_Numder');
        const deviceNumder = deviceNumderInput.value.trim();  // กรอกเลขพัสดุ/ครุภัณฑ์ที่ต้องการตรวจสอบ
        const errorElement = document.getElementById('deviceNumderError');

        // เรียกใช้ fetch เพื่อเช็คข้อมูลในฐานข้อมูล
        fetch(`check_device_Numder.php?device_Numder=${deviceNumder}`)
            .then(response => response.json())  // คาดว่าจะได้รับข้อมูลเป็น JSON
            .then(data => {
                if (data.exists) {
                    errorElement.style.display = 'inline';  // แสดงข้อความผิดพลาด
                    deviceNumderInput.classList.add('is-invalid');  // เปลี่ยนกรอบเป็นสีแดง
                    const audio = new Audio('path_to_alert_sound.mp3'); // เสียงแจ้งเตือน
                    audio.play();
                } else {
                    errorElement.style.display = 'none';  // ซ่อนข้อความผิดพลาด
                    deviceNumderInput.classList.remove('is-invalid');  // ลบกรอบแดงออก
                }
            })
            .catch(error => {
                console.error('Error checking device number:', error);
            });
    }
</script>
<script>
    // ฟังก์ชันที่จะกำหนดค่าวันที่สูงสุดเป็นวันที่ปัจจุบัน
    document.addEventListener('DOMContentLoaded', function() {
        const today = new Date().toISOString().split('T')[0]; // ดึงวันที่ปัจจุบันในรูปแบบ YYYY-MM-DD
        document.getElementById('device_Date').setAttribute('max', today); // กำหนดค่าสำหรับวันที่
    });
</script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
