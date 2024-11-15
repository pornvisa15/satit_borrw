<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>admin_home</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<!-- แถบที่1 -->
<nav class="navbar navbar-dark">
    <div class="container-fluid">
        <span class="navbar-brand text-uppercase fw-bold fs-4" style="color: black;">ระบบ ยืม-คืน อุปกรณ์</span>
        <div class="ms-auto">
            <span class="text-lowercase" style="color: black;">แอดมิน</span>
        </div>
    </div>
</nav>
<!-- แถบที่2 เขียว -->
<nav class="navbar navbar-dark" style="background-color: #007468;">
    <div class="container-fluid">
        <ul class="nav col-10 col-lg-auto me-lg-auto mb-3 justify-content-center mb-md-0 text-white fw-bold">
            <li><a href="#" class="nav-link px-2 text-white">หน้าหลัก</a></li>

            <!-- Dropdown menu สำหรับ คลังอุปกรณ์ -->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    คลังอุปกรณ์
                </a>
                <ul class="dropdown-menu text-white fw-bold" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="#">อุปกรณ์คอมพิวเตอร์</a></li>
                    <li><a class="dropdown-item" href="#">อุปกรณ์วิทยาศาสตร์</a></li>
                    <li><a class="dropdown-item" href="#">อุปกรณ์ดนตรี</a></li>
                </ul>
            </li>

            <li><a href="#" class="nav-link px-2 text-white">ข้อมูลเจ้าหน้าที่</a></li>
            <li><a href="#" class="nav-link px-2 text-white">ประวัติการใช้อุปกรณ์</a></li>
            <li><a href="#" class="nav-link px-2 text-white">ออกจากระบบ</a></li>
        </ul>
    </div>
</nav>
<!-- แถบที่3 ขาว -->
<nav class="navbar navbar-dark" style="background-white">
    <div class="container-fluid mb-4">

    </div>
</nav>

<!-- แถบที่4  เทา-->
<nav class="navbar navbar-dark" style="background-color: #f3f3f7;">
    <div class="container-fluid">
        <span class="navbar-brand text-uppercase">Navbar 5</span>
    </div>
</nav>

<!-- Navbar ที่ 6 -->
<nav class="navbar navbar-dark" style="background-color: #007468;">
    <div class="container-fluid">
        <span class="navbar-brand text-uppercase">Navbar 6</span>
    </div>
</nav>





<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>



</html>