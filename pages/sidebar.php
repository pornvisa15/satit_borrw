<?php
//กำหนดเวลาที่สามารถอยู่ในระบบ
$sessionlifetime = 30; //กำหนดเป็นนาที
if(isset($_SESSION["timeLasetdActive"])){
	$seclogin = (time()-$_SESSION["timeLasetdActive"])/60;
	//หากไม่ได้ Active ในเวลาที่กำหนด
	if($seclogin>$sessionlifetime){
		//goto logout page
		
		header("location:../connect/logout.php");
		exit;
	}else{
		$_SESSION["timeLasetdActive"] = time();
	}
}else{
	$_SESSION["timeLasetdActive"] = time();
}
session_start();
if(($_SESSION['useripass']== ''  )) {
    header("location:../logout.php");
    exit;
 } 

?>
<?php


if (isset($_SESSION['officer_Right']) && $_SESSION['officer_Right'] == 4) {
    ?>
    <div class="d-flex flex-column text-white p-4"
    style="width: 250px; min-height: 100vh; background-color: #466da7; margin-left: auto; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2); flex-shrink: 0; overflow-y: auto;">
    <?php
    if ($_SESSION['officer_Right'] == 3) {
        echo "<h3 class='mb-4 text-center' style='background: rgba(0, 0, 0, 0.3); backdrop-filter: blur(5px); color: white; padding: 18px 20px; border-radius: 13px;'>Admin</h3>";
    } elseif ($_SESSION['officer_Right'] == 4) {
        echo "<h3 class='mb-4 text-center' style='background: rgba(0, 0, 0, 0.3); backdrop-filter: blur(5px); color: white; padding: 18px 20px; border-radius: 13px;'>Officer</h3>";
    } else {
        echo "<span class='text-light'>ไม่มีสิทธิ์</span>";
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
                ประวัติอุปกรณ์
            </a>
        </li>
        <li class="nav-item mb-3">
    <a href="/satit_borrw/img/muaythai_research.pdf" class="nav-link text-white"
        style="background-color: #406398; border-radius: 8px; padding: 12px 18px; transition: background-color 0.3s, transform 0.3s; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);"
        target="_blank">
        คู่มือการใช้งาน
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

    ?>

    <!-- แอดมิน -->
    <?php
} elseif ($_SESSION['officer_Right'] == 3) {
    ?>
    <div class="d-flex flex-column text-white p-4"
    style="width: 250px; min-height: 100vh; background-color: #466da7; margin-left: auto; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2); flex-shrink: 0;">
    <?php
    if (isset($_SESSION['officer_Right'])) {
        if ($_SESSION['officer_Right'] == 3) {
            echo "<h3 class='mb-4 text-center' style='background: rgba(0, 0, 0, 0.3); backdrop-filter: blur(5px); color: white; padding: 18px 20px; border-radius: 13px;'>Admin</h3>";
        } elseif ($_SESSION['officer_Right'] == 4) {
            echo "<h3 class='mb-4 text-center' style='background: rgba(0, 0, 0, 0.3); backdrop-filter: blur(5px); color: white; padding: 18px 20px; border-radius: 13px;'>เจ้าหน้าที่</h3>";
        } else {
            echo "<span class='text-light'>ไม่มีสิทธิ์</span>";
        }
    } else {
        echo "<span class='text-light'>ไม่มีข้อมูลสิทธิ์</span>";
    }
    ?>
    <ul class="nav flex-column">
        <li class="nav-item mb-3">
            <a href="admin_homepages.php" class="nav-link text-white"
                style="background-color: #406398; border-radius: 8px; padding: 12px 18px; transition: background-color 0.3s, transform 0.3s; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                หน้าหลัก
            </a>
        </li>
        <li class="nav-item mb-3">
            <a href="admin_equipment.php" class="nav-link text-white"
                style="background-color: #406398; border-radius: 8px; padding: 12px 18px; transition: background-color 0.3s, transform 0.3s; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                คลังอุปกรณ์
            </a>
        </li>
        <li class="nav-item mb-3">
            <a href="admin_staffinfo.php" class="nav-link text-white"
                style="background-color: #406398; border-radius: 8px; padding: 12px 18px; transition: background-color 0.3s, transform 0.3s; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                ข้อมูลเจ้าหน้าที่
            </a>
        </li>
        <li class="nav-item mb-3">
            <a href="admin_record.php" class="nav-link text-white"
                style="background-color: #406398; border-radius: 8px; padding: 12px 18px; transition: background-color 0.3s, transform 0.3s; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                ประวัติอุปกรณ์
            </a>
        </li>
        <li class="nav-item mb-3">
            <a href="admin_finance.php" class="nav-link text-white"
                style="background-color: #406398; border-radius: 8px; padding: 12px 18px; transition: background-color 0.3s, transform 0.3s; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                ตั้งค่าบัญชีธนาคาร
            </a>
        </li>
        <li class="nav-item mb-3">
    <a href="/satit_borrw/img/muaythai_research.pdf" class="nav-link text-white"
        style="background-color: #406398; border-radius: 8px; padding: 12px 18px; transition: background-color 0.3s, transform 0.3s; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);"
        target="_blank">
        คู่มือการใช้งาน
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
} elseif ($_SESSION['officer_Right'] == 1) {

    ?>
    <!-- รูปภาพ with overlay text aligned to the left and moved slightly to the right -->
    <div class="position-relative">
        <img src="/satit_borrw/img/3.jpg" alt="Image not found" class="img-fluid w-100 h-100 object-fit-cover">
        <div class="position-absolute top-50 start-0 translate-middle-y text-light"
            style="font-size: 1.5rem; font-weight: bold; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5); padding-left: 60px;">
            ระบบ ยืม-คืน อุปกรณ์
        </div>
    </div>


    <!-- Grid System for Two Boxes -->
    <div class="container-fluid mt-4 ms-0 flex-grow-1">
        <div class="row">
            <!-- กล่องทางซ้าย (เมนู) -->
            <div class="col-md-3 col-lg-2">
                <div class="p-3 border rounded shadow-sm" style="background-color: #007468; color: #ffffff;">

                    <?php

                    include "../connect/mysql_studentsatit.php"; // การดึงฐานข้อมูลคนเดียววววววว
                    $sql = "SELECT * FROM studentsatit.detail_std WHERE detail_std.std_id = $_SESSION[useripass]";
                    $result = mysqli_query($conn, $sql);
                    $showdata = mysqli_fetch_array($result);
                    ?>
                    <div class="d-flex align-items-center mb-3 p-2 bg-white rounded shadow-sm">
                        <!-- แสดงไอคอน -->
                        <i class="bi bi-person-circle" style="font-size: 18px; color: #007468;"></i>
                        <!-- แสดงชื่อผู้ใช้ -->
                        <span class="ms-2" style="font-size: 14px; color: #007468;">
                            <?php echo $showdata['std_name'] . " " . $showdata['std_surname']; ?>
                        </span>
                    </div>



                    <ul class="nav flex-column mt-3">
                        <li>
                            <?php
                            if (isset($_SESSION['officer_Right'])) {
                                if ($_SESSION['officer_Right'] == 1) {  // ใช้ == แทน =
                                    echo "<a href='homepages.php' class='nav-link text-light'>สำหรับการยืม</a>";
                                } elseif ($_SESSION['officer_Right'] == 2) {  // ใช้ == แทน =
                                    echo "<a href='homepages.php' class='nav-link text-light'>สำหรับการยืม</a>";
                                } else {
                                    echo "<span class='text-light'>ไม่มีสิทธิ์</span>";
                                }
                            } else {
                                echo "<span class='text-light'>ไม่มีข้อมูลสิทธิ์</span>";
                            }
                            ?>
                        </li>
                        <li>
                            <a class="nav-link text-light d-flex align-items-center" data-bs-toggle="collapse"
                                href="#borrowSection" role="button" aria-expanded="false" aria-controls="borrowSection">
                                ประเภท
                                <i class="bi bi-chevron-down ms-2"></i>
                            </a>

                            <div class="collapse" id="borrowSection">
                                <div class="card card-body border-0">
                                    <ul class="list-unstyled">
                                        <li><a href="reservation_com.php"
                                                class="btn btn-light btn-lg w-100 mb-1 text-start rounded-3 p-2 shadow-sm fs-6 text-success">อุปกรณ์คอมพิวเตอร์</a>
                                        </li>
                                        <li><a href="reservation_science.php"
                                                class="btn btn-light btn-lg w-100 mb-1 text-start rounded-3 p-2 shadow-sm fs-6 text-success">อุปกรณ์วิทยาศาสตร์</a>
                                        </li>
                                        <li><a href="reservation_music.php"
                                                class="btn btn-light btn-lg w-100 mb-1 text-start rounded-3 p-2 shadow-sm fs-6 text-success">อุปกรณ์ดนตรี</a>
                                        </li>
                                        <li><a href="reservation_parcel.php"
                                                        class="btn btn-light btn-lg w-100 mb-1 text-start rounded-3 p-2 shadow-sm fs-6 text-success">อุปกรณ์พัสดุ</a>
                                                </li>
                                    </ul>
                                </div>
                            </div>
                        </li>

                        <li><a href="warn.php" class="nav-link text-light">แจ้งเตือน</a></li>
                        <li><a href="record.php" class="nav-link text-light">ประวัติการยืม</a></li>
                        <li><a href="../logout.php" class="nav-link text-white">ออกจากระบบ</a></li>

                    </ul>
                </div>
            </div>

            <!-- Bootstrap JS (Optional for interactive components) -->
            <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

            <!-- Custom CSS -->
            <style>
                /* เปลี่ยนสีเมนูเมื่อ hover */
                .nav-link:hover {
                    background-color: #005a3d;
                    /* สีเข้มขึ้นเมื่อ hover */
                    color: white;
                    border-radius: 4px;
                }

                /* เปลี่ยนสีเมนูเมื่อ active */
                .nav-link.active {
                    background-color: #00452c;
                    /* สีเข้มสุดเมื่อคลิก */
                    color: white;
                    border-radius: 4px;
                }

                /* เพิ่มเงาให้เมนู */
                .nav-link,
                .btn {
                    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
                }

                /* ปรับรูปแบบของเมนูให้ดูทันสมัย */
                .nav-link,
                .btn {
                    border-radius: 5px;
                }

                /* เพิ่มระยะห่างระหว่างเมนู */
                .nav-link {
                    margin-bottom: 8px;
                }
            </style>


            <?php
} elseif ($_SESSION['officer_Right'] == 2) {

    ?>
            <!-- รูปภาพ with overlay text aligned to the left and moved slightly to the right -->
            <div class="position-relative">
                <img src="/satit_borrw/img/3.jpg" alt="Image not found" class="img-fluid w-100 h-100 object-fit-cover">
                <div class="position-absolute top-50 start-0 translate-middle-y text-light"
                    style="font-size: 1.5rem; font-weight: bold; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5); padding-left: 60px;">
                    ระบบ ยืม-คืน อุปกรณ์
                </div>
            </div>


            <!-- Grid System for Two Boxes -->
            <div class="container-fluid mt-4 ms-0 flex-grow-1">
                <div class="row">
                    <!-- กล่องทางซ้าย (เมนู) -->
                    <div class="col-md-3 col-lg-2">
                        <div class="p-3 border rounded shadow-sm" style="background-color: #007468; color: #ffffff;">
                            <?php
                            include "../connect/myspl_das_satit.php"; // การเชื่อมต่อฐานข้อมูล
                        
                            // ตรวจสอบ $_SESSION ก่อนใช้งาน
                            if (isset($_SESSION['useripass'])) {
                                $useripass = mysqli_real_escape_string($conn, $_SESSION['useripass']);
                                $sql = "SELECT * FROM das_satit.das_admin WHERE das_admin.useripass = '$useripass'";
                                $result = mysqli_query($conn, $sql);

                                // ตรวจสอบว่ามีข้อมูลหรือไม่
                                if ($result && mysqli_num_rows($result) > 0) {
                                    $showdata = mysqli_fetch_array($result);
                                } else {
                                    echo "ไม่พบข้อมูลผู้ใช้";
                                    exit;
                                }
                            }

                            ?>

                            <div class="d-flex align-items-center mb-3 p-2 bg-white rounded shadow-sm">
                                <!-- แสดงไอคอน -->
                                <i class="bi bi-person-circle" style="font-size: 18px; color: #007468;"></i>
                                <!-- แสดงชื่อผู้ใช้ -->
                                <span class="ms-2" style="font-size: 14px; color: #007468;">
                                    <?php echo htmlspecialchars($showdata['name']) . " " . htmlspecialchars($showdata['surname']); ?>
                                </span>
                            </div>



                            <ul class="nav flex-column mt-3">
                                <li>
                                    <?php
                                    if (isset($_SESSION['officer_Right'])) {
                                        if ($_SESSION['officer_Right'] == 1) {  // ใช้ == แทน =
                                            echo "<a href='homepages.php' class='nav-link text-light'>สำหรับการยืมนักเรียน</a>";
                                        } elseif ($_SESSION['officer_Right'] == 2) {  // ใช้ == แทน =
                                            echo "<a href='homepages.php' class='nav-link text-light'>สำหรับการยืมบุคลากร</a>";
                                        } else {
                                            echo "<span class='text-light'>ไม่มีสิทธิ์</span>";
                                        }
                                    } else {
                                        echo "<span class='text-light'>ไม่มีข้อมูลสิทธิ์</span>";
                                    }
                                    ?>
                                </li>
                                <li>
                                    <a class="nav-link text-light d-flex align-items-center" data-bs-toggle="collapse"
                                        href="#borrowSection" role="button" aria-expanded="false"
                                        aria-controls="borrowSection">
                                        ประเภท
                                        <i class="bi bi-chevron-down ms-2"></i>
                                    </a>

                                    <div class="collapse" id="borrowSection">
                                        <div class="card card-body border-0">
                                            <ul class="list-unstyled">
                                                <li><a href="reservation_com.php"
                                                        class="btn btn-light btn-lg w-100 mb-1 text-start rounded-3 p-2 shadow-sm fs-6 text-success">อุปกรณ์คอมพิวเตอร์</a>
                                                </li>
                                                <li><a href="reservation_science.php"
                                                        class="btn btn-light btn-lg w-100 mb-1 text-start rounded-3 p-2 shadow-sm fs-6 text-success">อุปกรณ์วิทยาศาสตร์</a>
                                                </li>
                                                <li><a href="reservation_music.php"
                                                        class="btn btn-light btn-lg w-100 mb-1 text-start rounded-3 p-2 shadow-sm fs-6 text-success">อุปกรณ์ดนตรี</a>
                                                </li>
                                                <li><a href="reservation_music.php"
                                                        class="btn btn-light btn-lg w-100 mb-1 text-start rounded-3 p-2 shadow-sm fs-6 text-success">พัสดุอุปกรณ์</a>
                                                </li>

                                            </ul>
                                        </div>
                                    </div>
                                </li>

                                <li><a href="warn.php" class="nav-link text-light">แจ้งเตือน</a></li>
                                <li><a href="record.php" class="nav-link text-light">ประวัติการยืม</a></li>
                                <li><a href="../logout.php" class="nav-link text-white">ออกจากระบบ</a></li>

                            </ul>
                        </div>
                    </div>

                    <!-- Bootstrap JS (Optional for interactive components) -->
                    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
                    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
                    <script
                        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

                    <!-- Custom CSS -->
                    <style>
                        /* เปลี่ยนสีเมนูเมื่อ hover */
                        .nav-link:hover {
                            background-color: #005a3d;
                            /* สีเข้มขึ้นเมื่อ hover */
                            color: white;
                            border-radius: 4px;
                        }

                        /* เปลี่ยนสีเมนูเมื่อ active */
                        .nav-link.active {
                            background-color: #00452c;
                            /* สีเข้มสุดเมื่อคลิก */
                            color: white;
                            border-radius: 4px;
                        }

                        /* เพิ่มเงาให้เมนู */
                        .nav-link,
                        .btn {
                            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
                        }

                        /* ปรับรูปแบบของเมนูให้ดูทันสมัย */
                        .nav-link,
                        .btn {
                            border-radius: 5px;
                        }

                        /* เพิ่มระยะห่างระหว่างเมนู */
                        .nav-link {
                            margin-bottom: 8px;
                        }
                    </style>
                    <?php
}



