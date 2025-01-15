<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin</title>
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="d-flex bg-light">
    <?php
    session_start();
    include 'sidebar.php'; // Include Sidebar
    include '../connect/myspl_das_satit.php';
    include '../connect/mysql_studentsatit.php';
    include '../connect/mysql_borrow.php';

    // Retrieve session value
    $user_department_id = $_SESSION['officer_Cotton'] ?? 0;

    // Header configuration based on department
    $headerOptions = [
        1 => ["รายการอุปกรณ์คอมพิวเตอร์", "#537bb7"],
        2 => ["รายการอุปกรณ์วิทยาศาสตร์", "#537bb7"],
        3 => ["รายการอุปกรณ์ดนตรี", "#537bb7"],
        4 => ["รายการอุปกรณ์พัสดุ", "#537bb7"],
        5 => ["รายการอุปกรณ์ทั้งหมด", "#537bb7"],
    ];

    $headerText = $headerOptions[$user_department_id][0] ?? "อุปกรณ์";
    $bgColor = $headerOptions[$user_department_id][1] ?? "#333333";

    // Filter cottonId if set
    $cottonFilter = isset($_GET['cottonId']) ? $_GET['cottonId'] : '';
    ?>
    <div class="flex-grow-1 p-4">

        <?php include 'short.php'; ?>

        <div class="card shadow-sm mt-5">
            <div class="card-header text-white" style="background-color: <?= $bgColor ?>;">
                <h5 class="mb-0"><?= htmlspecialchars($headerText) ?></h5>
            </div>

            <div class="card-body">

                <!-- Dropdown to select department -->
                <div class="d-flex justify-content-between" style="gap: 20px; margin-top: 15px;">
                    <!-- Dropdown for Selecting Department -->

                    <?php include 'admin1.php'; ?>
                    <!-- Dropdown for Selecting Status -->
                    <form method="get" action="" style="flex: 1;">
                        <select id="equipmentType" name="status_Name" class="form-select" style="font-size: 14px;"
                            onchange="this.form.submit()">
                            <option value="" <?= (!isset($_GET['status_Name']) || $_GET['status_Name'] === '') ? 'selected' : '' ?> disabled>กรุณาเลือกสถานะ</option>
                            <option value="0" <?= (isset($_GET['status_Name']) && $_GET['status_Name'] == '0') ? 'selected' : '' ?>>ทั้งหมด</option>
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
                    </form>
                </div>




                </form>
                <div class="input-group mb-3" style="margin-top: 15px; margin-left: 1px; margin-right: 5px;">
                    <input type="text" id="searchEquipment" class="form-control" placeholder="ค้นหารายชื่ออุปกรณ์"
                        aria-label="Search" aria-describedby="button-search"
                        style="font-size: 14px; padding: 9px 12px;">
                    <button class="btn text-light" type="button" id="button-search"
                        style="background-color: #537bb7; border-color: #537bb7; font-size: 14px; padding: 9px 12px;">
                        ค้นหา
                    </button>
                </div>



                <!-- Display equipment based on selection -->
                <div id="equipmentList" style="margin-top: 20px; font-size: 14px;">
                    <!-- Equipment names will be dynamically added here -->
                </div>

                </tbody>

                <table class="table table-bordered table-striped text-center table-responsive" style="font-size: 14px;">
                    <thead class="table-light">
                        <tr>
                            <th style="width: 5%;">ลำดับ</th>
                            <th style="width: 12%;">เลขพัสดุ/ครุภัณฑ์</th>
                            <th style="width: 11%;">ชื่ออุปกรณ์</th>
                            <th style="width: 9%;">วันที่ยืม</th>
                            <th style="width: 9%;">วันที่คืน</th>
                            <th style="width:15%;">ผู้ยืม</th>
                            <th style="width: 5%;">สถานะ</th>
                            <th style="width: 23%;">หมายเหตุ</th>
                            <th style="width: 20%;">รายละเอียด</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $showAll = isset($_GET['show_all']) ? true : false;
                        $cottonId = isset($_GET['cottonId']) ? $_GET['cottonId'] : '';
                        // เริ่มต้น query ด้วย WHERE 1=1 เพื่อรองรับเงื่อนไขกรอง
                        $sql = "SELECT * FROM borrow.history_brs WHERE 1=1";

                        if ($user_department_id != 5) {
                            $sql .= " AND history_brs.cotton_Id = $user_department_id";
                        } elseif ($cottonFilter > 0) {
                            $sql .= " AND history_brs.cotton_Id = $cottonFilter";
                        } else {

                        }

                        // กรองตาม cottonFilter หรือ user_department_id
