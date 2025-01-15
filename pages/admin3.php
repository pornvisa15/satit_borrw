
<?php
// เรียกใช้ session_start() ก่อนใช้งาน $_SESSION
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['officer_Right']) && $_SESSION['officer_Right'] == 3) {
 ?>  
     <form method="GET" action="">
            <div class="mb-3">
    <select id="equipmentType" name="officer_Cotton" class="form-select" style="width: 180px; font-size: 14px; font-weight: normal;" onchange="this.form.submit()">
        <option value="" selected disabled>กรุณาเลือกเจ้าหน้าที่ฝ่าย</option>
        <option value="0" <?= (!isset($_GET['officer_Cotton']) || $_GET['officer_Cotton'] == 0) ? 'selected' : '' ?>>ทั้งหมด</option>
        <option value="1" <?= (isset($_GET['officer_Cotton']) && $_GET['officer_Cotton'] == 1) ? 'selected' : '' ?>>ฝ่ายคอมพิวเตอร์</option>
        <option value="2" <?= (isset($_GET['officer_Cotton']) && $_GET['officer_Cotton'] == 2) ? 'selected' : '' ?>>ฝ่ายวิทยาศาสตร์</option>
        <option value="3" <?= (isset($_GET['officer_Cotton']) && $_GET['officer_Cotton'] == 3) ? 'selected' : '' ?>>ฝ่ายดนตรี</option>
        <option value="4" <?= (isset($_GET['officer_Cotton']) && $_GET['officer_Cotton'] == 4) ? 'selected' : '' ?>>ฝ่ายพัสดุ</option>
        <option value="5" <?= (isset($_GET['officer_Cotton']) && $_GET['officer_Cotton'] == 4) ? 'selected' : '' ?>>แอดมิน</option>
    </select>
</div>

</form>

    
<?php
}
?>




