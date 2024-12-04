
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
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>



<body class="d-flex flex-column min-vh-100">

<!-- รูปภาพ with overlay text aligned to the left and moved slightly to the right -->
<div class="position-relative">
    <img src="/satit_borrw/img/3.jpg" alt="Image not found" class="img-fluid w-100 h-100 object-fit-cover">
    <div class="position-absolute top-50 start-0 translate-middle-y text-light" style="font-size: 1.5rem; font-weight: bold; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5); padding-left: 60px;">
        ระบบ ยืม-คืน อุปกรณ์
    </div>
</div>


<!-- Grid System for Two Boxes -->
<div class="container-fluid mt-4 ms-0 flex-grow-1">
    <div class="row">
        <!-- กล่องทางซ้าย (เมนู) -->
        <div class="col-md-3 col-lg-2">
            <div class="p-3 border rounded shadow-sm" style="background-color: #007468; color: #ffffff;">
                <!-- ชื่อและไอคอนคน -->
                <div class="d-flex align-items-center mb-3 p-2 bg-white rounded shadow-sm">
                    <i class="bi bi-person-circle" style="font-size: 18px; color: #007468;"></i>
                    <span class="ms-2" style="font-size: 14px; color: #007468;">นางสาวพรวิสาข์ ปรีชา</span>
                </div>

                <ul class="nav flex-column mt-3">
                    <li>
                        <a href="homepages.php" class="nav-link text-light">สำหรับการยืม</a>
                    </li>

                    <li>
                        <a class="nav-link text-light d-flex align-items-center" data-bs-toggle="collapse" href="#borrowSection" role="button" aria-expanded="false" aria-controls="borrowSection">
                            ประเภท
                            <i class="bi bi-chevron-down ms-2"></i>
                        </a>

                        <div class="collapse" id="borrowSection">
                            <div class="card card-body border-0">
                                <ul class="list-unstyled">
                                    <li><a href="reservation_com.php" class="btn btn-light btn-lg w-100 mb-1 text-start rounded-3 p-2 shadow-sm fs-6 text-success">อุปกรณ์คอมพิวเตอร์</a></li>
                                    <li><a href="reservation_science.php" class="btn btn-light btn-lg w-100 mb-1 text-start rounded-3 p-2 shadow-sm fs-6 text-success">อุปกรณ์วิทยาศาสตร์</a></li>
                                    <li><a href="reservation_music.php" class="btn btn-light btn-lg w-100 mb-1 text-start rounded-3 p-2 shadow-sm fs-6 text-success">อุปกรณ์ดนตรี</a></li>
                                </ul>
                            </div>
                        </div>
                    </li>

                    <li><a href="warn.php" class="nav-link text-light">แจ้งเตือน</a></li>
                    <li><a href="record.php" class="nav-link text-light">ประวัติการยืม</a></li>
                    <li><a href="../logout.php" class="nav-link text-white">ออกจากระบบ</a></li>
                </ul>
            </div>
        </div>
        
        <!-- กล่องทางขวา (เนื้อหา) -->
        <div class="col-md-9 col-lg-10">
            <div class="p-3 bg-light border rounded shadow-sm">
               
                <div class="row">
                <div class="col-2 text-end mt-3">
                <h5 class="card-title" 
    style="font-size: 18px; font-weight: bold; text-transform: uppercase; color: #007468;"onmouseover="this.style.color='#006043';" onmouseout="this.style.color='#007468';"> อุปกรณ์คอมพิวเตอร์
</h5>



</div>



