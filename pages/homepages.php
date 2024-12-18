<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>หน้าแรก</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" 
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body class="d-flex flex-column min-vh-100">
<?php
session_start();
include 'sidebar.php';
include "../connect/mysql_borrow.php";

// รับค่าคำค้นหาจากฟอร์ม
$searchQuery = isset($_POST['search']) ? $_POST['search'] : ''; 

// สร้าง SQL query โดยใช้ LIKE เพื่อค้นหาชื่ออุปกรณ์ที่ตรงกับคำค้นหา
$sql = "SELECT * FROM borrow.device_information";
if ($searchQuery != '') {
    $sql .= " WHERE device_Name LIKE '%" . $conn->real_escape_string($searchQuery) . "%'";
}

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $equipment = [];
    while ($row = $result->fetch_assoc()) {
        $equipment[] = [
            'id' => $row['device_Numder'],
            'name' => $row['device_Name'], 
            'status' => $row['device_Con'], 
            'image' => '../connect/equipment/equipment/img/' . $row['device_Image'], 
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
                <input type="text" class="form-control" id="searchEquipment" name="search" value="<?= htmlspecialchars($searchQuery); ?>" placeholder="ค้นหาอุปกรณ์" aria-label="Search" aria-describedby="button-search">
                <button class="btn text-light" type="submit" id="button-search" style="background-color: #007468; border-color: #007468;">
                    ค้นหา
                </button>
            </div>
        </form>
        <div class="row">
    <div class="col-12 text-center mt-3">
        <?php if (empty($searchQuery)): // แสดงข้อความ "อุปกรณ์ทั้งหมด" เฉพาะเมื่อไม่มีการค้นหา ?>
            <h5 class="card-title" 
                style="font-size: 20px; font-weight: bold; color: #007468; text-transform: uppercase;">
                อุปกรณ์ทั้งหมด
            </h5>
        <?php endif; ?>
    </div>
</div>


        <!-- ใช้ justify-content-start แทน justify-content-center -->
        <div class="row g-4 mt-5 justify-content-start">
            <?php 
            if (!empty($searchQuery)) {
                // หากมีการค้นหาอุปกรณ์
                if (!empty($equipment)): ?>
                    <?php foreach ($equipment as $item): ?>
                        <div class="col-md-3 col-12 equipmentRow" data-name="<?= $item['name']; ?>" data-department="<?= $item['status']; ?>">
                            <div class="card h-100 shadow-sm">
                                <div class="text-center p-3">
                                    <a href="reservation1yes_com.php?id=<?= $item['id']; ?>&status=<?= $item['status']; ?>&image=<?= $item['image']; ?>&name=<?= urlencode($item['name']); ?>">
                                        <img src="<?= $item['image']; ?>" alt="<?= $item['name']; ?> Image" class="img-fluid rounded" style="transition: transform 0.3s ease; height: 150px; object-fit: cover; cursor: pointer;" onmouseover="this.style.transform='scale(1.2)';" onmouseout="this.style.transform='scale(1)';">
                                    </a>
                                </div>
                                <div class="card-body text-center">
                                    <h6 class="card-title mb-3"><?= $item['name']; ?></h6>
                                    <p class="card-text mb-0">
                                        สถานะ: 
                                        <span class="fw-bold" style="color: <?= $item['status'] == 1 ? '#78C756' : '#FF090D'; ?>;">
                                            <?= $item['status'] == 1 ? 'ว่าง' : 'ไม่ว่าง'; ?>
                                        </span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p class="text-center text-danger" 
   style="font-size: 16px; font-weight: bold; margin-top: -50px; margin-bottom: 10px;">
    ไม่พบอุปกรณ์
</p>



                <?php endif; ?>
            <?php } else { 
                // หากไม่มีการค้นหา ให้แสดงอุปกรณ์ทั้งหมด
                if (!empty($equipment)): ?>
                    <?php foreach ($equipment as $item): ?>
                        <div class="col-md-3 col-12 equipmentRow" data-name="<?= $item['name']; ?>" data-department="<?= $item['status']; ?>">
                            <div class="card h-100 shadow-sm">
                                <div class="text-center p-3">
                                    <a href="reservation1yes_com.php?id=<?= $item['id']; ?>&status=<?= $item['status']; ?>&image=<?= $item['image']; ?>&name=<?= urlencode($item['name']); ?>">
                                        <img src="<?= $item['image']; ?>" alt="<?= $item['name']; ?> Image" class="img-fluid rounded" style="transition: transform 0.3s ease; height: 150px; object-fit: cover; cursor: pointer;" onmouseover="this.style.transform='scale(1.2)';" onmouseout="this.style.transform='scale(1)';">
                                    </a>
                                </div>
                                <div class="card-body text-center">
                                    <h6 class="card-title mb-3"><?= $item['name']; ?></h6>
                                    <p class="card-text mb-0">
                                        สถานะ: 
                                        <span class="fw-bold" style="color: <?= $item['status'] == 1 ? '#78C756' : '#FF090D'; ?>;">
                                            <?= $item['status'] == 1 ? 'ว่าง' : 'ไม่ว่าง'; ?>
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
            <?php } ?>
        </div>
    </div>
</div>
<!-- Footer -->
<footer style="background-color: #495057;" class="text-light py-3 mt-4">
    <div class="container text-center">
        <p class="mb-0">&copy; 2024 S.TSU Application V 2.0 | พัฒนาโดย ทีมงาน S.TSU</p>
    </div>
</footer>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
            integrity="sha384-zZ1AI1RrP2aSxvrA8mpzVUr3js6qTgnsC8RUV6hxX7t8hzl0TjtRktGhAKGwd5nL" crossorigin="anonymous"></script>
    
    <script>
        // ฟังก์ชันการค้นหาผ่านชื่ออุปกรณ์
        document.getElementById('searchEquipment').addEventListener('input', filterRows);

        function filterRows() {
            let searchValue = document.getElementById('searchEquipment').value.toLowerCase().trim();
            let rows = document.querySelectorAll('.equipmentRow');

            rows.forEach(function (row) {
                let name = row.getAttribute('data-name').toLowerCase().trim();

                if (searchValue === "" || name.includes(searchValue)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }
    </script>
</body>
</html>
