<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin รายละเอียด3</title>
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="d-flex bg-light">   
    
<?php
session_start();
include 'sidebar.php';
// เชื่อมต่อกับฐานข้อมูล
include '../connect/mysql_borrow.php';

// ตรวจสอบว่าได้รับ 'id' จาก URL หรือไม่
if (isset($_GET['id'])) {
    $history_Id = $_GET['id']; // รับค่า history_Id จาก URL
} else {
    echo "ไม่พบข้อมูล ID";
    exit; // ถ้าไม่มี ID ส่งมาก็หยุดทำงาน
}

// สร้างคำสั่ง SQL เพื่อดึงข้อมูลจากฐานข้อมูลตาม history_Id
$sql = "SELECT * FROM borrow.history_brs WHERE history_Id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $history_Id); // ผูกค่า $history_Id กับ SQL
$stmt->execute();
$result = $stmt->get_result();

// ตรวจสอบผลลัพธ์
if ($result && $result->num_rows > 0) {
    // ดึงข้อมูลจากผลลัพธ์
    $row = $result->fetch_assoc();
    $history_Other = $row['history_Other'] ?? 'ไม่มีข้อมูล';
    $history_Another = $row['history_Another'] ?? 'ไม่มีข้อมูล';
    $history_device = $row['history_device'] ?? 'ไม่มีข้อมูล';
    $user_Id = $row['user_Id'] ?? 'ไม่มีข้อมูล'; // ฟิลด์ผู้ใช้
    
    
} else {
    echo "ไม่พบข้อมูลสำหรับประวัติการยืมที่เลือก";
}

$stmt->close(); // ปิด statement
?>



</body>
</html>





    <div class="flex-grow-1 p-4">
    <?php include 'short.php'; ?>

        <div class="card shadow-sm border-0" style="margin-top: 49px;">
            <div class="card-header text-white"
                style="background-color:#537bb7; color: white; padding-top: 10px; padding-bottom: 10px;">
                <h4 class="mb-0" style="font-size: 22px;">รายละเอียดอุปกรณ์</h4>
            </div>
            <!-- Modal สำหรับสถานะการยืม -->
            <div class="modal fade" id="approveModal" tabindex="-1" aria-labelledby="approveModalLabel"
                aria-hidden="true">
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

                <div class="form-group" style="margin-bottom: 10px; display: flex; align-items: center;">
            <label for="deviceName" class="font-weight-bold text-success" style="font-size: 16px; margin-right: 10px; white-space: nowrap; color: black !important;">
                ชื่ออุปกรณ์ :
            </label>
            <input type="text" class="form-control" id="deviceName" value="<?php echo htmlspecialchars($history_device); ?>" readonly style="padding: 10px; font-size: 16px; flex-grow: 1; opacity: 0.6; color: black !important;">
        </div>

<input type="text" class="form-control"  hidden
                                    value="<?= htmlspecialchars( $history_Id ) ?>" 
                                    style="padding: 10px; font-size: 16px; opacity: 0.6;">
    <div class="form-group row" style="margin-bottom: 10px;">
        <div class="col-sm-6" style="padding-right: 5px;">
            <label for="purpose" class="font-weight-bold" style="font-size: 16px; color: black;">ชื่อผู้ใช้ :</label>
            <input type="text" class="form-control" id="deviceName" value="<?php echo htmlspecialchars($user_Id); ?>" readonly style="padding: 10px; font-size: 16px; flex-grow: 1; opacity: 0.6; color: black !important;">
        </div>
        <div class="col-sm-6" style="padding-left: 5px;">
            <label for="location" class="font-weight-bold" style="font-size: 16px; color: black;">สถานะ :</label>
            <input type="text" class="form-control" id="deviceName" value="อนุมัติ" readonly style="padding: 10px; font-size: 16px; flex-grow: 1; opacity: 0.6; color: black !important;">
        </div>
    </div>

    <div class="form-group row" style="margin-bottom: 10px; margin-top: 10px;">
    <div class="col-sm-6" style="padding-right: 5px;">
        <label for="purpose" class="font-weight-bold" style="font-size: 16px; color: black;">เพื่อไปใช้งาน :</label>
        <div class="form-control bg-light text-dark"
             style="padding: 10px; font-size: 16px; white-space: normal; overflow-y: auto; height: 100px; cursor: default;color:rgba(10, 23, 32, 0.63) !important;">
            <?php echo htmlspecialchars($history_Other); ?>
        </div>
    </div>
    <div class="col-sm-6" style="padding-left: 5px;">
        <label for="location" class="font-weight-bold" style="font-size: 16px; color: black;">สถานที่นำไปใช้ :</label>
        <div class="form-control bg-light"
     style="padding: 10px; font-size: 16px; white-space: normal; overflow-y: auto; height: 100px; cursor: default; color:rgba(10, 23, 32, 0.63) !important;">
    <?php echo htmlspecialchars($history_Another); ?>
