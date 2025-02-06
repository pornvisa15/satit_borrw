<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>หน้าการจอง</title>
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.24/dist/sweetalert2.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.24/dist/sweetalert2.all.min.js"></script>

</head>

<body class="d-flex flex-column min-vh-100">
    <?php

    if (isset($_GET['id'])) {
        $device_Id = $_GET['id'];
    }


    include 'sidebar.php';
    include "../connect/mysql_borrow.php";
    include '../connect/myspl_das_satit.php';

    $device_Id = isset($_GET['id']) ? $_GET['id'] : 'ข้อมูลไม่ถูกส่ง';
    $sql = "SELECT * FROM borrow.device_information WHERE device_Id= '$device_Id'";
    $result = $conn->query($sql);
    date_default_timezone_set('Asia/Bangkok'); // ตั้งโซนเวลา
    $currentDate = date('Y-m-d H:i:s');

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $device_Name = isset($row['device_Name']) ? $row['device_Name'] : 'ข้อมูลไม่ถูกส่ง';
        $device_Status = isset($row['device_Con']) ? $row['device_Con'] : 'ข้อมูลไม่ถูกส่ง';
        $device_Image = isset($row['device_Image']) ? '../connect/equipment/equipment/img/' . $row['device_Image'] : 'ข้อมูลไม่ถูกส่ง';
        $device_Other = isset($row['device_Other']) ? $row['device_Other'] : 'ข้อมูลไม่ถูกส่ง';
        $officer_Cotton = isset($row['officer_Cotton']) ? $row['officer_Cotton'] : 'ข้อมูลไม่ถูกส่ง';
        $device_Id = isset($row['device_Id']) ? $row['device_Id'] : 'ข้อมูลไม่ถูกส่ง';
        $device_Numder = isset($row['device_Numder']) ? $row['device_Numder'] : 'ข้อมูลไม่ถูกส่ง';
        $history_Id = isset($row['device_Name']) ? $row['device_Name'] : 'ข้อมูลไม่ถูกส่ง';
        $history_device = isset($row['device_Name']) ? $row['device_Name'] : 'ข้อมูลไม่ถูกส่ง';
        $parcel_Numder = isset($row['device_Numder']) ? $row['device_Numder'] : 'ข้อมูลไม่ถูกส่ง';
        $history_Status = isset($row['history_Status']) ? $row['history_Status'] : 'ข้อมูลไม่ถูกส่ง';
    } else {
        $device_Name = 'ข้อมูลไม่ถูกส่ง';
        $device_Status = 'ข้อมูลไม่ถูกส่ง';
        $device_Image = 'ข้อมูลไม่ถูกส่ง';
        $device_Other = 'ข้อมูลไม่ถูกส่ง';
        $officer_Cotton = 'ข้อมูลไม่ถูกส่ง';
        $device_Id = 'ข้อมูลไม่ถูกส่ง';
        $device_Numder = 'ข้อมูลไม่ถูกส่ง';
        $history_Id = 'ข้อมูลไม่ถูกส่ง';
        $history_device = 'ข้อมูลไม่ถูกส่ง';
        $parcel_Numder = 'ข้อมูลไม่ถูกส่ง';
        $history_Status = 'ข้อมูลไม่ถูกส่ง';
    }


    ?>

    <div class="col-md-9 col-lg-10">
        <div class="p-3 bg-light border rounded shadow-sm">
            <div class="row">
                <div class="col-2 text-end mt-3">
                    <?php
                    $department_Name = '';
                    switch ($officer_Cotton) {
                        case 1:
                            $department_Name = 'อุปกรณ์คอมพิวเตอร์';
                            break;
                        case 2:
                            $department_Name = 'อุปกรณ์วิทยาศาสตร์';
                            break;
                        case 3:
                            $department_Name = 'อุปกรณ์ดนตรี';
                            break;
                        case 4:
                            $department_Name = 'อุปกรณ์พัสดุ';
                            break;

                        default:
                            $department_Name = 'ข้อมูลไม่ระบุ';
                    }
                    ?>
                    <h5 class="card-title text-start ms-4"
                        style="font-size: 18px; font-weight: bold; text-transform: uppercase; color: #007468; text-align: left; margin-left: 10px; white-space: nowrap; margin-top: 10px;"
                        onmouseover="this.style.color='#006043';" onmouseout="this.style.color='#007468';">
                        <?= $department_Name; ?>
                    </h5>
                </div>
            </div>


            <div class="p-5 bg-light border rounded shadow-sm mt-5 mx-auto"
                style="max-width: 800px; margin-bottom: 30px;">
                <div class="container">

                    <h5 class="text-center text-success mb-4">รายละเอียดการทำรายการ</h5>

                    <form action="../connect/reservation/insert.php" method="post" enctype="multipart/form-data">

                        <input type="text" name="history_Status_BRS" id="historyStatusBRS" hidden>
                        <div class="container mt-4">
                            <div class="form-group mb-4">
                                <label for="device_Name" class="font-weight-bold text-success"
                                    style="font-size: 16px; color: #007468;">ชื่ออุปกรณ์ :</label>
                                <input type="text" class="form-control" id="history_devic"
                                    value="<?= htmlspecialchars($device_Name) ?>" readonly
                                    style="padding: 10px; font-size: 16px; opacity: 0.6;">

                                <input type="text" class="form-control" hidden name="device_Id"
                                    value="<?= htmlspecialchars($device_Id) ?>"
                                    style="padding: 10px; font-size: 16px; opacity: 0.6;">
                                <input type="text" class="form-control" hidden name="device_Name"
                                    value="<?= htmlspecialchars($history_device) ?>"
                                    style="padding: 10px; font-size: 16px; opacity: 0.6;">
                                <input type="text" class="form-control" hidden name="device_Numder"
                                    value="<?= htmlspecialchars($parcel_Numder) ?>"
                                    style="padding: 10px; font-size: 16px; opacity: 0.6;">
                                <input type="text" class="form-control" hidden name="officer_Cotton"
                                    value="<?= htmlspecialchars($officer_Cotton) ?>"
                                    style="padding: 10px; font-size: 16px; opacity: 0.6;">

                            </div>

                            <div class="form-group row mb-4">

                                <div class="col-sm-6">
                                    <label for="history_Other" class="font-weight-bold text-success"
                                        style="font-size: 16px; color: #007468;">เพื่อไปใช้งาน :</label>
                                    <textarea class="form-control" id="history_Other" name="history_Other" required
                                        style="padding: 10px; font-size: 16px; height: 60px; resize: none;"></textarea>
                                </div>
                                <div class="col-sm-6">
                                    <label for="history_Another" class="font-weight-bold text-success"
                                        style="font-size: 16px; color: #007468;">สถานที่นำไปใช้ :</label>
                                    <textarea class="form-control" id="history_Another" name="history_Another" required
                                        style="padding: 10px; font-size: 16px; height: 60px; resize: none;"></textarea>
                                </div>
                            </div>

                            <div class="form-group row mb-4">
                                <div class="col-sm-4">
                                    <label for="history_Borrow" class="font-weight-bold text-success"
                                        style="font-size: 16px; color: rgba(0, 116, 72, 0.6);">วันที่ยืม :</label>
                                    <input type="date" class="form-control" id="history_Borrow" name="history_Borrow"
                                        style="padding: 10px; font-size: 16px;" required>

                                </div>

                                <div class="col-sm-4">
                                    <label for="history_Return" class="font-weight-bold text-success"
                                        style="font-size: 16px; color: rgba(0, 116, 72, 0.6);">วันที่คืน :</label>
                                    <input type="date" class="form-control" id="history_Return" name="history_Return"
                                        style="padding: 10px; font-size: 16px;" required>
                                </div>

                                <div class="col-sm-4">
                                    <label for="history_Stop" class="font-weight-bold text-success"
                                        style="font-size: 16px; color: rgba(0, 116, 72, 0.6);">เวลาคืน :</label>
                                    <input type="time" class="form-control" id="history_Stop" name="history_Stop"
                                        style="padding: 10px; font-size: 16px;" required>
                                </div>
                            </div>



                            <div class="text-center d-flex justify-content-center gap-4" style="padding-top: 20px;">
                                <!-- ปุ่มยกเลิก -->
                                <button class="btn btn-danger"
                                    style="font-size: 16px; padding: 10px 20px; border-radius: 5px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);"
                                    id="cancelButton">
                                    <i class="bi bi-x-circle"></i> ยกเลิก
                                </button>

                                <!-- ปุ่มบันทึก -->
                                <button class="btn btn-success"
                                    style="font-size: 16px; padding: 10px 20px; border-radius: 5px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);"
                                    id="saveButton">
                                    <i class="bi bi-check-circle"></i> บันทึกข้อมูล
                                </button>
                            </div>
                            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                            <script>
                                // ฟังก์ชันให้ถามยืนยันก่อนการยกเลิก
                                document.getElementById('cancelButton').addEventListener('click', async function (e) {
                                    e.preventDefault(); // ป้องกันไม่ให้ลิงก์ทำงานทันที

                                    // แสดง SweetAlert เพื่อยืนยันการยกเลิก
                                    const result = await Swal.fire({
                                        title: 'ต้องการยกเลิกรายการหรือไม่?',
                                        icon: 'warning',
                                        iconColor: '#d33', // เปลี่ยนสีไอคอนเป็นสีแดง
                                        showCancelButton: true,
                                        confirmButtonText: 'ยกเลิก',
                                        cancelButtonText: 'ไม่ยกเลิก',
                                        confirmButtonColor: '#d33', // เปลี่ยนสีของปุ่มยกเลิกให้ดูเด่น
                                        cancelButtonColor: '#3085d6', // เปลี่ยนสีของปุ่มไม่ยกเลิก
                                        background: '#f8f9fa', // เปลี่ยนพื้นหลังให้ดูสะอาด
                                        backdrop: true
                                    });

                                    if (result.isConfirmed) {
                                        // ถ้าผู้ใช้กด "ยกเลิก" ให้ไปยังหน้าหลัก
                                        window.location.href = "../pages/homepages.php"; // เปลี่ยนเส้นทางตามต้องการ
                                    }
                                });



                                // ฟังก์ชันการบันทึกข้อมูล
                                document.getElementById('history_Other').addEventListener('input', function () {
                                    if (this.value.trim() !== '') {
                                        this.style.borderColor = ''; // คืนสีกรอบ
                                    } else {
                                        this.style.borderColor = 'red'; // เปลี่ยนสีกรอบเป็นสีแดง
                                    }
                                });

                                document.getElementById('history_Another').addEventListener('input', function () {
                                    if (this.value.trim() !== '') {
                                        this.style.borderColor = ''; // คืนสีกรอบ
                                    } else {
                                        this.style.borderColor = 'red'; // เปลี่ยนสีกรอบเป็นสีแดง
                                    }
                                });

                                document.getElementById('history_Borrow').addEventListener('input', function () {
                                    if (this.value.trim() !== '') {
                                        this.style.borderColor = ''; // คืนสีกรอบ
                                    } else {
                                        this.style.borderColor = 'red'; // เปลี่ยนสีกรอบเป็นสีแดง
                                    }
                                });

                                document.getElementById('history_Return').addEventListener('input', function () {
                                    if (this.value.trim() !== '') {
                                        this.style.borderColor = ''; // คืนสีกรอบ
                                    } else {
                                        this.style.borderColor = 'red'; // เปลี่ยนสีกรอบเป็นสีแดง
                                    }
                                });

                                document.getElementById('history_Stop').addEventListener('input', function () {
                                    if (this.value.trim() !== '') {
                                        this.style.borderColor = ''; // คืนสีกรอบ
                                    } else {
                                        this.style.borderColor = 'red'; // เปลี่ยนสีกรอบเป็นสีแดง
                                    }
                                });

                               
 
                            
                            </script>

                        </div>

                    </form>
                    <div class="mt-3"
                        style="font-size: 11px; color: #555; padding-top: 20px; line-height: 1.5; text-align: left;">
                        <strong style="color: red;">หมายเหตุ * </strong>
                        AM (Ante Meridiem) หมายถึงช่วงเวลา ก่อนเที่ยง (12:00 AM - 11:59 AM), เช่น 6:00 AM คือ 6 โมงเช้า
                        PM (Post Meridiem) หมายถึงช่วงเวลา หลังเที่ยง (12:00 PM - 11:59 PM), เช่น 6:00 PM คือ 6 โมงเย็น
                    </div>

                </div>



                <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>



            </div>
        </div>
    </div>
</body>

</html>
<footer style="background-color: #495057;" class="text-light py-3 mt-4">
    <div class="container text-center">
        <p class="mb-0">&copy; 2024 S.TSU Application V 2.0 | พัฒนาโดย ทีมงาน S.TSU</p>
    </div>
</footer>
</body>

</html>