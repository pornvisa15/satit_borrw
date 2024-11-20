<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" 
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body class="d-flex bg-light">



<div class="d-flex flex-column text-white p-4" style="width: 250px; min-height: 100vh; background-color: #00897b; border-radius: 15px 0 0 15px; margin-left: auto; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);">
    <h3 class="mb-4 text-center" style="background: rgba(0, 0, 0, 0.3); backdrop-filter: blur(5px); color: white; padding: 18px 20px; border-radius: 12px;">
        Admin
    </h3>

    <ul class="nav flex-column">
        <li class="nav-item mb-3">
            <a href="#" class="nav-link text-white" style="background-color: #00796b; border-radius: 8px; padding: 12px 18px; transition: background-color 0.3s, transform 0.3s; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                หน้าหลัก
            </a>
        </li>
        <li class="nav-item dropdown mb-3">
            <a href="#" class="nav-link text-white dropdown-toggle" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false" style="background-color: #00796b; border-radius: 8px; padding: 12px 18px; transition: background-color 0.3s, transform 0.3s; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                คลังอุปกรณ์
            </a>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="background-color: #ffffff; border-radius: 8px;">
                <li><a class="dropdown-item" href="#">อุปกรณ์คอมพิวเตอร์</a></li>
                <li><a class="dropdown-item" href="#">อุปกรณ์วิทยาศาสตร์</a></li>
                <li><a class="dropdown-item" href="#">อุปกรณ์ดนตรี</a></li>
            </ul>
        </li>
        <li class="nav-item mb-3">
            <a href="#" class="nav-link text-white" style="background-color: #00796b; border-radius: 8px; padding: 12px 18px; transition: background-color 0.3s, transform 0.3s; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                ข้อมูลเจ้าหน้าที่
            </a>
        </li>
        <li class="nav-item mb-3">
            <a href="#" class="nav-link text-white" style="background-color: #00796b; border-radius: 8px; padding: 12px 18px; transition: background-color 0.3s, transform 0.3s; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                ประวัติการใช้อุปกรณ์
            </a>
        </li>
        <li class="nav-item mb-3">
            <a href="#" class="nav-link text-white" style="background-color: #00796b; border-radius: 8px; padding: 12px 18px; transition: background-color 0.3s, transform 0.3s; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                ออกจากระบบ
            </a>
        </li>
    </ul>
</div>




<div class="flex-grow-1 p-4">

<div class="d-flex justify-content-end mt-auto">
    <div class="d-flex align-items-center p-3" style="background-color: #ffffff; border-radius: 12px; box-shadow: 0 6px 18px rgba(0, 0, 0, 0.1); border: 1px solid #e0e0e0;">
        <i class="bi bi-shield-lock" style="font-size: 22px; color: #f39c12;"></i>
        <span class="ms-3" style="color: #00897b; font-size: 16px; font-weight: 600; letter-spacing: 0.5px;">แอดมิน: วิลเลี่ยม เชคสเปียร์</span>
    </div>
</div>



<div class="card shadow-sm mt-5">
<div class="card-header" style="background-color: #009688; color: white;">
    <h4 class="mb-0">รายการอุปกรณ์</h4>
</div>



<div class="card-body">
    <table class="table table-bordered table-striped text-center" style="font-size: 14px;">
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
                <td><span class="badge bg-warning text-dark" style="border-radius: 12px; padding: 5px 10px;">รอตรวจสอบ</span></td>
                <td>ยืมคอมพิวเตอร์เพื่อสอบนักเรียนชั้น ม.3/5</td>
                <td><button class="btn btn-sm" style="background-color: #4fb05a; color: white; border-radius: 8px; transition: transform 0.3s, box-shadow 0.3s; padding: 6px 12px; font-size: 13px;" onmouseover="this.style.transform='scale(1.05)'; this.style.boxShadow='0 4px 12px rgba(0, 0, 0, 0.15)'" onmouseout="this.style.transform='scale(1)'; this.style.boxShadow='none'">รายละเอียด</button></td>
            </tr>
            <tr>
                <td>2</td>
                <td>B0000002</td>
                <td>Notebook BBB</td>
                <td>05/11/2024</td>
                <td>08/11/2024</td>
                <td>นางสาวธัญลักษณ์ พลฤทธิ์</td>
                <td><span class="badge bg-success" style="border-radius: 12px; padding: 5px 10px;">อนุมัติ</span></td>
                <td>ยืมคอมพิวเตอร์เพื่อสอนนักเรียนชั้น ม.4/5</td>
                <td><button class="btn btn-sm" style="background-color: #4fb05a; color: white; border-radius: 8px; transition: transform 0.3s, box-shadow 0.3s; padding: 6px 12px; font-size: 13px;" onmouseover="this.style.transform='scale(1.05)'; this.style.boxShadow='0 4px 12px rgba(0, 0, 0, 0.15)'" onmouseout="this.style.transform='scale(1)'; this.style.boxShadow='none'">รายละเอียด</button></td>
            </tr>
            <tr>
                <td>3</td>
                <td>B0000003</td>
                <td>Notebook BBB</td>
                <td>05/11/2024</td>
                <td>08/11/2024</td>
                <td>นางธรรมนารถ เพชรพล</td>
                <td><span class="badge bg-danger" style="border-radius: 12px; padding: 5px 10px;">ไม่อนุมัติ</span></td>
                <td>ยืมคอมพิวเตอร์เพื่อส่งงาน ROV</td>
                <td><button class="btn btn-sm" style="background-color: #4fb05a; color: white; border-radius: 8px; transition: transform 0.3s, box-shadow 0.3s; padding: 6px 12px; font-size: 13px;" onmouseover="this.style.transform='scale(1.05)'; this.style.boxShadow='0 4px 12px rgba(0, 0, 0, 0.15)'" onmouseout="this.style.transform='scale(1)'; this.style.boxShadow='none'">รายละเอียด</button></td>
            </tr>
        </tbody>
    </table>
</div>


</div>

</div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
