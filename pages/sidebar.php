
<?php if($_SESSION['officer_Right'] == 4 ){
?>

<div class="d-flex flex-column text-white p-4"
        style="width: 250px; min-height: 100vh; background-color: #466da7;  margin-left: auto; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);">
        <?php
if (isset($_SESSION['officer_Right'])) {
    if ($_SESSION['officer_Right'] == 3) { // ใช้ === เพื่อเปรียบเทียบค่า
        echo "<h3 class='mb-4 text-center' style='background: rgba(0, 0, 0, 0.3); backdrop-filter: blur(5px); color: white; padding: 18px 20px; border-radius: 13px;'>แอดมิน</h3>";
    } elseif ($_SESSION['officer_Right'] == 4) { // เปลี่ยนจาก officer_Cotton ให้ถูกต้อง
        echo "<h3 class='mb-4 text-center' style='background: rgba(0, 0, 0, 0.3); backdrop-filter: blur(5px); color: white; padding: 18px 20px; border-radius: 13px;'>เจ้าหน้าที่</h3>";
    } else {
        echo "<span class='text-light'>ไม่มีสิทธิ์ </span>";
     
    }
} else {
    echo "<span class='text-light'>ไม่มีข้อมูลสิทธิ์</span>";
   
}
?>   
    
<ul class="nav flex-column">
            <li class="nav-item mb-3">
                <a href="admin_homepages.php" class="nav-link text-white"
                    style="background-color:#406398; border-radius: 8px; padding: 12px 18px; transition: background-color 0.3s, transform 0.3s; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                    หน้าหลัก
                </a>
            </li>
            <li class="nav-item mb-3">
                <a href="admin_equipment.php" class="nav-link text-white"
                    style="background-color:#406398; border-radius: 8px; padding: 12px 18px; transition: background-color 0.3s, transform 0.3s; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                    คลังอุปกรณ์
                </a>
            </li>
         
            <li class="nav-item mb-3">
                <a href="admin_record.php" class="nav-link text-white"
                    style="background-color:#406398; border-radius: 8px; padding: 12px 18px; transition: background-color 0.3s, transform 0.3s; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                    ประวัติการใช้อุปกรณ์
                </a>
            </li>
            <li class="nav-item mb-3">
                <a href="../logout.php" class="nav-link text-white"
                    style="background-color: #406398; border-radius: 8px; padding: 12px 18px; transition: background-color 0.3s, transform 0.3s; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                    ออกจากระบบ
                </a>
            </li>
        </ul>

</div>

<?php
}    
elseif($_SESSION['officer_Right'] == 3){
?>

<ul class="nav flex-column">
            <li class="nav-item mb-3">
                <a href="admin_homepages.php" class="nav-link text-white"
                    style="background-color:#406398; border-radius: 8px; padding: 12px 18px; transition: background-color 0.3s, transform 0.3s; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                    หน้าหลัก
                </a>
            </li>
            <li class="nav-item mb-3">
                <a href="admin_equipment.php" class="nav-link text-white"
                    style="background-color:#406398; border-radius: 8px; padding: 12px 18px; transition: background-color 0.3s, transform 0.3s; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                    คลังอุปกรณ์
                </a>
            </li>
            <li class="nav-item mb-3"> 
                <a href="admin_staffinfo.php" class="nav-link text-white"
                    style="background-color:#406398; border-radius: 8px; padding: 12px 18px; transition: background-color 0.3s, transform 0.3s; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                    ข้อมูลเจ้าหน้าที่
                </a>
            </li>
            <li class="nav-item mb-3">
                <a href="admin_record.php" class="nav-link text-white"
                    style="background-color:#406398; border-radius: 8px; padding: 12px 18px; transition: background-color 0.3s, transform 0.3s; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                    ประวัติการใช้อุปกรณ์
                </a>
            </li>
            <li class="nav-item mb-3">
                <a href="../logout.php" class="nav-link text-white"
                    style="background-color: #406398; border-radius: 8px; padding: 12px 18px; transition: background-color 0.3s, transform 0.3s; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                    ออกจากระบบ
                </a>
            </li>
        </ul>
    
<?php
}
elseif($_SESSION['officer_Right'] == 1){

?>

    <?php
    if (isset($_SESSION['officer_Right'])) {
        if ($_SESSION['officer_Right'] == 'student') {  // ใช้ == แทน =
            echo "<a href='homepages.php' class='nav-link text-light'>สำหรับการยืมนักเรียน</a>";
        } elseif ($_SESSION['officer_Right'] == 'staff') {  // ใช้ == แทน =
            echo "<a href='homepages.php' class='nav-link text-light'>สำหรับการยืมบุคลากร</a>";
        } else {
            echo "<span class='text-light'>ไม่มีสิทธิ์</span>";
        }
    } else {
        echo "<span class='text-light'>ไม่มีข้อมูลสิทธิ์</span>";
    }
    ?>
</li>


    
<?php
}
elseif($_SESSION['officer_Right'] == 2){

?>

<?php
}



