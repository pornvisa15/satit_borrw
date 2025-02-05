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
<?php
 
?>


      <?php  include 'sidebar.php' ?>

    <div class="flex-grow-1 p-4">
    <?php include 'short.php'; ?>

        <div class="card shadow-sm border-0" style="margin-top: 49px;">
            <div class="card-header text-white"
                style="background-color:#537bb7; color: white; padding-top: 10px; padding-bottom: 10px;">
                <h4 class="mb-0" style="font-size: 22px;">ข้อมูลเจ้าหน้าที่</h4>
            </div>

            <!-- ฟอร์มด้านในจ้าาาาาาาาาาา -->
            <div class="p-5 bg-light border rounded shadow-sm mt-5 mx-auto" style="width: 650px; margin-bottom: 60px;">
                <h5 class="text-center mb-4">เเก้ไขข้อมูลเจ้าหน้าที่</h5>

                <!-- ชื่อ-นามสกุล -->
                <div class="mb-4">
                    <label for="fullname" class="font-weight-bold"
                        style="font-size: 16px; color: black;">ชื่อ-นามสกุล:</label>
                    <input type="text" class="form-control" id="deviceName" value="สมชาย ใจดี"
                        style="padding: 10px; font-size: 16px; flex-grow: 1; color: black !important;">
                </div>

                <!-- เจ้าหน้าที่ฝ่าย -->
                <div class="mb-4">
                    <label for="department" class="font-weight-bold"
                        style="font-size: 16px; color: black;">เจ้าหน้าที่ฝ่าย:</label>
                    <input type="text" class="form-control" id="department" value="ฝ่ายวิชาการวิทยาศาสตร์"
                        style="padding: 10px; font-size: 16px; flex-grow: 1; color: black !important;">
                </div>

                <div class="text-center d-flex justify-content-center gap-3">
                    <!-- ปุ่มยกเลิก -->
                    <button class="btn btn-danger"
                        style="font-size: 16px; padding: 10px 20px; border-radius: 5px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);"
                        onclick="window.history.back();">
                        <i class="bi bi-x-circle"></i> ยกเลิก
                    </button>

                    <!-- ปุ่มบันทึก -->
                    <button class="btn btn-success"
                        style="font-size: 16px; padding: 10px 20px; border-radius: 5px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);"
                        data-bs-toggle="modal" data-bs-target="#confirmModal">
                        <i class="bi bi-check-circle"></i> บันทึกข้อมูล
                    </button>
                </div>

                <!-- Modal ยืนยัน -->
                <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="confirmModalLabel">ยืนยันการทำรายการ</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p>คุณต้องการบันทึกรายการนี้หรือไม่?</p>
                            </div>
                            <div class="modal-footer">
                                <!-- ปุ่มยกเลิก -->
                                <button type="button" class="btn btn-danger"
                                    onclick="window.location.reload();">ยกเลิก</button>
                                <!-- ปุ่มตกลง (นำไปหน้า admin_homepages.php) -->
                                <a href="admin_staffinfo.php" class="btn btn-success">ตกลง</a>
                            </div>
                        </div>
                    </div>
                </div>




                <script>
                    function submitForm() {
                        // ตัวอย่างการดำเนินการเมื่อกด "ยืนยัน"
                        alert("บันทึกข้อมูลสำเร็จ!");
                        // ตัวเลือก: เปลี่ยนเส้นทาง
                        window.location.href = "admin_staffinfo.php";
                    }
                </script>





            </div>
        </div>
    </div>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>


</body>

</html>