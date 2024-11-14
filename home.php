<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action = ($_SERVER["PHP_SELF"]) method = "POST">
        username: <br>
        <input type = "text" name = "username">
        <input type = "submit" name = "submit" value = "login">
    </form>
</body>
</html>
<?php
    foreach($_SERVER as $key => $value){
        echo "{$key} = {$value}<br>";
    }
?>