<?php
include "../mysql_borrow.php";
$useripass = $_REQUEST['useripass'];
$officer_Right = $_REQUEST['officer_Right'];

$sql = "INSERT INTO `officer_staff`(`useripass`, `officer_Right`) 
VALUES ('$useripass','$officer_Right')";

if ($conn->query($sql) === TRUE) {
  echo "location.href = '../../pages/admin_staffinfo.php'";

} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>