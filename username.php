<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=\, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="index.php" method = "post" >
    <label> Enter your username:</label> <br>
    <input type = "text" name = "username"><br>
    <label> Enter your password:</label><br>
    <input type = "text" name = "password"><br>
    <input type = "submit" name="login" value = "Log in"><br>

    </form>
</body>
</html>
<?php


if(isset($_POST["login"])){

    $username = $_POST["username"];
    $password = $_POST["password"];

    if(empty($username)){
        echo "enter the username";
    }
    
    elseif(empty($password)){
        echo "Password should not be empty";
    }
    else{
        echo "Welcome {$username}";
    }
    
    
}

?>