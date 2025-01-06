
<?php
// เรียกใช้ session_start() ก่อนใช้งาน $_SESSION
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['officer_Right']) && $_SESSION['officer_Right'] == 3) {
 ?>  
    <form method="GET" action="">
                
    <div>
    <select id="equipmentType" name="cotton_Id" class="form-select" style="width: 180px; font-size: 14px; font-weight: normal;" onchange="this.form.submit()">
    
    <option value="0" <?= (!isset($_GET['cotton_Id']) || $_GET['cotton_Id'] == 0) ? 'selected' : '' ?>>ทั้งหมด</option>
        <option value="1" <?= (isset($_GET['cotton_Id']) && $_GET['cotton_Id'] == 1) ? 'selected' : '' ?>>อุปกรณ์คอมพิวเตอร์</option>
        <option value="2" <?= (isset($_GET['cotton_Id']) && $_GET['cotton_Id'] == 2) ? 'selected' : '' ?>>อุปกรณ์วิทยาศาสตร์</option>
        <option value="3" <?= (isset($_GET['cotton_Id']) && $_GET['cotton_Id'] == 3) ? 'selected' : '' ?>>อุปกรณ์ดนตรี</option>
        <option value="4" <?= (isset($_GET['cotton_Id']) && $_GET['cotton_Id'] == 4) ? 'selected' : '' ?>>อุปกรณ์พัสดุ</option>
    </select>
</div>


            </form>

    
<?php
}
?>




