<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin เพิ่มข้อมูลเจ้าหน้าที่</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body class="d-flex bg-light">
    <?php
    session_start();
    include 'sidebar.php';
    include '../connect/myspl_das_satit.php';
    include '../connect/mysql_borrow.php';

    // รับค่า device_Id จาก URL
    if (isset($_GET['finance_Id'])) {
        $finance_Id = $_GET['finance_Id'];

        // ดึงข้อมูลอุปกรณ์ที่ต้องการแก้ไข
        $sql = "SELECT * FROM borrow.finance
                INNER JOIN borrow.cotton ON finance.cotton_Id = cotton.cotton_Id 
                WHERE finance.finance_Id = '$finance_Id'";  
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            // กำหนดค่าตัวแปร
    
            $cotton_Id = $row['cotton_Id']; 
   
        } else {
            echo "ไม่พบข้อมูลอุปกรณ์ที่ต้องการแก้ไข";
            exit();
        }
    } else {
        echo "ข้อมูลไม่ถูกต้อง";
        exit();
    }
    ?>
 
    <div class="flex-grow-1 p-4">
    <?php include 'short.php'; ?>


        <div class="card shadow-sm border-0" style="margin-top: 49px;">
            <div class="card-header text-white" style="background-color:#537bb7; color: white; padding-top: 10px; padding-bottom: 10px;">
                <h4 class="mb-0" style="font-size: 22px;">ตั้งค่าการเงิน</h4>
            </div>

            <div class="p-5 bg-light border rounded shadow-sm mt-5 mx-auto" style="width: 650px; margin-bottom: 60px;">
                <h5 class="text-center mb-4">แก้ไขข้อมูลอุปกรณ์</h5>

                <form action="../connect/finance/update.php" method="post" enctype="multipart/form-data" onsubmit="return submitForm()">
    <input type="hidden" name="finance_Id" value="<?php echo $finance_Id; ?>">

    <div class="mb-4">
        <label for="cotton_Id" class="form-label" style="font-size: 16px; color: black;">ผู้รับผิดชอบ :</label>
        <select id="cotton_Id" name="cotton_Id" class="form-select">
            <option value="1" <?php echo ($cotton_Id == 1 ? 'selected' : ''); ?>>ฝ่ายคอมพิวเตอร์</option>
            <option value="2" <?php echo ($cotton_Id == 2 ? 'selected' : ''); ?>>ฝ่ายวิทยาศาสตร์</option>
            <option value="3" <?php echo ($cotton_Id == 3 ? 'selected' : ''); ?>>ฝ่ายดนตรี</option>
            <option value="4" <?php echo ($cotton_Id == 4 ? 'selected' : ''); ?>>ฝ่ายพัสดุ</option>
            <option value="5" <?php echo ($cotton_Id == 5 ? 'selected' : ''); ?>>ฝ่ายแอดมิน</option>
        </select>
    </div>

    <div class="mb-4">
        <label for="finance_Image" class="font-weight-bold" style="font-size: 16px; color: #333;">อัปโหลดไฟล์รูปภาพ:</label>
        <?php
        $finance_Image = isset($row['finance_Image']) ? $row['finance_Image'] : '';
        $filePath = "../connect/finance/finance/img/" . $finance_Image;
        ?>
        <div style="margin-top: 10px;">
            <?php if (!empty($finance_Image) && file_exists($filePath)) { ?>
                <img src="<?php echo htmlspecialchars($filePath); ?>" 
                     alt="Current Image" style="width: 100px; height: 100px; object-fit: cover; border-radius: 8px;">
                <p style="margin-top: 5px; color: #555;">ไฟล์เดิม: <strong><?php echo htmlspecialchars($finance_Image); ?></strong></p>
            <?php } else { ?>
                <p style="color: #888;">ไม่มีไฟล์รูปภาพเดิม</p>
            <?php } ?>
        </div>

        <input type="file" id="finance_Image" name="finance_Image" class="form-control" accept="image/*" style="margin-top: 10px;">
        <input type="hidden" name="finance_Image_hidden" value="<?php echo htmlspecialchars($finance_Image); ?>">
    </div>

    <div class="text-center d-flex justify-content-center gap-3">
        <button class="btn btn-success" type="submit">
            <i class="bi bi-check-circle"></i> บันทึกการแก้ไข
        </button>
    </div>
</form>

            </div>
        </div>
    </div>

    <script>
            <?php
    session_start();
    if (isset($_SESSION['message'])) {
        echo "<script>alert('" . $_SESSION['message'] . "');</script>";
        unset($_SESSION['message']); // ลบข้อความหลังจากแสดง
    }
    ?>

        function submitForm() {
            const deviceName = document.getElementById('device_Name').value;
            const devicePrice = document.getElementById('device_Price').value;
            if (deviceName === "" || devicePrice === "") {
                alert("กรุณากรอกข้อมูลให้ครบถ้วน");
                return false;
            }
            alert("บันทึกการแก้ไขเรียบร้อย");
            return true; // ส่งฟอร์มเมื่อทุกอย่างถูกต้อง
        }
    </script>
</body>

</html>
