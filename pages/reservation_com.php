<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>อุปกรณ์คอมพิวเตอร์</title>
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body class="d-flex flex-column min-vh-100">

    <?php

    include 'sidebar.php';
    include "../connect/mysql_borrow.php";

    $officerRight = isset($_SESSION['officer_Right']) ? $_SESSION['officer_Right'] : 0; // ค่าเริ่มต้นเป็น 0 ถ้าไม่มีการตั้งค่า
    $searchQuery = isset($_POST['search']) ? $_POST['search'] : '';
    $sql = "SELECT di.device_Id, di.device_Name, di.device_Image, di.device_Access, hb.hreturn_Status, 
    COALESCE(hb.device_Con, 'ไม่มีข้อมูล') AS device_Con
    FROM satit_borrow.device_information di
    LEFT JOIN satit_borrow.history_brs hb ON di.device_Id = hb.device_Id
    WHERE di.officer_Cotton = 1";  // เงื่อนไขพื้นฐาน
    
    // ตรวจสอบสิทธิ์ของเจ้าหน้าที่และเพิ่มเงื่อนไขที่เกี่ยวข้อง
    if ($officerRight == 1) {
        $sql .= " AND di.device_Access = 1";
    } elseif ($officerRight == 2) {
        $sql .= " AND (di.device_Access = 1 OR di.device_Access = 2)";
    }

    // เพิ่มเงื่อนไขการค้นหาหากมีการค้นหา
    if ($searchQuery != '') {
        $sql .= " AND di.device_Name LIKE '%" . $conn->real_escape_string($searchQuery) . "%'";
    }

    // เลือกตัวล่าสุดจากแต่ละ device_Id โดยใช้ GROUP BY และ MAX
    $sql .= " GROUP BY di.device_Id ORDER BY MAX(di.device_Id) DESC";  // เลือกข้อมูลล่าสุดของแต่ละ device_Id
    

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $equipment = [];
        while ($row = $result->fetch_assoc()) {
            $equipment[] = [
                'id' => $row['device_Id'],
                'name' => $row['device_Name'],
                'status' => isset($row['device_Con']) ? $row['device_Con'] : 'ไม่มีข้อมูล',
                'image' => '../connect/equipment/equipment/img/' . $row['device_Image'],
                'device_Access' => $row['device_Access'], // เพิ่มข้อมูล device_Access
                'hreturn_Status' => $row['hreturn_Status'],
            ];
        }
    } else {
        $equipment = [];
    }

    ?>



    <div class="col-md-9 col-lg-10 mb-5">
        <div class="p-3 bg-light border rounded shadow-sm">
            <h4>Search</h4>
            <!-- กล่องค้นหา -->
            <form method="POST" action="">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" id="searchEquipment" name="search"
                        value="<?= htmlspecialchars($searchQuery); ?>" placeholder="ค้นหาอุปกรณ์" aria-label="Search"
                        aria-describedby="button-search">
                    <button class="btn text-light" type="submit" id="button-search"
                        style="background-color: #007468; border-color: #007468;">
                        ค้นหา
                    </button>
                </div>
            </form>

            <div class="row">
                <div class="col-12 text-center mt-3">
                    <?php if (empty($searchQuery)): // แสดงข้อความ "อุปกรณ์คอมพิวเตอร์" เฉพาะเมื่อไม่มีการค้นหา ?>
                        <h5 class="card-title"
                            style="font-size: 20px; font-weight: bold; color: #007468; text-transform: uppercase;">
                            อุปกรณ์คอมพิวเตอร์
                        </h5>
                    <?php endif; ?>
                </div>
            </div>

            <!-- แสดงผลอุปกรณ์ -->
            <div class="row g-4 mt-5 justify-content-start">
                <?php
                if (!empty($equipment)):
                    foreach ($equipment as $item): ?>
                        <div class="col-md-3 col-12 equipmentRow" data-name="<?= $item['name']; ?>"
                            data-department="<?= $item['status']; ?>">
                            <div class="card h-100 shadow-sm">
                                <div class="text-center p-3">
                                    <a
                                        href="reservation1yes_com.php?id=<?= $item['id']; ?>&status=<?= $item['status']; ?>&image=<?= $item['image']; ?>&name=<?= urlencode($item['name']); ?>">
                                        <img src="<?= $item['image']; ?>" alt="<?= $item['name']; ?> Image"
                                            class="img-fluid rounded"
                                            style="transition: transform 0.3s ease; height: 150px; object-fit: cover; cursor: pointer;"
                                            onmouseover="this.style.transform='scale(1.2)';"
                                            onmouseout="this.style.transform='scale(1)';">
                                    </a>
                                </div>
                                <div class="card-body text-center">
                                    <h6 class="card-title mb-3"><?= $item['name']; ?></h6>
                                    <p class="card-text mb-0">
                                        สถานะ:
                                        <span class="fw-bold"
                                            style="color:  <?= ($item['hreturn_Status'] == '7') ? '#e63946' : '#6cbf42'; ?>;">
                                            <?= ($item['hreturn_Status'] == '7') ? 'ไม่ว่าง' : 'ว่าง'; ?>
                                        </span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p class="text-center text-danger" style="font-size: 16px; font-weight: bold; margin-top: -10px;">
                        ไม่พบอุปกรณ์คอมพิวเตอร์
                    </p>
                <?php endif; ?>
            </div>

        </div>
        <br> <br> <br> <br> <br> <br> <br><br> <br>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-zZ1AI1RrP2aSxvrA8mpzVUr3js6qTgnsC8RUV6hxX7t8hzl0TjtRktGhAKGwd5nL"
        crossorigin="anonymous"></script>
</body>
<footer style="background-color: #495057;" class="text-light py-3 mt-4">
    <div class="container text-center">
        <p class="mb-0">&copy; 2024 S.TSU Application V 2.0 | พัฒนาโดย ทีมงาน S.TSU</p>
    </div>
</footer>

</html>