</div>
<div class="p-5 bg-light border rounded shadow-sm mt-5 mx-auto" style="max-width: 800px; margin-bottom: 30px;">
    <div class="container mt-">
        <h5 class="text-center text-success">รายละเอียดการทำรายการ</h5>
        <div class="container mt-5">
        <div class="container mt-4">
        <form style="margin-top: -10px;">
            <div class="form-group" style="margin-bottom: 10px; margin-top: -10px; display: flex; align-items: center;">
                <label for="deviceName" class="font-weight-bold text-success" style="font-size: 16px; color: #007468; margin-right: 10px; white-space: nowrap;">ชื่ออุปกรณ์ :</label>
                <input type="text" class="form-control" id="deviceName" value="เมาส์" readonly style="padding: 10px; font-size: 16px; flex-grow: 1; opacity: 0.6;">
            </div>

            <div class="form-group row" style="margin-bottom: 10px;">
                <div class="col-sm-6" style="padding-right: 5px;">
                    <label for="purpose" class="font-weight-bold text-success" style="font-size: 16px; color: #007468;">
                        เพื่อไปใช้งาน :</label>
                    <textarea class="form-control" id="purpose" 
                            style="padding: 10px; font-size: 16px; height: 60px; resize: none; overflow-y: auto;"></textarea>
                </div>

                <div class="col-sm-6" style="padding-left: 5px;">
                    <label for="location" class="font-weight-bold text-success" style="font-size: 16px; color: #007468;">
                        สถานที่นำไปใช้ :</label>
                    <textarea class="form-control" id="location" 
                            style="padding: 10px; font-size: 16px; height: 60px; resize: none; overflow-y: auto;"></textarea>
                </div>
            </div>

            <div class="form-group row" style="margin-bottom: 10px;">
                <div class="col-sm-4" style="padding-right: 5px;">
                    <label for="startDate" class="font-weight-bold text-success" 
                           style="font-size: 16px; color: rgba(0, 116, 72, 0.6);">วันที่ยืม :</label>
                    <input type="date" class="form-control" id="startDate" 
                           style="padding: 10px; font-size: 16px; color: rgba(0, 0, 0, 0.6);">
                </div>

                <div class="col-sm-4" style="padding-right: 5px;">
                    <label for="endDate" class="font-weight-bold text-success" 
                           style="font-size: 16px; color: rgba(0, 116, 72, 0.6);">วันที่คืน :</label>
                    <input type="date" class="form-control" id="endDate" 
                           style="padding: 10px; font-size: 16px; color: rgba(0, 0, 0, 0.6);">
                </div>

                <div class="col-sm-4" style="padding-left: 5px;">
                    <label for="timeReturn" class="font-weight-bold text-success" 
                           style="font-size: 16px; color: rgba(0, 116, 72, 0.6);">เวลาคืน :</label>
                    <input type="time" class="form-control" id="timeReturn" 
                           style="padding: 10px; font-size: 16px; color: rgba(0, 0, 0, 0.6);">
                </div>
            </div>

            <!-- ปุ่มตกลง -->
            <div class="form-group" style="text-align: center; margin-top: 25px;">
                <button type="button" class="btn btn-success" id="agreeButton" style="padding: 10px 20px; font-size: 14px;">ตกลง</button>
            </div>
        </form>
    </div>

<!-- Modal -->

<div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="border-radius: 15px; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);">
        <div class="modal-header" style="background-color: #78C756; color: white; border-top-left-radius: 15px; border-top-right-radius: 15px; padding: 20px 30px;">
    <h5 class="modal-title" id="confirmationModalLabel" style="font-size: 20px; font-weight: 600; letter-spacing: 1px;">ข้อกำหนดและแนวปฏิบัติในการยืม-คืน พัสดุ/ครุภัณฑ์</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" 
        style="background-color: white; border: none; opacity: 0.8; transition: background-color 0.3s, opacity 0.3s;" 
        id="closeButton"
    >
</button>


</div>

            <div class="modal-body" style="font-size: 16px; color: #333; line-height: 1.6;">
    <p>กรุณายอมรับข้อกำหนดและแนวปฏิบัติในการยืม-คืน พัสดุ/ครุภัณฑ์ ก่อนทำการยืมอุปกรณ์</p>
    <ul class="list-group">
        <li class="list-group-item" style="font-size: 14px; border: none; padding: 10px 15px;">
            <strong>1. </strong> การยืมพัสดุ/ครุภัณฑ์ต้องระบุเหตุผลความจำเป็นที่ต้องการใช้งานทุกครั้ง และยืมเพื่อใช้ประโยชน์ในราชการเท่านั้น
        </li>
        <li class="list-group-item" style="font-size: 14px; border: none; padding: 10px 15px;">
            <strong>2. </strong> ผู้ยืมมีหน้าที่รับผิดชอบต่อพัสดุ/ครุภัณฑ์ ที่ได้ยืมเสมือนเป็นทรัพย์สินของผู้ยืมใช้เอง ไม่ให้เกิดความเสียหายหรือสูญหาย
        </li>
        <li class="list-group-item" style="font-size: 14px; border: none; padding: 10px 15px;">
            <strong>3. </strong> ผู้ยืมมีหน้าที่ชดใช้ความเสียหายในกรณีทรัพย์สินชำรุดหรือเสียหาย ผู้ยืมต้องซ่อมแซมให้คงสภาพเดิมโดยเสียค่าใช้จ่ายของตนเอง หรือชดใช้เป็นพัสดุครุณัฑ์ ประเภท ชนิด ขนาด ลักษณะ และคุณภาพต้องไม่น้อยกว่าเดิมหรือชดใช้เป็นเงินตามราคาที่เป็นอยู่ในขณะยืม ตามหลักเกณฑ์ที่กระทรวงการคลังกำหนด
        </li>
        <li class="list-group-item" style="font-size: 14px; border: none; padding: 10px 15px;">
            <strong>4. </strong> ผู้ยืมต้องไม่ให้ผู้อื่นยืมทรัพย์สินที่ตนเองได้ยืมมาไม่ว่ากรณีใดๆ เว้นแต่การยืมนั้นได้รับการอนุมัติเป็นลายลักษณ์อักษร จากผู้อำนาจอนุมติแล้วเท่านั้น
        </li>
        <li class="list-group-item" style="font-size: 14px; border: none; padding: 10px 15px;">
            <strong>5. </strong> ทรัพย์สินที่ผู้ยืมไปใช้งาน มีไว้ใช้เพื่อประโยชน์ของทางราชการเท่านั้น ห้ามมิให้ผู้ยืมนำพัสดุ/ครุภัณฑ์ ที่ยืมไปใช้อย่างอื่น นอกเหนือจากที่หน่วยงานกำหนดหรือทำให้เกิดความเสียหายที่เกิดจากการละเมิดดังกล่าวให้ถือเป็นความผิดส่วนบุคคล โดยผู้ยืมต้องรับผิดชอบต่อความเสียหายที่เกิดขึ้นนั้น
        </li>
        <li class="list-group-item" style="font-size: 14px; border: none; padding: 10px 15px;">
            <strong>6. </strong> ผู้ยืมจะต้องกำหนดระยะเวลาในการยืมให้ชัดเจน และต้องส่งคืนภายในระยะเวลาที่กำหนด
        </li>
        <li class="list-group-item" style="font-size: 14px; border: none; padding: 10px 15px;">
            <strong>7. </strong> กรณีมีความจำเป็นต้องใช้งานต่อ ให้ดำเนินการส่งคืนตามระยะเวลาที่กำหนดให้เรียบร้อยก่อน แล้วจึงขอยืมและกำหนดระยะเวลาใหม่ได้
        </li>
    </ul>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-secondary" data-bs-dismiss="modal" 
            style="border-radius: 8px; font-size: 16px; background-color: #FF0303; border: none; color: white;">
        ปิด
    </button>
    <button type="button" class="btn btn-primary" id="continueButton"
            style="border-radius: 8px; font-size: 16px; background-color: #78C756; border: none;">
        ดำเนินการต่อ
    </button>
