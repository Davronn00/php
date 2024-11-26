<?php
session_start();
require 'essential.php';

if (!isset($_SESSION['enter'])) {
    header("Location:logging.php");
    exit();
}


$pdo = getDatabaseConnection();
$message = '';

if (isset($_POST['create'])) {
    $username = $_POST['user'];
    $password = $_POST['pass'];

    if (!empty($username) && !empty($password)) {
        $stmt = $pdo->prepare("INSERT INTO `user` (name, pass) VALUES (:username, :password)");
        if ($stmt->execute(['username' => $username, 'password' => $password])) {
            $message = "User created successfully.";
        } else {
            $message = "Error creating user.";
        }
    } else {
        $message = "Username and Password cannot be empty!";
    }
}

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $username = $_POST['user'];
    $password = $_POST['pass'];

    if (!empty($username) && !empty($password)) {
        $stmt = $pdo->prepare("UPDATE `user` SET name = :username, pass = :password WHERE id = :id");
        if ($stmt->execute(['username' => $username, 'password' => $password, 'id' => $id])) {
            $message = "User updated successfully.";
        } else {
            $message = "Error updating user.";
        }
    } else {
        $message = "Username and Password cannot be empty!";
    }
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $stmt = $pdo->prepare("DELETE FROM `user` WHERE id = :id");
    if ($stmt->execute(['id' => $id])) {
        $message = "User deleted successfully.";
    } else {
        $message = "Error deleting user.";
    }
}

$edit = false;
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $stmt = $pdo->prepare("SELECT * FROM `user` WHERE id = :id");
    $stmt->execute(['id' => $id]);
    $user = $stmt->fetch();
    $edit = true;
}
?>

<h2>Dashboard</h2>
<?php if ($message != ''): ?>
    <p style="color: blue;"><?php echo $message; ?></p>
<?php endif; ?>

<form method="POST" action="Dashboard.php">
    <input type="hidden" name="id" value="<?php echo $edit ? $user['id'] : ''; ?>">
    <input type="text" name="user" placeholder="Username" value="<?php echo $edit ? $user['name'] : ''; ?>" required><br>
    <input type="password" name="pass" placeholder="Password" value="<?php echo $edit ? $user['pass'] : ''; ?>" required><br>
    <input type="submit" name="<?php echo $edit ? 'update' : 'create'; ?>" value="<?php echo $edit ? 'Update User' : 'Create User'; ?>">
</form>

<table border='1'>
    <tr>
        <th>ID</th>
        <th>Username</th>
        <th>Password</th>
        <th>Actions</th>
    </tr>

    <?php
    $stmt = $pdo->query("SELECT * FROM `user`");
    while ($row = $stmt->fetch()) {
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['name'] . "</td>";
        echo "<td>" . $row['pass'] . "</td>";
        echo "<td>";
        echo "<a href='Dashboard.php?edit=" . $row['id'] . "'>Edit</a> | ";
        echo "<a href='Dashboard.php?delete=" . $row['id'] . "' onclick='return confirm(\"Are you sure?\")'>Delete</a>";
        echo "</td>";
        echo "</tr>";
    }
    ?>
</table>

<br><a href="logging.php?exit=on">Logout</a>
