<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>หน้าแรก</title>
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body class="d-flex flex-column min-vh-100">
    <?php

    include 'sidebar.php';
    include "../connect/mysql_borrow.php";
    $officerRight = isset($_SESSION['officer_Right']) ? $_SESSION['officer_Right'] : 0;
    $searchQuery = isset($_POST['search']) ? $_POST['search'] : '';



    $sql = "SELECT di.device_Id, di.device_Name, di.device_Image, di.device_Access, 
       COALESCE(hb.device_Con, 0) AS device_Con, hb.hreturn_Status
FROM satit_borrow.device_information di
LEFT JOIN (
    SELECT device_Id, MAX(htime_Return) AS latest_return, device_Con, hreturn_Status
    FROM satit_borrow.history_brs
    GROUP BY device_Id
) hb ON di.device_Id = hb.device_Id
WHERE 1
";



    if ($searchQuery != '') {
        $sql .= " AND di.device_Name LIKE '%" . $conn->real_escape_string($searchQuery) . "%'";
    }

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $equipment = [];
        while ($row = $result->fetch_assoc()) {
            $equipment[] = [
                'id' => $row['device_Id'],
                'name' => $row['device_Name'],
                'image' => '../connect/equipment/equipment/img/' . $row['device_Image'],
                'device_Access' => $row['device_Access'],
                'device_Con' => $row['device_Con'], // สถานะว่าง/ไม่ว่าง
                'hreturn_Status' => $row['hreturn_Status'] // Add this line
            ];

        }
    } else {
        $equipment = [];
    }

    ?>

    <div class="col-md-9 col-lg-10 mb-5">
        <div class="p-3 bg-light border rounded shadow-sm">
            <h4>Search</h4>
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
                    <?php if (empty($searchQuery)): ?>
                        <h5 class="card-title"
                            style="font-size: 20px; font-weight: bold; color: #007468; text-transform: uppercase;">
                            อุปกรณ์ทั้งหมด
                        </h5>
                    <?php endif; ?>
                </div>
            </div>
            <div class="row g-4 mt-5 justify-content-start">
                <?php if (!empty($equipment)): ?>
                    <?php foreach ($equipment as $item): ?>
                        <div class="col-md-3 col-12 equipmentRow" data-name="<?= htmlspecialchars($item['name']); ?>">
                            <div class="card h-100 shadow-sm">
                                <div class="text-center p-3">
                                    <a
                                        href="reservation1yes_com.php?id=<?= $item['id']; ?>&image=<?= $item['image']; ?>&name=<?= urlencode($item['name']); ?>">
                                        <img src="<?= $item['image']; ?>" alt="<?= htmlspecialchars($item['name']); ?> Image"
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
                        ไม่พบอุปกรณ์
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