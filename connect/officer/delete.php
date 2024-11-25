<?php
include '../mysql_borrow.php';

$officerl_Id = $_REQUEST['officerl_Id'];
$sql = "DELETE FROM `officer_staff` WHERE officerl_Id = '$officerl_Id'";
if ($conn->query($sql) === TRUE) {
    echo "location.href = '../../pages/admin_staffinfo.php'";
  } else {
    echo "Error deleting record: " . $conn->error;
  }
  
  $conn->close();

?>