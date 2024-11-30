<?php
session_start();
include("database.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="create_user.php" method="post"><br>
        <input type="text" name="username" required><br>
        <input type="password" name="password" required><br>
        <input type="submit" name="register" value="Register"><br>
        <a href="login.php" >Go back to login page</a><br>
    </form>
</body>
</html>
<?php



$username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING) ?? '';
$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING) ?? '';

 // Hash the password using PHP's password_hash() function
 $hashed_password = password_hash($password, PASSWORD_DEFAULT);

 // Prepare and execute the SQL statement to insert the admin user
 $stmt = $conn->prepare("INSERT INTO users (username, password, is_admin) VALUES (?, ?, ?)");
 $stmt->bind_param("ssi", $username, $hashed_password, $is_admin);



 try {if ($stmt->execute()) {
         echo " User created successfully";
     } else {
         echo "Error: " . $stmt->error;
     }
    }
    catch(mysqli_sql_exception){
        echo "";
    }
?>



