<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="login.php" method = "post">
        username:<br>
    <input type = "text" name= "username" placeholder = "Your neptun ID"><br>
        password:<br>
    <input type = "password" name="password" ><br>
    <input type = "submit" name="login" value="login"><br>
    </form>
</body>
</html>
<?php
    

    if(isset($_POST["login"])){
        include("database.php");
        $username = $_POST["username"];
        $password = $_POST["password"];
        $hash = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (user, password)
            VALUES ($username,$hash)";
        if(!empty($_POST["username"] && 
            !empty($_POST["password"]))){

        $_SESSION["username"]= $username;
        $_SESSION["password"]= $password;

        try{
            mysqli_query($conn, $sql);
            echo"user is now registered";
        }
        catch(mysqli_sql_exception){
            echo "couldn't register user";
        }
        header("Location: game.php"); 
        }
        else{
            echo "Username or password shouldn't be empty";
        
        }
    }

?>
