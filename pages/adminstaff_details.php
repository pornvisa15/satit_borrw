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
                <h5 class="text-center mb-4">เพิ่มข้อมูลเจ้าหน้าที่</h5>

                <!-- ชื่อ-นามสกุล -->
                <!-- <div class="mb-4">
                    <label for="fullname" class="font-weight-bold"
                        style="font-size: 16px; color: black;">ชื่อ-นามสกุล:</label>
                    <input type = "text" class="form-control" name="fullname" placeholder="กรอกชื่อ-นามสกุล" required
                        style="margin-top :5px; padding: 10px; font-size: 16px; height: 45px; resize: none; overflow: hidden; border: 1px solid #ced4da; border-radius: 5px;"></ร>
                </div> -->
                <form id="editForm" action="../connect/officer/insert.php" method="POST">

                    <div class="mb-4">
                        <label for="fullname" class="font-weight-bold"
                            style="font-size: 16px; color: black;">ชื่อ-นามสกุล:</label>
                        <select class="form-select" name="useripass" required
                            style="margin-top :5px; font-size: 16px; padding: 10px; border-radius: 5px; border: 1px solid #ced4da;">
                            <option value="" selected disabled>กรุณาเลือกชื่อ-นามสกุล</option>
                            <?php
                            include "../connect/myspl_das_satit.php"; //ดึงไฟล์นี้เพื่อเชื่อมฐานข้อมูล
                            $sql = "SELECT * FROM das_satit.das_admin WHERE das_admin.statuson = 1";
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
                    <div class="mb-4">
                        <label for="department" class="font-weight-bold"
                            style="font-size: 16px; color: black;">สิทธิการเข้าใช้:</label>
                        <select class="form-select" name="officer_Right" required
                            style="margin-top :5px; font-size: 16px; padding: 10px; border-radius: 5px; border: 1px solid #ced4da;">
                            <option value="" selected disabled>กรุณาเลือกสิทธิ</option>
                            <option value="3">แอดมิน</option>
                            <option value="4">เจ้าหน้าที่</option>
                        </select>
                    </div>
                    <!-- เจ้าหน้าที่ฝ่าย -->
                    <div class="mb-4">
                        <label for="department" class="font-weight-bold"
                            style="font-size: 16px; color: black;">เจ้าหน้าที่ฝ่าย:</label>
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
                    <div class="text-center d-flex justify-content-center gap-3">
                        <!-- ปุ่มยกเลิก -->
                        <button class="btn btn-danger"
                            style="font-size: 16px; padding: 10px 20px; border-radius: 5px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);"
                            onclick="window.history.back();">
                            <i class="bi bi-x-circle"></i> ยกเลิก
                        </button>

                 
                    <!-- ปุ่มบันทึก -->
                    <button type="submit" class="btn btn-success" style="font-size: 16px; padding: 10px 20px; border-radius: 5px;">
        <i class="bi bi-check-circle"></i> บันทึกข้อมูล
    </button>
   </div>
   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function() {
    $('#editForm').submit(function(e) {
        e.preventDefault(); // ป้องกันการโหลดหน้าใหม่

        let formData = new FormData(this); // เก็บค่าทั้งหมดจากฟอร์ม

        $.ajax({
            url: '../connect/officer/insert.php',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                console.log("Response:", response); // ตรวจสอบค่า response ใน Console
                if (response.trim() === "success") {
                    Swal.fire({
                        icon: 'success',
                        title: 'บันทึกข้อมูลสำเร็จ',
              
                        confirmButtonText: 'ตกลง'
                    }).then(() => {
                        window.location.href = 'admin_staffinfo.php'; // ไปยังหน้าหลังบันทึกสำเร็จ
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'เกิดข้อผิดพลาด',
                        text: response // แสดงข้อความจาก PHP
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
                <script>
                    function submitForm() {
                        // ตัวอย่างการดำเนินการเมื่อกด "ยืนยัน"
                        alert("บันทึกการแก้ไข");
                        return true; // ให้ฟอร์มส่งข้อมูล
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