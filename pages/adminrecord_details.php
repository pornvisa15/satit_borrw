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
<?php
    session_start()
?>  

      <?php  include 'sidebar.php' ?>

   


    <div class="flex-grow-1 p-4">
    <?php include 'short.php'; ?>

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