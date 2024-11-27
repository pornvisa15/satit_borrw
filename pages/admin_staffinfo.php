<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin ข้อมูลเจ้าหน้าที่</title>
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>
</head>

<body class="d-flex bg-light">



    <div class="d-flex flex-column text-white p-4"
        style="width: 250px; min-height: 100vh; background-color: #466da7;  margin-left: auto; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);">
        <h3 class="mb-4 text-center"
            style="background: rgba(0, 0, 0, 0.3); backdrop-filter: blur(5px); color: white; padding: 18px 20px; border-radius: 13px; ">
            Admin
        </h3>


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
                <a href="#" class="nav-link text-white"
                    style="background-color: #406398; border-radius: 8px; padding: 12px 18px; transition: background-color 0.3s, transform 0.3s; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                    ออกจากระบบ
                </a>
            </li>
        </ul>
    </div>


    <div class="flex-grow-1 p-4">
        <div class="d-flex justify-content-end mt-auto">
            <div class="d-flex align-items-center p-2"
                style="background-color: #ffffff; border-radius: 8px; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1); border: 1px solid #e0e0e0;">
                <!-- ไอคอนโปรไฟล์ -->
                <i class="bi bi-person-circle"
                    style="font-size: 25px; color: #3b5681; border-radius: 50%; background-color: #ffffff;"></i>
                <span class="ms-2"
                    style="color: #05142d; font-size: 14px; font-weight: 500; letter-spacing: 0.3px;">แอดมิน: วิลเลี่ยม
                    เชคสเปียร์</span>
            </div>
        </div>
       
        <?php
include '../connect/myspl_das_satit.php';
include '../connect/mysql_borrow.php';
?>

<!-- การ์ดแสดงตาราง -->
<div class="card shadow-sm mt-5">
    <div class="card-header" style="background-color:#537bb7; color: white; padding-top: 10px; padding-bottom: 10px;">
        <h4 class="mb-0" style="font-size: 22px;">รายชื่อเจ้าหน้าที่</h4>
    </div>

    <div class="card-body">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <!-- เลือกประเภทอุปกรณ์ -->
        <div class="me-3">
            <select id="equipmentType" class="form-select" style="width: 220px; font-size: 14px;">
                <option value="" selected disabled>กรุณาเลือกฝ่าย</option>
                <option value="">ทั้งหมด</option>
                <option value="ฝ่ายวิชาการคอมพิวเตอร์">ฝ่ายวิชาการคอมพิวเตอร์</option>
                <option value="ฝ่ายวิชาการวิทยาศาสตร์">ฝ่ายวิชาการวิทยาศาสตร์</option>
                <option value="ฝ่ายดนตรี">ฝ่ายดนตรี</option>
                <option value="ฝ่ายพัสดุ">ฝ่ายพัสดุ</option>
                <option value="แอดมิน">แอดมิน</option>
            </select>
        </div>

        <!-- ปุ่มเพิ่มอุปกรณ์ -->
        <div class="ms-3">
            <button class="btn" style="box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); background-color: #4CAF50; border-radius: 5px; padding: 9px 15px; font-size: 14px; border-color: #4CAF50; color: white;"
                onmouseover="this.style.transform='scale(1.05)'; this.style.boxShadow='0 4px 12px rgba(0, 0, 0, 0.15)';"
                onmouseout="this.style.transform='scale(1)'; this.style.boxShadow='none';"
                onclick="window.location.href='adminstaff_details.php';">
                <i class="bi bi-person-plus"></i> เพิ่มรายชื่อเจ้าหน้าที่
            </button>
        </div>
    </div>

    <!-- กล่องค้นหาพร้อมปุ่ม -->
    <div class="input-group mb-3">
        <input type="text" id="searchEquipment" class="form-control" placeholder="ค้นหารายชื่อเจ้าหน้าที่"
            aria-label="Search" aria-describedby="button-search" style="font-size: 14px; padding: 9px 12px;">
        <button class="btn text-light" type="button" id="button-search"
            style="background-color: #537bb7; border-color: #537bb7; font-size: 14px; padding: 9px 12px;">
            ค้นหา
        </button>
    </div>

    <table class="table table-bordered table-striped text-center" style="font-size: 14px;">
        <thead class="table-light">
            <tr>
                <th>ลำดับ</th>
                <th>ชื่อ-นามสกุล</th>
                <th>เจ้าหน้าที่ฝ่าย</th>
                <th>แก้ไข</th>
                <th>ลบ</th>
            </tr>
        </thead>
        <tbody id="officerTable">
        <?php
        $i = 1;  // เริ่มจาก 1
        $sq_officer = "SELECT * FROM das_satit.das_admin 
                    INNER JOIN borrow.officer_staff ON das_admin.useripass = officer_staff.useripass";
        $result = $conn->query($sq_officer);

        if ($result->num_rows > 0) {
            // output data of each row
            while ($rowofficer = $result->fetch_assoc()) {
                $officer_right = htmlspecialchars($rowofficer['officer_Right']);
                $officer_id = urlencode($rowofficer['officerl_Id']);
        ?>
        <tr class="officerRow" 
            data-name="<?php echo htmlspecialchars($rowofficer['praname'] . $rowofficer['name'] . ' ' . $rowofficer['surname']); ?>" 
            data-department="<?php echo htmlspecialchars($rowofficer['officer_Right']); ?>">
            <td><?php echo $i; ?></td>
            <td><?php echo $rowofficer['praname'] . $rowofficer['name'] . " " . $rowofficer['surname']; ?></td>
            <td><?php echo $officer_right; ?></td>
            <td>
                <a href="adminstaff_details_edit.php?officerl_Id=<?php echo $officer_id; ?>" class="btn btn-warning">
                    <i class="fas fa-edit"></i>
                </a>
            </td>
            <td>
                <a href="../connect/officer/delete.php?officerl_Id=<?php echo $officer_id; ?>" class="btn btn-danger">
                    <i class="fas fa-trash-alt"></i>
                </a>
            </td>
        </tr>
        <?php
        $i++;  // เพิ่มค่าของ $i ทีละ 1 ทุกครั้งที่แสดงผล
            }
        }
        ?>
        </tbody>
    </table>
</div>

<script>
    // ฟังก์ชันการค้นหาผ่านชื่อเจ้าหน้าที่และกรองตามฝ่าย
    document.getElementById('searchEquipment').addEventListener('input', filterRows);
    document.getElementById('equipmentType').addEventListener('change', filterRows);

    function filterRows() {
        let searchValue = document.getElementById('searchEquipment').value.toLowerCase().trim();
        let selectedDepartment = document.getElementById('equipmentType').value.toLowerCase().trim();
        let rows = document.querySelectorAll('.officerRow');

        rows.forEach(function (row) {
            let name = row.getAttribute('data-name').toLowerCase().trim();
            let department = row.getAttribute('data-department').toLowerCase().trim();

            if (
                (searchValue === "" || name.includes(searchValue)) &&
                (selectedDepartment === "" || department.includes(selectedDepartment))
            ) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }
</script>


</div>


    </div>



    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>


</body>

</html>