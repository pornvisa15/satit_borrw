<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin</title>
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body class="d-flex bg-light">

    <!-- Sidebar -->
    <div class="d-flex flex-column bg-success text-white p-4"
        style="width: 250px; min-height: 100vh; border-radius: 10px 0 0 10px;">
        <h3 class="mb-4 text-center">Admin</h3>

        <ul class="nav flex-column">
            <li class="nav-item mb-2">
                <a href="#" class="nav-link text-white">หน้าหลัก</a>
            </li>
            <li class="nav-item dropdown mb-2">
                <a href="#" class="nav-link text-white dropdown-toggle" id="dropdownMenuButton"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    คลังอุปกรณ์
                </a>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <li><a class="dropdown-item" href="#">อุปกรณ์คอมพิวเตอร์</a></li>
                    <li><a class="dropdown-item" href="#">อุปกรณ์วิทยาศาสตร์</a></li>
                    <li><a class="dropdown-item" href="#">อุปกรณ์ดนตรี</a></li>
                </ul>
            </li>
            <li class="nav-item mb-2">
                <a href="#" class="nav-link text-white">ข้อมูลเจ้าหน้าที่</a>
            </li>
            <li class="nav-item mb-2">
                <a href="#" class="nav-link text-white">ประวัติการใช้อุปกรณ์</a>
            </li>
            <li class="nav-item mb-2">
                <a href="#" class="nav-link text-white">ออกจากระบบ</a>
            </li>
        </ul>

        <div class="mt-auto">
            <div class="d-flex align-items-center">
                <i class="bi bi-person-circle" style="font-size: 20px;"></i>
                <span class="ms-2">วิลเลี่ยม เชคสเปียร์</span>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="flex-grow-1 p-4">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">รายการอุปกรณ์</h4>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped text-center">
                    <thead class="table-light">
                        <tr>
                            <th>ลำดับ</th>
                            <th>เลขพัสดุ/ครุภัณฑ์</th>
                            <th>ชื่ออุปกรณ์</th>
                            <th>วันที่ยืม</th>
                            <th>วันที่คืน</th>
                            <th>ผู้ยืม</th>
                            <th>สถานะ</th>
                            <th>หมายเหตุ</th>
                            <th>รายละเอียด</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>A0000001</td>
                            <td>Notebook Acer</td>
                            <td>04/11/2024</td>
                            <td>07/11/2024</td>
                            <td>นางสาวพรวิสาข์ ปรีชา</td>
                            <td><span class="badge bg-warning text-dark">รอตรวจสอบ</span></td>
                            <td>ยืมคอมพิวเตอร์เพื่อสอบนักเรียนชั้น ม.3/5</td>
                            <td><button class="btn btn-info btn-sm">รายละเอียด</button></td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>B0000002</td>
                            <td>Notebook BBB</td>
                            <td>05/11/2024</td>
                            <td>08/11/2024</td>
                            <td>นางสาวธัญลักษณ์ พลฤทธิ์</td>
                            <td><span class="badge bg-success">อนุมัติ</span></td>
                            <td>ยืมคอมพิวเตอร์เพื่อสอนนักเรียนชั้น ม.4/5</td>
                            <td><button class="btn btn-info btn-sm">รายละเอียด</button></td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>B0000003</td>
                            <td>Notebook BBB</td>
                            <td>05/11/2024</td>
                            <td>08/11/2024</td>
                            <td>นางธรรมนารถ เพชรพล</td>
                            <td><span class="badge bg-danger">ไม่อนุมัติ</span></td>
                            <td>ยืมคอมพิวเตอร์เพื่อส่งงาน ROV</td>
                            <td><button class="btn btn-info btn-sm">รายละเอียด</button></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>