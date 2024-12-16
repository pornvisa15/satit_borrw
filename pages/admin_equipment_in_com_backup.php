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
        style="width: 250px; min-height: 100vh; background-color: #466da7; margin-left: auto; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);">
        <h3 class="mb-4 text-center"
            style="background: rgba(0, 0, 0, 0.3); backdrop-filter: blur(5px); color: white; padding: 18px 20px; border-radius: 13px;">
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
                <a href="admin_equipment.php" class="nav-link text-white"
                    style="background-color:#406398; border-radius: 8px; padding: 12px 18px; transition: background-color 0.3s, transform 0.3s; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                    คลังอุปกรณ์
                </a>
            </li>
            <li class="nav-item mb-3">
                <a href="admin_staffinfo.php" class="nav-link text-white"
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

            <!-- การแก้ไข -->
            <div class="card-header text-white"
                style="background-color:#537bb7; color: white; padding-top: 10px; padding-bottom: 10px;">
                <h4 class="mb-0" style="font-size: 22px;">ข้อมูลอุปกรณ์</h4>
            </div>
            <div class="p-5 bg-light border rounded shadow-sm mt-5 mx-auto" style="width: 650px; margin-bottom: 60px;">
                <h5 class="text-center mb-4">เพิ่มข้อมูลอุปกรณ์</h5>
                <form action="../connect/equipment/insert.php" method="post" enctype="multipart/form-data"
                    id="equipmentForm">
                    <!-- ช่องกรอกชื่ออุปกรณ์ -->
                    <div class="form-group" style="margin-bottom: 15px;">
                        <label for="device_Name" style="margin-bottom: 7px; font-size: 16px; color: black;">ชื่ออุปกรณ์
                            :</label>
                        <input type="text" class="form-control" id="device_Name" name="device_Name"
                            placeholder="กรอกชื่ออุปกรณ์" required style="font-size: 14px;">
                    </div>

                    <div class="form-group" style="margin-bottom: 15px;">
                        <label for="device_Numder"
                            style="margin-bottom: 7px; font-size: 16px; color: black;">เลขพัสดุ/ครุภัณฑ์ :</label>
                        <input type="text" class="form-control" id="device_Numder" name="device_Numder"
                            placeholder="กรอกเลขพัสดุ/ครุภัณฑ์" required style="font-size: 14px;">
                    </div>

                    <div class="form-group mb-4" style="margin-bottom: 15px;">
                        <label for="device_Type">ประเภท:</label>
                        <select id="device_Type" name="device_Type" class="form-select"
                            style="width: 100%; font-size: 14px; margin-top: 5px;" required>
                            <option value="" selected disabled>กรุณาเลือกฝ่าย</option>
                            <option value="ฝ่ายวิชาการคอมพิวเตอร์">ฝ่ายวิชาการคอมพิวเตอร์</option>
                            <option value="ฝ่ายวิชาการวิทยาศาสตร์">ฝ่ายวิชาการวิทยาศาสตร์</option>
                            <option value="ฝ่ายดนตรี">ฝ่ายดนตรี</option>
                            <option value="ฝ่ายพัสดุ">ฝ่ายพัสดุ</option>
                            <option value="แอดมิน">แอดมิน</option>
                        </select>
                    </div>


                    <div class="form-group" style="margin-bottom: 15px;">
                        <label for="device_Date" style="margin-bottom: 7px; font-size: 16px; color: black;">วันที่ซื้อ
                            :</label>
                        <input type="date" class="form-control" id="device_Date" name="device_Date" required
                            style="font-size: 14px;">
                    </div>

                    <div class="form-group" style="margin-bottom: 15px;">
                        <label for="device_Price"
                            style="margin-bottom: 7px; font-size: 16px; color: black;">ราคา:</label>
                        <input type="number" class="form-control" id="device_Price" name="device_Price"
                            placeholder="กรอกราคา (บาท)" min="0" step="1" required
                            style="font-size: 14px; padding: 10px; border-radius: 5px; border: 1px solid #ced4da; -webkit-appearance: none; -moz-appearance: textfield;">
                    </div>
                    <div class="form-group" style="margin-bottom: 15px;">
                        <label for="device_Duty" style="margin-bottom: 7px; font-size: 16px; color: black;">ผู้รับผิดชอบ
                            :</label>
                        <select class="form-select" name="useripass" required
                            style="font-size: 14px; border-radius: 5px; padding: 10px; margin-top: 5px;">
                            <option value="" selected disabled>กรุณาเลือกผู้รับผิดชอบ</option>
                            <?php
                            include "../connect/mysql_borrow.php";
                            include "../connect/myspl_das_satit.php"; //ดึงไฟล์นี้เพื่อเชื่อมฐานข้อมูล
                            $sql = "SELECT * FROM borrow.officer_staff INNER JOIN das_satit.das_admin ON officer_staff.useripass = das_admin.useripass WHERE officer_staff.officer_Right = 3";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                // output data of each row
                                while ($row = $result->fetch_assoc()) {
                                    ?>
                                    <option value="<?php echo $row['useripass'] ?>">
                                        <?php echo $row['praname'] . $row['name'] . " " . $row['surname'] ?>
                                    </option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group" style="margin-bottom: 15px;">
                        <label for="device_Other" style="margin-bottom: 7px; font-size: 16px; color: black;">รายละเอียด
                            :</label>
                        <textarea class="form-control" id="device_Other" name="device_Other"
                            placeholder="กรอกรายละเอียดในอุปกรณ์" required
                            style="font-size: 14px; height: 100px; resize: none;"></textarea>
                    </div>

                    <div class="form-group mb-4" style="margin-bottom: 15px;">
                        <label for="device_Image" style="margin-bottom: 7px; font-size: 16px; color: black;">รูปภาพ
                            :</label>
                        <input type="file" class="form-control" id="device_Image" name="device_Image"
                            accept="image/jpeg, image/png" style="font-size: 14px;">

                    </div>
                    <div class="form-group mb-4" style="margin-bottom: 15px;">
                        <label for="device_Access" class="font-weight-bold"
                            style="font-size: 16px; color: black;">ใช้สำหรับ :</label>
                        <select id="device_Access" name="device_Access" class="form-select"
                            style="font-size: 14px; margin-top: 5px;" required>
                            <option value="" selected disabled>กรุณาเลือก</option>
                            <option value="1">บุคลากร</option>
                            <option value="2">บุคลากรและนักเรียน</option>
                        </select>
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

                </form>
            </div>
        </div>
    </div>

    <!-- Modal for confirmation -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.querySelector("#confirmModal .btn-success").addEventListener("click", function () {
            document.getElementById("equipmentForm").submit();  // ส่งฟอร์มจริงๆ
        });
    </script>
</body>

</html>