</div>



    </div>
</div>

</div>
        <!-- สิ้นสุดฟอร์มค่าาาาาาาาาา -->

        <div class="modal fade" id="returnModal" tabindex="-1" aria-labelledby="returnModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="returnModalLabel">สถานะการรับคืน</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>คุณต้องการอนุมัติการทำรายการนี้หรือไม่?</p>
                        <!-- ฟอร์มสำหรับเลือกการทำรายการ -->
                        <form id="returnForm" action="/บันทึกรายการรับคืน" method="POST">
                            <div class="form-check mb-2">
                                <!-- ยืม: ตั้งเป็นค่าเริ่มต้น -->
                                <input class="form-check-input" type="radio" name="returnOption" id="returnOnly"
                                    value="returnOnly" checked required>
                                <label class="form-check-label" for="returnOnly">ยืม</label>
                            </div>
                            <div class="form-check mb-2">
                                <!-- คืน -->
                                <input class="form-check-input" type="radio" name="returnOption" id="returnAndBorrow"
                                    value="returnAndBorrow">
                                <label class="form-check-label" for="returnAndBorrow">คืน</label>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">ยกเลิก</button>
                        <!-- ลิงก์ "ตกลง" ที่เชื่อมไปยัง Modal ยืนยัน -->
                        <button type="button" class="btn btn-success" data-bs-toggle="modal"
                            data-bs-target="#confirmReturnModal">ตกลง</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal ยืนยันการรับคืน -->
        <div class="modal fade" id="confirmReturnModal" tabindex="-1" aria-labelledby="confirmReturnModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="confirmReturnModalLabel">ยืนยันการทำรายการ</h5>
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

        <!-- JavaScript สำหรับรีเซ็ตฟอร์ม -->
        <script>
            var returnModal = document.getElementById('returnModal');
            returnModal.addEventListener('show.bs.modal', function () {
                // ตั้งค่าเริ่มต้นให้ "ยืม" ถูกเลือกทุกครั้งที่เปิด Modal
                document.getElementById('returnOnly').checked = true;
            });
        </script>

        <div class="modal fade" id="damageModal" tabindex="-1" aria-labelledby="damageModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="damageModalLabel">สถานะชำรุด</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>เลือกสถานะการชำรุดของอุปกรณ์</p>
                        <form id="damageForm" action="/บันทึกรายการชำรุด" method="POST">
                            <select class="form-select" id="damageCondition" name="damageCondition" required
                                onchange="togglePriceInput()">
                                <option value="สภาพสมบูรณ์">สภาพสมบูรณ์</option>
                                <option value="สภาพไม่สมบูรณ์">สภาพไม่สมบูรณ์</option>
                                <option value="ครบถ้วนสมบูรณ์">ครบถ้วนสมบูรณ์</option>
                                <option value="ไม่ครบถ้วนสมบูรณ์">ไม่ครบถ้วนสมบูรณ์</option>
                                <option value="ผู้ยืมซ่อมแซม">ผู้ยืมซ่อมแซม</option>
                                <option value="ชดใช้เป็นพัสดุ">ชดใช้เป็นพัสดุ</option>
                                <option value="ชดใช้ค่าเสียหาย">ชดใช้ค่าเสียหาย</option>
                            </select>

                            <!-- ฟิลด์สำหรับกรอกราคา -->
                            <div id="priceInputContainer" style="display: none; margin-top: 10px;">
                                <label for="damagePrice" class="form-label">กรุณากรอกราคาที่ต้องชดใช้</label>
                                <input type="number" class="form-control" id="damagePrice" name="damagePrice"
                                    placeholder="กรอกจำนวนเงิน (บาท)" min="0" step="0.01" required>
                            </div>

                            <!-- หมายเหตุ -->
                            <div id="purpose-container" style="margin-top: 10px;">
                                <label for="purpose" class="font-weight-bold" style="font-size: 16px;">หมายเหตุ:</label>
                                <textarea class="form-control" id="purpose" name="purpose"
                                    style="padding: 10px; font-size: 16px; height: 50px; resize: none; overflow-y: auto;"
                                    required></textarea>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">ยกเลิก</button>
                        <button type="button" id="confirmDamageButton" class="btn btn-success" data-bs-toggle="modal"
                            data-bs-target="#confirmDamageModal">ตกลง</button>
                        <!-- ปุ่ม "ถัดไป" -->
                        <button type="button" id="nextButton" class="btn btn-primary" style="display: none;"
                            onclick="showCompletionModal()">ถัดไป</button>
                    </div>
                </div>
            </div>
        </div>

        <script>
            function togglePriceInput() {
                const damageCondition = document.getElementById('damageCondition').value;
                const priceInputContainer = document.getElementById('priceInputContainer');
                const nextButton = document.getElementById('nextButton');

                // Show price input if "ชดใช้ค่าเสียหาย" is selected
                if (damageCondition === "ชดใช้ค่าเสียหาย") {
                    priceInputContainer.style.display = "block";
                    nextButton.style.display = "inline-block"; // Show "Next" button
                } else {
                    priceInputContainer.style.display = "none";
                    nextButton.style.display = "none"; // Hide "Next" button
                }
            }
        </script>

        <div class="modal fade" id="completionModal" tabindex="-1" aria-labelledby="completionModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content shadow rounded-4 border-0">
                    <!-- Header -->
                    <div class="modal-header text-white text-center rounded-top-4" style="background-color: #007bff;">
                        <h5 class="modal-title w-100 fw-bold" id="completionModalLabel">บันทึกเสร็จสิ้น</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <table class="table table-hover table-bordered align-middle">
                            <thead class="table-primary">
                                <tr>
                                    <th scope="col" class="text-center fw-semibold fs-6">ชื่ออุปกรณ์</th>
                                    <th scope="col" class="text-center fw-semibold fs-6">ราคา</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="text-center">
                                    <td class="fw-semibold">Notebook Acer</td>
                                    <td><span id="priceInModal" class="text-success fw-bold fs-6">0</span> บาท</td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="text-center" style="padding-top: 10px;">
                                        <img src="/satit_borrw/img/10.jpg" alt="Mouse Image"
                                            class="img-fluid shadow rounded-3 border border-primary"
                                            style="width: 200px; height: auto; margin-top: 8px;">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>


                    <!-- Footer -->

                    <!-- Footer -->
                    <div class="modal-footer justify-content-center" style="border-top: none; padding-top: 5px;">
                        <button type="button" class="btn btn-primary btn-sm fw-bold px-4 py-2" data-bs-dismiss="modal"
                            style="background-color: #007bff; border: none; border-radius: 30px; box-shadow: 0 3px 8px rgba(0, 123, 255, 0.3); transition: all 0.3s ease; margin-top: -15px;">
                            ตกลง
                        </button>
                    </div>


                </div>
            </div>
        </div>

        <!-- Footer -->

    </div>
    </div>
    </div>


    <script>
        function showCompletionModal() {
            // ดึงราคาที่กรอกไว้ในฟอร์ม
            const damagePrice = document.getElementById('damagePrice').value;

            // แสดงราคานี้ในโมดัล
            document.getElementById('priceInModal').innerText = damagePrice;

            // ปิดโมดัลที่ใช้งานอยู่
            const currentModal = bootstrap.Modal.getInstance(document.getElementById('damageModal'));
            if (currentModal) {
                currentModal.hide(); // ซ่อนโมดัลเก่า
            }

            // แสดงโมดัลใหม่
            const completionModal = new bootstrap.Modal(document.getElementById('completionModal'));
            completionModal.show();
        }

        function togglePriceInput() {
            const damageCondition = document.getElementById('damageCondition').value;
            const priceInputContainer = document.getElementById('priceInputContainer');
            const damagePriceInput = document.getElementById('damagePrice');
            const purposeContainer = document.getElementById('purpose-container');
            const confirmDamageButton = document.getElementById('confirmDamageButton');
            const nextButton = document.getElementById('nextButton');

            if (damageCondition === "ชดใช้ค่าเสียหาย") {
                // แสดงฟิลด์ราคา
                priceInputContainer.style.display = "block";
                damagePriceInput.required = true;

                // ซ่อนฟิลด์หมายเหตุ
                purposeContainer.style.display = "none";
                document.getElementById('purpose').required = false;
                document.getElementById('purpose').value = "";

                // ซ่อนปุ่ม "ตกลง" และแสดงปุ่ม "ถัดไป"
                confirmDamageButton.style.display = "none";
                nextButton.style.display = "block";
            } else {
                // ซ่อนฟิลด์ราคา
                priceInputContainer.style.display = "none";
                damagePriceInput.required = false;
                damagePriceInput.value = "";

                // แสดงฟิลด์หมายเหตุ
                purposeContainer.style.display = "block";
                document.getElementById('purpose').required = true;

                // แสดงปุ่ม "ตกลง" และซ่อนปุ่ม "ถัดไป"
                confirmDamageButton.style.display = "block";
                nextButton.style.display = "none";
            }
        }
    </script>

    </script>




    <!-- JavaScript สำหรับรีเซ็ตฟอร์ม -->
    <script>
        var returnModal = document.getElementById('returnModal');
        returnModal.addEventListener('show.bs.modal', function () {
            // ตั้งค่าเริ่มต้นให้ "ยืม" ถูกเลือกทุกครั้งที่เปิด Modal
            document.getElementById('returnOnly').checked = true;
        });
    </script>


    </div>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>


</body>

</html>