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





    <div class="d-flex flex-column text-white p-4"
        style="width: 250px; min-height: 100vh; background-color: #466da7;  margin-left: auto; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);">
        <h3 class="mb-4 text-center"
            style="background: rgba(0, 0, 0, 0.3); backdrop-filter: blur(5px); color: white; padding: 18px 20px; border-radius: 13px; ">
            Admin
        </h3>


        <ul class="nav flex-column">
            <li class="nav-item mb-3">
                <a href="admin_homepages.php" class="nav-link text-white"
                    style="background-color:#406398; border-radius: 8px; padding: 12px 18px; transition: background-color 0.3s, transform 0.3s; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                    หน้าหลัก
                </a>
            </li>
            <li class="nav-item mb-3">
                <a class="nav-link text-white d-flex align-items-center" data-bs-toggle="collapse" href="#borrowSection"
                    role="button" aria-expanded="false" aria-controls="borrowSection"
                    style="background-color:#406398; border-radius: 8px; padding: 12px 18px; transition: background-color 0.3s, transform 0.3s; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                    คลังอุปกรณ์
                    <i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <div class="collapse mt-2" id="borrowSection">
                    <ul class="list-unstyled" style="color: #052659;">
                        <li><a href="admin_equipment_com.php"
                                class="btn btn-light btn-lg w-100 mb-1 text-start rounded-3 p-2 shadow-sm fs-6">อุปกรณ์คอมพิวเตอร์</a>
                        </li>
                        <li><a href="reservation_science.php"
                                class="btn btn-light btn-lg w-100 mb-1 text-start rounded-3 p-2 shadow-sm fs-6">อุปกรณ์วิทยาศาสตร์</a>
                        </li>
                        <li><a href="reservation_music.php"
                                class="btn btn-light btn-lg w-100 mb-1 text-start rounded-3 p-2 shadow-sm fs-6">อุปกรณ์ดนตรี</a>
                        </li>

                    </ul>
                </div>
            </li>
            <li class="nav-item mb-3">
                <a href="admin_equipment_com.php" class="nav-link text-white"
                    style="background-color:#406398; border-radius: 8px; padding: 12px 18px; transition: background-color 0.3s, transform 0.3s; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                    ข้อมูลเจ้าหน้าที่
                </a>
            </li>
            <li class="nav-item mb-3">
                <a href="admin_record.php" class="nav-link text-white"
                    style="background-color:#406398; border-radius: 8px; padding: 12px 18px; transition: background-color 0.3s, transform 0.3s; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                    ประวัติการใช้อุปกรณ์
                </a>
            </li>
            <li class="nav-item mb-3">
                <a href="#" class="nav-link text-white"
                    style="background-color: #406398; border-radius: 8px; padding: 12px 18px; transition: background-color 0.3s, transform 0.3s; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                    ออกจากระบบ
                </a>
            </li>
        </ul>
    </div>


    <div class="flex-grow-1 p-4">
        <div class="d-flex justify-content-end mt-auto">
            <div class="d-flex align-items-center p-2"
                style="background-color: #ffffff; border-radius: 8px; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1); border: 1px solid #e0e0e0;">
                <i class="bi bi-person-circle"
                    style="font-size: 25px; color: #3b5681; border-radius: 50%; background-color: #ffffff;"></i>
                <span class="ms-2"
                    style="color: #05142d; font-size: 14px; font-weight: 500; letter-spacing: 0.3px;">แอดมิน: วิลเลี่ยม
                    เชคสเปียร์</span>
            </div>
        </div>

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