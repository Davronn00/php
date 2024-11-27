<?php
session_start();
include("database.php");

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$is_admin = $_SESSION['is_admin'];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['create_news'])) {
    $title = $_POST['title'];
    $content = $_POST['content'];

    $stmt = $conn->prepare("INSERT INTO news (author_id, title, content) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $user_id, $title, $content);
    $stmt->execute();
    echo "News created successfully.";
}

if ($is_admin && isset($_GET['delete'])) {
    $news_id = $_GET['delete'];
    $stmt = $conn->prepare("DELETE FROM news WHERE id = ?");
    $stmt->bind_param("i", $news_id);
    $stmt->execute();
    echo "News deleted.";
}

$news_result = $conn->query("SELECT * FROM news");

while ($news = $news_result->fetch_assoc()) {
    echo "<h3>{$news['title']}</h3>";
    echo "<p>{$news['content']}</p>";
    if ($is_admin || $news['author_id'] == $user_id) {
        echo "<a href='?delete={$news['id']}'>Delete</a>";
    }
    echo "<hr>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NEWS</title>
</head>
<body>
<form method="post">
    <label for="title">Title:</label>
    <input type="text" name="title" required>
    <label for="content">Content:</label>
    <textarea name="content" required></textarea>
    <input type="submit" name="create_news" value="Create News">
</form>

</body>
</html>