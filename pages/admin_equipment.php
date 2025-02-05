<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin คลังอุปกรณ์</title>
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">
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
        1 => ["อุปกรณ์คอมพิวเตอร์", "#537bb7"],
        2 => ["อุปกรณ์วิทยาศาสตร์", "#537bb7"],
        3 => ["อุปกรณ์ดนตรี", "#537bb7"],
        4 => ["อุปกรณ์พัสดุ", "#537bb7"],
        5 => ["อุปกรณ์ทั้งหมด", "#537bb7"],
    ];

    $headerText = $headerOptions[$user_department_id][0] ?? "อุปกรณ์";
    $bgColor = $headerOptions[$user_department_id][1] ?? "#333333";

    // Set search term from GET parameter or default to an empty string
    $searchTerm = $_GET['search'] ?? '';
    $selectedCottonId = $_GET['officer_Cotton'] ?? 0;
    ?>

    <div class="flex-grow-1 p-4">

        <?php include 'short.php'; ?>

        <div class="card shadow-sm mt-5">
            <div class="card-header text-white" style="background-color: <?= $bgColor ?>;">
                <h5 class="mb-0"><?= htmlspecialchars($headerText) ?></h5>
            </div>

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <?php include 'admin1.php'; ?>
                    <button class="btn text-white"
                        style="background-color: #4CAF50; font-weight: normal; font-size: 14px;"
                        onclick="window.location.href='admin_equipment_in_com.php';">
                        <i class="bi bi-person-plus"></i> เพิ่มอุปกรณ์
                    </button>
                </div>


                <form method="GET" action="">
                    <div class="input-group mb-3">
                        <input type="text" id="searchEquipment" class="form-control" placeholder="ค้นหา"
                            name="search" value="<?= htmlspecialchars($searchTerm) ?>" style="font-size: 14px;">
                        <button class="btn text-light" type="submit"
                            style="background-color: #537bb7; font-size: 14px;">ค้นหา</button>
                    </div>

                </form>

                <div class="table-responsive mt-3">
                    <table class="table table-bordered table-striped text-center" style="font-size: 14px;">
                        <thead class="table-light">
                            <tr>
                                <th style="width: 1%;">ลำดับ</th>
                                <th style="width: 7%;">เลขพัสดุ/ครุภัณฑ์</th>
                                <th style="width: 7%;">ชื่ออุปกรณ์</th>
                                <th style="width: 6%;">ผู้รับผิดชอบ</th>
                                <th style="width: 8%;">สิทธิ์การเข้าถึง</th>
                                <th style="width: 3%;">วันที่ซื้อ</th>
                                <th style="width: 5%;">ราคา</th>
                                <th style="width: 17%;">รายละเอียด</th>
                                <th style="width: 1%;">แก้ไข</th>
                                <th style="width: 1%;">ลบ</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                           
                            // สร้างคำสั่ง SQL สำหรับดึงข้อมูลจากฐานข้อมูล
$sql = "SELECT * FROM borrow.device_information";

// ตรวจสอบเงื่อนไขสำหรับการกรองข้อมูล
if ($user_department_id != 5) {
    // กรองข้อมูลตาม $user_department_id
    $sql .= " WHERE officer_Cotton = $user_department_id";
} elseif ($selectedCottonId > 0) {
    // กรองข้อมูลตาม $selectedCottonId
    $sql .= " WHERE officer_Cotton = $selectedCottonId";
}

// รันคำสั่ง SQL
$result = $conn->query($sql);

// ตรวจสอบและแสดงผลลัพธ์
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
       
    }
} 

                            // Apply search filter if search term exists
                            if (!empty($searchTerm)) {
                                $searchTerm = $conn->real_escape_string($searchTerm);  // Escape special characters
                                $sql .= " AND (device_Name LIKE '%$searchTerm%' 
        OR device_Numder LIKE '%$searchTerm%' 
        OR cotton_Name LIKE '%$searchTerm%' 
        OR device_Other LIKE '%$searchTerm%')";
                            }

                            // Execute SQL query
                            $result = $conn->query($sql);

                          // ส่วนนี้เป็นเหมือนเดิม
if ($result->num_rows > 0) {
    $i = 1;
    while ($row = $result->fetch_assoc()) {

        // สร้างอาร์เรย์สำหรับแมปค่าของ officer_Cotton
        $departmentNames = [
            1 => "ฝ่ายคอมพิวเตอร์",
            2 => "ฝ่ายวิทยาศาสตร์",
            3 => "ฝ่ายดนตรี",
            4 => "ฝ่ายพัสดุ",
            5 => "ฝ่ายแอดมิน"
        ];

        // แปลงวันที่ยืม
        $borrowDate = new DateTime($row['device_Date']);  // ตรวจสอบว่า device_Date มีค่าเป็นวันที่ที่ถูกต้อง
        $formattedBorrowDate = $borrowDate->format('d/m/Y'); // แปลงวันที่ในรูปแบบ วัน/เดือน/ปี (เช่น 24/12/2024)

        // เริ่มแสดงผลข้อมูล
        echo "<tr>
        <td>{$i}</td>
        <td>" . htmlspecialchars($row['device_Numder']) . "</td>
        <td>" . htmlspecialchars($row['device_Name']) . "</td>
        <td>" . (isset($departmentNames[$row['officer_Cotton']]) 
                  ? $departmentNames[$row['officer_Cotton']] 
                  : "ไม่ทราบข้อมูล") . "</td>
        <td>" . ($row['device_Access'] == 1 ? 'นักเรียนและบุคลากร' : 'บุคลากร') . "</td>
        <td>{$formattedBorrowDate}</td>
        <td>" . (floor($row['device_Price']) == $row['device_Price'] 
                  ? number_format($row['device_Price'], 0) 
                  : number_format($row['device_Price'], 2)) . " บาท</td>
        <td>" . htmlspecialchars($row['device_Other']) . "</td>
        <td><a href='admin_equipment_edit.php?device_Id=" . urlencode($row['device_Id']) . "' class='btn btn-warning'>
                <i class='fas fa-edit'></i>
            </a>
        </td>
        <td>
            <button class='btn btn-danger' onclick='deleteDevice(\"" . urlencode($row['device_Id']) . "\")'>
                <i class='fas fa-trash-alt'></i>
            </button>
        </td>
    </tr>";



        $i++; // เพิ่มลำดับ
    }
} else {
    echo "<tr><td colspan='11'>ไม่มีข้อมูล</td></tr>";
}

                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
function deleteDevice(deviceId) {
    $.ajax({
        url: '../connect/equipment/delete.php', // ระบุ path ของ delete.php ให้ถูกต้อง
        type: 'POST',
        data: { device_Id: deviceId },
        success: function(response) {
            console.log("Response:", response); // Debugging
            if (response.trim() === "success") {
                Swal.fire({
                    icon: 'success',
                    title: 'ลบข้อมูลสำเร็จ',
                    confirmButtonText: 'OK'
                }).then(() => {
                    window.location.reload(); // รีโหลดหน้า
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'เกิดข้อผิดพลาด',
                    text: response
                });
            }
        },
        error: function(xhr, status, error) {
            console.error("AJAX Error:", status, error); // Debugging
            Swal.fire({
                icon: 'error',
                title: 'เกิดข้อผิดพลาด',
                text: 'ไม่สามารถเชื่อมต่อกับเซิร์ฟเวอร์ได้'
            });
        }
    });
}
</script>


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>

</body>

</html>