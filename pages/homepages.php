<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>หน้าแรก</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>

<?php
session_start();
if($_SESSION['priv']== 1){
    ?>
    <div>บุคลากร</div>
<?php

}
elseif($_SESSION['priv']== 2){
?>

<div>นักเรียน</div>

<?php
}

elseif($_SESSION['priv']== 3){
    ?>

    <div>เจ้าหน้าที่</div>
    
    <?php
}
?>


    
</body>
</html>