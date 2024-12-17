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
<?php
    session_start()
?>


      <?php  include 'sidebar.php' ?>
 

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
                <div class="input-group mb-3" style="margin-top: 15px; margin-left: 1px; margin-right: 5px;">
                    <input type="text" id="searchEquipment" class="form-control" placeholder="ค้นหารายชื่ออุปกรณ์"
                        aria-label="Search" aria-describedby="button-search"
                        style="font-size: 14px; padding: 9px 12px;">
                    <button class="btn text-light" type="button" id="button-search"
                        style="background-color: #537bb7; border-color: #537bb7; font-size: 14px; padding: 9px 12px;">
                        ค้นหา
                    </button>
                </div>
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
                            <td>
                                <a href="adminrecord_details.php?item_id=A0000001" class="btn btn-sm"
                                    style="background-color: #4fb05a; color: white; border-radius: 8px; transition: transform 0.3s, box-shadow 0.3s; padding: 6px 12px; font-size: 13px;"
                                    onmouseover="this.style.transform='scale(1.05)'; this.style.boxShadow='0 4px 12px rgba(0, 0, 0, 0.15)'"
                                    onmouseout="this.style.transform='scale(1)'; this.style.boxShadow='none'">
                                    รายละเอียด
                                </a>
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
                            <td>
                                <button class="btn btn-sm"
                                    style="background-color: #4fb05a; color: white; border-radius: 8px; transition: transform 0.3s, box-shadow 0.3s; padding: 6px 12px; font-size: 13px;"
                                    onmouseover="this.style.transform='scale(1.05)'; this.style.boxShadow='0 4px 12px rgba(0, 0, 0, 0.15)'"
                                    onmouseout="this.style.transform='scale(1)'; this.style.boxShadow='none'"
                                    onclick="redirectToDetails('B0000002')">
                                    รายละเอียด
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>

            </div>

            <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>


</body>

</html>