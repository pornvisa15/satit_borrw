<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>หน้าแรก</title>  
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>

<!-- รูปภาพ -->
<div>
    <img src="/satit_borrw/img/3.jpg" alt="Image not found" class="img-fluid w-100 h-100 object-fit-cover">
</div>

<!-- Grid System for Two Boxes -->
<div class="container mt-4">
    <div class="row">
        <!-- กล่องทางซ้าย (เมนู) -->
        <div class="col-md-3">
            <!-- ใช้ bg-dark เพื่อทำให้กล่องทางซ้ายมีสีเข้ม และ text-light เพื่อให้ตัวหนังสือมีสีอ่อน -->
            <div class="p-3 bg-dark text-light border rounded">
                <ul class="nav flex-column">
                    <li><a href="#" class="nav-link text-light">สำหรับการยืม</a></li>
                    
                    <!-- เมนูประเภทที่มีหมวดหมู่ย่อย -->
                    
                    
                    <!-- เมนูสำหรับการยืม -->
                    <li>
                        <a class="nav-link text-light" data-bs-toggle="collapse" href="#borrowSection" role="button" aria-expanded="false" aria-controls="borrowSection">
                        ประเภท
                        
                        </a>
                        <div class="collapse" id="borrowSection">
                            <div class="card card-body">
                                <ul>
                                    <li><a href="#" class="text-light">อุปกรณ์คอมพิวเตอร์</a></li>
                                    <li><a href="#" class="text-light">อุปกรณ์วิทยาศาสตร์</a></li>
                                    <li><a href="#" class="text-light">อุปกรณ์ดนตรี</a></li>
                                </ul>
                            </div>
                        </div>
                    </li>

                    <li><a href="#" class="nav-link text-light">ข้อมูลเจ้าหน้าที่</a></li>
                    <li><a href="#" class="nav-link text-light">แจ้งเตือน</a></li>
                    <li><a href="#" class="nav-link text-light">ประวัติการยืม</a></li>
                    <li><a href="#" class="nav-link text-light">ออกจากระบบ</a></li>
                </ul>
            </div>
        </div>

        <!-- กล่องทางขวา (เนื้อหา) -->
        <div class="col-md-9">
            <!-- ใช้ bg-light เพื่อให้กล่องเนื้อหามีสีอ่อน และ text-dark เพื่อให้ข้อความเป็นสีเข้ม -->
            <div class="p-3 bg-light border rounded">
                <!-- เนื้อหาหรือข้อมูลที่คุณต้องการแสดงจะอยู่ที่นี่ -->
                <h3>search</h3>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS (Optional for interactive components) -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>

</body>
</html>
