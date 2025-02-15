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

    <?php include 'sidebar.php' ?>

    <div class="flex-grow-1 p-4">
        <?php include 'short.php'; ?>
        <div class="card shadow-sm border-0" style="margin-top: 49px;">
            <div class="card-header text-white"
                style="background-color:#537bb7; color: white; padding-top: 10px; padding-bottom: 10px;">
                <h4 class="mb-0" style="font-size: 22px;">ข้อมูลเจ้าหน้าที่</h4>
            </div>

            <?php

            include "../connect/myspl_das_satit.php";

            // รับค่า officerl_Id จาก URL
            if (isset($_GET['officerl_Id'])) {
                $officerl_Id = $_GET['officerl_Id'];

                // ดึงข้อมูลเจ้าหน้าที่ที่ต้องการแก้ไข
                $sql = "SELECT * FROM das_satit.das_admin 
            INNER JOIN satit_borrow.officer_staff ON das_admin.useripass = officer_staff.useripass 
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

            <!-- ฟอร์มแก้ไขข้อมูลเจ้าหน้าที่ -->
            <div class="p-5 bg-light border rounded shadow-sm mt-5 mx-auto" style="width: 650px; margin-bottom: 60px;">

                <h5 class="text-center mb-4">แก้ไขข้อมูลเจ้าหน้าที่</h5>


                <form id="updateForm">
                    <input type="hidden" name="officerl_Id" value="<?php echo $officerl_Id; ?>">

                    <div class="mb-3">
                        <label for="name" class="form-label">ชื่อ-นามสกุล</label>
                        <input type="text" class="form-control" value="<?php echo $name; ?>" readonly>
                    </div>

                    <div class="mb-3">
                        <label for="department" class="form-label">สิทธิการเข้าใช้:</label>
                        <select class="form-select" name="officer_Right" required>
                            <option value="3" <?php echo ($department == "แอดมิน") ? 'selected' : ''; ?>>แอดมิน</option>
                            <option value="4" <?php echo ($department == "เจ้าหน้าที่") ? 'selected' : ''; ?>>เจ้าหน้าที่
                            </option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="department" class="form-label">เจ้าหน้าที่ฝ่าย:</label>
                        <select class="form-select" name="officer_Cotton" required>
                            <option value="1" <?php echo ($department == "ฝ่ายคอมพิวเตอร์") ? 'selected' : ''; ?>>
                                ฝ่ายคอมพิวเตอร์</option>
                            <option value="2" <?php echo ($department == "ฝ่ายวิทยาศาสตร์") ? 'selected' : ''; ?>>
                                ฝ่ายวิทยาศาสตร์</option>
                            <option value="3" <?php echo ($department == "ฝ่ายดนตรี") ? 'selected' : ''; ?>>ฝ่ายดนตรี
                            </option>
                            <option value="4" <?php echo ($department == "ฝ่ายพัสดุ") ? 'selected' : ''; ?>>ฝ่ายพัสดุ
                            </option>
                            <option value="5" <?php echo ($department == "แอดมิน") ? 'selected' : ''; ?>>แอดมิน</option>
                        </select>
                    </div>

                    <div class="text-center d-flex justify-content-center gap-3">
                        <button class="btn btn-success"
                            style="font-size: 16px; padding: 10px 20px; border-radius: 5px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);"
                            type="submit">
                            <i class="bi bi-check-circle"></i> บันทึกการแก้ไข
                        </button>
                    </div>
                </form>

                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

                <script>
                    // เมื่อฟอร์มถูกส่ง
                    $('#updateForm').on('submit', function (e) {
                        e.preventDefault(); // ป้องกันการส่งฟอร์มปกติ

                        var formData = new FormData(this); // เก็บข้อมูลในฟอร์ม

                        $.ajax({
                            url: '../connect/officer/update.php', // URL ของไฟล์ PHP ที่จะประมวลผล
                            type: 'POST',
                            data: formData,  // ส่งข้อมูลที่เก็บใน formData
                            processData: false, // ไม่ต้องแปลงข้อมูลเป็น query string
                            contentType: false, // ไม่ต้องระบุ content-type
                            success: function (response) {
                                if (response == 'success') {
                                    // แสดง SweetAlert2 เมื่อบันทึกสำเร็จ
                                    Swal.fire({
                                        title: 'บันทึกสำเร็จ!',

                                        icon: 'success',
                                        confirmButtonText: 'ตกลง'
                                    }).then(function () {

                                        window.location.href = 'admin_staffinfo.php';
                                    });
                                } else {
                                    // แสดงข้อผิดพลาด
                                    Swal.fire({
                                        title: 'เกิดข้อผิดพลาด!',
                                        text: response,  // ข้อความข้อผิดพลาด
                                        icon: 'error',
                                        confirmButtonText: 'ตกลง'
                                    });
                                }
                            },
                            error: function () {
                                Swal.fire({
                                    title: 'เกิดข้อผิดพลาด!',
                                    text: 'ไม่สามารถติดต่อเซิร์ฟเวอร์ได้.',
                                    icon: 'error',
                                    confirmButtonText: 'ตกลง'
                                });
                            }
                        });
                    });
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