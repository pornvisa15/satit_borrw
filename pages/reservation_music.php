
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>อุปกรณ์ดนตรี</title>  
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
        <h5 class="card-title">อุปกรณ์ดนตรี</h5>
    </div>
</div>
<div class="row g-4 mt-5 justify-content-center">
    <!-- Computer Equipment Card 1 -->
    <div class="col-3">
        <div class="card h-100 shadow-sm d-flex flex-column">
            <div class="text-center mb-4">
                <!-- คลิกลิงก์ที่รูปภาพ -->
                <a href="#">
                    <img src="/satit_borrw/img/9.jpg" alt="Mouse Image" class="img-fluid card-img" style="max-width: 150px;">
                </a>
            </div>
            <div class="card-body d-flex flex-column">
                <h6 class="card-title mb-auto">ชื่ออุปกรณ์: กลองเล็ก</h6>
                <p class="card-text">
                    สถานะ: <span style="color: #78C756; font-weight: bold;">ว่าง</span>
                </p>
            </div>
        </div>
    </div>

    <!-- Computer Equipment Card 2 -->
    <div class="col-3">
        <div class="card h-100 shadow-sm d-flex flexs-column">
            <div class="text-center mb-4">
                <a href="#">
                    <img src="/satit_borrw/img/8.jpg" alt="Laptop Image" class="img-fluid card-img" style="max-width: 150px;">
                </a>
            </div>
            <div class="card-body d-flex flex-column">
                <h6 class="card-title mb-auto">ชื่ออุปกรณ์ : กีต้าร์ไฟฟ้า</h6>
                <p class="card-text">
                    สถานะ: <span style="color: #FF090D; font-weight: bold;">ไม่ว่าง</span>
                </p>
            </div>
        </div>
    </div>

    <!-- Computer Equipment Card 3 -->
    <div class="col-3">
        <div class="card h-100 shadow-sm d-flex flex-column">
            <div class="text-center mb-4">
                <a href="#">
                    <img src="/satit_borrw/img/9.jpg" alt="Laptop Image" class="img-fluid card-img" style="max-width: 150px;">
                </a>
            </div>
            <div class="card-body d-flex flex-column">
                <h6 class="card-title mb-auto">ชื่ออุปกรณ์ : กลองเล็ก</h6>
                <p class="card-text">
                    สถานะ: <span style="color: #FF090D; font-weight: bold;">ไม่ว่าง</span>
                </p>
            </div>
        </div>
    </div>

    <!-- Computer Equipment Card 4 -->
    <div class="col-3">
        <div class="card h-100 shadow-sm d-flex flex-column">
            <div class="text-center mb-4">
                <a href="#">
                    <img src="/satit_borrw/img/8.jpg" alt="Mouse Image" class="img-fluid card-img" style="max-width: 150px;">
                </a>
            </div>
            <div class="card-body d-flex flex-column">
                <h6 class="card-title mb-auto">ชื่ออุปกรณ์ : กีต้าร์ไฟฟ้า</h6>
                <p class="card-text">
                    สถานะ: <span style="color: #78C756; font-weight: bold;">ว่าง</span>
                </p>
            </div>
        </div>
    </div>
</div>

<div class="row g-4 mt-5 justify-content-center">
    <!-- Computer Equipment Card 1 -->
    <div class="col-3">
        <div class="card h-100 shadow-sm d-flex flex-column">
            <div class="text-center mb-4">
                <!-- คลิกลิงก์ที่รูปภาพ -->
                <a href="reservation1yes_com.php">
                    <img src="/satit_borrw/img/9.jpg" alt="Mouse Image" class="img-fluid card-img" style="max-width: 150px;">
                </a>
            </div>
            <div class="card-body d-flex flex-column">
                <h6 class="card-title mb-auto">ชื่ออุปกรณ์: กลองเล็ก</h6>
                <p class="card-text">
                    สถานะ: <span style="color: #78C756; font-weight: bold;">ว่าง</span>
                </p>
            </div>
        </div>
    </div>

    <!-- Computer Equipment Card 2 -->
    <div class="col-3">
        <div class="card h-100 shadow-sm d-flex flex-column">
            <div class="text-center mb-4">
                <a href="reservation1no_com.php">
                    <img src="/satit_borrw/img/8.jpg" alt="Laptop Image" class="img-fluid card-img" style="max-width: 150px;">
                </a>
            </div>
            <div class="card-body d-flex flex-column">
                <h6 class="card-title mb-auto">ชื่ออุปกรณ์ : กีต้าร์ไฟฟ้า</h6>
                <p class="card-text">
                    สถานะ: <span style="color: #FF090D; font-weight: bold;">ไม่ว่าง</span>
                </p>
            </div>
        </div>
    </div>

    <!-- Computer Equipment Card 3 -->
    <div class="col-3">
        <div class="card h-100 shadow-sm d-flex flex-column">
            <div class="text-center mb-4">
                <a href="#">
                    <img src="/satit_borrw/img/9.jpg" alt="Laptop Image" class="img-fluid card-img" style="max-width: 150px;">
                </a>
            </div>
            <div class="card-body d-flex flex-column">
                <h6 class="card-title mb-auto">ชื่ออุปกรณ์ : กลองเล็ก</h6>
                <p class="card-text">
                    สถานะ: <span style="color: #FF090D; font-weight: bold;">ไม่ว่าง</span>
                </p>
            </div>
        </div>
    </div>

    <!-- Computer Equipment Card 4 -->
    <div class="col-3">
        <div class="card h-100 shadow-sm d-flex flex-column">
            <div class="text-center mb-4">
                <a href="#">
                    <img src="/satit_borrw/img/8.jpg" alt="Mouse Image" class="img-fluid card-img" style="max-width: 150px;">
                </a>
            </div>
            <div class="card-body d-flex flex-column">
                <h6 class="card-title mb-auto">ชื่ออุปกรณ์ : กีต้าร์ไฟฟ้า</h6>
                <p class="card-text">
                    สถานะ: <span style="color: #78C756; font-weight: bold;">ว่าง</span>
                </p>
            </div>
        </div>
    </div>
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
    


<!-- Footer -->
<footer style="background-color: #495057;" class="text-light py-3 mt-4">
    <div class="container text-center">
        <p class="mb-0">&copy; 2024 S.TSU Application V 2.0 | พัฒนาโดย ทีมงาน S.TSU</p>
    </div>
</footer>




</body>
</html>
