<?php
session_start();
include 'sidebar.php';
include "../connect/mysql_borrow.php";

// รับข้อมูลที่ส่งมาจากหน้า homepages.php
$device_Id = isset($_GET['id']) ? $_GET['id'] : 'ข้อมูลไม่ถูกส่ง';

// ดึงข้อมูลจากฐานข้อมูลเกี่ยวกับอุปกรณ์
$sql = "SELECT * FROM borrow.device_information WHERE device_Id = '$device_Id'"; // ใช้ device_Numder เป็นเงื่อนไข
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // ถ้ามีข้อมูล
    $row = $result->fetch_assoc();
    $device_Id = $row['device_Id'];
    $device_Name = $row['device_Name'];
    $device_Numder = $row['device_Numder'];
    $device_Status = $row['device_Con'];
    $device_Image = '../connect/equipment/equipment/img/' . $row['device_Image']; // ปรับ path ให้เหมาะสม
    $device_Other = $row['device_Other']; // ดึงข้อมูล device_Other จากฐานข้อมูล
    $cotton_Id = $row['cotton_Id'];
    $history_Numder = isset($row['history_Numder']) ? $row['history_Numder'] : 'ข้อมูลไม่ถูกส่ง'; // ตรวจสอบก่อนใช้งาน
} else {
    // ถ้าไม่มีข้อมูล
    $device_Id = 'ข้อมูลไม่ถูกส่ง';
    $device_Name = 'ข้อมูลไม่ถูกส่ง';
    $device_Status = 'ข้อมูลไม่ถูกส่ง';
    $device_Image = 'ข้อมูลไม่ถูกส่ง';
    $device_Other = 'ข้อมูลไม่ถูกส่ง';
    $cotton_Id = 'ข้อมูลไม่ถูกส่ง';
    $history_Numder = 'ข้อมูลไม่ถูกส่ง'; // กำหนดค่าเริ่มต้น
    $device_Numder = 'ข้อมูลไม่ถูกส่ง';
}

// คำนวณจำนวนครั้งที่อุปกรณ์ถูกยืม
$countSql = "SELECT COUNT(*) AS borrow_count FROM borrow.history_brs WHERE device_Id = '$device_Id' AND history_Status = '1'"; // กรองเฉพาะสถานะที่ยืม
$countResult = $conn->query($countSql);
$borrowCount = 0; // ค่าเริ่มต้น
if ($countResult->num_rows > 0) {
    $countRow = $countResult->fetch_assoc();
    $borrowCount = $countRow['borrow_count']; // จำนวนครั้งที่ถูกยืม
}
?>