// หากมี cottonFilter ให้กรองตาม cotton_Id
// if (!empty($cottonFilter)) {
//     $sql .= " AND cotton_Id = ?";
// } 
// // ถ้าไม่มี cottonFilter ให้ใช้ user_department_id
// else {
//     $sql .= "";
// }
                        
                        // เตรียม query
// $stmt = $conn->prepare($sql);
// $showAll = isset($_GET['show_all']) ? true : false;
// // ผูกค่าตัวแปร cottonFilter หรือ user_department_id
// if (!empty($cottonFilter)) {
//     // ถ้ามี cottonFilter
//     $stmt->bind_param("i", $cottonFilter);
// } 
// // ถ้าไม่มี cottonFilter ใช้ user_department_id
// else {
//     if($user_department_id != 5){
//         $stmt->bind_param("i", $user_department_id);
//     }
                        
                        // }
                        
                        // ผูกค่าตัวแปรสถานะ (ถ้ามี)
// if (isset($status)) {
//     // ถ้ามีการเลือกสถานะ
//     $stmt->bind_param("s", $status);
// }
                        
                        // $stmt->execute();
// $result = $stmt->get_result();
                        
                        $result = $conn->query($sql);

                        // แสดงผลข้อมูล
                        $i = 1;
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>{$i}</td>"; // ลำดับ
                                echo "<td>" . htmlspecialchars($row['parcel_Numder']) . "</td>"; // เลขพัสดุ/ครุภัณฑ์
                                echo "<td>" . htmlspecialchars($row['history_device']) . "</td>"; // ชื่ออุปกรณ์
                        
                                // แปลงวันที่ยืม
                                $borrowDate = new DateTime($row['history_Borrow']);
                                $formattedBorrowDate = $borrowDate->format('d/m/Y');

                                // แปลงวันที่คืน
                                $returnDate = new DateTime($row['history_Return']);
                                $formattedReturnDate = $returnDate->format('d/m/Y');

                                echo "<td>" . htmlspecialchars($formattedBorrowDate) . "</td>";
                                echo "<td>" . htmlspecialchars($formattedReturnDate) . "</td>";
                                echo "<td>" . htmlspecialchars($row['user_Id']) . "</td>"; // ผู้ยืม
                                echo "<td><span class='badge bg-warning text-dark' style='border-radius: 12px; padding: 5px 10px;'>" . htmlspecialchars($row['history_device']) . "</span></td>";
                                echo "<td>" . htmlspecialchars($row['history_Other']) . "</td>";
                                echo "<td><a href='adminhome_details.php?id=" . urlencode($row['history_Id']) . "' class='btn btn-sm' style='background-color: #4fb05a; color: white; border-radius: 8px;'>รายละเอียด</a></td>";
                                echo "</tr>";
                                $i++;
                            }
                        } else {
                            echo "<tr><td colspan='9'>ไม่พบข้อมูล</td></tr>";
                        }
                        ?>





                    </tbody>
                </table>

            </div>
        </div>

    </div>
    </div>
    </div>
    <script>
        // Search function for table data
        document.getElementById('searchEquipment').addEventListener('keyup', function () {
            let searchValue = this.value.toLowerCase();
            let rows = document.querySelectorAll('table tbody tr');
            rows.forEach(function (row) {
                let text = row.innerText.toLowerCase();
                row.style.display = text.includes(searchValue) ? '' : 'none';
            });
        });

        // Filter function based on cotton filter dropdown
        document.getElementById('cottonFilter').addEventListener('change', function () {
            let cottonId = this.value;  // Value from cotton filter dropdown
            let url = window.location.href.split('?')[0]; // Get current URL
            if (cottonId) {
                url += '?cottonId=' + cottonId; // Append cottonId to URL
            }
            window.location.href = url; // Reload page with selected filter
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>


</body>

</html>