<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <FORM NAME="form1" method="POST" action="index.php">
        <INPUT type="text" name="number" placeholder="Enter your guess">
        <INPUT type="submit" name="submit" value="TRY">
        <button type="submit" name="new_game">New Game</button><br>
    </FORM>
</body>
</html>
<?php
session_start();  // Start the session to store and manage game data

// Check if a random number hasn't been generated or if the user wants to start a new game
if (!isset($_SESSION['number']) || (isset($_GET['number']) && $_GET['number'] == 'new')) {
    $_SESSION['number'] = rand(0, 100);  // Generate a random number between 0 and 100
    $_SESSION['try'] = 0;  // Reset the number of tries
    $_SESSION['tries'] = array();  // Initialize an array to store the user's guesses
    $_SESSION['done'] = false;  // Game status: not yet won
}

// Check if the form has been submitted (user has made a guess)
if (isset($_POST['submit'])) {
    $_SESSION['tries'][] = $_POST['number'];  // Add the guessed number to the tries array
    $_SESSION['try']++;  // Increment the try counter

    // Compare the guessed number with the randomly generated number
    if ($_POST['number'] < $_SESSION['number']) {
        echo 'The number is bigger than: ' . $_POST['number'] . '<br>';
    } else if ($_POST['number'] > $_SESSION['number']) {
        echo 'The number is lower than: ' . $_POST['number'] . '<br>';
    } else {
        echo 'You got it! The number is: ' . $_SESSION['number'] . '<br>';  // Correct guess
        $_SESSION['done'] = true;  // Mark the game as completed
    }

    // Display the number of attempts the user has made
    echo 'Number of tries: ' . $_SESSION['try'] . '<br>';
}

// Check if the 'tries' session variable is set and is an array before using it
if (isset($_SESSION['tries']) && is_array($_SESSION['tries'])) {
    foreach ($_SESSION['tries'] as $k => $v) {
        echo ($k + 1) . ' --> ' . $v . '<br>';  // Output each guess with its attempt number
    }
} else {
    echo 'No tries yet.<br>';  // Display a message if there are no previous tries
}

// Provide a link to start a new game by generating a new random number
echo "<br> Congratulations! <BR> You've guessed the number";

// Check if the 'done' session variable is set before using it
if (!isset($_SESSION['done']) || !$_SESSION['done']) {
    echo 'The last number was ';
}
?>