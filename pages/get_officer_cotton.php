<?php
include "../connect/myspl_das_satit.php";

if (isset($_POST['useripass'])) {
    $useripass = $_POST['useripass'];

    $sql = "SELECT officer_Cotton FROM borrow.officer_staff WHERE useripass = '$useripass'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo $row['officer_Cotton']; // ส่งค่าฝ่ายกลับไปยัง JavaScript
    } else {
        echo "";
    }

    $conn->close();
}
?>
