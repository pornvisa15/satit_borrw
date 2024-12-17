
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ประวัติการยืม-คืน</title>  
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body class="d-flex flex-column min-vh-100">
<?php
    session_start()
?>
<?php  include 'sidebar.php' ?>

        
        <!-- กล่องทางขวา (เนื้อหา) -->
        <div class="col-md-9 col-lg-10 mb-5">
            <div class="p-3 bg-light border rounded shadow-sm">
               
            <div class="row">
   
</div>

<div class="p-5 bg-white border rounded shadow-sm mt-5 mx-auto" style="max-width: 800px; margin-bottom: 30px;">
    <h1 class="text-center mb-4" style="color: #007468; font-size: 20px; font-weight: bold;">ประวัติการยืม-คืน</h1>

    <ul class="list-group list-group-flush">
        <!-- Example Borrowing History Item -->
        <li class="list-group-item d-flex justify-content-between align-items-center" 
            style="transition: all 0.3s ease; background-color: #f8f9fa; border-radius: 10px;" 
            onmouseover="this.style.backgroundColor='#e9f7ef'; this.style.transform='scale(1.02)';" 
            onmouseout="this.style.backgroundColor='#f8f9fa'; this.style.transform='scale(1)';">
            <div>
                <span class="fw-bold" style="font-size: 14px; color: #007468;">โน๊ตบุ๊ค </span>
                <div style="font-size: 12px; color: #6c757d;">วันที่ยืม 10 พ.ย. 67 - วันที่ 15 พ.ย. 67</div>
                <div style="font-size: 12px; color: #6c757d;">สถานะ: คืนแล้ว</div>
                <!-- เพิ่มจำนวนครั้งที่ยืม -->
                <div style="font-size: 12px; color: #6c757d;">ยืมไปแล้ว 3 ครั้ง</div>
            </div>
            <span class="badge bg-success d-flex align-items-center" 
                style="transition: background-color 0.3s ease; background-color: #198754; font-size: 12px;" 
                onmouseover="this.style.backgroundColor='#28a745';" 
                onmouseout="this.style.backgroundColor='#198754';">
                <i class="bi bi-check-circle-fill me-1"></i> คืนแล้ว
            </span>
        </li>

        <!-- Another Borrowing History Item -->
        <li class="list-group-item d-flex justify-content-between align-items-center" 
            style="transition: all 0.3s ease; background-color: #f8f9fa; border-radius: 10px;" 
            onmouseover="this.style.backgroundColor='#e9f7ef'; this.style.transform='scale(1.02)';" 
            onmouseout="this.style.backgroundColor='#f8f9fa'; this.style.transform='scale(1)';">
            <div>
                <span class="fw-bold" style="font-size: 14px; color: #007468;">บีกเกอร์</span>
                <div style="font-size: 12px; color: #6c757d;">วันที่ยืม 1 พ.ย. 67 - วันที่ 7 พ.ย. 67</div>
                <div style="font-size: 12px; color: #6c757d;">สถานะ: คืนแล้ว</div>
                <!-- เพิ่มจำนวนครั้งที่ยืม -->
                <div style="font-size: 12px; color: #6c757d;">ยืมไปแล้ว 2 ครั้ง</div>
            </div>
            <span class="badge bg-success d-flex align-items-center" 
                style="transition: background-color 0.3s ease; background-color: #198754; font-size: 12px;" 
                onmouseover="this.style.backgroundColor='#28a745';" 
                onmouseout="this.style.backgroundColor='#198754';">
                <i class="bi bi-check-circle-fill me-1"></i> คืนแล้ว
            </span>
        </li>

        <!-- Another Borrowing History Item -->
        <li class="list-group-item d-flex justify-content-between align-items-center" 
            style="transition: all 0.3s ease; background-color: #f8f9fa; border-radius: 10px;" 
            onmouseover="this.style.backgroundColor='#e9f7ef'; this.style.transform='scale(1.02)';" 
            onmouseout="this.style.backgroundColor='#f8f9fa'; this.style.transform='scale(1)';">
            <div>
                <span class="fw-bold" style="font-size: 14px; color: #007468;">กีต้าร์ไฟฟ้า</span>
                <div style="font-size: 12px; color: #6c757d;">วันที่ยืม 10 ต.ค. 67 - วันที่ 12 ต.ค. 67</div>
                <div style="font-size: 12px; color: #6c757d;">สถานะ: คืนแล้ว</div>
                <!-- เพิ่มจำนวนครั้งที่ยืม -->
                <div style="font-size: 12px; color: #6c757d;">ยืมไปแล้ว 5 ครั้ง</div>
            </div>
            <span class="badge bg-success d-flex align-items-center" 
                style="transition: background-color 0.3s ease; background-color: #198754; font-size: 12px;" 
                onmouseover="this.style.backgroundColor='#28a745';" 
                onmouseout="this.style.backgroundColor='#198754';">
                <i class="bi bi-check-circle-fill me-1"></i> คืนแล้ว
            </span>
        </li>

        <!-- Pending Item Example -->
        <li class="list-group-item d-flex justify-content-between align-items-center" 
            style="transition: all 0.3s ease; background-color: #f8f9fa; border-radius: 10px;" 
            onmouseover="this.style.backgroundColor='#e9f7ef'; this.style.transform='scale(1.02)';" 
            onmouseout="this.style.backgroundColor='#f8f9fa'; this.style.transform='scale(1)';">
            <div>
                <span class="fw-bold" style="font-size: 14px; color: #007468;">กลองเล็ก</span>
                <div style="font-size: 12px; color: #6c757d;">วันที่ยืม 16 พ.ย. 67 - วันที่ 20 พ.ย. 67</div>
                <div style="font-size: 12px; color: #6c757d;">สถานะ: กำลังยืม</div>
                <!-- เพิ่มจำนวนครั้งที่ยืม -->
                <div style="font-size: 12px; color: #6c757d;">ยืมไปแล้ว 1 ครั้ง</div>
            </div>
            <span class="badge bg-warning d-flex align-items-center" 
                style="transition: background-color 0.3s ease; background-color: #ffc107; font-size: 12px;" 
                onmouseover="this.style.backgroundColor='#e0a800';" 
                onmouseout="this.style.backgroundColor='#ffc107';">
                <i class="bi bi-exclamation-circle-fill me-1"></i> กำลังยืม
            </span>
        </li>
    </ul>
</div>


        </div>
    </div>
</div>



           
        </div>
</body>
</html>

<!-- Footer -->
<footer style="background-color: #495057;" class="text-light py-3 mt-4">
    <div class="container text-center">
        <p class="mb-0">&copy; 2024 S.TSU Application V 2.0 | พัฒนาโดย ทีมงาน S.TSU</p>
    </div>
</footer>



</body>
</html>
