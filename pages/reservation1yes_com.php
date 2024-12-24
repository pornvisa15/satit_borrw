<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>หน้าแสดงหลายละเอียด ก่อนการจอง</title>
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body class="d-flex flex-column min-vh-100">

    <?php
    session_start();
    include 'sidebar.php';
    include "../connect/mysql_borrow.php";

    // รับข้อมูลที่ส่งมาจากหน้า homepages.php
    $device_Id = isset($_GET['id']) ? $_GET['id'] : 'ข้อมูลไม่ถูกส่ง';

    // ดึงข้อมูลจากฐานข้อมูล
    $sql = "SELECT * FROM borrow.device_information WHERE device_Numder = '$device_Id'"; // ใช้ device_Numder เป็นเงื่อนไข
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // ถ้ามีข้อมูล
        $row = $result->fetch_assoc();
        $device_Numder = $row['device_Numder'];
        $device_Name = $row['device_Name'];
        $device_Status = $row['device_Con'];
        $device_Image = '../connect/equipment/equipment/img/' . $row['device_Image']; // ปรับ path ให้เหมาะสม
        $device_Other = $row['device_Other']; // ดึงข้อมูล device_Other จากฐานข้อมูล
        $cotton_Id = $row['cotton_Id'];
    } else {
        // ถ้าไม่มีข้อมูล
        $device_Numder = 'ข้อมูลไม่ถูกส่ง';
        $device_Name = 'ข้อมูลไม่ถูกส่ง';
        $device_Status = 'ข้อมูลไม่ถูกส่ง';
        $device_Image = 'ข้อมูลไม่ถูกส่ง';
        $device_Other = 'ข้อมูลไม่ถูกส่ง';
        $cotton_Id = 'ข้อมูลไม่ถูกส่ง';
    }
    ?>


    <!-- กล่องเนื้อหา -->
    <div class="col-md-9 col-lg-10">
        <div class="p-3 bg-light border rounded shadow-sm">
            <div class="row">
                <div class="col-2 text-end mt-3">
                    <?php
                    // ตรวจสอบค่า cotton_Id และกำหนดข้อความที่เหมาะสม
                    $department_Name = '';
                    switch ($cotton_Id) {
                        case 1:
                            $department_Name = 'อุปกรณ์คอมพิวเตอร์';
                            break;
                        case 2:
                            $department_Name = 'อุปกรณ์วิทยาศาสตร์';
                            break;
                        case 3:
                            $department_Name = 'อุปกรณ์ดนตรี';
                            break;
                        default:
                            $department_Name = 'ข้อมูลไม่ระบุ';
                    }
                    ?>
                    <h5 class="card-title text-start ms-4"
                        style="font-size: 18px; font-weight: bold; text-transform: uppercase; color: #007468; text-align: left; margin-left: 10px; white-space: nowrap; margin-top: 10px;"
                        onmouseover="this.style.color='#006043';" onmouseout="this.style.color='#007468';">
                        <?= $department_Name; ?>
                    </h5>

                </div>

                <div class="d-flex justify-content-center mt-5 mb-5">
                    <div class="p-5 bg-light border rounded shadow-sm" style="max-width: 800px; width: 100%;">
                        <div class="d-flex align-items-center">
                            <!-- รูปภาพ -->
                            <img src="<?= $device_Image; ?>" class="img-fluid me-3" alt="Image Placeholder" style="border-radius: 8px; max-width: 250px; height: 250px; 
            object-fit: contain; transition: transform 0.3s ease; cursor: pointer;" data-bs-toggle="modal"
                                data-bs-target="#zoomModal" onmouseover="this.style.transform='scale(1.1)';"
                                onmouseout="this.style.transform='scale(1)';">

                            <!-- Modal สำหรับแสดงภาพขนาดใหญ่ -->
                            <div class="modal fade" id="zoomModal" tabindex="-1" aria-labelledby="zoomModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body text-center"
                                            style="background-color: #f9f9f9; padding: 20px;">
                                            <img src="<?= $device_Image; ?>" class="img-fluid" alt="Zoomed Image"
                                                style="max-width: 80%; max-height: 400px; height: auto; object-fit: contain; border-radius: 8px;">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="ms-5">
                                <h5 class="mb-2" style="font-size: 0.95rem; color: #555;">
                                    <strong style="color: #000; font-weight: 600;">ชื่ออุปกรณ์:</strong>
                                    <?= $device_Name; ?>
                                </h5>
                                <div class="mb-2" style="line-height: 1.6;">

                                    <p class="mb-2" style="font-size: 0.95rem; color: #555;">
                                        <strong style="color: #000; font-weight: 600;">เลขพัสดุ/ครุภัณฑ์:</strong>
                                        <?= $device_Numder; ?>
                                    </p>
                                    <p class="mb-2" style="font-size: 0.95rem; color: #555;">
                                        <strong style="color: #000; font-weight: 600;">รายละเอียด:</strong>
                                        <?= $device_Other; ?>
                                    </p>
                                    <p class="mb-2" style="font-size: 0.95rem; color: #555;">
                                        <strong style="color: #000; font-weight: 600;">สถานที่รับ:</strong>
                                        <?php
                                        switch ($cotton_Id) {
                                            case 1:
                                                echo 'ฝ่ายคอมพิวเตอร์';
                                                break;
                                            case 2:
                                                echo 'ฝ่ายวิทยาศาสตร์';
                                                break;
                                            case 3:
                                                echo 'ฝ่ายดนตรี';
                                                break;
                                            default:
                                                echo 'ข้อมูลไม่ระบุ';
                                        }
                                        ?>
                                    </p>
                                    <p class="mb-2" style="font-size: 0.95rem; color: #555;">
                                        <strong style="color: #000; font-weight: 600;">สถานะการใช้งาน:</strong>
                                        <span
                                            style="font-weight: 600; color: <?= $device_Status == 1 ? '#6cbf42' : '#e63946'; ?>;">
                                            <?= $device_Status == 1 ? 'ว่าง' : 'ไม่ว่าง'; ?>
                                        </span>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end" style="width: 100%;">
                            <!-- ปุ่มจอง -->
                            <a href="reservation1_book_com.php?id=<?php echo $device_Id; ?>">
                                <button class="btn btn-sm"
                                    style="background-color: <?php echo ($device_Status == 1) ? '#78C756' : '#FFC721'; ?>; color: white; transition: transform 0.3s ease; border: none;"
                                    onmouseover="this.style.transform='scale(1.3)';"
                                    onmouseout="this.style.transform='scale(1)';">
                                    จอง
                                </button>
                            </a>
                        </div>


                        <?php if ($device_Status != 1): // แสดงประวัติการยืมเฉพาะเมื่อสถานะไม่ว่าง ?>
                            <div class="p-5 bg-white border rounded shadow-sm mt-5 mx-auto" style="max-width: 800px;">
                                <!-- Title Section -->
                                <h5 class="text-center mb-4 text-white p-2"
                                    style="background-color: #007468; border-radius: 4px;">ประวัติการยืม</h5>

                                <!-- Table Section -->
                                <table class="table table-hover table-bordered">
                                    <thead class="text-white" style="background-color: #007468; font-size: 0.85rem;">
                                        <tr>
                                            <th scope="col">ผู้ยืม</th>
                                            <th scope="col">วันที่ยืม</th>
                                            <th scope="col">วันที่คืน</th>
                                            <th scope="col">เวลาคืน</th>
                                        </tr>
                                    </thead>
                                    <tbody style="font-size: 0.8rem;">
                                        <tr>
                                            <td>นางสาวพรวิสาข์ ปรีชา</td>
                                            <td>2024-11-18</td>
                                            <td>2024-11-25</td>
                                            <td>15:30</td>
                                        </tr>
                                        <tr>
                                            <td>นายอภิชาติ จิตรานนท์</td>
                                            <td>2024-11-10</td>
                                            <td>2024-11-15</td>
                                            <td>14:45</td>
                                        </tr>
                                        <tr>
                                            <td>นางสาวจุฬาภรณ์ สุขกิจ</td>
                                            <td>2024-11-05</td>
                                            <td>2024-11-12</td>
                                            <td>09:00</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        <?php endif; ?>





                    </div>
                </div>


            </div>
        </div>
    </div>





    <!-- Footer -->
    <footer style="background-color: #495057;" class="text-light py-3 mt-4">
        <div class="container text-center">
            <p class="mb-0">&copy; 2024 S.TSU Application V 2.0 | พัฒนาโดย ทีมงาน S.TSU</p>
        </div>
    </footer>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-zZ1AI1RrP2aSxvrA8mpzVUr3js6qTgnsC8RUV6hxX7t8hzl0TjtRktGhAKGwd5nL"
        crossorigin="anonymous"></script>
</body>

</html>