<!-- ที่เหลือของโค้ดจะไม่เปลี่ยนแปลง -->


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
                        case 4:
                            $department_Name = 'อุปกรณ์ฝ่ายพัสดุ';
                            break;
                        default:
                            $department_Name = 'ข้อมูลไม่ระบุ';
                    }
                    ?>
                    <h5 class="card-title text-start ms-4"
                        style="font-size: 18px; font-weight: bold; text-transform: uppercase; color: #007468; text-align: left; margin-left: 10px; white-space: nowrap; margin-top: 10px; "
                        onmouseover="this.style.color='#006043';" onmouseout="this.style.color='#007468';">
                        <?= $department_Name; ?>
                    </h5>

                </div>

                <div class="d-flex justify-content-center mt-5 mb-5">
                    <div class="p-5 bg-light border rounded shadow-sm" style="max-width: 800px; width: 100%;">
                        <div class="d-flex align-items-center">
                            <!-- รูปภาพ -->
                            <img src="<?= $device_Image; ?>" class="img-fluid me-3" alt="Image Placeholder"
                                style="border-radius: 8px; max-width: 250px; height: 250px; object-fit: contain; transition: transform 0.3s ease; cursor: pointer;"
                                data-bs-toggle="modal" data-bs-target="#zoomModal"
                                onmouseover="this.style.transform='scale(1.1)';"
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

                                    <p class="mb-2" style="font-size: 0.95rem; color: #555;">
                                        <strong style="color: #000; font-weight: 600;">จำนวนครั้งที่ถูกยืม:</strong>
                                        <?= $borrowCount; ?> ครั้ง
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end" style="width: 100%;">
                            <!-- ปุ่มจอง -->

                            <button class="btn btn-sm"
                                style="background-color: <?php echo ($device_Status == 1) ? '#78C756' : '#FFC721'; ?>; color: white; transition: transform 0.3s ease; border: none;"
                                onmouseover="this.style.transform='scale(1.3)';"
                                onmouseout="this.style.transform='scale(1)';" data-bs-toggle="modal"
                                data-bs-target="#termsModal">
                                จอง
                            </button>
                            </a>
                        </div>

                        <!-- Modal -->
                        <div class="modal fade" id="termsModal" tabindex="-1" aria-labelledby="termsModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                <!-- Added modal-lg for larger width -->
                                <div class="modal-content"
                                    style="border-radius: 12px; overflow: hidden; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);">
                                    <div class="modal-header d-flex justify-content-center"
                                        style="background-color: #78C756; color: white; border-bottom: none; position: relative;">
                                        <h5 class="modal-title" id="termsModalLabel"
                                            style="font-size: 20px; font-weight: bold; margin: 0;">
                                            ข้อกำหนดและแนวปฏิบัติ
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"
                                            style="color: white; position: absolute; right: 15px; top: 15px;">
                                        </button>
                                    </div>

                                    <div class="modal-body"
                                        style="font-size: 16px; color: #333; line-height: 1.6; padding: 20px;">
                                        <p style="font-weight: bold; margin-bottom: 15px;">
                                            กรุณายอมรับข้อกำหนดและแนวปฏิบัติในการยืม-คืน พัสดุ/ครุภัณฑ์
                                            ก่อนทำการยืมอุปกรณ์</p>
                                        <ul class="list-group">
                                            <li class="list-group-item"
                                                style="font-size: 14px; border: none; padding: 10px 15px; background: #f9f9f9;">
                                                <strong>1. </strong>
                                                การยืมพัสดุ/ครุภัณฑ์ต้องระบุเหตุผลความจำเป็นที่ต้องการใช้งานทุกครั้ง
                                                และยืมเพื่อใช้ประโยชน์ในราชการเท่านั้น
                                            </li>
                                            <li class="list-group-item"
                                                style="font-size: 14px; border: none; padding: 10px 15px; background: #ffffff;">
                                                <strong>2. </strong> ผู้ยืมมีหน้าที่รับผิดชอบต่อพัสดุ/ครุภัณฑ์
                                                ที่ได้ยืมเสมือนเป็นทรัพย์สินของผู้ยืมใช้เอง
                                                ไม่ให้เกิดความเสียหายหรือสูญหาย
                                            </li>
                                            <li class="list-group-item"
                                                style="font-size: 14px; border: none; padding: 10px 15px; background: #f9f9f9;">
                                                <strong>3. </strong>
                                                ผู้ยืมมีหน้าที่ชดใช้ความเสียหายในกรณีทรัพย์สินชำรุดหรือเสียหาย
                                                ผู้ยืมต้องซ่อมแซมให้คงสภาพเดิมโดยเสียค่าใช้จ่ายของตนเอง
                                                หรือชดใช้เป็นพัสดุครุภัณฑ์ ประเภท ชนิด ขนาด ลักษณะ
                                                และคุณภาพต้องไม่น้อยกว่าเดิมหรือชดใช้เป็นเงินตามราคาที่เป็นอยู่ในขณะยืม
                                                ตามหลักเกณฑ์ที่กระทรวงการคลังกำหนด
                                            </li>
                                            <li class="list-group-item"
                                                style="font-size: 14px; border: none; padding: 10px 15px; background: #ffffff;">
                                                <strong>4. </strong>
                                                ผู้ยืมต้องไม่ให้ผู้อื่นยืมทรัพย์สินที่ตนเองได้ยืมมาไม่ว่ากรณีใดๆ
                                                เว้นแต่การยืมนั้นได้รับการอนุมัติเป็นลายลักษณ์อักษร
                                                จากผู้อำนาจอนุมัติแล้วเท่านั้น
                                            </li>
                                            <li class="list-group-item"
                                                style="font-size: 14px; border: none; padding: 10px 15px; background: #f9f9f9;">
                                                <strong>5. </strong> ทรัพย์สินที่ผู้ยืมไปใช้งาน
                                                มีไว้ใช้เพื่อประโยชน์ของทางราชการเท่านั้น
                                                ห้ามมิให้ผู้ยืมนำพัสดุ/ครุภัณฑ์ ที่ยืมไปใช้อย่างอื่น
                                                นอกเหนือจากที่หน่วยงานกำหนดหรือทำให้เกิดความเสียหายที่เกิดจากการละเมิดดังกล่าวให้ถือเป็นความผิดส่วนบุคคล
                                                โดยผู้ยืมต้องรับผิดชอบต่อความเสียหายที่เกิดขึ้นนั้น
                                            </li>
                                            <li class="list-group-item"
                                                style="font-size: 14px; border: none; padding: 10px 15px; background: #ffffff;">
                                                <strong>6. </strong> ผู้ยืมจะต้องกำหนดระยะเวลาในการยืมให้ชัดเจน
                                                และต้องส่งคืนภายในระยะเวลาที่กำหนด
                                            </li>
                                            <li class="list-group-item"
                                                style="font-size: 14px; border: none; padding: 10px 15px; background: #f9f9f9;">
                                                <strong>7. </strong> กรณีมีความจำเป็นต้องใช้งานต่อ
                                                ให้ดำเนินการส่งคืนตามระยะเวลาที่กำหนดให้เรียบร้อยก่อน
                                                แล้วจึงขอยืมและกำหนดระยะเวลาใหม่ได้
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="modal-footer justify-content-end" style="padding: 15px;">
                                        <!-- Right-aligned -->
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                                            style="border-radius: 8px; font-size: 16px; background-color: #FF0303; border: none; color: white; margin-right: 10px;">
                                            ปิด
                                        </button>
                                        <button type="button" class="btn btn-primary" id="continueButton"
                                            style="border-radius: 8px; font-size: 16px; background-color: #78C756; border: none;">
                                            ดำเนินการต่อ
                                        </button>
                                    </div>


                                </div>
                            </div>
                        </div>

                        <script>
                            document.getElementById('continueButton').addEventListener('click', function () {
                                window.location.href = "reservation1_book_com.php?id=<?php echo $device_Id; ?>";
                            });
                        </script>




                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>