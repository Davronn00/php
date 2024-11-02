<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="index.php" method = "post">
        <input type = "text" name = "son">
        <input type = "submit" value = "start">
    </form>
</body>
</html>
<?php

$counter = $_POST["son"];
$marta = round((1+($counter - 90)/100),0);
for($t = 1; $t < $marta; $t++){
        echo $t. '<br>';
    };
for($i = 90; $i <= $counter; $i+=100){
    echo "bu son $marta marta chop etiladi <br> ";
}
?>