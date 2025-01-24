<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ประวัติการยืม-คืน</title>
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body class="d-flex flex-column min-vh-100">

    <?php
    session_start();
    include 'sidebar.php';
    include "../connect/mysql_borrow.php";

    // ตรวจสอบว่า user_Id มีค่าหรือไม่
    $user_id = $_SESSION['user_Id'] ?? null;
    if (!$user_id) {
        die("<p class='text-danger text-center'>กรุณาเข้าสู่ระบบก่อนเข้าถึงหน้านี้</p>");
    }

    // ใช้ Prepared Statement
    $stmt = $conn->prepare(
        "SELECT di.device_Name, hb.history_Borrow, hb.history_Return, hb.history_Status ,hb.user_Id
     FROM history_brs hb
     INNER JOIN device_information di ON hb.device_Id = di.device_Id 
     WHERE hb.user_Id = '$user_id'
     "
    );
    if (!$stmt) {
        die("ข้อผิดพลาดในการเตรียมคำสั่ง SQL: " . $conn->error);
    }


    $stmt->execute();
    $result = $stmt->get_result();

    // ตรวจสอบข้อผิดพลาด
    if (!$result) {
        die("ข้อผิดพลาดในการดึงข้อมูล: " . $stmt->error);
    }
    ?>
    <!-- กล่องทางขวา (เนื้อหา) -->
    <div class="col-md-9 col-lg-10 mb-5">
        <div class="p-3 bg-light border rounded shadow-sm">

            <div class="row">

            </div>

            <div class="p-5 bg-white border rounded shadow-sm mt-5 mx-auto"
                style="max-width: 800px; margin-bottom: 30px;">
                <h1 class="text-center mb-4" style="color: #007468; font-size: 20px; font-weight: bold;">
                    ประวัติการยืม-คืน</h1>

                <ul class="list-group list-group-flush">
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <li class="list-group-item d-flex justify-content-between align-items-center"
                            style="transition: all 0.3s ease; background-color: #f8f9fa; border-radius: 10px;"
                            onmouseover="this.style.backgroundColor='#e9f7ef'; this.style.transform='scale(1.02)';"
                            onmouseout="this.style.backgroundColor='#f8f9fa'; this.style.transform='scale(1)';">
                            <div>

                                <!-- แสดงชื่ออุปกรณ์ -->
                                <span class="fw-bold" style="font-size: 14px; color: #007468;">
                                    <?= htmlspecialchars($row['device_Name']) ?>
                                </span>
                                <!-- แสดงวันที่ยืมและคืน -->
                                <div style="font-size: 12px; color: #6c757d;">
                                    วันที่ยืม <?= htmlspecialchars($row['history_Borrow']) ?> - วันที่
                                    <?= htmlspecialchars($row['history_Return']) ?>
                                </div>
                                <!-- แสดงสถานะการยืม -->
                                <div style="font-size: 12px; color: #6c757d;">
                                    สถานะ:
                                    <?= $row['history_Status'] == '2' ? 'คืนแล้ว' : 'กำลังยืม' ?>
                                </div>
                            </div>
                            <!-- แสดง Badge ตามสถานะ -->
                            <span
                                class="badge <?= $row['history_Status'] == '2' ? 'bg-info' : 'bg-success' ?> d-flex align-items-center"
                                style="transition: background-color 0.3s ease; font-size: 12px;">
                                <i
                                    class="bi <?= $row['history_Status'] == '2' ? 'bi-check-circle-fill' : 'bi-exclamation-circle-fill' ?> me-1"></i>
                                <?= $row['history_Status'] == '2' ? 'คืนแล้ว' : 'กำลังยืม' ?>
                            </span>
                        </li>
                    <?php endwhile; ?>
                </ul>

            </div>


        </div>
    </div>
    </div>




    </div>
</body>

</html>

<!-- Footer -->
<footer style="background-color: #495057;" class="text-light py-3 mt-4">
    <div class="container text-center">
        <p class="mb-0">&copy; 2024 S.TSU Application V 2.0 | พัฒนาโดย ทีมงาน S.TSU</p>
    </div>
</footer>



</body>

</html>