<?php
// เรียกใช้ session_start() ก่อนใช้งาน $_SESSION
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
   
    <?php
// กำหนดค่าเริ่มต้น
$officer_title = "ไม่มีข้อมูลสิทธิ์";
$full_name = "ไม่ระบุ"; // ค่าเริ่มต้นสำหรับชื่อและนามสกุล

// ตรวจสอบสิทธิ์ใน $_SESSION
if (isset($_SESSION['officer_Right'])) {
    if ($_SESSION['officer_Right'] == 3) {
        $officer_title = "แอดมิน"; // สิทธิ์ระดับ 3 เป็นแอดมิน
    } elseif ($_SESSION['officer_Right'] == 4) {
        $officer_title = "เจ้าหน้าที่"; // สิทธิ์ระดับ 4 เป็นเจ้าหน้าที่
    }
}

// ดึงข้อมูลจากฐานข้อมูล
if (isset($_SESSION['useripass'])) {
    include "../connect/myspl_das_satit.php"; // การเชื่อมต่อฐานข้อมูล

    $useripass = mysqli_real_escape_string($conn, $_SESSION['useripass']); // ป้องกัน SQL Injection
    $sql = "SELECT name, surname FROM das_satit.das_admin WHERE useripass = '$useripass'";
    $result = mysqli_query($conn, $sql);

    // ตรวจสอบข้อมูลในฐานข้อมูล
    if ($result && mysqli_num_rows($result) > 0) {
        $showdata = mysqli_fetch_array($result);
        $full_name = $showdata['name'] . " " . $showdata['surname']; // รวมชื่อและนามสกุล
    } 
}
?>

<div class="d-flex justify-content-end mt-auto">
    <div class="d-flex align-items-center p-2"
        style="background-color: #ffffff; border-radius: 8px; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1); border: 1px solid #e0e0e0;">
        <!-- ไอคอนโปรไฟล์ -->
        <i class="bi bi-person-circle"
            style="font-size: 25px; color: #3b5681; border-radius: 50%; background-color: #ffffff;"></i>
        <span class="ms-2"
            style="color: #05142d; font-size: 14px; font-weight: 500; letter-spacing: 0.3px;"><?php echo $officer_title; ?>:
            <?php echo $full_name; ?></span>
    </div>

</div>

