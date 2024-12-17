
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>แจ้งเตือน</title>  
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
    <h1 class="text-center mb-4" style="color: #007468; font-size: 20px; font-weight: bold;">แจ้งเตือน</h1>
    <ul class="list-group list-group-flush">
        

        <!-- อุปกรณ์ที่ใกล้ครบกำหนด -->
        <li class="list-group-item d-flex justify-content-between align-items-center"
            style="transition: all 0.3s ease; background-color: #f8f9fa; border-radius: 10px;" 
            onmouseover="this.style.backgroundColor='#e9f7ef'; this.style.transform='scale(1.02)';" 
            onmouseout="this.style.backgroundColor='#f8f9fa'; this.style.transform='scale(1)';">
            <div>
                <span class="fw-bold" style="font-size: 14px; color: #007468;">บีกเกอร์</span>
                <div style="font-size: 12px; color: #6c757d;">วันที่ยืม 28 ต.ค. 67 - วันที่ 8 พ.ย. 67</div>
            </div>
            <span class="badge bg-warning text-dark d-flex align-items-center" 
                style="transition: background-color 0.3s ease; background-color: #ffc107; font-size: 12px;" 
                onmouseover="this.style.backgroundColor='#e0a800';" 
                onmouseout="this.style.backgroundColor='#ffc107';">
                <i class="bi bi-exclamation-circle-fill me-1"></i> ใกล้ครบกำหนด
            </span>
        </li>
        <!-- อุปกรณ์ที่ชดใช้ค่าเสียหาย -->
<li class="list-group-item d-flex justify-content-between align-items-center"
    style="transition: all 0.3s ease; background-color: #f8f9fa; border-radius: 10px;" 
    onmouseover="this.style.backgroundColor='#e9f7ef'; this.style.transform='scale(1.02)';" 
    onmouseout="this.style.backgroundColor='#f8f9fa'; this.style.transform='scale(1)';">
    <div>
        <span class="fw-bold" style="font-size: 14px; color: #007468;">กลองเล็ก</span>
        <div style="font-size: 12px; color: #6c757d;">วันที่ยืม 28 ต.ค. 67 - วันที่ 8 พ.ย. 67</div>
    </div>
    <span class="badge bg-info text-light d-flex align-items-center" 
        style="transition: background-color 0.3s ease; background-color: #17a2b8; font-size: 12px;" 
        onmouseover="this.style.backgroundColor='#138496';" 
        onmouseout="this.style.backgroundColor='#17a2b8';">
        <!-- ไอคอนที่เปลี่ยนเป็น "clipboard-check-fill" -->
        <i class="bi bi-check-circle-fill me-1"></i> ชดใช้ค่าเสียหายแล้ว
    </span>
</li>
<!-- อุปกรณ์ที่ชดใช้เป็นพัสดุ -->
<li class="list-group-item d-flex justify-content-between align-items-center"
    style="transition: all 0.3s ease; background-color: #f8f9fa; border-radius: 10px;" 
    onmouseover="this.style.backgroundColor='#e9f7ef'; this.style.transform='scale(1.02)';" 
    onmouseout="this.style.backgroundColor='#f8f9fa'; this.style.transform='scale(1)';">
    <div>
        <span class="fw-bold" style="font-size: 14px; color: #007468;">เมาส์</span>
        <div style="font-size: 12px; color: #6c757d;">วันที่ยืม 28 ต.ค. 67 - วันที่ 8 พ.ย. 67</div>
    </div>
    <span class="badge bg-primary text-light d-flex align-items-center" 
        style="transition: background-color 0.3s ease; background-color: #007bff; font-size: 12px;" 
        onmouseover="this.style.backgroundColor='#0056b3';" 
        onmouseout="this.style.backgroundColor='#007bff';">
        <!-- ไอคอนใหม่ "box-arrow-up-right" สำหรับการชดใช้เป็นพัสดุ -->
        <i class="bi bi-check-circle-fill me-1"></i> ชดใช้เป็นพัสดุแล้ว
    </span>
</li>





        <!-- อุปกรณ์ที่เลยกำหนด -->
        <li class="list-group-item d-flex justify-content-between align-items-center"
            style="transition: all 0.3s ease; background-color: #f8f9fa; border-radius: 10px;" 
            onmouseover="this.style.backgroundColor='#e9f7ef'; this.style.transform='scale(1.02)';" 
            onmouseout="this.style.backgroundColor='#f8f9fa'; this.style.transform='scale(1)';">
            <div>
                <span class="fw-bold" style="font-size: 14px; color: #007468;">กีต้าร์ไฟฟ้า</span>
                <div style="font-size: 12px; color: #6c757d;">วันที่ยืม 20 ต.ค. 67 - วันที่ 21 ต.ค. 67</div>
            </div>
            <span class="badge bg-danger d-flex align-items-center" 
                style="transition: background-color 0.3s ease; background-color: #dc3545; font-size: 12px;" 
                onmouseover="this.style.backgroundColor='#c82333';" 
                onmouseout="this.style.backgroundColor='#dc3545';">
                <i class="bi bi-x-circle-fill me-1"></i> เลยกำหนด
            </span>

            
        </li>
    </ul>
    <div class="alert alert-primary d-flex align-items-center mt-3" role="alert" 
     style="border-radius: 10px; padding: 15px; transition: transform 0.3s ease; cursor: pointer;">
    <i class="bi bi-exclamation-triangle-fill me-3" style="font-size: 1.5rem; color: #0056b3;"></i>
    <div>
        <strong style="font-size: 0.85rem;">โปรดคืนอุปกรณ์ภายในวันที่ 20 พ.ย. 67</strong>
        <p class="mb-0" style="font-size: 0.75rem;">กรุณานำอุปกรณ์คืนเพื่อหลีกเลี่ยงค่าปรับ</p>
    </div>
</div>

<script>
    // เพิ่มการเด้งขึ้นเมื่อเมาส์ชี้ไปที่ alert
    document.querySelector('.alert').addEventListener('mouseenter', function() {
        this.style.transform = 'translateY(-5px)';
        this.style.boxShadow = '0 8px 16px rgba(0, 0, 0, 0.2)';
    });

    document.querySelector('.alert').addEventListener('mouseleave', function() {
        this.style.transform = 'translateY(0)';
        this.style.boxShadow = 'none';
    });
</script>



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
