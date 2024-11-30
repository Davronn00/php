
<?php

session_start();
include("database.php");

if (!isset($_SESSION['number']) || isset($_POST['new_game'])) {
    $_SESSION['number'] = str_pad(rand(0, 99999), 5, '0', STR_PAD_LEFT);
    $_SESSION['guesses'] = [];
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['guess'])) {
    $guess = $_POST['guess'];
    $number = $_SESSION['number'];
    $feedback = [];

    
    if (preg_match('/^\d{5}$/', $guess)) {
        
        for ($i = 0; $i < 5; $i++) {
            if ($guess[$i] === $number[$i]) {
                $feedback[$i] = "Digit {$guess[$i]} is correct and in the right place";
            } elseif (strpos($number, $guess[$i]) !== false) {
                $feedback[$i] = "Digit {$guess[$i]} is in the number but in the wrong place";
            } else {
                $feedback[$i] = "Digit {$guess[$i]} is not in the number";
            }
        }

        $_SESSION['guesses'][] = ['guess' => $guess, 'feedback' => $feedback];

       
        if ($guess === $number) {
            $feedback[] = "<br> Congratulations! <br> You've guessed the number: $number.";
            $_SESSION['win'] = true;
        }
    } else {
        $feedback[] = "Please enter a valid 5-digit number.";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>5-digit guessing game</title>
</head>
<body>
    
    <form method="post">
    <h1>5-digit guessing game</h1>
        <label for="guess">Enter your guess <br> (It should be 5 digits): </label>
        <button type = "submit" name= "Post_news">Click here to post news</button>   <input type= "submit" name = "Logout" value = "logout"><br><br>
        <input type="number" name="guess" id="guess" maxlength="5" oninput="this.value = this.value.slice(0, 5)">
        <button type="submit">Guess the number</button><br><br>
        
    </form><br>
    <?php
    if(isset($_POST["logout"])){
        header("Location: login.php");
    }
    ?>
    <?php
    if(isset($_POST["Post_news"])){
        header("Location: news.php");
    }
    ?>
    

    <div class="feedback">
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form method="post">
    <h1>5-digit guessing game</h1>
        <button type="submit" name="new_game" href="game.php?number=new">Start the new game</button>
        
    </form><br>
</body>
</html>
        <?php
        if (isset($feedback)) {
            foreach ($feedback as $message) {
                echo "<p>$message</p>";
            }
        }
        ?>
    </div>
    
    <div class="guesses">
        <h3>Your Guesses</h3>

        <ul>
            <?php
            if (isset($_SESSION['guesses'])) {
                foreach ($_SESSION['guesses'] as $entry) {
                    echo "<li><strong>Guess:</strong> {$entry['guess']} - ";
                    echo implode(", ", $entry['feedback']);
                    echo "</li>";
                }
            }
            ?>
        </ul>
    </div>
</body>
</html>

