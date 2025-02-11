<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin เพิ่มการเงิน</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="d-flex bg-light">
    <?php
    
    include 'sidebar.php';
    ?>

    <div class="flex-grow-1 p-4">
        <?php include 'short.php'; ?>

        <div class="card shadow-sm border-0" style="margin-top: 49px;">
            <div class="card-header text-white" style="background-color:#537bb7; color: white; padding-top: 10px; padding-bottom: 10px;">
                <h4 class="mb-0" style="font-size: 22px;">ตั้งค่าการเงิน</h4>
            </div>

            <div class="p-5 bg-light border rounded shadow-sm mt-5 mx-auto" style="width: 650px; margin-bottom: 60px;">
                <h5 class="text-center mb-4">เพิ่มใบเสร็จ</h5>

               <!-- ฟอร์ม -->
               <form action="../connect/receipt/insert.php" method="post" enctype="multipart/form-data" id="equipmentForm">
               <?php
include "../connect/mysql_borrow.php";

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

<div class="mb-4">
    <label for="user_Id" class="font-weight-bold" style="font-size: 16px; color: black;">ชื่อ-นามสกุล:</label>
    <select id="user_Id" class="form-select" name="user_Id" required>
        <option value="" selected disabled>กรุณาเลือกชื่อ-นามสกุล</option>
        <?php
        $sql = "SELECT user_Id FROM satit_borrow.history_brs;
";
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<option value='" . $row['user_Id']  . "</option>";
            }
        } else {
            echo "<option value='' disabled>ไม่มีข้อมูล</option>";
        }

        $conn->close();
        ?>
    </select>
</div>


    <!-- รูปภาพ -->
    <div class="form-group mb-4">
        <label for="finance_Image" style="font-size: 16px; color: black;">รูปภาพ :</label>
        <input type="file" class="form-control" id="finance_Image" name="finance_Image" accept="image/jpeg, image/png" required>
    </div>

    <!-- ปุ่มบันทึก -->
    <div class="text-center d-flex justify-content-center gap-3">
        <button type="button" class="btn btn-danger" style="font-size: 16px; padding: 10px 20px; border-radius: 5px;" onclick="window.history.back();">
            <i class="bi bi-x-circle"></i> ยกเลิก
        </button>

        <button type="submit" class="btn btn-success" style="font-size: 16px; padding: 10px 20px; border-radius: 5px;">
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