</div>


<!-- Modal ยืนยัน -->
<div class="modal fade" id="confirmSaveModal" tabindex="-1" aria-labelledby="confirmSaveModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmSaveModalLabel">ยืนยันการบันทึก</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                คุณต้องการบันทึกข้อมูลนี้หรือไม่?
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" 
            style="border-radius: 8px; font-size: 16px; background-color: #FF0303; border: none; color: white;">
        ยกเลิก
    </button>
                <button type="button" class="btn btn-primary" id="saveButton" 
                        style="border-radius: 8px; font-size: 16px; background-color: #78C756; border: none;">
                    บันทึก
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    // เมื่อกด "ดำเนินการต่อ" ให้แสดง Modal ยืนยัน
    document.getElementById('continueButton').addEventListener('click', function () {
        const confirmSaveModal = new bootstrap.Modal(document.getElementById('confirmSaveModal'));
        confirmSaveModal.show();
    });

    // เมื่อกด "บันทึก" ใน Modal ยืนยัน
    document.getElementById('saveButton').addEventListener('click', function () {
        alert('ข้อมูลถูกบันทึกเรียบร้อยแล้ว!');

        // ปิด Modal ยืนยัน
        const confirmSaveModal = bootstrap.Modal.getInstance(document.getElementById('confirmSaveModal'));
        confirmSaveModal.hide();

        // เพิ่มโค้ดสำหรับการบันทึกข้อมูล เช่น การส่งข้อมูลไปยังเซิร์ฟเวอร์
        // Example:
        // fetch('/save-endpoint', {
        //     method: 'POST',
        //     body: JSON.stringify({ data: yourData }),
        // }).then(response => {
        //     if (response.ok) {
        //         console.log('บันทึกสำเร็จ');
        //     } else {
        //         console.log('บันทึกไม่สำเร็จ');
        //     }
        // });

        // นำผู้ใช้ไปที่หน้า homepages.php
        window.location.href = "homepages.php";
    });
</script>

        </div>
    </div>
</div>
        </div>
    </div>
</div>

<!-- Bootstrap JS (Optional for interactive components) -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>


<!-- Custom JS to trigger Modal -->
<script>
    // เมื่อกดปุ่ม "ตกลง"
    document.getElementById('agreeButton').addEventListener('click', function() {
        // เปิด Modal
        var myModal = new bootstrap.Modal(document.getElementById('confirmationModal'));
        myModal.show();
    });
</script>


           
        </div>
    </div>
</div>




</body>
</html>


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


<!-- Bootstrap JS (Optional for interactive components) -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>

<!-- Custom CSS -->
<style>
    /* ทำให้การ์ดมีขนาดเท่ากัน */
.card {
    height: 100%;
}

/* กำหนดรูปภาพให้มีขนาดคงที่ */
.card img {
    max-height: 150px;
    object-fit: cover;
}

    /* เปลี่ยนสีเมนูเมื่อ hover */
    .nav-link:hover {
        background-color: #005a3d; /* สีเข้มขึ้นเมื่อ hover */
        color: white;
        border-radius: 4px;
    }

    /* เปลี่ยนสีเมนูเมื่อ active */
    .nav-link.active {
        background-color: #00452c; /* สีเข้มสุดเมื่อคลิก */
        color: white;
        border-radius: 4px;
    }

    /* เพิ่มเงาให้เมนู */
    .nav-link, .btn {
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    /* ปรับรูปแบบของเมนูให้ดูทันสมัย */
    .nav-link, .btn {
        border-radius: 5px;
    }

    /* เพิ่มระยะห่างระหว่างเมนู */
    .nav-link {
        margin-bottom: 8px;
    }
</style>

</body>
</html>
