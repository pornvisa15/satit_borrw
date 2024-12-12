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
                <a href="admin_equipment.php" class="nav-link text-white"
                    style="background-color:#406398; border-radius: 8px; padding: 12px 18px; transition: background-color 0.3s, transform 0.3s; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                    คลังอุปกรณ์
                </a>
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
        <?php
        include '../connect/myspl_das_satit.php';
        include '../connect/mysql_borrow.php';

        // รับค่า officerl_Id จาก URL
        if (isset($_GET['device_Id'])) {
            $device_Id = $_GET['device_Id'];

            // ดึงข้อมูลเจ้าหน้าที่ที่ต้องการแก้ไข
            $sq_equipment = "SELECT * FROM borrow.device_information 
            INNER JOIN borrow.officer_staff ON das_admin.useripass = officer_staff.useripass 
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







        <div class="card shadow-sm border-0" style="margin-top: 49px;">
            <div class="card-header text-white"
                style="background-color:#537bb7; color: white; padding-top: 10px; padding-bottom: 10px;">
                <h4 class="mb-0" style="font-size: 22px;">ข้อมูลอุปกรณ์</h4>
            </div>

            <!-- ฟอร์มด้านในจ้าาาาาาาาาาา -->
            <div class="p-5 bg-light border rounded shadow-sm mt-5 mx-auto" style="width: 650px; margin-bottom: 60px;">
                <h5 class="text-center mb-4">แก้ไขข้อมูลอุปกรณ์</h5>


                <div class="mb-4">
                    <label for="equipmentName" class="font-weight-bold"
                        style="font-size: 16px; color: black;">ชื่ออุปกรณ์:</label>
                    <input type="text" id="equipmentName" name="equipmentName" class="form-control"
                        placeholder="กรอกชื่ออุปกรณ์" required
                        style="margin-top: 5px; font-size: 16px; padding: 10px; border-radius: 5px; border: 1px solid #ced4da;">
                </div>

                <div class="mb-4">
                    <label for="assetNumber" class="font-weight-bold"
                        style="font-size: 16px; color: black;">เลขพัสดุ/ครุภัณฑ์:</label>
                    <input type="text" id="assetNumber" name="assetNumber" class="form-control"
                        placeholder="กรอกเลขพัสดุ/ครุภัณฑ์" required
                        style="margin-top: 5px; font-size: 16px; padding: 10px; border-radius: 5px; border: 1px solid #ced4da;">
                </div>
                <div class="mb-4">
                    <label for="usageFor" class="font-weight-bold"
                        style="font-size: 16px; color: black;">ประเภท:</label>
                    <select id="usageFor" name="usageFor" class="form-select" required
                        style="margin-top: 5px; font-size: 16px; padding: 10px; border-radius: 5px; border: 1px solid #ced4da;">
                        <option value="" disabled selected>ประเภท</option>
                        <option value="นักเรียน">อุปกรณ์คอมพิวเตอร์</option>
                        <option value="บุคลากร">อุปกรณ์วิทยาศาสตร์</option>
                        <option value="นักเรียน">อุปกรณ์ดนตรี </option>
                    </select>
                </div>
                <div class="mb-4">
                    <label for="purchaseDate" class="font-weight-bold"
                        style="font-size: 16px; color: black;">วันที่ซื้อ:</label>
                    <input type="date" id="purchaseDate" name="purchaseDate" class="form-control" required
                        style="margin-top: 5px; font-size: 16px; padding: 10px; border-radius: 5px; border: 1px solid #ced4da;">
                </div>

                <div class="mb-4 ">
                    <label for="price" class="font-weight-bold" style="font-size: 16px; color: black;">ราคา:</label>
                    <input type="number" id="price" name="price" class="form-control" placeholder="กรอกราคา (บาท)"
                        min="0" step="0.01" required
                        style="margin-top: 5px; font-size: 16px; padding: 10px; border-radius: 5px; border: 1px solid #ced4da;">
                </div>

                <div class="mb-4">
                    <label for="details" class="font-weight-bold"
                        style="font-size: 16px; color: black;">รายละเอียด:</label>
                    <textarea id="details" name="details" class="form-control" placeholder="กรอกรายละเอียดเพิ่มเติม"
                        rows="4" required style="margin-top: 5px; font-size: 16px; padding: 10px; border-radius: 5px; border: 1px solid #ced4da; 
               height: 150px; overflow-y: auto;"></textarea>
                </div>


                <div class="mb-4">
                    <label for="fileUpload" class="font-weight-bold"
                        style="font-size: 16px; color: black;">อัปโหลดไฟล์รูปภาพ:</label>
                    <input type="file" id="fileUpload" name="fileUpload" class="form-control" accept="image/*" required
                        style="margin-top: 5px; font-size: 16px; padding: 10px; border-radius: 5px; border: 1px solid #ced4da;">
                </div>

                <div class="mb-4">
                    <label for="usageFor" class="font-weight-bold"
                        style="font-size: 16px; color: black;">ใช้สำหรับ:</label>
                    <select id="usageFor" name="usageFor" class="form-select" required
                        style="margin-top: 5px; font-size: 16px; padding: 10px; border-radius: 5px; border: 1px solid #ced4da;">
                        <option value="" disabled selected>เลือกผู้ใช้งาน</option>
                        <option value="นักเรียน">นักเรียน</option>
                        <option value="บุคลากร">บุคลากร</option>
                    </select>
                </div>




                <!-- ฟอร์ม -->
                <form id="equipmentForm" action="process_data.php" method="POST">
                    <div class="text-center d-flex justify-content-center gap-3">
                        <!-- ปุ่มยกเลิก -->
                        <button type="button" class="btn btn-danger"
                            style="font-size: 16px; padding: 10px 20px; border-radius: 5px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);"
                            onclick="window.history.back();">
                            <i class="bi bi-x-circle"></i> ยกเลิก
                        </button>

                        <!-- ปุ่มบันทึก -->
                        <button type="button" class="btn btn-success"
                            style="font-size: 16px; padding: 10px 20px; border-radius: 5px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);"
                            data-bs-toggle="modal" data-bs-target="#confirmModal">
                            <i class="bi bi-check-circle"></i> บันทึกข้อมูล
                        </button>
                    </div>
                </form>

            </div>





            <!-- Modal ยืนยัน -->
            <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="confirmModalLabel">ยืนยันการทำรายการ</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>คุณต้องการบันทึกรายการนี้หรือไม่?</p>
                        </div>
                        <div class="modal-footer">
                            <!-- ปุ่มยกเลิก -->
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">ยกเลิก</button>
                            <!-- ปุ่มยืนยันการส่งฟอร์ม -->
                            <button type="submit" class="btn btn-success" form="equipmentForm">ตกลง</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>


</body>

</html>