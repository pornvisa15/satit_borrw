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
    session_start();
    include 'sidebar.php';
    include '../connect/myspl_das_satit.php';
    include '../connect/mysql_borrow.php';

    // รับค่า device_Id จาก URL
    if (isset($_GET['device_Id'])) {
        $device_Id = $_GET['device_Id'];

        // ดึงข้อมูลอุปกรณ์ที่ต้องการแก้ไข
        $sql = "SELECT * FROM borrow.device_information 
                INNER JOIN borrow.cotton ON device_information.cotton_Id = cotton.cotton_Id 
                WHERE device_information.device_Id = '$device_Id'";  
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            // กำหนดค่าตัวแปร
            $device_Name = $row['device_Name'];
            $device_Date = $row['device_Date'];
            $device_Price = $row['device_Price'];
            $device_Other = $row['device_Other'];
            $device_Access = $row['device_Access'];
            $cotton_Id = $row['cotton_Id'];
            $device_Numder = $row['device_Numder'];
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
                <h4 class="mb-0" style="font-size: 22px;">แก้ไขข้อมูลอุปกรณ์</h4>
            </div>

            <div class="p-5 bg-light border rounded shadow-sm mt-5 mx-auto" style="width: 650px; margin-bottom: 60px;">
                <h5 class="text-center mb-4">แก้ไขข้อมูลอุปกรณ์</h5>

                <form action="../connect/equipment/update.php" method="post" enctype="multipart/form-data" onsubmit="return submitForm()">
                    <input type="hidden" name="device_Id" value="<?php echo $device_Id; ?>">

                    <!-- ฟิลด์ข้อมูลต่างๆ -->
                    <div class="mb-4">
                        <label for="device_Numder" class="font-weight-bold" style="font-size: 16px; color: black;">เลขพัสดุ/ครุภัณฑ์:</label>
                        <input type="text" id="device_Numder" name="device_Numder" class="form-control"
                            value="<?php echo $device_Numder; ?>" readonly>
                    </div>

                    <div class="mb-4">
                        <label for="device_Name" class="form-label" style="font-size: 16px; color: black;">ชื่ออุปกรณ์:</label>
                        <input type="text" id="device_Name" name="device_Name" class="form-control"
                            value="<?php echo $device_Name; ?>" placeholder="กรอกชื่ออุปกรณ์" required>
                    </div>

                    <div class="mb-4">
                        <label for="cotton_Id" class="form-label" style="font-size: 16px; color: black;">ฝ่ายที่รับผิดชอบ:</label>
                        <select id="cotton_Id" name="cotton_Id" class="form-select">
                            <option value="1" <?php echo ($cotton_Id == 1 ? 'selected' : ''); ?>>ฝ่ายวิชาการคอมพิวเตอร์</option>
                            <option value="2" <?php echo ($cotton_Id == 2 ? 'selected' : ''); ?>>ฝ่ายวิชาการวิทยาศาสตร์</option>
                            <option value="3" <?php echo ($cotton_Id == 3 ? 'selected' : ''); ?>>ฝ่ายดนตรี</option>
                            <option value="4" <?php echo ($cotton_Id == 4 ? 'selected' : ''); ?>>ฝ่ายพัสดุ</option>
                            <option value="5" <?php echo ($cotton_Id == 5 ? 'selected' : ''); ?>>แอดมิน</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="device_Date" class="form-label" style="font-size: 16px; color: black;">วันที่ซื้อ:</label>
                        <input type="date" id="device_Date" name="device_Date" class="form-control"
                            value="<?php echo $device_Date; ?>" required>
                    </div>

                    <div class="mb-4">
                        <label for="device_Price" class="form-label" style="font-size: 16px; color: black;">ราคา:</label>
                        <input type="text" id="device_Price" name="device_Price" class="form-control"
                            value="<?php echo $device_Price; ?>" placeholder="ราคา" required>
                    </div>

                    <div class="mb-4">
                        <label for="device_Other" class="form-label" style="font-size: 16px; color: black;">รายละเอียด:</label>
                        <input type="text" id="device_Other" name="device_Other" class="form-control"
                            value="<?php echo $device_Other; ?>" placeholder="รายละเอียด" required>
                    </div>

                    <div class="mb-4">
    <label for="device_Image" class="font-weight-bold" style="font-size: 16px; color: #333;">อัปโหลดไฟล์รูปภาพ:</label>

    <div style="margin-top: 10px;">
        <?php if (!empty($device_Image) && file_exists('../connect/equipment/equipment/img/' . $device_Image)): ?>
            <img src="../connect/equipment/equipment/img/<?php echo htmlspecialchars($device_Image); ?>"
                alt="Current Image" style="width: 100px; height: 100px; object-fit: cover; border-radius: 8px;">
        <?php else: ?>
           
        <?php endif; ?>
    </div>

    <input type="file" id="device_Image" name="device_Image" class="form-control" accept="image/*">
</div>


                    <div class="mb-4">
                        <label for="device_Access" class="form-label" style="font-size: 16px; color: black;">ใช้สำหรับ:</label>
                        <select id="device_Access" name="device_Access" class="form-select" required>
                            <option value="1" <?php echo ($device_Access == 1 ? 'selected' : ''); ?>>นักเรียน</option>
                            <option value="2" <?php echo ($device_Access == 2 ? 'selected' : ''); ?>>บุคลากรและนักเรียน</option>
                        </select>
                    </div>

                    <div class="text-center d-flex justify-content-center gap-3">
                        <!-- ปุ่มบันทึก -->
                        <button class="btn btn-success" type="submit">
                            <i class="bi bi-check-circle"></i> บันทึกการแก้ไข
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
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
