<?php
// เรียกใช้ session_start() ก่อนใช้งาน $_SESSION
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['officer_Right']) && $_SESSION['officer_Right'] == 3) {
?>  
 <form method="get" action="" style="flex: 1;">
    <select id="cottonFilter" name="officer_Cotton" class="form-select" style="font-size: 14px;" onchange="this.form.submit()">
        
        <option value="0" <?= (isset($_GET['officer_Cotton']) && $_GET['officer_Cotton'] == '0') ? 'selected' : '' ?>>ทั้งหมด</option>
        <option value="1" <?= (isset($_GET['officer_Cotton']) && $_GET['officer_Cotton'] == '1') ? 'selected' : '' ?>>อุปกรณ์คอมพิวเตอร์</option>
        <option value="2" <?= (isset($_GET['officer_Cotton']) && $_GET['officer_Cotton'] == '2') ? 'selected' : '' ?>>อุปกรณ์วิทยาศาสตร์</option>
        <option value="3" <?= (isset($_GET['officer_Cotton']) && $_GET['officer_Cotton'] == '3') ? 'selected' : '' ?>>อุปกรณ์ดนตรี</option>
        <option value="4" <?= (isset($_GET['officer_Cotton']) && $_GET['officer_Cotton'] == '4') ? 'selected' : '' ?>>อุปกรณ์พัสดุ</option>
    </select>
</form>




<?php
}
?>
