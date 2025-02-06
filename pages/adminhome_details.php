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
    $sql = "SELECT * FROM borrow.history_brs WHERE history_Id = ?";

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
    $disableApprove = 'disabled'; // ปุ่มอนุมัติ กดไม่ได้
    $disableReturn = ''; // ปุ่มรับคืน กดได้  
} else if ($history_Status_BRS == 2) {
    $disableApprove = 'disabled'; // ปุ่มอนุมัติ กดไม่ได้
    $disableReturn = 'disabled'; // ปุ่มรับคืน กดไม่ได้
}else if ($history_Status_BRS == 0) {
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
    <div class="modal-dialog">
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
                        <input type="radio" id="approveRadio" name="device_Con" value="1" required>
                        <label for="approveRadio">อนุมัติ</label>

                        <input type="radio" id="disapproveRadio" name="device_Con" value="2" required>
                        <label for="disapproveRadio">ไม่อนุมัติ</label>
                    </div>

                    <input type="hidden" name="history_Status_BRS" id="historyStatusBRS">

                    <div class="mt-3">
                        <label for="purpose" class="fw-bold">
                            หมายเหตุ <span class="text-danger">*</span> <span class="text-muted">(สถานที่รับ)</span>
                        </label>
                        <textarea class="form-control" id="purpose" name="note_Other" 
                                  style="height: 50px; resize: none;" required></textarea>
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
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
                    title: 'กรุณาเลือกสถานะ',
                    text: 'คุณต้องเลือก อนุมัติ หรือ ไม่อนุมัติ ก่อนดำเนินการ',
                    confirmButtonColor: '#ff5733',
                });
                return false;
            }

            // ตรวจสอบหมายเหตุ
            if (note === "") {
                Swal.fire({
                    icon: 'warning',
                    title: 'กรุณากรอกหมายเหตุ',
                    text: 'โปรดระบุหมายเหตุเพื่อดำเนินการต่อ',
                    confirmButtonColor: '#ff5733',
                });
                return false;
            }

            // บันทึกค่าและปิดปุ่มกันกดซ้ำ
            $('#historyStatusBRS').val(statusValue);
            $('#confirmApproveBtn').prop('disabled', true);

            Swal.fire({
                icon: 'success',
                title: 'บันทึกข้อมูลสำเร็จ',
                confirmButtonColor: '#6C5CE7',
                confirmButtonText: 'OK',
            }).then(() => {
                $('#approveForm').submit();
            });

            return false;
        });
    });
</script>







<!-- Modal -->
<div class="modal fade" id="returnModal" tabindex="-1" aria-labelledby="returnModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="margin-top: 15vh;"> <!-- ปรับ margin-top เพื่อขยับกล่องลง -->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="returnModalLabel">สถานะการรับคืน</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>คุณต้องการรับคืนรายการนี้หรือไม่?</p>
                <form id="returnForm" action="../connect/refund/update.php" method="POST" enctype="multipart/form-data">
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="radio" name="history_Status" id="rStatus" value="return" required>
                        <label class="form-check-label" for="history_Status">คืน</label>
                    </div>

                    <div class="mb-2" id="returnField" style="display: none;">
                        <label for="returnDate">วันที่คืน:</label>
                        <input type="date" class="form-control" id="returnDate" name="htime_Return" lang="th">
                    </div>

                    <input type="hidden" name="history_Status" id="history_Status" value="2">
                    <input type="hidden" name="history_Id" id="history_Id" value="<?php echo $history_Id ?>">

                    <p>กรุณาเลือกสถานะอุปกรณ์</p>
                    <select class="form-select" id="damageCondition" name="hreturn_Status" required onchange="togglePriceInput()">
                        <option value="1">สภาพสมบูรณ์</option>
                        <option value="3">ผู้ยืมซ่อมแซม</option>
                        <option value="4">ชดใช้เป็นพัสดุ</option>
                        <option value="7">ชดใช้ค่าเสียหาย</option>
                    </select>

                    <!-- ฟิลด์สำหรับกรอกราคา -->
                    <div id="priceInputContainer" style="display: none; margin-top: 10px;">
                        <label for="damagePrice" class="form-label">กรุณากรอกราคาที่ต้องชดใช้</label>
                        <input type="number" class="form-control" id="damagePrice" name="money"
                            placeholder="กรอกจำนวนเงิน (บาท)" min="0" step="0.01" required>
                    </div>
                    <div id="purpose-container" style="margin-top: 10px;">
    <label for="purpose" class="font-weight-bold" style="font-size: 16px;">
        หมายเหตุ
    </label>
    <textarea class="form-control" id="purpose" name="tool_Other"
        style="padding: 10px; font-size: 16px; height: 50px; resize: none; overflow-y: auto;"></textarea>
