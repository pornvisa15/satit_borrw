<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin ข้อมูลเจ้าหน้าที่</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>

<body class="d-flex bg-light">
    <?php
        session_start();
        include 'sidebar.php';
        include '../connect/myspl_das_satit.php';
        include '../connect/mysql_borrow.php';
    ?>

    <div class="flex-grow-1 p-4">
        <?php include 'short.php'; ?>

        <!-- การ์ดแสดงตาราง -->
        <div class="card shadow-sm mt-5">
        <div class="card-header" style="background-color:#537bb7; color: white; padding-top: 10px; padding-bottom: 10px;">
    <h5 class="mb-0" style="font-size: 20px;">รายชื่อเจ้าหน้าที่</h5>
</div>


            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <!-- เลือกประเภทอุปกรณ์ -->
                    <div class="me-3">
                        <select id="equipmentType" class="form-select" style="width: 220px; font-size: 14px;" onchange="filterRows()">
                            <option value="" selected disabled>กรุณาเลือกเจ้าหน้าที่ฝ่าย</option>
                            <option value="">ทั้งหมด</option>
                            <option value="1">ฝ่ายคอมพิวเตอร์</option>
                            <option value="2">ฝ่ายวิทยาศาสตร์</option>
                            <option value="3">ฝ่ายดนตรี</option>
                            <option value="4">ฝ่ายพัสดุ</option>
                            <option value="5">แอดมิน</option>
                        </select>
                    </div>

                    <!-- ปุ่มเพิ่มอุปกรณ์ -->
                    <div class="ms-3">
    <button class="btn" style="box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); background-color: #4CAF50; border-radius: 5px; padding: 9px 15px; font-size: 14px; font-weight: normal; border-color: #4CAF50; color: white;" onmouseover="this.style.transform='scale(1.05)'; this.style.boxShadow='0 4px 12px rgba(0, 0, 0, 0.15)';" onmouseout="this.style.transform='scale(1)'; this.style.boxShadow='none';" onclick="window.location.href='adminstaff_details.php';">
        <i class="bi bi-person-plus"></i> เพิ่มรายชื่อเจ้าหน้าที่
    </button>
</div>

                </div>

                <!-- กล่องค้นหาพร้อมปุ่ม -->
                <div class="input-group mb-3">
                    <input type="text" id="searchEquipment" class="form-control" placeholder="ค้นหารายชื่อเจ้าหน้าที่" aria-label="Search" aria-describedby="button-search" style="font-size: 14px; padding: 9px 12px;">
                    <button class="btn text-light" type="button" id="button-search" style="background-color: #537bb7; border-color: #537bb7; font-size: 14px; padding: 9px 12px;">
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
                        $i = 1; // เริ่มจาก 1
                        $sq_officer = "SELECT * FROM das_satit.das_admin 
                            INNER JOIN borrow.officer_staff ON das_admin.useripass = officer_staff.useripass";
                        $result = $conn->query($sq_officer);

                        if ($result->num_rows > 0) {
                            // output data of each row
                            while ($rowofficer = $result->fetch_assoc()) {
                                $officer_right = htmlspecialchars($rowofficer['officer_Right']);
                                $officer_cotton = htmlspecialchars($rowofficer['officer_Cotton']);
                                $officer_id = urlencode($rowofficer['officerl_Id']);
                                ?>
                                <tr class="officerRow"
                                    data-name="<?php echo htmlspecialchars($rowofficer['praname'] . $rowofficer['name'] . ' ' . $rowofficer['surname']); ?>"
                                    data-department="<?php echo htmlspecialchars($rowofficer['officer_Cotton']); ?>">
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo htmlspecialchars($rowofficer['praname'] . $rowofficer['name'] . " " . $rowofficer['surname']); ?></td>
                                   
                                    <td>
                                        <?php
                                        if ($rowofficer['officer_Cotton'] == 1) {
                                            echo "เจ้าหน้าที่ฝ่ายคอมพิวเตอร์";
                                        } else if ($rowofficer['officer_Cotton'] == 2) {
                                            echo "เจ้าหน้าที่ฝ่ายวิทยาศาสตร์";
                                        } else if ($rowofficer['officer_Cotton'] == 3) {
                                            echo "เจ้าหน้าที่ฝ่ายดนตรี";
                                        } else if ($rowofficer['officer_Cotton'] == 4) {
                                            echo "เจ้าหน้าที่ฝ่ายพัสดุ";
                                        } else if ($rowofficer['officer_Cotton'] == 5) {
                                            echo "แอดมิน";
                                        } else {
                                            echo "ไม่ทราบ";
                                        }
                                        ?>
                                    </td> <!-- เจ้าหน้าที่ฝ่าย -->
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
                                $i++; // เพิ่มค่าของ $i ทีละ 1 ทุกครั้งที่แสดงผล
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>

            <script>
                function filterRows() {
                    let searchValue = document.getElementById('searchEquipment').value.toLowerCase().trim();  // รับค่าค้นหาจากช่องค้นหา
                    let selectedDepartment = document.getElementById('equipmentType').value.trim();  // รับค่าจาก dropdown ฝ่าย
                    let rows = document.querySelectorAll('.officerRow');  // เลือกทุกแถวในตารางที่มีคลาส .officerRow

                    rows.forEach(function(row) {
                        let name = row.getAttribute('data-name').toLowerCase().trim();  // ดึงชื่อเจ้าหน้าที่จาก data-name
                        let department = row.getAttribute('data-department').trim();  // ดึงข้อมูลฝ่ายจาก data-department

                        // ตรวจสอบการกรองโดยใช้ค่าค้นหาจากชื่อเจ้าหน้าที่และฝ่าย
                        if (
                            (searchValue === "" || name.includes(searchValue)) &&  // หากไม่มีการค้นหาหรือชื่อเจ้าหน้าที่ตรง
                            (selectedDepartment === "" || department == selectedDepartment)  // หากไม่มีการเลือกฝ่ายหรือฝ่ายตรง
                        ) {
                            row.style.display = '';  // แสดงแถว
                        } else {
                            row.style.display = 'none';  // ซ่อนแถวที่ไม่ตรง
                        }
                    });
                }

                // ฟังก์ชันการค้นหาผ่านชื่อเจ้าหน้าที่และกรองตามฝ่าย
                document.getElementById('searchEquipment').addEventListener('input', filterRows);
                document.getElementById('equipmentType').addEventListener('change', filterRows);
            </script>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
</body>

</html>
