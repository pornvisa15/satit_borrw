
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

                    <li><a href="#" class="nav-link text-light">แจ้งเตือน</a></li>
                    <li><a href="#" class="nav-link text-light">ประวัติการยืม</a></li>
                    <li><a href="#" class="nav-link text-light">ออกจากระบบ</a></li>
                </ul>
            </div>
        </div>
        
        <!-- กล่องทางขวา (เนื้อหา) -->
        <div class="col-md-9 col-lg-10">
            <div class="p-3 bg-light border rounded shadow-sm">
            <div class="row">
                <div class="col-2 text-end mt-3">
                <h5 class="card-title" 
            
    style="font-size: 18px; font-weight: bold; text-transform: uppercase; color: #007468;"onmouseover="this.style.color='#006043';" onmouseout="this.style.color='#007468';"> อุปกรณ์คอมพิวเตอร์
</h5>
               
</div>

<div class="d-flex justify-content-center mt-5">
    <div class="p-5 bg-light border rounded shadow-sm" style="max-width: 800px; width: 100%;">
        <div class="d-flex align-items-center">
            <!-- Larger Rectangular Image on the left -->
            <img src="/satit_borrw/img/6.jpg" class="img-fluid me-3" alt="Image Placeholder" style="max-width: 250px; height: auto;">

            <!-- Content on the right -->
            <div class="ms-auto">
                <h5 class="mb-2 text-dark" style="font-size: 1.1rem;">ชื่ออุปกรณ์: เมาส์</h5>
                <div class="mb-2">
                    <p class="mb-1 text-muted" style="font-size: 0.9rem;"><strong>เลขพัสดุ/ครุภัณฑ์:</strong> M0001234</p>
                    <p class="mb-1 text-muted" style="font-size: 0.9rem;"><strong>รายละเอียด:</strong> หน้าจอแสดงผลขนาด 16.0" ระดับ FHD IPS WUXGA
                    หน่วยประมวลผล Intel Core i3-1215U Processor หน่วยประมวลผลกราฟิก Intel UHD Graphics (Integrated)</p>
                    <p class="mb-1 text-muted" style="font-size: 0.9rem;"><strong>เจ้าของอุปกรณ์:</strong> นางสาวพรวิสาข์ ปรีชา</p>
                    <p class="mb-1 text-muted" style="font-size: 0.9rem;">
                    <strong>สถานะการใช้งาน:</strong> <span style="color: red;">ไม่ว่าง</span>
                    </p>
                </div>
                <!-- Button for booking -->
                <div class="text-end">
                    <!-- Link to another page when the button is clicked -->
                    <a href="reservation1_book_com.php">
                        <button class="btn btn-sm" style="background-color: #FFC721; color: white;">จอง</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>




<div class="p-5 bg-white border rounded shadow-sm mt-5 mx-auto" style="max-width: 800px;">
    <!-- Title Section -->
    <h5 class="text-center mb-4 text-white p-2" style="background-color: #007468; border-radius: 4px;">ประวัติการยืม</h5>

    <!-- Table Section -->
    <table class="table table-hover table-bordered">
        <thead class="text-white" style="background-color: #007468; font-size: 0.85rem;">
            <tr>
               
                <th scope="col">ผู้ยืม</th>
                <th scope="col">วันที่ยืม</th>
                <th scope="col">วันที่คืน</th>
                <th scope="col">เวลาคืน</th>
            </tr>
        </thead>
        <tbody style="font-size: 0.8rem;">
            <tr>
                
                <td>นางสาวพรวิสาข์ ปรีชา</td>
                <td>2024-11-18</td>
                <td>2024-11-25</td>
                <td>15:30</td>
            </tr>
            <tr>
                
                <td>นายอภิชาติ จิตรานนท์</td>
                <td>2024-11-10</td>
                <td>2024-11-15</td>
                <td>14:45</td>
            </tr>
            <tr>
                
                <td>นางสาวจุฬาภรณ์ สุขกิจ</td>
                <td>2024-11-05</td>
                <td>2024-11-12</td>
                <td>09:00</td>
            </tr>
        </tbody>
    </table>
</div>










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
