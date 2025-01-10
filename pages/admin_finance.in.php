<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin เพิ่มการเงิน</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="d-flex bg-light">
    <?php
    session_start();
    ?>
    <?php include 'sidebar.php'; ?>

    <div class="flex-grow-1 p-4">
        <?php include 'short.php'; ?>

        <div class="card shadow-sm border-0" style="margin-top: 49px;">
            <div class="card-header text-white"
                style="background-color:#537bb7; color: white; padding-top: 10px; padding-bottom: 10px;">
                <h4 class="mb-0" style="font-size: 22px;">ตั้งค่าการเงิน</h4>
            </div>
            <div class="p-5 bg-light border rounded shadow-sm mt-5 mx-auto" style="width: 650px; margin-bottom: 60px;">
                <h5 class="text-center mb-4">เพิ่มข้อมูลคิวอาร์โค้ด</h5>
                <form action="../connect/finance/insert.php" method="post" enctype="multipart/form-data"
                    id="equipmentForm">
                    <form action="../connect/officer/insert.php" method="POST"></form>
                    <div class="mb-4">
    <label for="fullname" class="font-weight-bold" style="font-size: 16px; color: black;">ชื่อ-นามสกุล:</label>
    <select class="form-select" name="useripass" required
        style="margin-top :5px; font-size: 16px; padding: 10px; border-radius: 5px; border: 1px solid #ced4da;">
        <option value="" selected disabled>กรุณาเลือกชื่อ-นามสกุล</option>

        <?php
        
        include "../connect/myspl_borrow"; // Include database connection file

        // Query to fetch officer data from the borrow.officer_staff table
        $sql = "SELECT * FROM borrow.officer_staff"; // Adjust table name and fields as needed
        $result = $conn->query($sql);
    
// ตรวจสอบการดึงข้อมูลจากฐานข้อมูล
if ($result->num_rows > 0) {
    // วนลูปแต่ละแถวในผลลัพธ์
    while ($row = $result->fetch_assoc()) {
        // ตรวจสอบข้อมูลของเจ้าหน้าที่แต่ละคน หากข้อมูลใดเป็น NULL หรือ EMPTY จะแสดงข้อความแทน
        $praname = isset($row['praname']) && !empty($row['praname']) ? htmlspecialchars($row['praname']) : 'ไม่ระบุ';
        $name = isset($row['name']) && !empty($row['name']) ? htmlspecialchars($row['name']) : 'ไม่ระบุ';
        $surname = isset($row['surname']) && !empty($row['surname']) ? htmlspecialchars($row['surname']) : 'ไม่ระบุ';

        // รวมชื่อ-นามสกุล
        $fullname = $praname . " " . $name . " " . $surname;
        ?>
        <option value="<?php echo htmlspecialchars($row['useripass']); ?>">
            <?php echo $fullname . ' (' . htmlspecialchars($row['useripass']) . ')'; ?>
        </option>
        <?php
    }
} else {
    // หากไม่มีข้อมูลจะแสดงข้อความว่าไม่มีข้อมูล
    echo "<option value=''>ไม่มีข้อมูล</option>";
}


        ?>
        
        
    </select>
</div>

</form>
                    <div class="form-group" style="margin-bottom: 15px;">
                        <label for="officerl_Id" style="margin-bottom: 7px; font-size: 16px; color: black;">ผู้รับผิดชอบ :</label>
                        <select class="form-select" name="cotton_Id" required
                            style="font-size: 14px; border-radius: 5px; padding: 10px; margin-top: 5px;">
                            <option value="" selected disabled>กรุณาเลือกผู้รับผิดชอบ</option>
                            <?php
                            include "../connect/mysql_borrow.php";
                            include "../connect/myspl_das_satit.php"; //ดึงไฟล์นี้เพื่อเชื่อมฐานข้อมูล
                            $sql = "SELECT * FROM borrow.cotton";
                            $result = $conn->query($sql);
                            
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    ?>
                                    <option value="<?php echo $row['cotton_Id'] ?>">
                                    <?php echo $row['cotton_Name'] ?> 
                                    </option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                    </div>

                    

                    <div class="form-group mb-4" style="margin-bottom: 15px;">
                        <label for="device_Image" style="margin-bottom: 7px; font-size: 16px; color: black;">รูปภาพ :</label>
                        <input type="file" class="form-control" id="device_Image" name="finance_Image"
                            accept="image/jpeg, image/png" style="font-size: 14px;">
                    </div>


                    <div class="text-center d-flex justify-content-center gap-3">
                        <button class="btn btn-danger"
                            style="font-size: 16px; padding: 10px 20px; border-radius: 5px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);"
                            onclick="window.history.back();">
                            <i class="bi bi-x-circle"></i> ยกเลิก
                        </button>

                        <button class="btn btn-success"
                            style="font-size: 16px; padding: 10px 20px; border-radius: 5px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);"
                            data-bs-toggle="modal" data-bs-target="#confirmModal">
                            <i class="bi bi-check-circle"></i> บันทึกข้อมูล
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
