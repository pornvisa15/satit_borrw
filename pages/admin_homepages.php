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
    include 'sidebar.php';
    include '../connect/myspl_das_satit.php';
    include '../connect/mysql_studentsatit.php';
    include '../connect/mysql_borrow.php';
    $user_department_id = $_SESSION['officer_Cotton'] ?? 0;
    $headerOptions = [
        1 => ["รายการอุปกรณ์คอมพิวเตอร์", "#537bb7"],
        2 => ["รายการอุปกรณ์วิทยาศาสตร์", "#537bb7"],
        3 => ["รายการอุปกรณ์ดนตรี", "#537bb7"],
        4 => ["รายการอุปกรณ์พัสดุ", "#537bb7"],
        5 => ["รายการอุปกรณ์ทั้งหมด", "#537bb7"],
    ];

    $headerText = $headerOptions[$user_department_id][0] ?? "อุปกรณ์";
    $bgColor = $headerOptions[$user_department_id][1] ?? "#333333";
    $cottonFilter = isset($_GET['cottonId']) ? $_GET['cottonId'] : '';
    ?>
    <div class="flex-grow-1 p-4">
        <?php include 'short.php'; ?>
        <div class="card shadow-sm mt-5">
            <div class="card-header text-white" style="background-color: <?= $bgColor ?>;">
                <h5 class="mb-0"><?= htmlspecialchars($headerText) ?></h5>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-between" style="gap: 20px; margin-top: 15px;">
                    <?php include 'admin1.php'; ?>
                    
                    <div class="mb-3" style="display: inline-flex; justify-content: space-between; width: 100%;">
                    <form method="get" action="" style="flex: 1;">
                    <select id="history_Status_BRS" name="history_Status_BRS" class="form-select" style="width: 180px; font-size: 14px; font-weight: normal;" onchange="this.form.submit()">
                    
        <!-- ตัวเลือกที่ไม่เลือกสถานะ (กรุณาเลือกสถานะ) -->
        <option value="" <?= (!isset($_GET['history_Status_BRS']) || $_GET['history_Status_BRS'] === '') ? 'selected' : '' ?> disabled>กรุณาเลือกสถานะ</option>
        
        <!-- ตัวเลือก "ทั้งหมด" -->
        <option value="" <?= (isset($_GET['history_Status_BRS']) && $_GET['history_Status_BRS'] === '') ? 'selected' : '' ?>>ทั้งหมด</option>
        
        <!-- ตัวเลือกสำหรับสถานะ -->
        <option value="0" <?= (isset($_GET['history_Status_BRS']) && $_GET['history_Status_BRS'] == '0') ? 'selected' : '' ?>>รออนุมัติ</option>
        <option value="1" <?= (isset($_GET['history_Status_BRS']) && $_GET['history_Status_BRS'] == '1') ? 'selected' : '' ?>>อนุมัติ</option>
        <option value="2" <?= (isset($_GET['history_Status_BRS']) && $_GET['history_Status_BRS'] == '2') ? 'selected' : '' ?>>ไม่อนุมัติ</option>
    </select>
</form>

                        </select>
                    </form>
                </div>
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
                <div id="equipmentList" style="margin-top: 20px; font-size: 14px;">
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
                        $officer_Cotton = isset($_GET['officer_Cotton']) ? $_GET['officer_Cotton'] : '';
                        $sql = "SELECT * FROM borrow.history_brs WHERE 1=1 AND history_Status != 2";

                   
                        // Query based on the selected cottonFilter value
                      
                        if (isset($_GET['officer_Cotton']) && $_GET['officer_Cotton'] !== '0') {
                            $cottonFilter = $_GET['officer_Cotton'];
                            $sql .= " AND officer_Cotton = $officer_Cotton";
                        }

// ตรวจสอบค่าจาก $_GET['history_Status_BRS']
if (isset($_GET['history_Status_BRS']) && $_GET['history_Status_BRS'] !== '') {
    $historyStatusBRS = $_GET['history_Status_BRS'];
    // เพิ่มเงื่อนไขในการกรองตามสถานะที่เลือก
    $sql .= " AND history_Status_BRS = $historyStatusBRS";
}


                        if ($user_department_id != 5) {
                            $sql .= " AND history_brs.officer_Cotton = $user_department_id ";
                        } elseif ($cottonFilter > 0) {
                            $sql .= " AND history_brs.officer_Cotton = $cottonFilter";
                        }

                        $result = $conn->query($sql);
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
                        
                                // ใช้ switch กำหนดสถานะ
                                $status = $row['history_Status_BRS'];
                                $statusDetails = match ($status) {
                                    '0' => ['รออนุมัติ', 'bg-warning', 'bi-clock'],   // สีเหลือง พร้อมไอคอนนาฬิกา
                                    '1' => ['อนุมัติ', 'bg-success', 'bi-check-circle'], // สีเขียว พร้อมไอคอนถูก
                                    '2' => ['ไม่อนุมัติ', 'bg-danger', 'bi-x-circle'],  // สีแดง พร้อมไอคอนกากบาท
                                    default => ['ไม่ทราบสถานะ', 'bg-secondary', 'bi-question-circle'], // กรณีไม่ทราบสถานะ
                                };

                                $statusName = $statusDetails[0];
                                $statusColor = $statusDetails[1];
                                $statusIcon = $statusDetails[2];

                                echo "<td><span class='badge $statusColor text-light' style='border-radius: 12px; padding: 5px 10px;'>
                                    <i class='$statusIcon me-1'></i>$statusName</span></td>";

                                // echo "<td><span class='badge bg-warning text-dark' style='border-radius: 12px; padding: 5px 10px;'>{$statusName}</span></td>";
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
        document.getElementById('searchEquipment').addEventListener('keyup', function () {
            let searchValue = this.value.toLowerCase();
            let rows = document.querySelectorAll('table tbody tr');
            rows.forEach(function (row) {
                let text = row.innerText.toLowerCase();
                row.style.display = text.includes(searchValue) ? '' : 'none';
            });
        });
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