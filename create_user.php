<?php
include("database.php");

 // Hash the password using PHP's password_hash() function
 $password = password_hash("admin123", PASSWORD_DEFAULT);

 // Prepare and execute the SQL statement to insert the admin user
 $stmt = $conn->prepare("INSERT INTO users (username, password, is_admin) VALUES (?, ?, ?)");
 $stmt->bind_param("ssi", $username, $hashed_password, $is_admin);

 $username = 'admin';
 $hashed_password = $password;
 $is_admin = 1; // 1 represents TRUE for admin rights

     if ($stmt->execute()) {
         echo "Admin user 'admin' created successfully!";
     } else {
         echo "Error: " . $stmt->error;
     }
?>


