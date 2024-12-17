
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>อุปกรณ์คอมพิวเตอร์</title>  
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body class="d-flex flex-column min-vh-100">
<?php
    session_start()
?>
<?php  include 'sidebar.php' ?>

        
        <!-- กล่องทางขวา (เนื้อหา) -->
        <div class="col-md-9 col-lg-10 mb-5">
            <div class="p-3 bg-light border rounded shadow-sm">
                <h4>Search</h4>
                <!-- กล่องค้นหา -->
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="ค้นหาอุปกรณ์" aria-label="Search" aria-describedby="button-search">
                    <button class="btn text-light" type="button" id="button-search" style="background-color: #007468; border-color: #007468;">
                        Search
                    </button>
                </div>
                <div class="row">
    
</div>

<?php
// เชื่อมต่อฐานข้อมูล
include "../connect/mysql_borrow.php"; // ไฟล์เชื่อมต่อฐานข้อมูล

// ดึงข้อมูลจากฐานข้อมูล
$sql = "SELECT * FROM borrow.device_information";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $equipment = [];
    while ($row = $result->fetch_assoc()) {
        $equipment[] = [
            'name' => $row['device_Name'], // ชื่ออุปกรณ์ (สมมติว่าคอลัมน์ในฐานข้อมูลชื่อ 'device_name')
            'status' => $row['device_Con'], // สถานะ (สมมติว่าคอลัมน์ในฐานข้อมูลชื่อ 'device_status')
            'image' => '../connect/equipment/equipment/img/' . $row['device_Image'], 
        ];
    }
} else {
    $equipment = []; // ถ้าไม่มีข้อมูล ให้เก็บเป็นอาร์เรย์ว่าง
}
?>

<div class="row g-4 mt-5 justify-content-center">
    <?php if (!empty($equipment)): ?>
        <?php foreach ($equipment as $item): ?>
            <div class="col-md-3 col-12"> <!-- แสดง 4 คอลัมน์ในหน้าจอขนาดกลางขึ้นไป, แสดงเต็มแถวบนมือถือ -->
                <div class="card h-100 shadow-sm d-flex flex-column">
                    <div class="text-center mb-4">
                        <a href="<?= $item['status'] == 1 ? 'reservation1yes_com.php' : 'reservation1no_com.php'; ?>">
                            <img src="<?= $item['image']; ?>" alt="<?= $item['name']; ?> Image" class="img-fluid card-img" style="max-width: 150px;">
                        </a>
                    </div>
                    <div class="card-body d-flex flex-column">
                        <h6 class="card-title mb-auto">ชื่ออุปกรณ์: <?= $item['name']; ?></h6>
                        <p class="card-text">
                            สถานะ: 
                            <span style="color: <?= $item['status'] == 1 ? '#78C756' : '#FF090D'; ?>; font-weight: bold;">
                                <?= $item['status'] == 1 ? 'ว่าง' : 'ไม่ว่าง'; ?>
                            </span>
                        </p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p class="text-center">ไม่มีข้อมูลอุปกรณ์ในขณะนี้</p>
    <?php endif; ?>
</div>



</body>
</html>