</div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">ยกเลิก</button>
                <button type="button" id="confirmDamageButton" class="btn btn-success"
                    onclick="handleConfirm()">ตกลง</button>
                <button type="button" id="nextButton" class="btn btn-primary" style="display: none;"
                    onclick="showCompletionModal()">ถัดไป</button>
            </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('input[name="history_Status"]').on('change', function () {
            if ($(this).val() === 'borrow') {
                $('#borrowField').show();
                $('#returnField').hide();
                $('#htime_Return').val('');
            } else if ($(this).val() === 'return') {
                $('#borrowField').hide();
                $('#returnField').show();
            }
        });
    });

        function handleConfirm() {
    const damageCondition = document.getElementById('damageCondition').value;
    const damagePrice = document.getElementById('damagePrice').value.trim();
    const returnDate = document.getElementById('returnDate').value;
    const note = document.getElementById('purpose').value.trim();

    // ตรวจสอบวันที่คืน
    if (!returnDate) {
        Swal.fire({
            icon: 'warning',
            title: 'กรุณากรอกวันที่คืน!',
            confirmButtonText: 'ตกลง',
            confirmButtonColor: '#3085d6'
        }).then(() => document.getElementById('returnDate').focus());
        return;
    }

    // ตรวจสอบสถานะอุปกรณ์
    if (!damageCondition) {
        Swal.fire({
            icon: 'warning',
            title: 'กรุณาเลือกสถานะอุปกรณ์!',
            confirmButtonText: 'ตกลง',
            confirmButtonColor: '#3085d6'
        }).then(() => document.getElementById('damageCondition').focus());
        return;
    }

    // ตรวจสอบราคาชดใช้ ถ้าเลือก 'ชดใช้ค่าเสียหาย'
    if (damageCondition === "7" && (!damagePrice || isNaN(damagePrice) || parseFloat(damagePrice) <= 0)) {
        Swal.fire({
            icon: 'warning',
            title: 'กรุณากรอกราคาที่ต้องชดใช้ให้ถูกต้อง!',
            confirmButtonText: 'ตกลง',
            confirmButtonColor: '#3085d6'
        }).then(() => document.getElementById('damagePrice').focus());
        return;
    }

    // ไม่จำเป็นต้องกรอกหมายเหตุ (ลบการตรวจสอบหมายเหตุ)
    /*if (!note) {
        Swal.fire({
            icon: 'warning',
            title: 'กรุณากรอกหมายเหตุ!',
            confirmButtonText: 'ตกลง',
            confirmButtonColor: '#3085d6'
        }).then(() => document.getElementById('purpose').focus());
        return;
    }*/

    Swal.fire({
        icon: 'success',
        title: 'บันทึกข้อมูลสำเร็จ!',
        confirmButtonText: 'ตกลง',
        confirmButtonColor: '#3085d6'
    }).then(() => {
        document.getElementById('returnForm').submit();
    });
}

    function togglePriceInput() {
        const damageCondition = document.getElementById('damageCondition').value;
        const priceInputContainer = document.getElementById('priceInputContainer');
        const damagePrice = document.getElementById('damagePrice');

        if (damageCondition === "7") {
            priceInputContainer.style.display = "block";
            damagePrice.setAttribute("required", "true");
        } else {
            priceInputContainer.style.display = "none";
            damagePrice.removeAttribute("required");
            damagePrice.value = "";
        }
    }
</script>

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Modal Completion -->
<div class="modal fade" id="completionModal" tabindex="-1" aria-labelledby="completionModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content shadow rounded-4 border-0">
            <!-- Header -->
            <div class="modal-header text-white text-center rounded-top-9" style="background-color: #007bff; margin-top: -20px;">
<h5 class="modal-title w-100 fw-bold" id="completionModalLabel">บันทึกเสร็จสิ้น</h5>
<button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
</div>

            <?php
// สมมติว่ามีการเชื่อมต่อฐานข้อมูลแล้ว

