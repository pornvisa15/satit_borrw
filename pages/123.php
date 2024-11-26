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
                   aria-label="Search" aria-describedby="button-search" style="font-size: 14px; padding: 9px 12px;">
            <button class="btn text-light" type="button" id="button-search"
                    style="background-color: #537bb7; border-color: #537bb7; font-size: 14px; padding: 9px 12px;">
                ค้นหา
            </button>
        </div>

        <!-- ตารางแสดงข้อมูลอุปกรณ์ -->
        <div class="table-responsive mt-3">
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

        <!-- ปุ่มหน้าถัดไปและเลขหน้า -->
        <div class="d-flex justify-content-center mt-3">
            <div id="pagination" class="pagination"></div>
        </div>
    </div>
</div>

<script>
    // ข้อมูลตัวอย่างของอุปกรณ์
    const equipmentData = {
    computer: [
        {id: 1, code: 'A0000001', name: 'Notebook Acer', access: 'นักเรียน', date: '01/01/2023', price: '25,000 บาท', borrowCount: 15, status: 'รอตรวจสอบ'},
        {id: 2, code: 'A0000002', name: 'Desktop PC', access: 'บุคลากร', date: '15/03/2022', price: '30,000 บาท', borrowCount: 20, status: 'ใช้งาน'},
        {id: 3, code: 'A0000003', name: 'Laptop Dell', access: 'นักเรียน', date: '10/12/2021', price: '28,000 บาท', borrowCount: 5, status: 'รอตรวจสอบ'},
        {id: 4, code: 'A0000004', name: 'MacBook Pro', access: 'บุคลากร', date: '05/08/2022', price: '60,000 บาท', borrowCount: 12, status: 'ใช้งาน'},
        {id: 5, code: 'A0000005', name: 'Chromebook', access: 'นักเรียน', date: '07/09/2022', price: '12,000 บาท', borrowCount: 10, status: 'รอตรวจสอบ'},
        {id: 6, code: 'A0000006', name: 'Asus Gaming Laptop', access: 'บุคลากร', date: '22/04/2021', price: '35,000 บาท', borrowCount: 18, status: 'ใช้งาน'},
        {id: 7, code: 'A0000007', name: 'HP Spectre x360', access: 'นักเรียน', date: '15/03/2023', price: '45,000 บาท', borrowCount: 4, status: 'รอตรวจสอบ'},
        {id: 8, code: 'A0000008', name: 'Microsoft Surface Pro', access: 'บุคลากร', date: '12/01/2020', price: '50,000 บาท', borrowCount: 9, status: 'ใช้งาน'},
        {id: 9, code: 'A0000009', name: 'Lenovo ThinkPad', access: 'นักเรียน', date: '25/11/2021', price: '22,000 บาท', borrowCount: 7, status: 'รอตรวจสอบ'},
        {id: 10, code: 'A0000010', name: 'Acer Predator Helios', access: 'บุคลากร', date: '20/07/2022', price: '55,000 บาท', borrowCount: 2, status: 'ใช้งาน'},
        {id: 11, code: 'A0000011', name: 'Alienware M15', access: 'นักเรียน', date: '10/06/2021', price: '75,000 บาท', borrowCount: 16, status: 'รอตรวจสอบ'},
        {id: 12, code: 'A0000012', name: 'Razer Blade Stealth', access: 'บุคลากร', date: '18/05/2020', price: '40,000 บาท', borrowCount: 13, status: 'ใช้งาน'},
        {id: 13, code: 'A0000013', name: 'Microsoft Surface Laptop 4', access: 'นักเรียน', date: '03/04/2023', price: '38,000 บาท', borrowCount: 8, status: 'รอตรวจสอบ'},
        {id: 14, code: 'A0000014', name: 'Gigabyte Aero', access: 'บุคลากร', date: '22/02/2021', price: '45,000 บาท', borrowCount: 6, status: 'ใช้งาน'},
        {id: 15, code: 'A0000015', name: 'MacBook Air M1', access: 'นักเรียน', date: '13/09/2022', price: '32,000 บาท', borrowCount: 3, status: 'รอตรวจสอบ'},
        {id: 16, code: 'A0000016', name: 'HP Envy x360', access: 'บุคลากร', date: '07/06/2020', price: '28,000 บาท', borrowCount: 14, status: 'ใช้งาน'},
        {id: 17, code: 'A0000017', name: 'Asus ZenBook', access: 'นักเรียน', date: '29/01/2021', price: '36,000 บาท', borrowCount: 11, status: 'รอตรวจสอบ'},
        {id: 18, code: 'A0000018', name: 'Lenovo Legion 5', access: 'บุคลากร', date: '21/10/2022', price: '49,000 บาท', borrowCount: 9, status: 'ใช้งาน'},
        {id: 19, code: 'A0000019', name: 'Toshiba Satellite', access: 'นักเรียน', date: '02/12/2021', price: '18,000 บาท', borrowCount: 5, status: 'รอตรวจสอบ'},
        {id: 20, code: 'A0000020', name: 'Samsung Notebook 9', access: 'บุคลากร', date: '11/07/2023', price: '40,000 บาท', borrowCount: 4, status: 'ใช้งาน'}
    ],
    science: [
        {id: 1, code: 'S0000001', name: 'กล้องจุลทรรศน์', access: 'นักเรียน', date: '10/10/2023', price: '10,000 บาท', borrowCount: 5, status: 'รอตรวจสอบ'},
        {id: 2, code: 'S0000002', name: 'เครื่องวัดแสง', access: 'บุคลากร', date: '20/06/2021', price: '8,000 บาท', borrowCount: 12, status: 'ใช้งาน'},
        {id: 3, code: 'S0000003', name: 'เครื่องวัดอุณหภูมิ', access: 'นักเรียน', date: '18/04/2022', price: '5,000 บาท', borrowCount: 8, status: 'รอตรวจสอบ'},
        {id: 4, code: 'S0000004', name: 'แล็บทดลองเคมี', access: 'บุคลากร', date: '02/01/2023', price: '15,000 บาท', borrowCount: 7, status: 'ใช้งาน'},
        {id: 5, code: 'S0000005', name: 'เครื่องดูดฝุ่นห้องทดลอง', access: 'นักเรียน', date: '13/07/2022', price: '3,500 บาท', borrowCount: 4, status: 'รอตรวจสอบ'},
        {id: 6, code: 'S0000006', name: 'กล้องถ่ายภาพดิจิตอล', access: 'บุคลากร', date: '11/11/2021', price: '18,000 บาท', borrowCount: 10, status: 'ใช้งาน'},
        {id: 7, code: 'S0000007', name: 'เครื่องวัดความดัน', access: 'นักเรียน', date: '06/06/2023', price: '12,000 บาท', borrowCount: 6, status: 'รอตรวจสอบ'},
        {id: 8, code: 'S0000008', name: 'เครื่องวัดปริมาณแสง', access: 'บุคลากร', date: '08/09/2020', price: '9,000 บาท', borrowCount: 5, status: 'ใช้งาน'},
        {id: 9, code: 'S0000009', name: 'เครื่องกลั่นน้ำ', access: 'นักเรียน', date: '15/12/2021', price: '7,000 บาท', borrowCount: 9, status: 'รอตรวจสอบ'},
        {id: 10, code: 'S0000010', name: 'เครื่องวัดการสั่นสะเทือน', access: 'บุคลากร', date: '30/03/2022', price: '14,000 บาท', borrowCount: 11, status: 'ใช้งาน'},
        {id: 11, code: 'S0000011', name: 'เครื่องผสมสารเคมี', access: 'นักเรียน', date: '20/11/2020', price: '20,000 บาท', borrowCount: 6, status: 'รอตรวจสอบ'},
        {id: 12, code: 'S0000012', name: 'เครื่องหมุนเหวี่ยง', access: 'บุคลากร', date: '17/02/2023', price: '25,000 บาท', borrowCount: 8, status: 'ใช้งาน'},
        {id: 13, code: 'S0000013', name: 'เตาอบอุตสาหกรรม', access: 'นักเรียน', date: '23/06/2022', price: '30,000 บาท', borrowCount: 5, status: 'รอตรวจสอบ'},
        {id: 14, code: 'S0000014', name: 'เครื่องปั่นผสม', access: 'บุคลากร', date: '10/09/2021', price: '13,000 บาท', borrowCount: 7, status: 'ใช้งาน'},
        {id: 15, code: 'S0000015', name: 'เครื่องทดสอบแรงดึง', access: 'นักเรียน', date: '19/08/2020', price: '35,000 บาท', borrowCount: 4, status: 'รอตรวจสอบ'},
        {id: 16, code: 'S0000016', name: 'เครื่องวัดความหนืด', access: 'บุคลากร', date: '15/05/2023', price: '18,000 บาท', borrowCount: 9, status: 'ใช้งาน'},
        {id: 17, code: 'S0000017', name: 'เครื่องทดสอบการกัดกร่อน', access: 'นักเรียน', date: '10/02/2022', price: '22,000 บาท', borrowCount: 6, status: 'รอตรวจสอบ'},
        {id: 18, code: 'S0000018', name: 'เครื่องวัดระดับเสียง', access: 'บุคลากร', date: '01/11/2021', price: '16,000 บาท', borrowCount: 11, status: 'ใช้งาน'},
        {id: 19, code: 'S0000019', name: 'เครื่องวัดความชื้น', access: 'นักเรียน', date: '17/03/2023', price: '8,000 บาท', borrowCount: 9, status: 'รอตรวจสอบ'},
        {id: 20, code: 'S0000020', name: 'เครื่องวัดการไหลของน้ำ', access: 'บุคลากร', date: '12/07/2020', price: '19,000 บาท', borrowCount: 8, status: 'ใช้งาน'}
    ],
    music: [
        {id: 1, code: 'M0000001', name: 'กีต้าร์ไฟฟ้า', access: 'นักเรียน', date: '01/01/2024', price: '15,000 บาท', borrowCount: 3, status: 'รอตรวจสอบ'},
        {id: 2, code: 'M0000002', name: 'เปียโน', access: 'บุคลากร', date: '12/12/2022', price: '50,000 บาท', borrowCount: 8, status: 'ใช้งาน'},
        {id: 3, code: 'M0000003', name: 'กลองชุด', access: 'นักเรียน', date: '10/10/2023', price: '25,000 บาท', borrowCount: 12, status: 'รอตรวจสอบ'},
        {id: 4, code: 'M0000004', name: 'ไวโอลิน', access: 'บุคลากร', date: '20/07/2021', price: '35,000 บาท', borrowCount: 6, status: 'ใช้งาน'},
        {id: 5, code: 'M0000005', name: 'กีต้าร์โปร่ง', access: 'นักเรียน', date: '03/03/2022', price: '8,000 บาท', borrowCount: 9, status: 'รอตรวจสอบ'},
        {id: 6, code: 'M0000006', name: 'เครื่องเป่าแตร', access: 'บุคลากร', date: '14/06/2020', price: '12,000 บาท', borrowCount: 5, status: 'ใช้งาน'},
        {id: 7, code: 'M0000007', name: 'แซ็กโซโฟน', access: 'นักเรียน', date: '11/11/2021', price: '20,000 บาท', borrowCount: 7, status: 'รอตรวจสอบ'},
        {id: 8, code: 'M0000008', name: 'เครื่องเคาะจังหวะ', access: 'บุคลากร', date: '09/09/2022', price: '18,000 บาท', borrowCount: 6, status: 'ใช้งาน'},
        {id: 9, code: 'M0000009', name: 'ออร์แกน', access: 'นักเรียน', date: '01/08/2023', price: '30,000 บาท', borrowCount: 10, status: 'รอตรวจสอบ'},
        {id: 10, code: 'M0000010', name: 'ไมโครโฟน', access: 'บุคลากร', date: '05/04/2021', price: '5,000 บาท', borrowCount: 3, status: 'ใช้งาน'},
        {id: 11, code: 'M0000011', name: 'เบสไฟฟ้า', access: 'นักเรียน', date: '12/10/2021', price: '22,000 บาท', borrowCount: 8, status: 'รอตรวจสอบ'},
        {id: 12, code: 'M0000012', name: 'คีย์บอร์ด', access: 'บุคลากร', date: '07/07/2022', price: '10,000 บาท', borrowCount: 5, status: 'ใช้งาน'},
        {id: 13, code: 'M0000013', name: 'กีต้าร์คลาสสิก', access: 'นักเรียน', date: '23/12/2020', price: '18,000 บาท', borrowCount: 4, status: 'รอตรวจสอบ'},
        {id: 14, code: 'M0000014', name: 'แอคคูสติกกีต้าร์', access: 'บุคลากร', date: '10/02/2021', price: '25,000 บาท', borrowCount: 6, status: 'ใช้งาน'},
        {id: 15, code: 'M0000015', name: 'ไวโอลินไฟฟ้า', access: 'นักเรียน', date: '01/09/2023', price: '40,000 บาท', borrowCount: 2, status: 'รอตรวจสอบ'},
        {id: 16, code: 'M0000016', name: 'เครื่องดนตรีไทย', access: 'บุคลากร', date: '04/06/2022', price: '18,000 บาท', borrowCount: 7, status: 'ใช้งาน'},
        {id: 17, code: 'M0000017', name: 'กีต้าร์เบส', access: 'นักเรียน', date: '13/03/2021', price: '28,000 บาท', borrowCount: 9, status: 'รอตรวจสอบ'},
        {id: 18, code: 'M0000018', name: 'ฟลุต', access: 'บุคลากร', date: '20/04/2022', price: '15,000 บาท', borrowCount: 4, status: 'ใช้งาน'},
        {id: 19, code: 'M0000019', name: 'ออร์แกนไฟฟ้า', access: 'นักเรียน', date: '02/09/2021', price: '38,000 บาท', borrowCount: 11, status: 'รอตรวจสอบ'},
        {id: 20, code: 'M0000020', name: 'ขิม', access: 'บุคลากร', date: '09/08/2023', price: '50,000 บาท', borrowCount: 8, status: 'ใช้งาน'}
    ]
};


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
    document.getElementById('equipmentType').addEventListener('change', function() {
        currentPage = 1; // Reset to first page when changing category
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