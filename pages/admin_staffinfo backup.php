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


      <?php  include 'sidebar.php' ?>



    <div class="flex-grow-1 p-4">
    <?php include 'short.php'; ?>
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