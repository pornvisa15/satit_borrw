<?php
$servername = "localhost";
$username = "skyline694";
$password = "29012540";
$dbname = "das_satit";
// Create connection
$conn = new mysqli($servername, $username, $password ,$dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

?>