// ดึงข้อมูลจาก borrow.history_brs และ borrow.finance ที่มี officer_Cotton ตรงกัน
$sql = "SELECT history_brs.history_device
FROM borrow.history_brs
LEFT JOIN borrow.finance ON history_brs.officer_Cotton = finance.officer_Cotton
WHERE history_brs.device_Id = ?"; // ใช้ device_Id ที่ต้องการ

$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $device_Id); // ใส่ค่าของ device_Id ที่ต้องการค้นหา
$stmt->execute();
$result = $stmt->get_result();

?>

<div class="modal-body">
<!-- Table for device details -->
<table class="table table-hover table-bordered align-middle">
<thead class="table-primary">
    <tr>
        <th scope="col" class="text-center fw-semibold fs-6">ชื่ออุปกรณ์</th>
        <th scope="col" class="text-center fw-semibold fs-6">ราคา</th>
    </tr>
</thead>
<tbody>
    <tr class="text-center">
        <td class="fw-semibold"><?php echo htmlspecialchars($history_device); ?></td>
        <td><span id="priceInModal" class="text-success fw-bold fs-6">0</span> บาท</td>
    </tr>
</tbody>
</table>

<!-- Information for the payment transfer -->
<?php
// ดึงข้อมูลจากฐานข้อมูล borrow.bank
$sql = "SELECT * FROM borrow.bank"; // หรือเพิ่ม WHERE clause ถ้าคุณต้องการดึงข้อมูลที่เจาะจง
$result = $conn->query($sql);

if ($result->num_rows > 0) {
// ใช้ while loop เพื่อแสดงผลข้อมูลจากฐานข้อมูล
while ($row = $result->fetch_assoc()) {
    echo '<div class="container mt-4">';  // เพิ่ม margin เพื่อเว้นพื้นที่
    echo '<h4 class="text-center text-info mb-4">ข้อมูลการโอนเงิน</h4>';  // ใช้ text-info เพื่อสีฟ้า
    echo '<ul class="list-group list-group-flush shadow-sm">';  // เพิ่ม shadow เพื่อให้ดูนุ่มนวล

    // แสดงข้อมูลจากฐานข้อมูล
    echo '<li class="list-group-item d-flex justify-content-between align-items-center py-3">';
    echo '<strong>ธนาคาร:</strong> <span class="text-primary">' . htmlspecialchars($row['bank_Name']) . '</span>';
    echo '</li>';
    echo '<li class="list-group-item d-flex justify-content-between align-items-center py-3">';
    echo '<strong>หมายเลขบัญชี:</strong> <span class="text-secondary">' . htmlspecialchars($row['account_Number']) . '</span>';
    echo '</li>';
    echo '<li class="list-group-item d-flex justify-content-between align-items-center py-3">';
    echo '<strong>ชื่อ:</strong> <span class="text-dark">' . htmlspecialchars($row['account_Name']) . '</span>';
    echo '</li>';
    echo '<li class="list-group-item d-flex justify-content-between align-items-center py-3">';
    echo '<strong>รายละเอียด:</strong> <span class="text-muted">' . htmlspecialchars($row['bank_Details']) . '</span>';
    echo '</li>';

    echo '</ul>';
    echo '</div>';
}
} else {
echo '<p class="text-center text-danger mt-3">ไม่พบข้อมูล</p>';  // ใช้ข้อความแจ้งเตือนในกรณีที่ไม่มีข้อมูล
}
?>
</div>



<!-- Modal Footer -->
<div class="modal-footer d-flex justify-content-center">
<button type="button" id="confirmDamageButton" class="btn btn-success" onclick="handleConfirm()">ตกลง</button>
</div>

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

                // กำหนดฟังก์ชันปิดโมดัลเมื่อคลิกปุ่ม "ตกลง"
                document.getElementById('closeModalButton').onclick = function () {
                    completionModal.hide();
                };
            }

            function togglePriceInput() {
                const damageCondition = document.getElementById('damageCondition').value;
                const priceInputContainer = document.getElementById('priceInputContainer');
                const damagePriceInput = document.getElementById('damagePrice');
                const purposeContainer = document.getElementById('purpose-container');
                const confirmDamageButton = document.getElementById('confirmDamageButton');
                const nextButton = document.getElementById('nextButton');

                if (damageCondition === "7") {
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


</div>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
</body>

</html>