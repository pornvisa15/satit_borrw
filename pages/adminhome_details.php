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

    include 'sidebar.php';
    // เชื่อมต่อกับฐานข้อมูล
    include '../connect/mysql_borrow.php';

    // ตรวจสอบว่าได้รับ 'id' จาก URL หรือไม่
    if (isset($_GET['id'])) {
        $history_Id = $_GET['id']; // รับค่า history_Id จาก URL
    } else {
        echo "ไม่พบข้อมูล ID";
        exit;
    }
    $sql = "SELECT * FROM satit_borrow.history_brs WHERE history_Id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $history_Id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $history_Other = $row['history_Other'] ?? 'ไม่มีข้อมูล';
        $history_Another = $row['history_Another'] ?? 'ไม่มีข้อมูล';
        $history_device = $row['history_device'] ?? 'ไม่มีข้อมูล';
        $user_Id = $row['user_Id'] ?? 'ไม่มีข้อมูล';
        $history_Status_BRS = $row['history_Status_BRS'] ?? 'ไม่มีข้อมูล';
        $status_Id = $row['status_Id'] ?? 'ไม่มีข้อมูล';
        $tool_Other = $row['tool_Other'] ?? 'ไม่มีข้อมูล';
    } else {
        echo "ไม่พบข้อมูลสำหรับประวัติการยืมที่เลือก";
    }
    $stmt->close();
    $selectedCottonId = $_GET['status_Id'] ?? 0;
    $history_Id = $_GET['id'];
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
        <div class="p-5 bg-light border rounded shadow-sm mt-5 mx-auto" style="width: 700px; margin-bottom: 60px;">
            <h5 class="text-center">รายละเอียดการทำรายการ</h5>
            <?php
            if ($history_Status_BRS == 1) {
                $disableApprove = ''; // ปุ่มอนุมัติ กดไม่ได้
                $disableReturn = ''; // ปุ่มรับคืน กดได้  
            } else if ($history_Status_BRS == 2) {
                $disableApprove = 'disabled'; // ปุ่มอนุมัติ กดไม่ได้
                $disableReturn = 'disabled'; // ปุ่มรับคืน กดไม่ได้
            } else if ($history_Status_BRS == 0) {
                $disableApprove = ''; // ปุ่มอนุมัติ กดไม่ได้
                $disableReturn = 'disabled'; // ปุ่มรับคืน กดไม่ได้
            } else {
                $disableApprove = ''; // ปุ่มอนุมัติ กดได้
                $disableReturn = ''; // ปุ่มรับคืน กดได้
            }

            // กำหนด CSS สำหรับปุ่มที่ถูกปิดการใช้งาน
            $disabledStyle = 'opacity: 0.5; cursor: not-allowed;';
            ?>

            <div class="d-flex justify-content-start mb-4"
                style="max-width: 100%; margin: 0 auto; padding-top: 10px; margin-top: 40px; gap: 10px;">

                <button class="btn btn-success px-3 py-2" data-bs-toggle="modal" data-bs-target="#approveModal"
                    style="font-size: 12px; border-radius: 3px; width: auto; <?php echo $disableApprove ? $disabledStyle : ''; ?>"
                    <?php echo $disableApprove; ?>>
                    <i class="bi bi-check-circle" style="font-size: 12px;"></i> อนุมัติ
                </button>

                <button class="btn btn-info text-white px-3 py-2" data-bs-toggle="modal" data-bs-target="#returnModal"
                    style="font-size: 12px; border-radius: 3px; width: auto; <?php echo $disableReturn ? $disabledStyle : ''; ?>"
                    <?php echo $disableReturn; ?>>
                    <i class="bi bi-arrow-repeat" style="font-size: 12px;"></i> รับคืน
                </button>

            </div>





            <div class="form-group" style="margin-bottom: 10px; display: flex; align-items: center;">
                <label for="deviceName" class="font-weight-bold text-success"
                    style="font-size: 16px; margin-right: 10px; white-space: nowrap; color: black !important;">
                    ชื่ออุปกรณ์ :
                </label>
                <input type="text" class="form-control" id="deviceName"
                    value="<?php echo htmlspecialchars($history_device); ?>" readonly
                    style="padding: 10px; font-size: 16px; flex-grow: 1; opacity: 0.6; color: black !important;">
            </div>
            <input type="text" class="form-control" hidden value="<?= htmlspecialchars($history_Id) ?>"
                style="padding: 10px; font-size: 16px; opacity: 0.6;">
            <div class="form-group row" style="margin-bottom: 10px;">
                <div class="col-sm-6" style="padding-right: 5px;">
                    <label for="purpose" class="font-weight-bold" style="font-size: 16px; color: black;">ชื่อผู้ใช้
                        :</label>
                    <input type="text" class="form-control" id="deviceName"
                        value="<?php echo htmlspecialchars($user_Id); ?>" readonly
                        style="padding: 10px; font-size: 16px; flex-grow: 1; opacity: 0.6; color: black !important;">
                </div>
                <div class="col-sm-6" style="padding-left: 5px;">
                    <label for="location" class="font-weight-bold" style="font-size: 16px; color: black;">สถานะ
                        :</label>
                    <input type="text" class="form-control" id="deviceName"
                        value="<?php echo getStatusName($history_Status_BRS); ?>" readonly
                        style="padding: 10px; font-size: 16px; flex-grow: 1; opacity: 0.6; color: black !important;">
                </div>
                <?php
                function getStatusName($status)
                {
                    switch ($status) {
                        case '0':
                            return 'รออนุมัติ'; // ค่าเมื่อรออนุมัติ
                        case '1':
                            return 'อนุมัติ'; // ค่าเมื่ออนุมัติ
                        case '2':
                            return 'ไม่อนุมัติ'; // ค่าเมื่อไม่อนุมัติ
                
                    }
                }
                ?>

            </div>
            <div class="form-group row" style="margin-bottom: 10px; margin-top: 10px;">
                <div class="col-sm-6" style="padding-right: 5px;">
                    <label for="purpose" class="font-weight-bold" style="font-size: 16px; color: black;">เพื่อไปใช้งาน
                        :</label>
                    <div class="form-control bg-light text-dark"
                        style="padding: 10px; font-size: 16px; white-space: normal; overflow-y: auto; height: 100px; cursor: default;color:rgba(10, 23, 32, 0.63) !important;">
                        <?php echo htmlspecialchars($history_Other); ?>
                    </div>
                </div>
                <div class="col-sm-6" style="padding-left: 5px;">
                    <label for="location" class="font-weight-bold" style="font-size: 16px; color: black;">สถานที่นำไปใช้
                        :</label>
                    <div class="form-control bg-light"
                        style="padding: 10px; font-size: 16px; white-space: normal; overflow-y: auto; height: 100px; cursor: default; color:rgba(10, 23, 32, 0.63) !important;">
                        <?php echo htmlspecialchars($history_Another); ?>
                    </div>
                </div>
            </div>

        </div>


        <!-- โมดัลสำหรับอนุมัติ -->
        <div class="modal fade" id="approveModal" tabindex="-1" aria-labelledby="approveModalLabel" aria-hidden="true">
            <div class="modal-dialog" style="margin-top: 23vh;">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="approveModalLabel">สถานะการยืม</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>คุณต้องการอนุมัติการทำรายการนี้หรือไม่?</p>
                        <form method="POST" action="../connect/examine/update.php" id="approveForm">
                            <input type="hidden" name="history_Id" value="<?php echo htmlspecialchars($history_Id); ?>">

                            <div>
                                <input class="form-check-input" type="radio" id="approveRadio" name="device_Con"
                                    value="1" required>
                                <label class="form-check-label" for="approveRadio">อนุมัติ</label>

                                <input class="form-check-input" type="radio" id="disapproveRadio" name="device_Con"
                                    value="2" required>
                                <label class="form-check-label" for="disapproveRadio">ไม่อนุมัติ</label>
                            </div>

                            <input type="hidden" name="history_Status_BRS" id="historyStatusBRS">

                            <div class="mt-3">
                                <label for="purpose" class="fw-bold">
                                    หมายเหตุ <span class="text-danger">*</span> <span
                                        class="text-muted">(สถานที่รับ)</span>
                                </label>
                                <textarea class="form-control" id="purpose" name="note_Other"
                                    style="height: 50px; resize: none;" required></textarea>
                            </div>
                        </form>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">ยกเลิก</button>
                        <button type="button" class="btn btn-success" id="confirmApproveBtn">ตกลง</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- ใช้งาน jQuery และ SweetAlert -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            $(document).ready(function () {
                $('#confirmApproveBtn').click(function () {
                    let statusValue = null;
                    let note = $('#purpose').val().trim();

                    // ตรวจสอบการเลือกสถานะ
                    if ($('#approveRadio').is(':checked')) {
                        statusValue = '1'; // อนุมัติ
                    } else if ($('#disapproveRadio').is(':checked')) {
                        statusValue = '2'; // ไม่อนุมัติ
                    } else {
                        Swal.fire({
                            icon: 'warning',
                            iconColor: '#ff5858',
                            title: 'กรุณาเลือกสถานะ',
                            text: 'คุณต้องเลือก อนุมัติ หรือ ไม่อนุมัติ ก่อนดำเนินการ',
                            confirmButtonColor: '#d33',
                        });
                        return false;
                    }

                    // ตรวจสอบหมายเหตุ
                    if (note === "") {
                        Swal.fire({
                            icon: 'warning',
                            iconColor: '#ff5858',
                            title: 'กรุณากรอกหมายเหตุ',
                            text: 'โปรดระบุหมายเหตุเพื่อดำเนินการต่อ',
                            confirmButtonColor: '#d33',
                        });
                        return false;
                    }

                    // บันทึกค่าและปิดปุ่มกันกดซ้ำ
                    $('#historyStatusBRS').val(statusValue);
                    $('#confirmApproveBtn').prop('disabled', true);

                    // ปิด Modal ก่อนแสดง SweetAlert
                    let approveModal = bootstrap.Modal.getInstance(document.getElementById('approveModal'));
                    if (approveModal) {
                        approveModal.hide();
                    }

                    // ใช้ setTimeout เพื่อรอให้ Modal ปิดก่อนแสดง SweetAlert
                    setTimeout(() => {
                        Swal.fire({
                            icon: 'success',
                            title: 'บันทึกข้อมูลสำเร็จ',
                            confirmButtonColor: '#6C5CE7',
                            confirmButtonText: 'OK',
                        }).then(() => {
                            $('#approveForm').submit();
                        });
                    }, 300); // รอ 300ms ให้ Modal ปิดสนิทก่อน (สามารถปรับเวลาได้)

                    return false;
                });
            });


        </script>







        <!-- Modal -->
        <div class="modal fade" id="returnModal" tabindex="-1" aria-labelledby="returnModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered"> <!-- ปรับ margin-top เพื่อขยับกล่องลง -->
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="returnModalLabel">สถานะการรับคืน</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>คุณต้องการรับคืนรายการนี้หรือไม่?</p>
                        <form id="returnForm" action="../connect/refund/update.php" method="POST"
                            enctype="multipart/form-data">
                            <!-- ปุ่มคืน -->
                            <div class="d-flex align-items-center mb-2">
                                <div class="form-check me-3">
                                    <input class="form-check-input" type="checkbox" id="rStatus" name="history_Status[]"
                                        value="return">
                                    <label class="form-check-label" for="rStatus">คืน</label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="overdueStatus"
                                        name="history_Status[]" value="overdue">
                                    <label class="form-check-label" for="overdueStatus">เลยกำหนด</label>
                                </div>
                            </div>


                            <div class="mb-2" id="returnField" style="display: none;">
                                <label for="returnDate">วันที่คืน:</label>
                                <input type="date" class="form-control" id="returnDate" name="htime_Return" lang="th">
                            </div>

                            <!-- ช่องกรอกค่าปรับ -->
                            <div id="overdueInputContainer" style="display: none; margin-top: 10px;">
                                <label for="overduePrice" class="form-label">กรุณากรอกค่าปรับ</label>
                                <input type="number" class="form-control" id="overduePrice" name="money_time"
                                    placeholder="กรอกจำนวนเงิน (บาท)" min="0" step="0.01" oninput="updateFinePrice()">

                            </div>

                            <input type="hidden" name="history_Status" id="history_Status" value="2">
                            <input type="hidden" name="history_Id" id="history_Id" value="<?php echo $history_Id ?>">

                            <p>กรุณาเลือกสถานะอุปกรณ์</p>
                            <select class="form-select" id="damageCondition" name="hreturn_Status" required
                                onchange="togglePriceInput()">
                                <option value="1">สภาพปกติ</option>
                                <option value="3">ผู้ยืมซ่อมแซม</option>
                                <option value="4">ชดใช้เป็นพัสดุ</option>
                                <option value="7">ชดใช้ค่าเสียหาย</option>
                            </select>

                            <!-- ฟิลด์สำหรับกรอกราคา -->
                            <div id="priceInputContainer" style="display: none; margin-top: 10px;">
                                <label for="damagePrice" class="form-label">กรุณากรอกราคาที่ต้องชดใช้</label>
                                <input type="number" class="form-control" id="damagePrice" name="money"
                                    placeholder="กรอกจำนวนเงิน (บาท)" min="0" step="0.01">
                            </div>

                            <div id="purpose-container" style="margin-top: 10px;">
                                <label for="purpose" class="font-weight-bold" style="font-size: 16px;">หมายเหตุ</label>
                                <textarea class="form-control" id="purpose" name="tool_Other"
                                    style="padding: 10px; font-size: 16px; height: 50px; resize: none; overflow-y: auto;"></textarea>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">ยกเลิก</button>
                                <button type="submit" id="confirmDamageButton" class="btn btn-success">ตกลง</button>

                                <button type="button" id="nextButton" class="btn btn-primary" style="display: none;"
                                    onclick="showCompletionModal()">ถัดไป</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <script>
                document.addEventListener("DOMContentLoaded", function () {
                    const confirmButton = document.getElementById('confirmDamageButton');

                    if (confirmButton) {
                        confirmButton.addEventListener('click', function (event) {
                            event.preventDefault(); // ป้องกันการส่งฟอร์มทันที
                            console.log("✅ กดปุ่ม confirmDamageButton แล้ว");

                            const returnModalElement = document.getElementById('returnModal');
                            let returnModal = bootstrap.Modal.getInstance(returnModalElement);

                            if (returnModal) {
                                returnModal.hide(); // ปิดโมดอลก่อนแสดง SweetAlert
                            }

                            // รอให้โมดอลปิดสนิทก่อนแสดง SweetAlert
                            setTimeout(() => {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'บันทึกข้อมูลสำเร็จ!',
                                    text: 'ระบบจะดำเนินการต่อไป...',
                                    confirmButtonText: 'ตกลง',
                                    confirmButtonColor: '#3085d6'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        console.log("✅ ผู้ใช้กด 'ตกลง' แล้ว ส่งฟอร์ม...");
                                        document.getElementById('returnForm').submit(); // ส่งฟอร์มเมื่อกด "ตกลง"
                                    }
                                });
                            }, 300); // หน่วงเวลาให้โมดอลปิดก่อน
                        });
                    } else {
                        console.error("❌ ไม่พบปุ่ม confirmDamageButton");
                    }

                    // ตรวจสอบ input checkbox และจัดการแสดงผล
                    document.querySelectorAll('input[name="history_Status[]"]').forEach(input => {
                        input.addEventListener('change', function () {
                            document.getElementById('returnField').style.display = document.getElementById('rStatus').checked ? "block" : "none";
                            document.getElementById('overdueInputContainer').style.display = document.getElementById('overdueStatus').checked ? "block" : "none";
                            togglePriceInput();
                        });
                    });

                    // จัดการเปลี่ยนแปลงสถานะอุปกรณ์
                    document.getElementById('damageCondition').addEventListener('change', togglePriceInput);
                    document.getElementById('overduePrice').addEventListener('input', toggleNextButton);
                    document.getElementById('damagePrice').addEventListener('input', toggleNextButton);
                });

                function togglePriceInput() {
                    const damageCondition = document.getElementById('damageCondition').value;
                    const overdueChecked = document.getElementById('overdueStatus').checked;
                    const overdueInputContainer = document.getElementById('overdueInputContainer');
                    const priceInputContainer = document.getElementById('priceInputContainer');

                    overdueInputContainer.style.display = "none";
                    priceInputContainer.style.display = "none";

                    if (damageCondition === "7" && overdueChecked) {
                        overdueInputContainer.style.display = "block";
                        priceInputContainer.style.display = "block";
                    } else if (damageCondition === "7") {
                        priceInputContainer.style.display = "block";
                    } else if (overdueChecked) {
                        overdueInputContainer.style.display = "block";
                    }

                    toggleNextButton();
                }

                function toggleNextButton() {
                    const overduePrice = parseFloat(document.getElementById('overduePrice').value) || 0;
                    const damagePrice = parseFloat(document.getElementById('damagePrice').value) || 0;
                    const nextButton = document.getElementById('nextButton');
                    const confirmDamageButton = document.getElementById('confirmDamageButton');

                    if (overduePrice > 0 || damagePrice > 0) {
                        confirmDamageButton.style.display = "none";
                        nextButton.style.display = "block";
                    } else {
                        confirmDamageButton.style.display = "block";
                        nextButton.style.display = "none";
                    }
                }
                function showCompletionModal() {
                    console.log("✅ showCompletionModal() ถูกเรียก");

                    let returnModalElement = document.getElementById('returnModal');
                    let returnModal = bootstrap.Modal.getInstance(returnModalElement);

                    if (!returnModal) {
                        returnModal = new bootstrap.Modal(returnModalElement); // สร้าง instance ถ้ายังไม่มี
                    }

                    console.log("🟡 ปิด returnModal...");
                    returnModal.hide(); // พยายามปิด modal

                    // เช็คว่า returnModal ปิดสำเร็จหรือไม่
                    setTimeout(() => {
                        if (returnModalElement.classList.contains("show")) {
                            console.warn("⚠️ returnModal ยังไม่ถูกปิด!");
                        } else {
                            console.log("✅ returnModal ถูกปิดแล้ว");
                        }

                        removeModalBackdrop(); // ลบพื้นหลัง modal

                        let completionModalElement = document.getElementById('completionModal');
                        if (!completionModalElement) {
                            console.error("❌ ไม่พบ #completionModal");
                            return;
                        }

                        console.log("🟡 เปิด completionModal...");
                        let completionModal = new bootstrap.Modal(completionModalElement);
                        completionModal.show();
                        console.log("✅ completionModal ถูกเปิด");
                    }, 500); // รอให้ modal ปิดก่อน
                }

                // ฟังก์ชันลบพื้นหลังโมดอล
                function removeModalBackdrop() {
                    console.log("🟡 ลบ modal-backdrop...");
                    document.querySelectorAll('.modal-backdrop').forEach(backdrop => backdrop.remove());
                    document.body.classList.remove("modal-open");
                    console.log("✅ modal-backdrop ถูกลบออกแล้ว");
                }







                function handleConfirm(event) {
                    event.preventDefault();
                    console.log("✅ handleConfirm() ถูกเรียก");

                    let returnForm = document.getElementById('returnForm');
                    let completionModal = bootstrap.Modal.getInstance(document.getElementById('completionModal'));

                    if (completionModal) {
                        completionModal.hide(); // ปิดโมดอลก่อน
                    }

                    setTimeout(() => {
                        Swal.fire({
                            icon: 'success',
                            title: 'บันทึกข้อมูลสำเร็จ',
                            text: 'ระบบจะดำเนินการต่อไป...',
                            confirmButtonColor: '#6C5CE7',
                            confirmButtonText: 'OK',
                        }).then(() => {
                            returnForm.submit(); // ส่งฟอร์มไปยัง update.php
                        });
                    }, 300); // รอ 300ms ให้ completionModal ปิดสนิทก่อน
                }


            </script>



            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

            <!-- Completion Modal -->
            <div class="modal fade" id="completionModal" tabindex="-1" aria-labelledby="completionModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content shadow-lg rounded-4 border-0" style="overflow: hidden;">
                        <div class="modal-header text-white"
                            style="background: linear-gradient(45deg, #007bff, #0056b3); border-top-left-radius: 1rem; border-top-right-radius: 1rem;">
                            <h5 class="modal-title w-100 fw-bold text-center" id="completionModalLabel">
                                <i class="bi bi-check-circle-fill me-2"></i> บันทึกเสร็จสิ้น
                            </h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>


                        <div class="modal-body">
                            <div class="card shadow-sm rounded-3 border-0">
                                <div class="card-body">
                                    <h5 class="text-center text-dark fw-bold mb-3">รายละเอียดค่าปรับ</h5>
                                    <table class="table table-hover table-bordered align-middle">
                                        <thead class="table-primary">
                                            <tr class="text-center">
                                                <th>ชื่ออุปกรณ์</th>
                                                <th>ค่าชดใช้</th>
                                                <th>ค่าปรับ</th>
                                                <th>ราคารวม</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="text-center">
                                                <td class="fw-semibold"><?php echo htmlspecialchars($history_device); ?>
                                                </td>
                                                <td><span id="damagePriceInModal"
                                                        class="text-success fw-bold fs-6">0</span> บาท</td>
                                                <td><span id="finePriceInModal"
                                                        class="text-danger fw-bold fs-6">0</span> บาท</td>
                                                <td><span id="totalPriceInModal"
                                                        class="text-primary fw-bold fs-6">0</span> บาท</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <!-- ฟอร์มสำหรับส่งข้อมูลไป update.php -->
                            <form id="returnForm" action="../connect/refund/update.php" method="POST">
                                <input type="hidden" id="hiddenDamagePrice" name="damagePrice" value="0">
                                <input type="hidden" id="hiddenFinePrice" name="finePrice" value="0">
                                <input type="hidden" id="hiddenTotalPrice" name="totalPrice" value="0">

                                <!-- ข้อมูลธนาคาร -->
                                <div id="bankInfoContainer" class="container mt-4" style="display: none;">
                                    <h5 class="text-center text-dark fw-bold mb-3"><i class="bi bi-bank me-2"></i>
                                        ข้อมูลการโอนเงิน</h5>
                                    <ul class="list-group shadow-sm">
                                        <?php
                                        $sql = "SELECT bank_Name, account_Number, account_Name, bank_Details FROM satit_borrow.bank";
                                        $result = $conn->query($sql);

                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                                echo '<li class="list-group-item d-flex justify-content-between align-items-center py-3">';
                                                echo '<strong>ธนาคาร:</strong> <span class="text-primary">' . htmlspecialchars($row['bank_Name']) . '</span>';
                                                echo '</li>';
                                                echo '<li class="list-group-item d-flex justify-content-between align-items-center py-3">';
                                                echo '<strong>หมายเลขบัญชี:</strong> <span class="text-secondary">' . htmlspecialchars($row['account_Number']) . '</span>';
                                                echo '</li>';
                                                echo '<li class="list-group-item d-flex justify-content-between align-items-center py-3">';
                                                echo '<strong>ชื่อบัญชี:</strong> <span class="text-dark">' . htmlspecialchars($row['account_Name']) . '</span>';
                                                echo '</li>';
                                                echo '<li class="list-group-item d-flex justify-content-between align-items-center py-3">';
                                                echo '<strong>รายละเอียด:</strong> <span class="text-muted">' . htmlspecialchars($row['bank_Details']) . '</span>';
                                                echo '</li>';
                                            }
                                        } else {
                                            echo '<p class="text-center text-danger mt-3">❌ ไม่พบข้อมูลธนาคาร</p>';
                                        }
                                        ?>
                                    </ul>
                                </div>

                                <div class="modal-footer d-flex justify-content-center">
                                    <button type="submit" id="confirmDamageButton"
                                        class="btn btn-success px-4 rounded-3" onclick="handleConfirm(event)">
                                        <i class="bi bi-check-lg"></i> ตกลง
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <script>
                function updateFinePrice() {
                    let finePrice = parseFloat(document.getElementById('overduePrice')?.value || 0);
                    let damagePrice = parseFloat(document.getElementById('damagePrice')?.value || 0);
                    let totalPrice = damagePrice + finePrice;

                    document.getElementById('finePriceInModal').innerText = finePrice.toFixed(2);
                    document.getElementById('damagePriceInModal').innerText = damagePrice.toFixed(2);
                    document.getElementById('totalPriceInModal').innerText = totalPrice.toFixed(2);

                    document.getElementById('hiddenFinePrice').value = finePrice;
                    document.getElementById('hiddenDamagePrice').value = damagePrice;
                    document.getElementById('hiddenTotalPrice').value = totalPrice;

                    document.getElementById('bankInfoContainer').style.display = totalPrice > 0 ? 'block' : 'none';
                }

                function showCompletionModal() {
                    console.log("✅ showCompletionModal() ถูกเรียก");
                    updateFinePrice();

                    let completionModal = new bootstrap.Modal(document.getElementById('completionModal'));
                    completionModal.show();
                    console.log("✅ completionModal ถูกเปิด");
                }

                function handleConfirm(event) {
                    event.preventDefault();
                    console.log("✅ handleConfirm() ถูกเรียก");

                    let returnForm = document.getElementById('returnForm');
                    let completionModal = bootstrap.Modal.getInstance(document.getElementById('completionModal'));

                    if (completionModal) {
                        completionModal.hide(); // ปิดโมดอลก่อน
                    }

                    setTimeout(() => {
                        Swal.fire({
                            icon: 'success',
                            title: 'บันทึกข้อมูลสำเร็จ',
                            confirmButtonColor: '#6C5CE7',
                            confirmButtonText: 'OK',
                            allowOutsideClick: false, // ปิดการคลิกออกนอกกล่อง
                            backdrop: 'black', // ทำให้พื้นหลังดำสนิท
                            willOpen: () => {
                                document.body.style.overflow = 'hidden'; // ปิดการเลื่อนหน้า
                            },
                            willClose: () => {
                                document.body.style.overflow = ''; // เปิดการเลื่อนหน้าหลังจากปิด
                            }
                        }).then(() => {
                            returnForm.submit(); // ส่งฟอร์มไปยัง update.php
                        });
                    }, 10); // รอ 300ms ให้ Modal ปิดสนิทก่อน
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