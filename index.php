<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action = "index.php" method = "post">
        <input type = "radio" name="credit_card" value = "Visa"> Visa <br>
        <input type = "radio" name="credit_card " value = "Master card"> Master card <br>
        <input type = "radio" name = "credit_card" value = "American express"> American express <br>
        <input type = "submit" name = "confirm" value ="confirm"> <br><br>
    </form>
</body>
</html>
<?php
    if(isset($_POST["confirm"])){

        $credit_card = null;
        
        if(isset($_POST["credit_card"])){

            $credit_card = $_POST["credit_card"];
        }
        switch($credit_card){
            case "Visa";
                echo "You choose the Visa";
                break;
            case "Master card";
                echo "You choose the Master card";
                break;
            case "American express";
                echo "You choose the American express";
                break;
            default:
                echo "You didn't choose the card";
                break;
        }

        
    }