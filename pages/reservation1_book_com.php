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

</head>

<body class="d-flex flex-column min-vh-100">
    <?php

    if (isset($_GET['id'])){
         $device_Id = $_GET['id'];
    }
       
    session_start();
    include 'sidebar.php';
    include "../connect/mysql_borrow.php";
    include '../connect/myspl_das_satit.php';

    // รับข้อมูลที่ส่งมาจากหน้า homepages.php
    $device_Id = isset($_GET['id']) ? $_GET['id'] : 'ข้อมูลไม่ถูกส่ง';

    // ดึงข้อมูลจากฐานข้อมูล
 
    $sql =  "SELECT * FROM borrow.device_information WHERE device_Id= '$device_Id'";
   
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // ถ้ามีข้อมูล
        $row = $result->fetch_assoc();

        // ตรวจสอบและกำหนดค่าให้ตัวแปร
        $device_Name = isset($row['device_Name']) ? $row['device_Name'] : 'ข้อมูลไม่ถูกส่ง';
        $device_Status = isset($row['device_Con']) ? $row['device_Con'] : 'ข้อมูลไม่ถูกส่ง';
        $device_Image = isset($row['device_Image']) ? '../connect/equipment/equipment/img/' . $row['device_Image'] : 'ข้อมูลไม่ถูกส่ง';
        $device_Other = isset($row['device_Other']) ? $row['device_Other'] : 'ข้อมูลไม่ถูกส่ง';
        $cotton_Id = isset($row['cotton_Id']) ? $row['cotton_Id'] : 'ข้อมูลไม่ถูกส่ง';
        $device_Id = isset($row['device_Id']) ? $row['device_Id'] : 'ข้อมูลไม่ถูกส่ง';
        $device_Numder = isset($row['device_Numder']) ? $row['device_Numder'] : 'ข้อมูลไม่ถูกส่ง';
        $history_Id = isset($row['device_Name']) ? $row['device_Name'] : 'ข้อมูลไม่ถูกส่ง';
        $history_device = isset($row['device_Name']) ? $row['device_Name'] : 'ข้อมูลไม่ถูกส่ง';
        $parcel_Numder = isset($row['device_Numder']) ? $row['device_Numder'] : 'ข้อมูลไม่ถูกส่ง';
        
    } else {
        // ถ้าไม่มีข้อมูล
        $device_Name = 'ข้อมูลไม่ถูกส่ง';
        $device_Status = 'ข้อมูลไม่ถูกส่ง';
        $device_Image = 'ข้อมูลไม่ถูกส่ง';
        $device_Other = 'ข้อมูลไม่ถูกส่ง';
        $cotton_Id = 'ข้อมูลไม่ถูกส่ง';
        $device_Id = 'ข้อมูลไม่ถูกส่ง';
        $device_Numder = 'ข้อมูลไม่ถูกส่ง';
        $history_Id = 'ข้อมูลไม่ถูกส่ง';
        $history_device = 'ข้อมูลไม่ถูกส่ง';
        $parcel_Numder = 'ข้อมูลไม่ถูกส่ง';
    }
    ?>

    <!-- กล่องทางขวา (เนื้อหา) -->
    <div class="col-md-9 col-lg-10">
        <div class="p-3 bg-light border rounded shadow-sm">
            <div class="row">
                <div class="col-2 text-end mt-3">
                    <?php
                    // ตรวจสอบค่า cotton_Id และกำหนดข้อความที่เหมาะสม
                    $department_Name = '';
                    switch ($cotton_Id) {
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
                <div class="container mt-">

                    <h5 class="text-center text-success mb-4">รายละเอียดการทำรายการ</h5>

                    <form action="../connect/reservation/insert.php" method="post" enctype="multipart/form-data">
                        <div class="container mt-4">
                            <!-- ชื่ออุปกรณ์ -->
                            <div class="form-group mb-4">
                                <label for="device_Name" class="font-weight-bold text-success"
                                    style="font-size: 16px; color: #007468;">ชื่ออุปกรณ์ :</label>
                                <input type="text" class="form-control" id="history_devic"
                                    value="<?= htmlspecialchars($device_Name) ?>" readonly
                                    style="padding: 10px; font-size: 16px; opacity: 0.6;">
                                    
                                    <input type="text" class="form-control" hidden  
                                    value="<?= htmlspecialchars($device_Id) ?>" 
                                    style="padding: 10px; font-size: 16px; opacity: 0.6;">
                                    <input type="text" class="form-control" hidden  name="device_Name"  
                                    value="<?= htmlspecialchars($history_device ) ?>" 
                                    style="padding: 10px; font-size: 16px; opacity: 0.6;">
                                    <input type="text" class="form-control"  hidden name="device_Numder" 
                                    value="<?= htmlspecialchars($parcel_Numder) ?>" 
                                    style="padding: 10px; font-size: 16px; opacity: 0.6;">
                                    
                                   
                            </div>

                            <!-- เพื่อไปใช้งาน และ สถานที่นำไปใช้ -->
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

                            <!-- วันที่ยืม, วันที่คืน และ เวลาคืน -->
                            <div class="form-group row mb-4">
                                <div class="col-sm-4">
                                    <label for="history_Borrow" class="font-weight-bold text-success"
                                        style="font-size: 16px; color: rgba(0, 116, 72, 0.6);">วันที่ยืม :</label>
                                    <input type="date" class="form-control" id="history_Borrow" name="history_Borrow"
                                        style="padding: 10px; font-size: 16px;" readonly required>
                                    <script>
                                        // ตั้งค่าให้วันที่ยืมเป็นวันที่ปัจจุบัน
                                        let today = new Date().toISOString().split('T')[0];
                                        document.getElementById('history_Borrow').value = today;
                                    </script>
                                </div>

                                <div class="col-sm-4">
                                    <label for="history_Return" class="font-weight-bold text-success"
                                        style="font-size: 16px; color: rgba(0, 116, 72, 0.6);">วันที่คืน :</label>
                                    <input type="date" class="form-control" id="history_Return" name="history_Return"
                                        style="padding: 10px; font-size: 16px;" required>
                                </div>

                                <script>
                                    document.getElementById('history_Return').setAttribute('min', new Date().toISOString().split('T')[0]);
                                </script>

                                <div class="col-sm-4">
                                    <label for="history_Stop" class="font-weight-bold text-success"
                                        style="font-size: 16px; color: rgba(0, 116, 72, 0.6);">เวลาคืน :</label>
                                    <input type="time" class="form-control" id="history_Stop" name="history_Stop"
                                        style="padding: 10px; font-size: 16px;" required>
                                </div>
                            </div>

                            <!-- ปุ่มตกลง -->
                            <div class="text-center d-flex justify-content-center gap-4">
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
                        </div>
                    </form>

                </div>

                <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>

                <script>
                    // เมื่อกดปุ่ม "ตกลง"
                    document.getElementById('agreeButton').addEventListener('click', function () {
                        // เปิด Modal
                        var myModal = new bootstrap.Modal(document.getElementById('confirmationModal'));
                        myModal.show();
                    });
                </script>
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