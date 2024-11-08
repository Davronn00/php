<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action = "index.php" method = "post">
        <label>Aylana radiusini kiriting:</label><br>
    <input type = "number" name = "Number"><br>
    <input type = "submit" value = "login"><br>
    </form>
</body>

</html>
<?php
    function hello($number): float{
        $yuza = $number*pi()*2;
        return $yuza;
    }
    
        $yuzaa = null;    
        $radius = $_POST["Number"];
        $yuzaa = hello($radius);
        echo "Aylana yuzasi {$yuzaa}ga teng";
    
?>