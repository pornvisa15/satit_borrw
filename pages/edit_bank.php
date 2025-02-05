<?php
session_start();
include '../connect/myspl_das_satit.php';
include '../connect/mysql_borrow.php';

// ตรวจสอบว่าได้ส่งค่า bank_Id มาจาก URL หรือไม่
if (isset($_GET['bank_Id'])) {
    $bank_Id = $_GET['bank_Id'];

    // ดึงข้อมูลจากฐานข้อมูลสำหรับการแก้ไข
    $sql = "SELECT * FROM borrow.bank WHERE bank_Id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $bank_Id); // ผูกค่าตัวแปร $bank_Id เป็นแบบ integer
    $stmt->execute();
    $result = $stmt->get_result();

    // ตรวจสอบว่าเจอข้อมูลหรือไม่
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $bank_Name = $row['bank_Name'];
        $account_Number = $row['account_Number'];
        $account_Name = $row['account_Name'];
        $bank_Details = $row['bank_Details'];
    } else {
        echo "ไม่พบข้อมูลของธนาคารนี้";
        exit();
    }

    // ปิดการเชื่อมต่อ
    $stmt->close();
} else {
    echo "ไม่พบ bank_Id ใน URL";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin แก้ไขการเงิน</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="d-flex bg-light">
    <?php include 'sidebar.php'; ?>

    <div class="flex-grow-1 p-4">
        <?php include 'short.php'; ?>

        <div class="card shadow-sm border-0" style="margin-top: 49px;">
            <div class="card-header text-white" style="background-color:#537bb7; color: white; padding-top: 10px; padding-bottom: 10px;">
                <h4 class="mb-0" style="font-size: 22px;">แก้ไขข้อมูลการเงิน</h4>
            </div>

            <div class="p-5 bg-light border rounded shadow-sm mt-5 mx-auto" style="width: 650px; margin-bottom: 60px;">
                <h5 class="text-center mb-4">แก้ไขเลขบัญชี</h5>
<!-- ฟอร์มแก้ไข -->
<form action="../connect/bank/update.php" method="post" id="editForm">
    <input type="hidden" name="bank_Id" value="<?php echo $bank_Id; ?>">

    <!-- ชื่อธนาคาร -->
    <div class="mb-4">
        <label for="bank_name" class="form-label">ชื่อธนาคาร <span class="text-danger">*</span></label>
        <select class="form-select" id="bank_name" name="bank_name" required>
            <option value="" disabled selected>เลือกธนาคาร</option>
            <option value="ธนาคารกรุงเทพ">ธนาคารกรุงเทพ</option>
            <option value="ธนาคารกสิกรไทย">ธนาคารกสิกรไทย</option>
            <option value="ธนาคารไทยพาณิชย์">ธนาคารไทยพาณิชย์</option>
            <option value="ธนาคารกรุงไทย">ธนาคารกรุงไทย</option>
            <option value="ธนาคารทหารไทยธนชาต">ธนาคารทหารไทยธนชาต</option>
            <option value="ธนาคารกรุงศรีอยุธยา">ธนาคารกรุงศรีอยุธยา</option>
            <option value="ธนาคารออมสิน">ธนาคารออมสิน</option>
            <option value="อื่นๆ">อื่นๆ</option>
        </select>
        <input type="text" class="form-control mt-2" id="other_bank_name" name="other_bank_name" placeholder="กรุณาระบุธนาคารอื่นๆ" style="display:none;">
    </div>

    <script>
        document.getElementById('bank_name').addEventListener('change', function() {
            var selectedBank = document.getElementById('bank_name').value;
            var otherBankInput = document.getElementById('other_bank_name');
            
            if (selectedBank === 'อื่นๆ') {
                otherBankInput.style.display = 'block';  // แสดงช่องกรอกข้อมูล
            } else {
                otherBankInput.style.display = 'none';  // ซ่อนช่องกรอกข้อมูล
                otherBankInput.value = '';  // ลบค่าที่กรอกไว้
            }
        });
    </script>

    <!-- หมายเลขบัญชี -->
    <div class="mb-4">
        <label for="account_number" class="form-label">หมายเลขบัญชี <span class="text-danger">*</span></label>
        <input type="text" class="form-control" id="account_number" name="account_number" value="<?php echo htmlspecialchars($account_Number); ?>" oninput="formatAccountNumber(this)" required>
    </div>

    <script>
        function formatAccountNumber(input) {
            let value = input.value.replace(/\D/g, '');  // ลบตัวอักษรที่ไม่ใช่ตัวเลข
            if (value.length > 3) {
                value = value.replace(/(\d{3})(?=\d)/g, '$1-');  // ใส่ "-" หลังจากทุก 3 ตัวเลข
            }
            input.value = value;
        }
    </script>

    <!-- ชื่อบัญชี -->
    <div class="mb-4">
        <label for="account_name" class="form-label">ชื่อบัญชี <span class="text-danger">*</span></label>
        <input type="text" class="form-control" id="account_name" name="account_name" value="<?php echo htmlspecialchars($account_Name); ?>" required>
    </div>

    <!-- รายละเอียดบัญชี -->
    <div class="mb-4">
        <label for="account_detail" class="form-label">รายละเอียดเพิ่มเติม <span class="text-danger">*</span></label>
        <textarea class="form-control" id="account_detail" name="account_detail" rows="3" required><?php echo htmlspecialchars($bank_Details); ?></textarea>
    </div>

    <!-- ปุ่มบันทึก -->
    <div class="text-center d-flex justify-content-center gap-3">
        <button type="button" class="btn btn-danger" style="font-size: 16px; padding: 10px 20px; border-radius: 5px;" onclick="window.history.back();">
            <i class="bi bi-x-circle"></i> ยกเลิก
        </button>
        <button type="submit" class="btn btn-success" style="font-size: 16px; padding: 10px 20px; border-radius: 5px;">
            <i class="bi bi-check-circle"></i> บันทึกการแก้ไข
        </button>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#editForm').submit(function(e) {
                e.preventDefault(); // ป้องกันการรีโหลดหน้า
                let formData = new FormData(this); // เก็บค่าฟอร์มทั้งหมดรวมถึงไฟล์

                // ตรวจสอบว่ามีการเลือกธนาคารและกรอกข้อมูลที่จำเป็นครบถ้วน
                var bankName = $('#bank_name').val();
                var accountNumber = $('#account_number').val();
                var accountName = $('#account_name').val();
                var accountDetail = $('#account_detail').val();
                var otherBankName = $('#other_bank_name').val();

                if (!bankName) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'กรุณาเลือกธนาคาร',
                        text: 'กรุณาเลือกธนาคารจากรายการ',
                    });
                    return; // หยุดการส่งฟอร์ม
                }

                // ถ้าเลือก "อื่นๆ" ต้องกรอกชื่อธนาคารเพิ่มเติม
                if (bankName === 'อื่นๆ' && !otherBankName) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'กรุณาระบุธนาคารอื่นๆ',
                        text: 'กรุณาระบุชื่อธนาคารอื่นๆ ที่คุณเลือก',
                    });
                    return; // หยุดการส่งฟอร์ม
                }

                // ตรวจสอบหมายเลขบัญชี
                if (!accountNumber) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'กรุณากรอกหมายเลขบัญชี',
                        text: 'กรุณากรอกหมายเลขบัญชีให้ครบถ้วน',
                    });
                    return; // หยุดการส่งฟอร์ม
                }

                // ตรวจสอบชื่อบัญชี
                if (!accountName) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'กรุณากรอกชื่อบัญชี',
                        text: 'กรุณากรอกชื่อบัญชีของคุณ',
                    });
                    return; // หยุดการส่งฟอร์ม
                }

                // ตรวจสอบรายละเอียดบัญชี
                if (!accountDetail) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'กรุณากรอกรายละเอียดบัญชี',
                        text: 'กรุณากรอกรายละเอียดเพิ่มเติมสำหรับบัญชี',
                    });
                    return; // หยุดการส่งฟอร์ม
                }

                // ถ้าผ่านการตรวจสอบทั้งหมดแล้ว ส่งฟอร์ม
                $.ajax({
                    url: '../connect/bank/update.php',  // ตรวจสอบว่า URL นี้ถูกต้อง
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if (response.trim() === "success") {
                            Swal.fire({
                                icon: 'success',
                                title: 'บันทึกข้อมูลสำเร็จ',
                                text: 'ข้อมูลถูกอัปเดตเรียบร้อยแล้ว',
                                confirmButtonText: 'OK'
                            }).then(() => {
                                window.location.href = 'admin_finance.php';
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
</form>


            </div>
        </div>
    </div>

   

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
