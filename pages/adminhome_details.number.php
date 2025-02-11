<?php

include 'sidebar.php';
include '../connect/myspl_das_satit.php';
include '../connect/mysql_borrow.php';
include '../connect/mysql_borrow.php';


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin ข้อมูลเจ้าหน้าที่</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>
<body class="d-flex bg-light">
    <div class="flex-grow-1 p-4">
        <?php include 'short.php'; ?>

        <!-- การ์ดแสดงตาราง -->
      <!-- การ์ดแสดงตาราง -->
      <div class="card shadow-sm" style="margin-top: 60px;">



    <div class="card-header" style="background-color:#537bb7; color: white; padding-top: 10px; padding-bottom: 10px;">
        <h5 class="mb-0" style="font-size: 20px;">แก้ไขเลขบัญชีธนาคาร</h5>
    </div>

    <!-- เว้นระยะห่างขยับลง -->
    <div class="card-body mt-3"> 
        <table class="table table-bordered table-striped text-center" style="font-size: 14px;">
            <thead class="table-light">
                <tr>
                    <th>ธนาคาร</th>
                    <th>หมายเลขบัญชี</th>
                    <th>ชื่อบัญชี</th>
                    <th>รายละเอียดเพิ่มเติม</th>
                    <th>แก้ไข</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM satit_borrow.bank";
                $result = $conn->query($sql);

                if (!$result) {
                    die("Error in SQL: " . $conn->error);
                }

                if ($result->num_rows > 0) {
                    $i = 1;
                    while ($row = $result->fetch_assoc()) {
                        $bank_Id = htmlspecialchars($row['bank_Id']); // ✅ กำหนดค่าตัวแปรก่อนใช้งาน
                        
                        echo "<tr>";
                       
                        echo "<td>" . htmlspecialchars($row['bank_Name']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['account_Number']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['account_Name']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['bank_Details']) . "</td>";
                        echo "<td>
                                <a href='edit_bank.php?bank_Id=" . $bank_Id . "' class='btn btn-warning'>
                                    <i class='fas fa-edit'></i>
                                </a>
                              </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>ไม่มีข้อมูล</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>


        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
</body>
</html>
