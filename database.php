<?php
    $db_server = "localhost";
    $db_user = "root";
    $db_pass = "";
    $db_name = "mysql";
    $conn = "";

    
try{$conn = mysqli_connect($db_server, 
    $db_user, 
    $db_pass, 
    $db_name);}
catch(mysqli_sql_exception){
    echo "Couldn't connect!<br>";
 }             
if($conn){
    echo "You're connected!<br>";
}
?>