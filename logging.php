<?php
session_start();
require 'essential.php';

$message = '';

if (isset($_POST['login'])) {
    $username = $_POST['user'];
    $password = $_POST['pass'];

    if (empty($username) || empty($password)) {
        $message = "Username and Password cannot be empty!";
    } else {
        try {
            $pdo = getDatabaseConnection();
            $stmt = $pdo->prepare("SELECT * FROM `user` WHERE name = :username");
            $stmt->execute(['username' => $username]);
            $user = $stmt->fetch();

            if ($user && password_verify($password, $user['pass'])) {
                // Secure session
                session_regenerate_id(true);

                $_SESSION['enter'] = true;
                $_SESSION['user'] = $user['name'];

                header("Location: Dashboard.php");
                exit();
            } else {
                $message = "Incorrect username or password!";
            }
        } catch (Exception $e) {
            $message = "An error occurred. Please try again later.";
            error_log($e->getMessage()); // Log the error for debugging
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <?php if (!empty($message)): ?>
        <p style="color: red;"><?php echo htmlspecialchars($message); ?></p>
    <?php endif; ?>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
        <input type="text" name="user" placeholder="Username" required><br>
        <input type="password" name="pass" placeholder="Password" required><br>
        <input type="submit" name="login" value="Login">
    </form>
</body>
</html>
