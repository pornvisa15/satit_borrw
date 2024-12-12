<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin คลังอุปกรณ์คอมพิวเตอร์</title>
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">



    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
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
                <a href="#" class="nav-link text-white"
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
                    style="color: #05142d; font-size: 14px; font-weight: 500; letter-spacing: 0.3px;">แอดมิน: วิลเลี่ยม
                    เชคสเปียร์</span>
            </div>
        </div>

        <?php
        include '../connect/myspl_das_satit.php';
        include '../connect/mysql_studentsatit.php';
        include '../connect/mysql_borrow.php';
        ?>



        <!-- กล่องค้นหา -->




        <div class="card shadow-lg mt-5">
            <div class="card-header text-white" style="background-color:#537bb7; padding: 10px; padding-left: 20px;">
                <h4 class="mb-0" style="font-size: 22px;">คลังอุปกรณ์</h4>
            </div>

            <div class="card-body">
                <!-- กล่องค้นหาและเลือกประเภท -->
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <!-- เลือกประเภทอุปกรณ์ -->
                    <div class="me-3">
                        <select id="equipmentType" class="form-select" style="width: 220px; font-size: 14px;">
                            <option value="" disabled selected>เลือกประเภทอุปกรณ์</option>
                            <option value="computer">อุปกรณ์คอมพิวเตอร์</option>
                            <option value="science">อุปกรณ์วิทยาศาสตร์</option>
                            <option value="music">อุปกรณ์ดนตรี</option>
                        </select>
                    </div>

                    <!-- ปุ่มเพิ่มอุปกรณ์ -->
                    <div class="ms-3">
                        <button class="btn"
                            style="box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); background-color: #4CAF50; border-radius: 5px; padding: 9px 15px; font-size: 14px; border-color: #4CAF50; color: white;"
                            onmouseover="this.style.transform='scale(1.05)'; this.style.boxShadow='0 4px 12px rgba(0, 0, 0, 0.15)';"
                            onmouseout="this.style.transform='scale(1)'; this.style.boxShadow='none';"
                            onclick="window.location.href='admin_equipment_in_com.php';">
                            <i class="bi bi-person-plus"></i> เพิ่มอุปกรณ์
                        </button>
                    </div>
                </div>

                <!-- กล่องค้นหาพร้อมปุ่ม -->
                <div class="input-group mb-3">
                    <input type="text" id="searchEquipment" class="form-control" placeholder="ค้นหาชื่ออุปกรณ์"
                        aria-label="Search" aria-describedby="button-search"
                        style="font-size: 14px; padding: 9px 12px;">
                    <button class="btn text-light" type="button" id="button-search"
                        style="background-color: #537bb7; border-color: #537bb7; font-size: 14px; padding: 9px 12px;">
                        ค้นหา
                    </button>
                </div>

                <!-- ตารางแสดงข้อมูลอุปกรณ์ -->
                <div class="table-responsive mt-3">
                    <table class="table table-bordered table-striped text-center" style="font-size: 14px; ">
                        <thead class="table-light">
                            <tr>
                                <th>ลำดับ</th>
                                <th>เลขพัสดุ /ครุภัณฑ์</th>
                                <th>ชื่ออุปกรณ์</th>
                                <th>สิทธิ์การเข้าถึง</th>
                                <th>วันที่ซื้อ</th>
                                <th>ราคา</th>
                                <th style="width: 13%;">รายละเอียด</th>
                                <th>ไฟล์ภาพ</th>
                                <th>แก้ไข</th>
                                <th>ลบ</th>
                            </tr>
                        </thead>
                        <tbody id="equipmentTable">
                            <?php
                            $i = 1;  // เริ่มจาก 1
                            $sq_equipment = "SELECT * FROM borrow.device_information";
                            $result = $conn->query($sq_equipment);
                            if ($result->num_rows > 0) {

                                while ($rowequipment = $result->fetch_assoc()) {
                                    $device_Id = urlencode($rowequipment['device_Id']);  // ลำดับ
                                    $device_Numder = htmlspecialchars($rowequipment['device_Numder']); // 	เลขพัสดุ/ครุภัณฑ์
                                    $device_device_Name = htmlspecialchars($rowequipment['device_Name']); // ชื่ออุปกรณ์
                                    $device_Type = htmlspecialchars($rowequipment['device_Access']); // ใช้สำกหรับ
                                    $device_Date = htmlspecialchars($rowequipment['device_Date']); // 	วัน
                                    $device_Price = htmlspecialchars($rowequipment['device_Price']); // 	ราคา
                                    $device_Other = htmlspecialchars($rowequipment['device_Other']);// 	อื่นๆ
                                    // $device_Date = htmlspecialchars($rowequipment['device_Date']); //จำนวนครั้งที่ยืม
                                    // $device_Date = htmlspecialchars($rowequipment['device_Date']); //สถานะ ทำยังนะ
                                    $device_Image = htmlspecialchars($rowequipment['device_Image']);

                                    ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo htmlspecialchars($rowequipment['device_Numder']); ?></td>
                                        <td><?php echo htmlspecialchars($rowequipment['device_Name']); ?></td>
                                        <td>
                                            <?php
                                            if ($rowequipment['device_Access'] == 1) {
                                                echo "บุคลากร";
                                            } else if ($rowequipment['device_Access'] == 2) {
                                                echo "บุคลากรและนักเรียน";
                                            } else {
                                                echo "ไม่ทราบ";
                                            }
                                            ?>
                                        </td>


                                        <td><?php echo htmlspecialchars($rowequipment['device_Date']); ?></td>
                                        <td><?php echo htmlspecialchars($rowequipment['device_Price']); ?></td>
                                        <td><?php echo htmlspecialchars($rowequipment['device_Other']); ?></td>

                                        <td style="text-align: center; vertical-align: middle;">
                                            <?php
                                            $device_Image = $rowequipment['device_Image'];

                                            if (!empty($device_Image) && file_exists('../connect/equipment/equipment/img/' . $device_Image)) {
                                                // แสดงรูปภาพโดยตั้งขนาดเท่ากัน และอยู่กลาง
                                                echo '<img src="../connect/equipment/equipment/img/' . htmlspecialchars($device_Image) . '" alt="device_Image" style="width: 100px; height: 100px; object-fit: cover;">';
                                            } else {
                                                echo 'ไม่มีรูปภาพ';
                                            }

                                            if (isset($_FILES['device_Image']) && $_FILES['device_Image']['error'] == 0) {
                                                $deviceImage = $_FILES['device_Image'];
                                                if (!empty($deviceImage['name'])) {
                                                    $uploadDir = '../connect/equipment/equipment/img/';
                                                    $uploadFile = $uploadDir . basename($deviceImage['name']);
                                                    if (!file_exists($uploadFile)) {
                                                        move_uploaded_file($deviceImage['tmp_name'], $uploadFile);
                                                        echo 'อัปโหลดไฟล์สำเร็จ';
                                                    } else {
                                                        echo 'ไฟล์นี้มีอยู่แล้ว';
                                                    }
                                                }
                                            }
                                            ?>
                                        </td>


                                        <td>
                                            <a href="admin_equipment_edit.php?device_Id=<?php echo $device_Id; ?>"
                                                class="btn btn-warning">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        </td>
                                        <td>
                                            <a href="../connect/equipment/delete.php?device_Id=<?php echo $device_Id; ?>"
                                                class="btn btn-danger">
                                                <i class="fas fa-trash-alt"></i>
                                            </a>
                                        </td>
                                    </tr>

                                    <?php
                                    $i++;
                                }
                            }

                            ?>
                        </tbody>

                    </table>
                </div>

                <!-- ปุ่มหน้าถัดไปและเลขหน้า -->
                <div class="d-flex justify-content-center mt-3">
                    <div id="pagination" class="pagination"></div>
                </div>
            </div>
        </div>

        <script>

            let currentPage = 1;
            const itemsPerPage = 15;
            let totalItems = 0;
            let currentData = [];

            // ฟังก์ชันที่ใช้ในการอัพเดตตารางตามประเภทที่เลือก
            function updateTable(type) {
                totalItems = equipmentData[type].length;
                currentData = equipmentData[type];
                const startIndex = (currentPage - 1) * itemsPerPage;
                const endIndex = Math.min(startIndex + itemsPerPage, totalItems);

                const tableBody = document.getElementById('equipmentTableBody');
                tableBody.innerHTML = ''; // ล้างข้อมูลเก่า

                currentData.slice(startIndex, endIndex).forEach((equipment, index) => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                <td>${startIndex + index + 1}</td>
                <td>${equipment.code}</td>
                <td>${equipment.name}</td>
                <td>${equipment.access}</td>
                <td>${equipment.date}</td>
                <td>${equipment.price}</td>
                <td>${equipment.borrowCount} ครั้ง</td>
                <td><span class="badge bg-warning text-dark" style="border-radius: 12px; padding: 5px 10px;">${equipment.status}</span></td>
                <td><i class="bi bi-file-earmark-image" style="font-size: 20px; color: #4fb05a;"></i></td>
                <td>
                    <button class="btn btn-sm" style="background-color: #ff9800; color: white; border-radius: 8px;" 
                            onclick="window.location.href='admin_equipment_edit.php';">
                        <i class="bi bi-pencil-square"></i>
                    </button>
                </td>
                <td><button class="btn btn-sm" style="background-color: #f44336; color: white; border-radius: 8px;">
                    <i class="bi bi-trash"></i></button></td>
            `;
                    tableBody.appendChild(row);
                });

                updatePagination();
            }

            // ฟังก์ชันเพื่ออัพเดต pagination
            function updatePagination() {
                const totalPages = Math.ceil(totalItems / itemsPerPage);
                const paginationDiv = document.getElementById('pagination');
                paginationDiv.innerHTML = ''; // ล้าง pagination เก่า

                // Create previous button
                if (currentPage > 1) {
                    paginationDiv.innerHTML += `<button class="btn btn-primary me-2" onclick="changePage(${currentPage - 1})">Previous</button>`;
                }

                // Create page buttons
                for (let i = 1; i <= totalPages; i++) {
                    paginationDiv.innerHTML += `<button class="btn ${i === currentPage ? 'btn-secondary' : 'btn-outline-secondary'} me-2" onclick="changePage(${i})">${i}</button>`;
                }

                // Create next button
                if (currentPage < totalPages) {
                    paginationDiv.innerHTML += `<button class="btn btn-primary ms-2" onclick="changePage(${currentPage + 1})">Next</button>`;
                }
            }

            // ฟังก์ชันเปลี่ยนหน้า
            function changePage(page) {
                currentPage = page;
                updateTable(document.getElementById('equipmentType').value);
            }

            // ฟังก์ชันที่จะถูกเรียกเมื่อมีการเปลี่ยนแปลงจาก dropdown
            document.getElementById('equipmentType').addEventListener('change', function () {
                currentPage = 1; // Reset to first page when changing category
                updateTable(this.value);
            });

            // เริ่มต้นโหลดข้อมูลเมื่อหน้าเว็บโหลด
            window.onload = function () {
                updateTable('computer'); // ตั้งค่าเริ่มต้นให้แสดงอุปกรณ์คอมพิวเตอร์
            };
        </script>








    </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>


</body>

</html>