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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="d-flex bg-light">



    <div class="d-flex flex-column text-white p-4"
        style="width: 250px; min-height: 100vh; background-color: #466da7;  margin-left: auto; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);">
        <h3 class="mb-4 text-center"
            style="background: rgba(0, 0, 0, 0.3); backdrop-filter: blur(5px); color: white; padding: 18px 20px; border-radius: 13px;">
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
                <a class="nav-link text-white d-flex align-items-center" data-bs-toggle="collapse" href="#borrowSection"
                    role="button" aria-expanded="false" aria-controls="borrowSection"
                    style="background-color:#406398; border-radius: 8px; padding: 12px 18px; transition: background-color 0.3s, transform 0.3s; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                    คลังอุปกรณ์
                    <i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <div class="collapse mt-2" id="borrowSection">
                    <ul class="list-unstyled">
                        <li><a href="admin_equipment_com.php"
                                class="btn btn-light btn-lg w-100 mb-1 text-start rounded-3 p-2 shadow-sm fs-6"
                                style="color: #466da7;">อุปกรณ์คอมพิวเตอร์</a>
                        </li>
                        <li><a href="reservation_science.php"
                                class="btn btn-light btn-lg w-100 mb-1 text-start rounded-3 p-2 shadow-sm fs-6"
                                style="color: #466da7;">อุปกรณ์วิทยาศาสตร์</a>
                        </li>
                        <li><a href="reservation_music.php"
                                class="btn btn-light btn-lg w-100 mb-1 text-start rounded-3 p-2 shadow-sm fs-6"
                                style="color: #466da7;">อุปกรณ์ดนตรี</a>
                        </li>

                    </ul>
                </div>
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
                    style="color: #05142d; font-size: 14px; font-weight: 500; letter-spacing: 0.3px;">แอดมิน: วิลเลี่ยม
                    เชคสเปียร์</span>
            </div>
        </div>



        <div class="card shadow-sm mt-5">
            <div class="card-header"
                style="background-color:#537bb7; color: white; padding-top: 10px; padding-bottom: 10px;">
                <h4 class="mb-0" style="font-size: 22px;">ประวัติการใช้อุปกรณ์</h4>
            </div>

            <div class="card-body">
                <table class="table table-bordered table-striped text-center" style="font-size: 14px;">
                    <thead class="table-light">
                        <tr>
                            <th>ลำดับ</th>
                            <th>เลขพัสดุ /ครุภัณฑ์</th>
                            <th>ชื่ออุปกรณ์</th>
                            <th>ผู้ยืม</th>
                            <th>วันที่ยืม</th>
                            <th>วันที่คืน</th>
                            <th>เวลาคืน</th>
                            <th>รายละเอียด</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>A0000001</td>
                            <td>Notebook Acer</td>
                            <td>นางสาวพรวิสาข์ ปรีชา</td>
                            <td>04/11/2024</td>
                            <td>07/11/2024</td>
                            <td>14:00 น.</td>
                            <td><button class="btn btn-sm"
                                    style="background-color: #4fb05a; color: white; border-radius: 8px; transition: transform 0.3s, box-shadow 0.3s; padding: 6px 12px; font-size: 13px;"
                                    onmouseover="this.style.transform='scale(1.05)'; this.style.boxShadow='0 4px 12px rgba(0, 0, 0, 0.15)'"
                                    onmouseout="this.style.transform='scale(1)'; this.style.boxShadow='none'">รายละเอียด</button>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>B0000002</td>
                            <td>Notebook BBB</td>
                            <td>นางสาวธัญลักษณ์ พลฤทธิ์</td>
                            <td>05/11/2024</td>
                            <td>08/11/2024</td>
                            <td>15:30 น.</td>
                            <td><button class="btn btn-sm"
                                    style="background-color: #4fb05a; color: white; border-radius: 8px; transition: transform 0.3s, box-shadow 0.3s; padding: 6px 12px; font-size: 13px;"
                                    onmouseover="this.style.transform='scale(1.05)'; this.style.boxShadow='0 4px 12px rgba(0, 0, 0, 0.15)'"
                                    onmouseout="this.style.transform='scale(1)'; this.style.boxShadow='none'">รายละเอียด</button>
                            </td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>B0000003</td>
                            <td>Notebook BBB</td>
                            <td>นางธรรมนารถ เพชรพล</td>
                            <td>05/11/2024</td>
                            <td>08/11/2024</td>
                            <td>16:00 น.</td>
                            <td><button class="btn btn-sm"
                                    style="background-color: #4fb05a; color: white; border-radius: 8px; transition: transform 0.3s, box-shadow 0.3s; padding: 6px 12px; font-size: 13px;"
                                    onmouseover="this.style.transform='scale(1.05)'; this.style.boxShadow='0 4px 12px rgba(0, 0, 0, 0.15)'"
                                    onmouseout="this.style.transform='scale(1)'; this.style.boxShadow='none'">รายละเอียด</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>


</body>

</html>