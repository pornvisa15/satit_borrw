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
 
        
       
      

<!-- กล่องค้นหา -->


    

<div class="card shadow-lg mt-5">
    <div class="card-header" style="background-color:#537bb7; color: white; padding: 10px;">
        <h4 class="mb-0" style="font-size: 22px;">อุปกรณ์</h4>
    </div>

    <!-- กล่องค้นหา -->
    <div class="card-body">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <!-- เลือกประเภทอุปกรณ์ -->
        <div class="mb-3 d-flex flex-column">
    <!-- ป้ายคำบรรยายประเภทอุปกรณ์ -->
    <label for="equipmentType" class="form-label mb-2">ประเภทอุปกรณ์</label>
    
    <!-- Dropdown เลือกประเภทอุปกรณ์ -->
    <select id="equipmentType" class="form-select" style="width: 200px;">
        <option value="computer">อุปกรณ์คอมพิวเตอร์</option>
        <option value="science">อุปกรณ์วิทยาศาสตร์</option>
        <option value="music">อุปกรณ์ดนตรี</option>
    </select>
</div>



        <!-- ส่วนค้นหาชื่ออุปกรณ์ -->
        <div class="input-group w-50 me-3">
            <input type="text" id="searchEquipment" class="form-control" placeholder="ค้นหาชื่ออุปกรณ์" aria-label="Search" aria-describedby="button-search">
        </div>

        <!-- ปุ่มค้นหาที่อยู่ขวามือสุด -->
        <div class="input-group ms-2 d-flex justify-content-start p-3">
    <!-- ปุ่มค้นหา -->
    <button class="btn text-light" type="button" id="button-search" style="background-color: #537bb7; border-color: #537bb7; font-size: 14px; padding: 9px 12px;">
        ค้นหา
    </button>

    <!-- ปุ่มเพิ่มอุปกรณ์ -->
    <button class="btn ms-3"
        style="box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); background-color: #4CAF50; border-radius: 5px; padding: 9px 12px; font-size: 14px; border-color: #4CAF50; color: white;"
        onmouseover="this.style.transform='scale(1.05)'; this.style.boxShadow='0 4px 12px rgba(0, 0, 0, 0.15)';"
        onmouseout="this.style.transform='scale(1)'; this.style.boxShadow='none';"
        onclick="window.location.href='admin_equipment_in_com.php';">
        <i class="bi bi-person-plus"></i> เพิ่มอุปกรณ์
    </button>
</div>


    </div>
</div>


    <!-- ตารางแสดงข้อมูล -->
    <div class="card-body">
        <table class="table table-bordered table-striped text-center" style="font-size: 14px;">
            <thead class="table-light">
                <tr>
                    <th>ลำดับ</th>
                    <th>เลขพัสดุ /ครุภัณฑ์</th>
                    <th>ชื่ออุปกรณ์</th>
                    <th>สิทธิ์การเข้าถึง</th>
                    <th>วันที่ซื้อ</th>
                    <th>ราคา</th>
                    <th>จำนวนครั้ง/การยืม</th>
                    <th>สถานะ</th>
                    <th>ไฟล์ภาพ</th>
                    <th>แก้ไข</th>
                    <th>ลบ</th>
                </tr>
            </thead>
            <tbody id="equipmentTableBody">
                <!-- ข้อมูลแถวจะถูกเพิ่มผ่าน JavaScript -->
            </tbody>
        </table>
    </div>
</div>

</div>

<script>
    // ข้อมูลตัวอย่างของอุปกรณ์
    const equipmentData = {
        computer: [
            {id: 1, code: 'A0000001', name: 'Notebook Acer', access: 'นักเรียน', date: '01/01/2023', price: '25,000 บาท', borrowCount: 15, status: 'รอตรวจสอบ'},
            {id: 2, code: 'A0000002', name: 'Desktop PC', access: 'บุคลากร', date: '15/03/2022', price: '30,000 บาท', borrowCount: 20, status: 'ใช้งาน'},
        ],
        science: [
            {id: 1, code: 'S0000001', name: 'กล้องจุลทรรศน์', access: 'นักเรียน', date: '10/10/2023', price: '10,000 บาท', borrowCount: 5, status: 'รอตรวจสอบ'},
            {id: 2, code: 'S0000002', name: 'เครื่องวัดแสง', access: 'บุคลากร', date: '20/06/2021', price: '8,000 บาท', borrowCount: 12, status: 'ใช้งาน'},
        ],
        music: [
            {id: 1, code: 'M0000001', name: 'กีต้าร์ไฟฟ้า', access: 'นักเรียน', date: '01/01/2024', price: '15,000 บาท', borrowCount: 3, status: 'รอตรวจสอบ'},
            {id: 2, code: 'M0000002', name: 'เปียโน', access: 'บุคลากร', date: '12/12/2022', price: '50,000 บาท', borrowCount: 8, status: 'ใช้งาน'},
        ]
    };

    // ฟังก์ชันที่ใช้ในการอัพเดตตารางตามประเภทที่เลือก
    function updateTable(type) {
        const tableBody = document.getElementById('equipmentTableBody');
        tableBody.innerHTML = ''; // ล้างข้อมูลเก่า

        const data = equipmentData[type];
        data.forEach((equipment, index) => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${index + 1}</td>
                <td>${equipment.code}</td>
                <td>${equipment.name}</td>
                <td>${equipment.access}</td>
                <td>${equipment.date}</td>
                <td>${equipment.price}</td>
                <td>${equipment.borrowCount} ครั้ง</td>
                <td><span class="badge bg-warning text-dark" style="border-radius: 12px; padding: 5px 10px;">${equipment.status}</span></td>
                <td><i class="bi bi-file-earmark-image" style="font-size: 20px; color: #4fb05a;"></i></td>
                <td><button class="btn btn-sm" style="background-color: #ff9800; color: white; border-radius: 8px;"><i class="bi bi-pencil-square"></i></button></td>
                <td><button class="btn btn-sm" style="background-color: #f44336; color: white; border-radius: 8px;"><i class="bi bi-trash"></i></button></td>
            `;
            tableBody.appendChild(row);
        });
    }

    // ฟังก์ชันที่จะถูกเรียกเมื่อมีการเปลี่ยนแปลงจาก dropdown
    document.getElementById('equipmentType').addEventListener('change', function() {
        updateTable(this.value);
    });

    // เริ่มต้นโหลดข้อมูลเมื่อหน้าเว็บโหลด
    window.onload = function() {
        updateTable('computer'); // ตั้งค่าเริ่มต้นให้แสดงอุปกรณ์คอมพิวเตอร์
    };
</script>







    </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>


</body>

</html>