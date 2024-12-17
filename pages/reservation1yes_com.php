
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>หน้าแรก</title>  
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body class="d-flex flex-column min-vh-100">
<?php
    session_start()
?>
<?php  include 'sidebar.php' ?>

        
        <!-- กล่องทางขวา (เนื้อหา) -->
        <div class="col-md-9 col-lg-10">
            <div class="p-3 bg-light border rounded shadow-sm">
            <div class="row">
                <div class="col-2 text-end mt-3">
                <h5 class="card-title" 
            
    style="font-size: 18px; font-weight: bold; text-transform: uppercase; color: #007468;"onmouseover="this.style.color='#006043';" onmouseout="this.style.color='#007468';"> อุปกรณ์คอมพิวเตอร์
</h5>
               
</div>

<div class="d-flex justify-content-center mt-5 mb-5">
    <div class="p-5 bg-light border rounded shadow-sm" style="max-width: 800px; width: 100%;">
        <div class="d-flex align-items-center">
            <!-- Larger Rectangular Image on the left -->
            <!-- รูปภาพที่จะแสดงในหน้าเว็บ -->
<img src="/satit_borrw/img/6.jpg" class="img-fluid me-3" alt="Image Placeholder" style="max-width: 250px; height: auto;" data-bs-toggle="modal" data-bs-target="#zoomModal">

<!-- Modal สำหรับแสดงภาพขนาดใหญ่ -->
<div class="modal fade" id="zoomModal" tabindex="-1" aria-labelledby="zoomModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <!-- รูปภาพที่จะแสดงในโหมดซูม -->
                <img src="/satit_borrw/img/6.jpg" class="img-fluid" alt="Zoomed Image" style="max-width: 100%; height: auto;">
            </div>
        </div>
    </div>
</div>
  


            <!-- Content on the right -->
            <div class="ms-auto">
                <h5 class="mb-2 text-dark" style="font-size: 1.1rem;">ชื่ออุปกรณ์: เมาส์</h5>
                <div class="mb-2">
                    <p class="mb-1 text-muted" style="font-size: 0.9rem;"><strong>เลขพัสดุ/ครุภัณฑ์:</strong> A0001234</p>
                    <p class="mb-1 text-muted" style="font-size: 0.9rem;"><strong>รายละเอียด:</strong> เมาส์ไร้สาย Anitech Bluetooth and Wireless Mouse Sanrio KU-W239-BK Black</p>
                    <p class="mb-1 text-muted" style="font-size: 0.9rem;"><strong>เจ้าของอุปกรณ์:</strong> นางสาวพรวิสาข์ ปรีชา</p>
                    <p class="mb-1 text-muted" style="font-size: 0.9rem;">
                    <strong>สถานะการใช้งาน:</strong> <span style="color: #78C756; font-weight: bold;">ว่าง</span>
                    </p>
                </div>
                <!-- Button for booking -->
                <div class="text-end">
                    <!-- Link to another page when the button is clicked -->
                    <a href="reservation1_book_com.php">
                        <button class="btn btn-sm" style="background-color: #FFC721; color: white;">จอง</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

</div>
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

<!-- Bootstrap JS และ Popper.js (จำเป็นต้องใช้ในการทำงานของ modal) -->


</body>
</html>
