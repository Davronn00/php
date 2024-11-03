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
    <input type = "text" name = "username" value = "try"><br>
    <label> Enter your password:</label><br>
    <input type = "text" name = "Password"><br>
    <input type = "submit" name="Login" value = "Log in"><br>

    </form>
</body>
</html>
<?php
if($_POST["username"]){

    $username = $_POST["username"];
    $password = $_POST["password"];

    if(empty($username)){
        echo "enter the username";
    }
    elseif(isset($username)){
        echo "hello {$username}";
    }
    elseif(empty($password)){
        echo "password should not be empty";
 
    }
    else{
        echo "Welcome";
    }
    
    
}

?>