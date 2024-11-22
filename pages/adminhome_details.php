<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin รายละเอียด</title>
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
                    <ul class="list-unstyled">
                        <li><a href="admin_equipment_com.php"
                                class="btn btn-light btn-lg w-100 mb-1 text-start rounded-3 p-2 shadow-sm fs-6"
                                style="color: #466da7;">อุปกรณ์คอมพิวเตอร์</a>
                        </li>
                        <li><a href="#" class="btn btn-light btn-lg w-100 mb-1 text-start rounded-3 p-2 shadow-sm fs-6"
                                style="color: #466da7;">อุปกรณ์วิทยาศาสตร์</a>
                        </li>
                        <li><a href="#" class="btn btn-light btn-lg w-100 mb-1 text-start rounded-3 p-2 shadow-sm fs-6"
                                style="color: #466da7;">อุปกรณ์ดนตรี</a>
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
                <h4 class="mb-0" style="font-size: 22px;">รายละเอียดอุปกรณ์</h4>
            </div>

            <!-- ฟอร์มด้านในจ้าาาาาาาาาาา -->
            <div class="p-5 bg-light border rounded shadow-sm mt-5 mx-auto" style="width: 700px; margin-bottom: 60px;">
                <h5 class="text-center">รายละเอียดการทำรายการ</h5>
                <!-- ปุ่มไอคอน -->
                <div class="d-flex justify-content-start mb-4"
                    style="max-width: 100%; margin: 0 auto; padding-top: 10px; margin-top: 40px; gap: 10px;">
                    <button class="btn btn-success px-3 py-2" data-bs-toggle="modal" data-bs-target="#approveModal"
                        style="font-size: 12px; border-radius: 3px; width: auto;">
                        <i class="bi bi-check-circle" style="font-size: 12px;"></i> อนุมัติ
                    </button>
                    <button class="btn btn-info text-white px-3 py-2" data-bs-toggle="modal"
                        data-bs-target="#returnModal" style="font-size: 12px; border-radius: 3px; width: auto;">
                        <i class="bi bi-arrow-repeat" style="font-size: 12px;"></i> รับคืน
                    </button>
                    <button class="btn btn-danger px-3 py-2" data-bs-toggle="modal" data-bs-target="#damageModal"
                        style="font-size: 12px; border-radius: 3px; width: auto;">
                        <i class="bi bi-x-circle" style="font-size: 12px;"></i> ชำรุด/สูญหาย
                    </button>
                </div>

                <div class="form-group" style="margin-bottom: 10px;; display: flex; align-items: center;">
                    <label for="deviceName" class="font-weight-bold text-success"
                        style="font-size: 16px; margin-right: 10px; white-space: nowrap; color: black !important;">
                        ชื่ออุปกรณ์ :
                    </label>
                    <input type="text" class="form-control" id="deviceName" value="Notebook Acer" readonly
                        style="padding: 10px; font-size: 16px; flex-grow: 1; opacity: 0.6; color: black !important;">
                </div>


                <div class="form-group row" style="margin-bottom: 10px;">
                    <div class="col-sm-6" style="padding-right: 5px;">
                        <label for="purpose" class="font-weight-bold" style="font-size: 16px; color: black;">
                            ชื่อผู้ใช้ :
                        </label>
                        <input type="text" class="form-control" id="deviceName" value="นางสาวพรวิสาข์ ปรีชา" readonly
                            style="padding: 10px; font-size: 16px; flex-grow: 1; opacity: 0.6; color: black !important;">
                        <!-- <textarea class="form-control" id="purpose"
                            style="padding: 10px; font-size: 16px; height: 45px; resize: none; overflow: hidden;"></textarea> -->

                    </div>

                    <div class="col-sm-6" style="padding-left: 5px;">
                        <label for="location" class="font-weight-bold" style="font-size: 16px; color: black;">
                            สถานะ :
                        </label>
                        <input type="text" class="form-control" id="deviceName" value="รอตรวจสอบ" readonly
                            style="padding: 10px; font-size: 16px; flex-grow: 1; opacity: 0.6; color: black !important;">
                        <!-- <textarea class="form-control" id="location"
                            style="padding: 10px; font-size: 16px; height: 45px; resize: none; overflow-y: auto;"></textarea> -->
                    </div>
                </div>
                <div class="form-group row" style="margin-bottom: 10px;  margin-top: 10px">
                    <div class="col-sm-6" style="padding-right: 5px;">
                        <label for="purpose" class="font-weight-bold " style="font-size: 16px; color: black;">
                            เพื่อไปใช้งาน :</label>
                        <input type="text" class="form-control" id="deviceName"
                            value="ยืมคอมพิวเตอร์เพื่อสอบนักเรียนชั้น ม.3/5" readonly
                            style="padding: 10px; font-size: 16px; flex-grow: 1; opacity: 0.6; color: black !important;">
                        <!-- <textarea class="form-control" id="purpose"
                            style="padding: 10px; font-size: 16px; height: 45px; resize: none; overflow-y: auto;"></textarea> -->
                    </div>

                    <div class="col-sm-6" style="padding-left: 5px;">
                        <label for="location" class="font-weight-bold " style="font-size: 16px; color: black;">
                            สถานที่นำไปใช้ :</label>
                        <input type="text" class="form-control" id="deviceName" value="ห้องสมุด" readonly
                            style="padding: 10px; font-size: 16px; flex-grow: 1; opacity: 0.6; color: black !important;">
                        <!-- <textarea class="form-control" id="location"
                            style="padding: 10px; font-size: 16px; height: 45px; resize: none; overflow-y: auto;"></textarea> -->
                    </div>
                </div>
            </div>
        </div>
        <!-- สิ้นสุดฟอร์มค่าาาาาาาาาา -->
        <!-- Modal สำหรับสถานะการยืม -->
        <div class="modal fade" id="approveModal" tabindex="-1" aria-labelledby="approveModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="approveModalLabel">สถานะการยืม</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>คุณต้องการอนุมัติการทำรายการนี้หรือไม่?</p>
                        <!-- ฟอร์มสำหรับเลือกการอนุมัติ -->
                        <form id="approvalForm" action="/บันทึกรายการ" method="POST">
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="radio" name="approval" id="approve"
                                    value="approve" required>
                                <label class="form-check-label" for="approve">อนุมัติ</label>
                            </div>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="radio" name="approval" id="disapprove"
                                    value="disapprove">
                                <label class="form-check-label" for="disapprove">ไม่อนุมัติ</label>
                            </div>

                            <!-- ฟิลด์หมายเหตุพร้อมปุ่มลบ -->
                            <div class="col-sm-6" style="padding-right: 5px; width: 100%">
                                <label for="purpose" class="font-weight-bold "
                                    style="margin-top :5px; font-size: 16px; ">
                                    หมายเหตุ :</label>
                                <textarea class="form-control" id="purpose"
                                    style=" padding: 10px; font-size: 16px; height: 50px; resize: none; overflow-y: auto;"></textarea>
                            </div>

                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">ยกเลิก</button>
                        <!-- ลิงก์ "ตกลง" ที่เชื่อมไปยัง Modal ยืนยัน -->
                        <button type="button" class="btn btn-success" data-bs-toggle="modal"
                            data-bs-target="#confirmModal">ตกลง</button>
                    </div>
                </div>
            </div>
        </div>

        <script>
            // ฟังก์ชันสำหรับลบข้อความในฟิลด์หมายเหตุ
            function clearRemarks() {
                document.getElementById('remarks').value = '';  // ล้างข้อความใน textarea
            }
        </script>


        <!-- Modal ยืนยันการทำรายการ -->
        <!-- Modal ยืนยันการทำรายการ -->
        <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
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
                        <button type="button" class="btn btn-danger" onclick="window.location.reload();">ยกเลิก</button>
                        <!-- ปุ่มตกลง (นำไปหน้า admin_homepages.php) -->
                        <a href="admin_homepages.php" class="btn btn-success">ตกลง</a>
                    </div>
                </div>
            </div>
        </div>


        <!-- JavaScript เพิ่มเติมที่ใช้รีเซ็ตฟอร์มเมื่อเปิด Modal -->
        <script>
            // รีเซ็ตฟอร์มเมื่อ Modal เปิด
            var approveModal = document.getElementById('approveModal');
            approveModal.addEventListener('show.bs.modal', function () {
                // รีเซ็ตฟอร์มเมื่อ Modal เปิด
                document.getElementById('approvalForm').reset();
            });
        </script>





        <!-- Modal สำหรับ "ชำรุด/สูญหาย" -->
        <div class="modal fade" id="damageModal" tabindex="-1" aria-labelledby="damageModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="damageModalLabel">ชำรุด/สูญหาย</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>คุณต้องการแจ้งว่าอุปกรณ์ชำรุดหรือสูญหายหรือไม่?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
                        <button type="button" class="btn btn-danger">ชำรุด/สูญหาย</button>
                    </div>
                </div>
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