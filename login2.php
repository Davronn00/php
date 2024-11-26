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
   <form action = "<?php htmlspecialchars($_SERVER["PHP_SELF"])?>" method = "post">
   username: <br>
   <input type = "text" name = "username"><br>
   password:<br>
    <input type="password" name="password">
    <input type="submit" name = "submit" value = "login">
   </form> 
</body>
</html>

<?php
    if($_SERVER["REQUEST_METHOD"]== "POST"){
        $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
        $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);
        if(empty($username)){
            echo "Enter username!";
        
        }
        elseif(empty($password)){
            echo "Enter password!";
        }
        else{
            
            $sql = "INSERT INTO dgggdb (user, password)
                    VALUES ('$username','$password')";
                mysqli_query($conn, $sql);
                echo "You're registered";
            
        }
        mysqli_close($conn);
    }
?>
<?php
// Database connection
$sql = mysqli_connect("localhost", "root", 
"", "dgggdb"); // Replace with your credentials
if (!$sql) {
    die("Connection failed: " . mysqli_connect_error());
}

// Insert query
$username = 'test_user'; // Replace with user input
$password = 'test_password'; // Replace with user input
$query = "INSERT INTO users (username, password) VALUES ('$username', '$password')";

// Execute query
if (mysqli_query($sql, $query)) {
    echo "New record created successfully";
} else {
    echo "Error: " . mysqli_error($sql);
}

// Close connection
mysqli_close($sql);
?>
