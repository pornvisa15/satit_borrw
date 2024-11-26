<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin ข้อมูลเจ้าหน้าที่</title>
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="d-flex bg-light">

    <div class="d-flex flex-column text-white p-4"
        style="width: 250px; min-height: 100vh; background-color: #466da7;  margin-left: auto; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);">
        <h3 class="mb-4 text-center"
            style="background: rgba(0, 0, 0, 0.3); backdrop-filter: blur(5px); color: white; padding: 18px 20px; border-radius: 13px; ">
            Admin
        </h3>


        <ul class="nav flex-column">
            <li class="nav-item mb-3">
                <a href="admin_homepages.php" class="nav-link text-white"
                    style="background-color:#406398; border-radius: 8px; padding: 12px 18px; transition: background-color 0.3s, transform 0.3s; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                    หน้าหลัก
                </a>
            </li>
            <li class="nav-item mb-3">
                <a href="admin_equipment.php" class="nav-link text-white"
                    style="background-color:#406398; border-radius: 8px; padding: 12px 18px; transition: background-color 0.3s, transform 0.3s; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                    คลังอุปกรณ์
                </a>
            </li>
            <li class="nav-item mb-3">
                <a href="admin_staffinfo.php" class="nav-link text-white"
                    style="background-color:#406398; border-radius: 8px; padding: 12px 18px; transition: background-color 0.3s, transform 0.3s; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                    ข้อมูลเจ้าหน้าที่
                </a>
            </li>
            <li class="nav-item mb-3">
                <a href="admin_record.php" class="nav-link text-white"
                    style="background-color:#406398; border-radius: 8px; padding: 12px 18px; transition: background-color 0.3s, transform 0.3s; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                    ประวัติการใช้อุปกรณ์
                </a>
            </li>
            <li class="nav-item mb-3">
                <a href="#" class="nav-link text-white"
                    style="background-color: #406398; border-radius: 8px; padding: 12px 18px; transition: background-color 0.3s, transform 0.3s; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                    ออกจากระบบ
                </a>
            </li>
        </ul>
    </div>


    <div class="flex-grow-1 p-4">
        <div class="d-flex justify-content-end mt-auto">
            <div class="d-flex align-items-center p-2"
                style="background-color: #ffffff; border-radius: 8px; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1); border: 1px solid #e0e0e0;">
                <!-- ไอคอนโปรไฟล์ -->
                <i class="bi bi-person-circle"
                    style="font-size: 25px; color: #3b5681; border-radius: 50%; background-color: #ffffff;"></i>
                <span class="ms-2"
                    style="color: #05142d; font-size: 14px; font-weight: 500; letter-spacing: 0.3px;">แอดมิน:
                    วิลเลี่ยม
                    เชคสเปียร์</span>
            </div>
        </div>

        <!-- การ์ดแสดงตาราง -->


        <div class="card shadow-sm mt-5">
            <div class="card-header"
                style="background-color:#537bb7; color: white; padding-top: 10px; padding-bottom: 10px;">
                <h4 class="mb-0" style="font-size: 22px;">ประวัติการใช้อุปกรณ์</h4>
            </div>

            <div class="p-5 bg-white border rounded shadow-sm mt-4 mx-auto"
                style="max-width: 100%; min-height: 300px; margin-bottom: 40px; width: 90%;">
                <!-- Title Section -->
                <h5 class="text-align: right; mb-4 font-weight-bold" style="font-size: 18px; ">
                    A0000001
                </h5>

                <!-- Table Section -->
                <table class="table table-hover table-bordered text-center">
                    <thead class="text-white" style="background-color:#537bb7;">
                        <tr>
                            <th scope="col" style="font-size: 14px; color: white;">ผู้ยืม</th>
                            <th scope="col" style="font-size: 14px; color: white;">วันที่ยืม</th>
                            <th scope="col" style="font-size: 14px; color: white;">วันที่คืน</th>
                            <th scope="col" style="font-size: 14px; color: white;">เวลาคืน</th>
                            <th scope="col" style="font-size: 14px; color: white;">จำนวนครั้ง/ยืม</th>
                            <th scope="col" style="font-size: 14px; color: white;">สถานะ</th>
                        </tr>
                    </thead>
                    <tbody style="font-size: 13px;">
                        <tr>
                            <td>นางสาวพรวิสาข์ ปรีชา</td>
                            <td>2024-11-18</td>
                            <td>2024-11-25</td>
                            <td>15:30</td>
                            <td>20</td>
                            <td class="text-danger">ไม่ครบถ้วนสมบูรณ์</td>
                        </tr>
                        <tr>
                            <td>นายอภิชาติ จิตรานนท์</td>
                            <td>2024-11-10</td>
                            <td>2024-11-15</td>
                            <td>14:45</td>
                            <td>19</td>
                            <td class="text-warning">สภาพไม่สมบูรณ์</td>
                        </tr>
                        <tr>
                            <td>นางสาวจุฬาภรณ์ สุขกิจ</td>
                            <td>2024-11-05</td>
                            <td>2024-11-12</td>
                            <td>09:00</td>
                            <td>18</td>
                            <td class="text-success">ครบถ้วนสมบูรณ์</td>
                        </tr>
                        <tr>
                            <td>นางสาวจุฬาภรณ์ สุขกิจ</td>
                            <td>2024-11-05</td>
                            <td>2024-11-12</td>
                            <td>09:00</td>
                            <td>18</td>
                            <td class="text-success">ครบถ้วนสมบูรณ์</td>
                        </tr>
                    </tbody>
                </table>



            </div>
        </div>







        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>


</body>


</html>