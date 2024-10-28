<?php
session_start();


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
    <title><br>5-digit guessing game</title>
</head>
<body>
    <h1><br>5-digit guessing game</h1>
    <form method="post">
        <label for="guess">Enter your guess <br> (It should be 5 digits): </label><br><br>
        <input type="number" name="guess" id="guess" maxlength="5" oninput="this.value = this.value.slice(0, 5)">
        <button type="submit">Guess the number</button><br><br>
        <button type="submit" name="new_game" href="game.php?number=new">Clean and start the new game</button>
        
    </form><br>
   
    

    <div class="feedback">
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
