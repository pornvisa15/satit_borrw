<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin เพิ่มการเงิน</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="d-flex bg-light">
    <?php
    session_start();
    include 'sidebar.php';
    ?>

    <div class="flex-grow-1 p-4">
        <?php include 'short.php'; ?>

        <div class="card shadow-sm border-0" style="margin-top: 49px;">
            <div class="card-header text-white" style="background-color:#537bb7; color: white; padding-top: 10px; padding-bottom: 10px;">
                <h4 class="mb-0" style="font-size: 22px;">ตั้งค่าการเงิน</h4>
            </div>

            <div class="p-5 bg-light border rounded shadow-sm mt-5 mx-auto" style="width: 650px; margin-bottom: 60px;">
                <h5 class="text-center mb-4">เพิ่มข้อมูลคิวอาร์โค้ด</h5>

                <!-- ฟอร์ม -->
                <form action="../connect/finance/insert.php" method="post" enctype="multipart/form-data" id="equipmentForm">
                    <div class="mb-4">
                        <label for="fullname" class="font-weight-bold" style="font-size: 16px; color: black;">ชื่อ-นามสกุล:</label>
                        <select class="form-select" name="useripass" required style="margin-top: 5px; font-size: 16px; padding: 10px; border-radius: 5px; border: 1px solid #ced4da;">
                            <option value="" selected disabled>กรุณาเลือกชื่อ-นามสกุล</option>
                            <?php
                            include "../connect/myspl_das_satit.php"; // เชื่อมต่อฐานข้อมูล

                            // ตรวจสอบการเชื่อมต่อ
                            if ($conn->connect_error) {
                                die("Connection failed: " . $conn->connect_error);
                            }

                            // เขียนคำสั่ง SQL เพื่อทำการเชื่อมโยงข้อมูลจากทั้งสองฐาน
                            $sql = "SELECT officer_staff.useripass, das_admin.praname, das_admin.name, das_admin.surname 
                                    FROM borrow.officer_staff 
                                    INNER JOIN das_satit.das_admin 
                                    ON officer_staff.useripass = das_admin.useripass 
                                    WHERE das_admin.statuson = 1"; // เชื่อมโยงทั้งสองตารางโดยใช้ useripass และ statuson

                            // ดำเนินการ query
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                // แสดงผลลัพธ์
                                while ($row = $result->fetch_assoc()) {
                                    // สร้างชื่อเต็ม
                                    $fullname = $row['praname'] . $row['name'] . " " . $row['surname'];
                                    ?>
                                    <option value="<?php echo $row['useripass']; ?>">
                                        <?php echo $fullname; ?> <!-- แสดงชื่อเต็มโดยไม่แสดง useripass -->
                                    </option>
                                    <?php
                                }
                            } else {
                                echo "<option value=''>ไม่มีข้อมูล</option>";
                            }

                            $conn->close(); // ปิดการเชื่อมต่อฐานข้อมูล
                            ?>
                        </select>
                    </div>
                    <div class="form-group mb-4">
     <div class="mb-4">
                        <label for="department" class="font-weight-bold"
                            style="font-size: 16px; color: black;">ผู้รับผิดชอบ :</label>
                        <select class="form-select" name="officer_Cotton" required
                            style="margin-top :5px; font-size: 16px; padding: 10px; border-radius: 5px; border: 1px solid #ced4da;">
                            <option value="" selected disabled>กรุณาเลือกฝ่าย</option>
                            <option value="1">ฝ่ายคอมพิวเตอร์</option>
                            <option value="2">ฝ่ายวิทยาศาสตร์</option>
                            <option value="3">ฝ่ายดนตรี</option>
                            <option value="4">ฝ่ายพัสดุ</option>
                            <option value="5">แอดมิน</option>
                        </select>
                    </div>
</div>

                    <!-- รูปภาพ -->
                    <div class="form-group mb-4">
                        <label for="finance_Image" style="font-size: 16px; color: black;">รูปภาพ :</label>
                        <input type="file" class="form-control" id="finance_Image" name="finance_Image" accept="image/jpeg, image/png" required>
                    </div>

                    <!-- ปุ่มบันทึก -->
                    <div class="text-center d-flex justify-content-center gap-3">
                        <button type="button" class="btn btn-danger" style="font-size: 16px; padding: 10px 20px; border-radius: 5px;" onclick="window.history.back();">
                            <i class="bi bi-x-circle"></i> ยกเลิก
                        </button>

                        <button type="submit" class="btn btn-success" style="font-size: 16px; padding: 10px 20px; border-radius: 5px;">
                            <i class="bi bi-check-circle"></i> บันทึกข้อมูล
                        </button>
                    </div>
                    
                    

                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
