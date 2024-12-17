
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
    <div class="col-12 text-end mt-5">
        <h5 class="card-title">อุปกรณ์คอมพิวเตอร์</h5>
    </div>
</div>

<?php
// ตัวอย่างข้อมูลอุปกรณ์ที่ดึงมาจากฐานข้อมูล
$equipment = [
    ['name' => 'เมาส์', 'status' => 'ว่าง', 'image' => '/satit_borrw/img/6.jpg'],
    ['name' => 'โน๊ตบุ๊ค', 'status' => 'ไม่ว่าง', 'image' => '/satit_borrw/img/2.jpg'],
    ['name' => 'โน๊ตบุ๊ค', 'status' => 'ไม่ว่าง', 'image' => '/satit_borrw/img/2.jpg'],
    ['name' => 'เมาส์', 'status' => 'ว่าง', 'image' => '/satit_borrw/img/6.jpg'],
];
?>

<div class="row g-4 mt-5 justify-content-center">
    <?php foreach ($equipment as $item): ?>
        <div class="col-3">
            <div class="card h-100 shadow-sm d-flex flex-column">
                <div class="text-center mb-4">
                    <a href="<?= $item['status'] === 'ว่าง' ? 'reservation1yes_com.php' : 'reservation1no_com.php'; ?>">
                        <img src="<?= $item['image']; ?>" alt="<?= $item['name']; ?> Image" class="img-fluid card-img" style="max-width: 150px;">
                    </a>
                </div>
                <div class="card-body d-flex flex-column">
                    <h6 class="card-title mb-auto">ชื่ออุปกรณ์: <?= $item['name']; ?></h6>
                    <p class="card-text">
                        สถานะ: <span style="color: <?= $item['status'] === 'ว่าง' ? '#78C756' : '#FF090D'; ?>; font-weight: bold;"><?= $item['status']; ?></span>
                    </p>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<style>
    /* เพิ่มเอฟเฟกต์เมื่อชี้เมาส์ที่ภาพ */
    .card-img {
        transition: transform 0.3s ease, box-shadow 0.3s ease; /* การเคลื่อนที่และเงา */
    }

    .card-img:hover {
        transform: scale(1.1); /* ขยายภาพขึ้น 10% */
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15); /* เพิ่มเงาเมื่อชี้เมาส์ */
    }
</style>


</div>
    </div>
    
</div>


        </div>

   



</body>
</html>
