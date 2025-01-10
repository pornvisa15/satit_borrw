<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin การเงิน</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
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
    1 => ["ตั้งค่าการเงินอุปกรณ์คอมพิวเตอร์", "#537bb7"],
    2 => ["ตั้งค่าการเงินอุปกรณ์วิทยาศาสตร์", "#537bb7"],
    3 => ["ตั้งค่าการเงินอุปกรณ์ดนตรี", "#537bb7"],
    4 => ["ตั้งค่าการเงินอุปกรณ์พัสดุ", "#537bb7"],
    5 => ["ตั้งค่าการเงินอุปกรณ์ทั้งหมด", "#537bb7"],
];

$headerText = $headerOptions[$user_department_id][0] ?? "อุปกรณ์";
$bgColor = $headerOptions[$user_department_id][1] ?? "#333333";

// Set search term from GET parameter or default to an empty string
$searchTerm = $_GET['search'] ?? '';
$selectedCottonId = $_GET['cotton_Id'] ?? 0;
?>

<div class="flex-grow-1 p-4">
    
    <?php include 'short.php'; ?>

    <div class="card shadow-sm mt-5">
        <div class="card-header text-white" style="background-color: <?= $bgColor ?>;">
            <h5 class="mb-0"><?= htmlspecialchars($headerText) ?></h5>
        </div>

        <div class="card-body">
       
        <div class="d-flex justify-content-between align-items-center mb-4">
            <?php include 'admin2.php'; ?> 
            <button class="btn text-white" style="background-color: #4CAF50; font-weight: normal; font-size: 14px;" onclick="window.location.href='admin_finance.in.php';">
                <i class="bi bi-person-plus"></i> เพิ่มคิวอาร์โค้ด
            </button>
        </div>

        <form method="GET" action="">
            <div class="input-group mb-3">
                <input type="text" id="searchEquipment" class="form-control" placeholder="ค้นหาชื่ออุปกรณ์" name="search" value="<?= htmlspecialchars($searchTerm) ?>" style="font-size: 14px;">
                <button class="btn text-light" type="submit" style="background-color: #537bb7; font-size: 14px;">ค้นหา</button>
            </div>
        </form>

        <div class="table-responsive mt-3">
            <table class="table table-bordered table-striped text-center" style="font-size: 14px;">
                <thead class="table-light">
                    <tr>
                        <th style="width: 25;">ลำดับ</th>
                        <th>ชื่อ-นามสกุล</th>
                        <th style="width: 25%;">ผู้รับผิดชอบ</th>
                        <th style="width: 25;">คิวอาร์โค้ด</th>
                        <th style="width: 15%;">แก้ไข</th>
                        <th style="width: 15%;">ลบ</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    // SQL query setup
                    $sql = "SELECT * FROM borrow.finance
                            INNER JOIN borrow.cotton 
                            ON finance.cotton_Id = cotton.cotton_Id";

                    // Add conditions
                    $conditions = [];
                    $params = [];

                    if ($user_department_id != 5) {
                        $conditions[] = "finance.cotton_Id = ?";
                        $params[] = $user_department_id;
                    }

                    if ($selectedCottonId > 0) {
                        $conditions[] = "finance.cotton_Id = ?";
                        $params[] = $selectedCottonId;
                    }

                    // Apply conditions to SQL
                    if (!empty($conditions)) {
                        $sql .= " WHERE " . implode(" AND ", $conditions);
                    }

                    // Prepare the statement to prevent SQL Injection
                    $stmt = $conn->prepare($sql);
                    if ($stmt === false) {
                        die("การเตรียมคำสั่ง SQL ล้มเหลว: " . $conn->error);
                    }

                    // Bind parameters
                    if (!empty($params)) {
                        $stmt->bind_param(str_repeat('s', count($params)), ...$params);
                    }

                    $stmt->execute();
                    $result = $stmt->get_result();
                    $i = 1;

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            // Ensure all values are defined
                            $device_Image = isset($row['finance_Image']) ? $row['finance_Image'] : 'default_image.jpg';
                            $cotton_Name = isset($row['cotton_Name']) ? htmlspecialchars($row['cotton_Name']) : 'ไม่ระบุ';
                            
                            // Check officer data
                            $officerName = isset($row['praname']) && isset($row['name']) && isset($row['surname']) 
                                ? htmlspecialchars($row['praname'] . ' ' . $row['name'] . ' ' . $row['surname']) 
                                : 'ไม่มีข้อมูล';
                            $officerDepartment = isset($row['officer_Cotton']) ? htmlspecialchars($row['officer_Cotton']) : 'ไม่มีข้อมูล';
                    
                            // Display row data
                            echo "<tr>
                                    <td>" . htmlspecialchars($i) . "</td>
                                    <td style='text-align: center; vertical-align: middle;'>
                                        <div class='officerRow' data-name='" . $officerName . "' data-department='" . $officerDepartment . "'>
                                            " . $officerName . "
                                        </div>
                                    </td>
                                    <td>" . $cotton_Name . "</td>";
                    
                            // Display image if exists
                            $imagePath = '../connect/finance/finance/img/' . $device_Image;
                            if (!empty($device_Image) && file_exists($imagePath)) {
                                echo "<td><img src='" . htmlspecialchars($imagePath) . "' alt='finance_Image' style='width: 100px; height: 100px; object-fit: cover;'></td>";
                            } else {
                                echo "<td>ไม่มีรูปภาพ</td>";
                            }
                    
                            echo "<td><a href='admin_finance.edit.php?finance_Id=" . urlencode($row['finance_Id']) . "' class='btn btn-warning'><i class='fas fa-edit'></i></a></td>
                                  <td><a href='../connect/finance/delete.php?finance_Id=" . urlencode($row['finance_Id']) . "' class='btn btn-danger'><i class='fas fa-trash-alt'></i></a></td>
                                  </tr>";
                            $i++;
                        }
                    } else {
                        echo "<tr><td colspan='6'>ไม่มีข้อมูล</td></tr>";
                    }
                    
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>

</body>

</html>
