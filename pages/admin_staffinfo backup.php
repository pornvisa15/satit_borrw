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
                <a href="../logout.php" class="nav-link text-white"
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
        <?php
        include '../connect/myspl_das_satit.php';

        ?>
        <!-- การ์ดแสดงตาราง -->
        <div class="card shadow-sm mt-5">
            <div class="card-header"
                style="background-color:#537bb7; color: white; padding-top: 10px; padding-bottom: 10px;">
                <h4 class="mb-0" style="font-size: 22px;">รายชื่อเจ้าหน้าที่</h4>
            </div>

            <div class="card-body">
                <table class="table table-bordered table-striped text-center" style="font-size: 14px;">
                    <thead class="table-light">
                        <tr>
                            <th>ลำดับ</th>
                            <th>ชื่อ-นามสกุล</th>
                            <th>เจ้าหน้าที่ฝ่าย</th>
                            <th>แก้ไข</th>
                            <th>ลบ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>สมชาย ใจดี</td>
                            <td>ฝ่ายวิชาการวิทยาศาสตร์</td>
                            <td>
                                <!-- ปุ่มแก้ไข -->
                                <button class="btn btn-sm"
                                    style="background-color: #ff9800; color: white; border-radius: 8px;"
                                    onmouseover="this.style.transform='scale(1.1)'; this.style.boxShadow='0 4px 12px rgba(0, 0, 0, 0.15)';"
                                    onmouseout="this.style.transform='scale(1)'; this.style.boxShadow='none';"
                                    onclick="window.location.href='adminstaff_editdetails.php';">
                                    <i class="bi bi-pencil-square"></i>
                                </button>
                            </td>
                            <td>
                                <!-- ปุ่มลบ -->
                                <button class="btn btn-sm"
                                    style="background-color: #f44336; color: white; border-radius: 8px;"
                                    onmouseover="this.style.transform='scale(1.1)'; this.style.boxShadow='0 4px 12px rgba(0, 0, 0, 0.15)';"
                                    onmouseout="this.style.transform='scale(1)'; this.style.boxShadow='none';"
                                    onclick="confirmDelete(1, 'สมชาย ใจดี')">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </td>
                        </tr>

                        <script>
                            function confirmDelete(id, name) {
                                if (confirm(`คุณต้องการลบเจ้าหน้าที่ ${name} หรือไม่?`)) {
                                    // ส่งคำขอไปยัง Backend เพื่อลบข้อมูล
                                    fetch(`delete_staff.php?id=${id}`, {
                                        method: 'POST',
                                    })
                                        .then(response => response.json())
                                        .then(data => {
                                            if (data.success) {
                                                alert('ลบข้อมูลสำเร็จ');
                                                // รีเฟรชหน้าเว็บเพื่ออัปเดตตาราง
                                                location.reload();
                                            } else {
                                                alert('เกิดข้อผิดพลาด: ' + data.message);
                                            }
                                        })
                                        .catch(error => {
                                            console.error('Error:', error);
                                            alert('ไม่สามารถลบข้อมูลได้');
                                        });
                                }
                            }
                        </script>

                        <tr>
                            <td>2</td>
                            <td>แมว ใจดี</td>
                            <td>ฝ่ายวิทชาการคอมพิวเตอร์</td>
                            <td>
                                <button class="btn btn-sm"
                                    style="background-color: #ff9800; color: white; border-radius: 8px;"
                                    onmouseover="this.style.transform='scale(1.1)'; this.style.boxShadow='0 4px 12px rgba(0, 0, 0, 0.15)';"
                                    onmouseout="this.style.transform='scale(1)'; this.style.boxShadow='none';">
                                    <i class="bi bi-pencil-square"></i>
                                </button>
                            </td>
                            <td>
                                <button class="btn btn-sm"
                                    style="background-color: #f44336; color: white; border-radius: 8px;"
                                    onmouseover="this.style.transform='scale(1.1)'; this.style.boxShadow='0 4px 12px rgba(0, 0, 0, 0.15)';"
                                    onmouseout="this.style.transform='scale(1)'; this.style.boxShadow='none';">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="d-flex justify-content-start p-3">
            <button class="btn"
                style="box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); background-color: #4CAF50; border-radius: 5px; padding: 9px 12px; font-size: 14px; border-color: #4CAF50; color: white;"
                onmouseover="this.style.transform='scale(1.05)'; this.style.boxShadow='0 4px 12px rgba(0, 0, 0, 0.15)';"
                onmouseout="this.style.transform='scale(1)'; this.style.boxShadow='none';"
                onclick="window.location.href='adminstaff_details.php';">
                <i class="bi bi-person-plus"></i> เพิ่มเจ้าหน้าที่
            </button>
        </div>



    </div>



    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>


</body>

</html>