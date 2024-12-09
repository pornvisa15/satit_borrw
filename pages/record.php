
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ประวัติการยืม-คืน</title>  
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
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
                        <a href="homepages.php" class="nav-link text-light">สำหรับการยืม</a>
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
                    <li><a href="../logout.php" class="nav-link text-white">ออกจากระบบ</a></li>
                </ul>
            </div>
        </div>
        
        <!-- กล่องทางขวา (เนื้อหา) -->
        <div class="col-md-9 col-lg-10 mb-5">
            <div class="p-3 bg-light border rounded shadow-sm">
               
            <div class="row">
   
</div>

<div class="p-5 bg-white border rounded shadow-sm mt-5 mx-auto" style="max-width: 800px; margin-bottom: 30px;">
    <h1 class="text-center mb-4" style="color: #007468; font-size: 20px; font-weight: bold;">ประวัติการยืม-คืน</h1>

    <ul class="list-group list-group-flush">
        <!-- Example Borrowing History Item -->
        <li class="list-group-item d-flex justify-content-between align-items-center" 
            style="transition: all 0.3s ease; background-color: #f8f9fa; border-radius: 10px;" 
            onmouseover="this.style.backgroundColor='#e9f7ef'; this.style.transform='scale(1.02)';" 
            onmouseout="this.style.backgroundColor='#f8f9fa'; this.style.transform='scale(1)';">
            <div>
                <span class="fw-bold" style="font-size: 14px; color: #007468;">โน๊ตบุ๊ค </span>
                <div style="font-size: 12px; color: #6c757d;">วันที่ยืม 10 พ.ย. 67 - วันที่ 15 พ.ย. 67</div>
                <div style="font-size: 12px; color: #6c757d;">สถานะ: คืนแล้ว</div>
                <!-- เพิ่มจำนวนครั้งที่ยืม -->
                <div style="font-size: 12px; color: #6c757d;">ยืมไปแล้ว 3 ครั้ง</div>
            </div>
            <span class="badge bg-success d-flex align-items-center" 
                style="transition: background-color 0.3s ease; background-color: #198754; font-size: 12px;" 
                onmouseover="this.style.backgroundColor='#28a745';" 
                onmouseout="this.style.backgroundColor='#198754';">
                <i class="bi bi-check-circle-fill me-1"></i> คืนแล้ว
            </span>
        </li>

        <!-- Another Borrowing History Item -->
        <li class="list-group-item d-flex justify-content-between align-items-center" 
            style="transition: all 0.3s ease; background-color: #f8f9fa; border-radius: 10px;" 
            onmouseover="this.style.backgroundColor='#e9f7ef'; this.style.transform='scale(1.02)';" 
            onmouseout="this.style.backgroundColor='#f8f9fa'; this.style.transform='scale(1)';">
            <div>
                <span class="fw-bold" style="font-size: 14px; color: #007468;">บีกเกอร์</span>
                <div style="font-size: 12px; color: #6c757d;">วันที่ยืม 1 พ.ย. 67 - วันที่ 7 พ.ย. 67</div>
                <div style="font-size: 12px; color: #6c757d;">สถานะ: คืนแล้ว</div>
                <!-- เพิ่มจำนวนครั้งที่ยืม -->
                <div style="font-size: 12px; color: #6c757d;">ยืมไปแล้ว 2 ครั้ง</div>
            </div>
            <span class="badge bg-success d-flex align-items-center" 
                style="transition: background-color 0.3s ease; background-color: #198754; font-size: 12px;" 
                onmouseover="this.style.backgroundColor='#28a745';" 
                onmouseout="this.style.backgroundColor='#198754';">
                <i class="bi bi-check-circle-fill me-1"></i> คืนแล้ว
            </span>
        </li>

        <!-- Another Borrowing History Item -->
        <li class="list-group-item d-flex justify-content-between align-items-center" 
            style="transition: all 0.3s ease; background-color: #f8f9fa; border-radius: 10px;" 
            onmouseover="this.style.backgroundColor='#e9f7ef'; this.style.transform='scale(1.02)';" 
            onmouseout="this.style.backgroundColor='#f8f9fa'; this.style.transform='scale(1)';">
            <div>
                <span class="fw-bold" style="font-size: 14px; color: #007468;">กีต้าร์ไฟฟ้า</span>
                <div style="font-size: 12px; color: #6c757d;">วันที่ยืม 10 ต.ค. 67 - วันที่ 12 ต.ค. 67</div>
                <div style="font-size: 12px; color: #6c757d;">สถานะ: คืนแล้ว</div>
                <!-- เพิ่มจำนวนครั้งที่ยืม -->
                <div style="font-size: 12px; color: #6c757d;">ยืมไปแล้ว 5 ครั้ง</div>
            </div>
            <span class="badge bg-success d-flex align-items-center" 
                style="transition: background-color 0.3s ease; background-color: #198754; font-size: 12px;" 
                onmouseover="this.style.backgroundColor='#28a745';" 
                onmouseout="this.style.backgroundColor='#198754';">
                <i class="bi bi-check-circle-fill me-1"></i> คืนแล้ว
            </span>
        </li>

        <!-- Pending Item Example -->
        <li class="list-group-item d-flex justify-content-between align-items-center" 
            style="transition: all 0.3s ease; background-color: #f8f9fa; border-radius: 10px;" 
            onmouseover="this.style.backgroundColor='#e9f7ef'; this.style.transform='scale(1.02)';" 
            onmouseout="this.style.backgroundColor='#f8f9fa'; this.style.transform='scale(1)';">
            <div>
                <span class="fw-bold" style="font-size: 14px; color: #007468;">กลองเล็ก</span>
                <div style="font-size: 12px; color: #6c757d;">วันที่ยืม 16 พ.ย. 67 - วันที่ 20 พ.ย. 67</div>
                <div style="font-size: 12px; color: #6c757d;">สถานะ: กำลังยืม</div>
                <!-- เพิ่มจำนวนครั้งที่ยืม -->
                <div style="font-size: 12px; color: #6c757d;">ยืมไปแล้ว 1 ครั้ง</div>
            </div>
            <span class="badge bg-warning d-flex align-items-center" 
                style="transition: background-color 0.3s ease; background-color: #ffc107; font-size: 12px;" 
                onmouseover="this.style.backgroundColor='#e0a800';" 
                onmouseout="this.style.backgroundColor='#ffc107';">
                <i class="bi bi-exclamation-circle-fill me-1"></i> กำลังยืม
            </span>
        </li>
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
