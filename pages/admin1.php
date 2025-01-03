<?php
// เรียกใช้ session_start() ก่อนใช้งาน $_SESSION
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['officer_Right']) && $_SESSION['officer_Right'] == 3) {
?>  
    <form method="GET" action="">
        <div class="me-3">
            <select id="equipmentType" name="status_Name" class="form-select" style="width: 220px; font-size: 14px; font-weight: normal;" onchange="this.form.submit()">
                <option value="" selected disabled>กรุณาเลือกสถานะ</option>
                <option value="0" <?= (!isset($_GET['status_Name']) || $_GET['status_Name'] == 0) ? 'selected' : '' ?>>ทั้งหมด</option>
                <option value="รอตรวจสอบ" <?= (isset($_GET['status_Name']) && $_GET['status_Name'] == 'รอตรวจสอบ') ? 'selected' : '' ?>>รอตรวจสอบ</option>
                <option value="อนุมัติ" <?= (isset($_GET['status_Name']) && $_GET['status_Name'] == 'อนุมัติ') ? 'selected' : '' ?>>อนุมัติ</option>
                <option value="ไม่อนุมัติ" <?= (isset($_GET['status_Name']) && $_GET['status_Name'] == 'ไม่อนุมัติ') ? 'selected' : '' ?>>ไม่อนุมัติ</option>
                <option value="กำลังยืม" <?= (isset($_GET['status_Name']) && $_GET['status_Name'] == 'กำลังยืม') ? 'selected' : '' ?>>กำลังยืม</option>
                <option value="คืนแล้ว" <?= (isset($_GET['status_Name']) && $_GET['status_Name'] == 'คืนแล้ว') ? 'selected' : '' ?>>คืนแล้ว</option>
                <option value="ชำรุด" <?= (isset($_GET['status_Name']) && $_GET['status_Name'] == 'ชำรุด') ? 'selected' : '' ?>>ชำรุด</option>
                <option value="ผู้ยืมซ่อมแซม" <?= (isset($_GET['status_Name']) && $_GET['status_Name'] == 'ผู้ยืมซ่อมแซม') ? 'selected' : '' ?>>ผู้ยืมซ่อมแซม</option>
                <option value="ชำระค่าเสียหาย" <?= (isset($_GET['status_Name']) && $_GET['status_Name'] == 'ชำระค่าเสียหาย') ? 'selected' : '' ?>>ชำระค่าเสียหาย</option>
                <option value="ชดใช้เป็นพัสดุ" <?= (isset($_GET['status_Name']) && $_GET['status_Name'] == 'ชดใช้เป็นพัสดุ') ? 'selected' : '' ?>>ชดใช้เป็นพัสดุ</option>
            </select>
        </div>
    </form>
<?php
}
?>
