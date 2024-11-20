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

<body style="display: flex; margin: 0; padding: 0; height: 100vh; box-sizing: border-box;">
    <!-- กล่องที่ 1 -->
    <div
        style="flex: 1;background-color:#4fb05a; border: 2px solid #007468; margin-right: 10px; display: flex; flex-direction: column; align-items: center; justify-content: flex-start; border-radius: 10px; padding: 20px;">
        <h3 style="margin-bottom: 40px; text-align: center; text-decoration: none; color: white; font-size: 30px;">Admin
        </h3>

        <ul style="list-style: none; padding: 0; margin: 0; text-align: center; width: 100%;">
            <li style="margin-bottom: 15px;">
                <a href="#"
                    style="border-radius: 10px; text-decoration: none; color: white; padding: 10px 20px; display: block; transition: background-color 0.3s, color 0.3s;"
                    onmouseover="this.style.backgroundColor='#00a695'; this.style.color='white';"
                    onmouseout="this.style.backgroundColor='transparent'; this.style.color='white';">หน้าหลัก</a>
            </li>
            <li style="margin-bottom: 15px;" class="dropdown d-flex justify-content-center">
                <a href="#" class="text-decoration-none text-white dropdown-toggle"
                    style="padding: 10px 20px; display: block; transition: background-color 0.3s, color 0.3s; border-radius: 10px; width: 100%;"
                    id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false"
                    onmouseover="this.style.backgroundColor='#00a695'; this.style.color='white'; this.style.width='100%';"
                    onmouseout="this.style.backgroundColor='transparent'; this.style.color='white'; this.style.width='100%';">
                    คลังอุปกรณ์
                </a>
                <ul class="dropdown-menu text-center" aria-labelledby="dropdownMenuButton"
                    style="border-radius: 10px; width: 100%; text-align: center; padding: 0; border-radius: 10px;">
                    <li><a class="dropdown-item" href="#" style="border-radius: 10px;">อุปกรณ์คอมพิวเตอร์</a></li>
                    <li><a class="dropdown-item" href="#" style="border-radius: 10px;">อุปกรณ์วิทยาศาสตร์</a></li>
                    <li><a class="dropdown-item" href="#" style="border-radius: 10px;">อุปกรณ์ดนตรี</a></li>
                </ul>
            </li>


            <li style="margin-bottom: 15px;">
                <a href="#"
                    style="border-radius: 10px; text-decoration: none; color: white; padding: 10px 20px; display: block; transition: background-color 0.3s, color 0.3s;"
                    onmouseover="this.style.backgroundColor='#00a695'; this.style.color='white';"
                    onmouseout="this.style.backgroundColor='transparent'; this.style.color='white';">ข้อมูลเจ้าหน้าที่</a>
            </li>
            <li style="margin-bottom: 15px;">
                <a href="#"
                    style="border-radius: 10px;text-decoration: none; color: white; padding: 10px 20px; display: block; transition: background-color 0.3s, color 0.3s;"
                    onmouseover="this.style.backgroundColor='#00a695'; this.style.color='white';"
                    onmouseout="this.style.backgroundColor='transparent'; this.style.color='white';">ประวัติการใช้อุปกรณ์</a>
            </li>
            <li style="margin-bottom: 15px;">
                <a href="#"
                    style="border-radius: 10px; text-decoration: none; color: white; padding: 10px 20px; display: block; transition: background-color 0.3s, color 0.3s;"
                    onmouseover="this.style.backgroundColor='#00a695'; this.style.color='white';"
                    onmouseout="this.style.backgroundColor='transparent'; this.style.color='white';">ออกจากระบบ</a>
            </li>
        </ul>

        <!-- โปรไฟล์ขยายเต็มแถบและอยู่ด้านล่างสุด -->
        <ul style="list-style: none; padding: 0; margin-top: auto; width: 100%; text-align: center;">
            <li>
                <div class="d-flex align-items-center p-3" style="background-color: white; border-radius: 10px;">
                    <i class="bi bi-person-circle" style="font-size: 18px; color: #007468;"></i>
                    <span class="ms-3" style="font-size: 14px; color: #007468;">วิลเลี่ยม เชคสเปียร์</span>
                </div>
            </li>
        </ul>
    </div>

    <!-- กล่องที่ 2 -->
    <div
        style="flex: 7; display: flex; align-items: center; justify-content: center; border-radius: 10px; padding: 20px; overflow: auto;">
        <table class="table table-bordered table-striped text-center"
            style="background-color: #5db2d2; border-radius: 10px; overflow: hidden; width: 100%; border-color: #5db2d2;">
            <thead style="background-color: #5db2d2;">
                <tr>
                    <th style="background-color: #5db2d2; color: white;">ลำดับ</th>
                    <th style="background-color: #5db2d2; color: white;">เลขพัสดุ/ครุภัณฑ์</th>
                    <th style="background-color: #5db2d2; color: white;">ชื่ออุปกรณ์</th>
                    <th style="background-color: #5db2d2; color: white;">วันที่ยืม</th>
                    <th style="background-color: #5db2d2; color: white;">วันที่คืน</th>
                    <th style="background-color: #5db2d2; color: white;">ผู้ยืม</th>
                    <th style="background-color: #5db2d2; color: white;">สถานะ</th>
                    <th style="background-color: #5db2d2; color: white;">หมายเหตุ</th>
                    <th style="background-color: #5db2d2; color: white;">รายละเอียด</th>
                </tr>
            </thead>
            <tbody>
                <tr style="background-color: #e0f1f5; color: black;">
                    <td>1</td>
                    <td>A0000001</td>
                    <td>Notebook Acer</td>
                    <td>04/11/2024</td>
                    <td>07/11/2024</td>
                    <td>นางสาวพรวิสาข์ ปรีชา</td>
                    <td><span style="color: orange;">รอตรวจสอบ</span></td>
                    <td>ยืมคอมพิวเตอร์เพื่อสอบนักเรียนชั้น ม.3/5</td>
                    <td><button class="btn btn-success btn-sm">รายละเอียด</button></td>
                </tr>
                <tr style="background-color: #e0f1f5; color: black;">
                    <td>2</td>
                    <td>B0000002</td>
                    <td>Notebook BBB</td>
                    <td>05/11/2024</td>
                    <td>08/11/2024</td>
                    <td>นางสาวธัญลักษณ์ พลฤทธิ์</td>
                    <td><span style="color: blue;">อนุมัติ</span></td>
                    <td>ยืมคอมพิวเตอร์เพื่อสอนนักเรียนชั้น ม.4/5</td>
                    <td><button class="btn btn-success btn-sm">รายละเอียด</button></td>
                </tr>
                <tr style="background-color: #e0f1f5; color: black;">
                    <td>3</td>
                    <td>B0000003</td>
                    <td>Notebook BBB</td>
                    <td>05/11/2024</td>
                    <td>08/11/2024</td>
                    <td>นางธรรมนารถ เพชรพล</td>
                    <td><span style="color: red;">ไม่อนุมัติ</span></td>
                    <td>ยืมคอมพิวเตอร์เพื่อส่งงาน ROV</td>
                    <td><button class="btn btn-success btn-sm">รายละเอียด</button></td>
                </tr>
            </tbody>
        </table>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>


</body>

</html>