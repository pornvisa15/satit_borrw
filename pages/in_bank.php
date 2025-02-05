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
                <h5 class="text-center mb-4">เพิ่มเลขบัญชี</h5>

                <form action="../connect/bank/insert.php" method="post" id="equipmentForm">
    <div class="mb-4">
        <label for="bank_name" class="form-label">ชื่อธนาคาร</label>
        <input type="text" class="form-control" id="bank_name" name="bank_name" required>
    </div>

    <div class="mb-4">
        <label for="account_number" class="form-label">หมายเลขบัญชี</label>
        <input type="text" class="form-control" id="account_number" name="account_number" required>
    </div>

    <div class="mb-4">
        <label for="account_name" class="form-label">ชื่อบัญชี</label>
        <input type="text" class="form-control" id="account_name" name="account_name" required>
    </div>

    <div class="mb-4">
        <label for="account_detail" class="form-label">รายละเอียดเพิ่มเติม</label>
        <textarea class="form-control" id="account_detail" name="account_detail" rows="3" required></textarea>
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

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
    $(document).ready(function() {
        $('#equipmentForm').submit(function(e) {
            e.preventDefault(); // ❌ ป้องกันการรีโหลดหน้า
            
            let formData = new FormData(this); // ✅ เก็บค่าฟอร์มทั้งหมดรวมถึงไฟล์

            $.ajax({
    url: '../connect/bank/insert.php',  // ตรวจสอบว่า URL นี้ถูกต้อง
    type: 'POST',
    data: formData,
    contentType: false,
    processData: false,
    success: function(response) {
        if (response.trim() === "success") {
            Swal.fire({
                icon: 'success',
                title: 'บันทึกข้อมูลสำเร็จ',
                confirmButtonText: 'OK'
            }).then(() => {
                window.location.href = 'adminhome_details.php';
            });
        } else {
            Swal.fire({
                icon: 'error',
                title: 'เกิดข้อผิดพลาด',
                text: response
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
