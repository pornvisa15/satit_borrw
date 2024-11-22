
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

<!-- รูปภาพ with overlay text aligned to the left and moved slightly to the right -->
<div class="position-relative">
    <img src="/satit_borrw/img/3.jpg" alt="Image not found" class="img-fluid w-100 h-100 object-fit-cover">
    <div class="position-absolute top-50 start-0 translate-middle-y text-light" style="font-size: 1.5rem; font-weight: bold; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5); padding-left: 60px;">
        ระบบ ยืม-คืน อุปกรณ์
    </div>
</div>

       
<!-- Grid System for Two Boxes -->
<div class="container-fluid mt-4 ms-0 flex-grow-1">
    <div class="row">
        <!-- กล่องทางซ้าย (เมนู) -->
        <div class="col-md-3 col-lg-2">
            <div class="p-3 border rounded shadow-sm" style="background-color: #007468; color: #ffffff;">
                <!-- ชื่อและไอคอนคน -->
                <div class="d-flex align-items-center mb-3 p-2 bg-white rounded shadow-sm">
                    <i class="bi bi-person-circle" style="font-size: 18px; color: #007468;"></i>
                    <span class="ms-2" style="font-size: 14px; color: #007468;">นางสาวพรวิสาข์ ปรีชา</span>
                </div>

                <ul class="nav flex-column mt-3">
                    <li>
                        <a href="#" class="nav-link text-light">สำหรับการยืม</a>
                    </li>

                    <li>
                        <a class="nav-link text-light d-flex align-items-center" data-bs-toggle="collapse" href="#borrowSection" role="button" aria-expanded="false" aria-controls="borrowSection">
                            ประเภท
                            <i class="bi bi-chevron-down ms-2"></i>
                        </a>

                        <div class="collapse" id="borrowSection">
                            <div class="card card-body border-0">
                                <ul class="list-unstyled">
                                    <li><a href="reservation_com.php" class="btn btn-light btn-lg w-100 mb-1 text-start rounded-3 p-2 shadow-sm fs-6 text-success">อุปกรณ์คอมพิวเตอร์</a></li>
                                    <li><a href="reservation_science.php" class="btn btn-light btn-lg w-100 mb-1 text-start rounded-3 p-2 shadow-sm fs-6 text-success">อุปกรณ์วิทยาศาสตร์</a></li>
                                    <li><a href="reservation_music.php" class="btn btn-light btn-lg w-100 mb-1 text-start rounded-3 p-2 shadow-sm fs-6 text-success">อุปกรณ์ดนตรี</a></li>
                                </ul>
                            </div>
                        </div>
                    </li>

               
                    <li><a href="warn.php" class="nav-link text-light">แจ้งเตือน</a></li>
                    <li><a href="record.php" class="nav-link text-light">ประวัติการยืม</a></li>
                    <li><a href="homepages.php" class="nav-link text-light">ออกจากระบบ</a></li>
                </ul>
            </div>
        </div>
        
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
    
</div>


        </div>

    </div>
</div>

<!-- Footer -->
<footer style="background-color: #495057;" class="text-light py-3 mt-4">
    <div class="container text-center">
        <p class="mb-0">&copy; 2024 S.TSU Application V 2.0 | พัฒนาโดย ทีมงาน S.TSU</p>
    </div>
</footer>



<!-- Bootstrap JS (Optional for interactive components) -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>

<!-- Custom CSS -->
<style>
    /* ทำให้การ์ดมีขนาดเท่ากัน */
.card {
    height: 100%;
}

/* กำหนดรูปภาพให้มีขนาดคงที่ */
.card img {
    max-height: 150px;
    object-fit: cover;
}

    /* เปลี่ยนสีเมนูเมื่อ hover */
    .nav-link:hover {
        background-color: #005a3d; /* สีเข้มขึ้นเมื่อ hover */
        color: white;
        border-radius: 4px;
    }

    /* เปลี่ยนสีเมนูเมื่อ active */
    .nav-link.active {
        background-color: #00452c; /* สีเข้มสุดเมื่อคลิก */
        color: white;
        border-radius: 4px;
    }

    /* เพิ่มเงาให้เมนู */
    .nav-link, .btn {
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    /* ปรับรูปแบบของเมนูให้ดูทันสมัย */
    .nav-link, .btn {
        border-radius: 5px;
    }

    /* เพิ่มระยะห่างระหว่างเมนู */
    .nav-link {
        margin-bottom: 8px;
    }
</style>

</body>
</html>
