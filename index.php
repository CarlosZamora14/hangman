<?php
  session_start();

  if (!isset($_SESSION['word'])) {
    $words = file('words.txt');
    $word = $words[array_rand($words)];
    $word = strtoupper(rtrim($word));
    $_SESSION['word'] = $word;
    $_SESSION['guesses'] = [];
    $_SESSION['lives'] = 6;

    if (!isset($_SESSION['games_won'])) {
      $_SESSION['games_won'] = 0;
    }
    if (!isset($_SESSION['games_lost'])) {
      $_SESSION['games_lost'] = 0;
    }
  }

  if (isset($_POST['guess'])) {
    if (!in_array($_POST['guess'], $_SESSION['guesses'])) {
      if (stripos($_SESSION['word'], $_POST['guess']) === false) {
        $_SESSION['lives'] -= 1;
      }

      array_push($_SESSION['guesses'], $_POST['guess']);
    } else {
      echo 'You have already guessed the letter ' . $_POST['guess'];
    }
  }

  $word = $_SESSION['word'];
  $word_length = strlen($word);
  $guesses = $_SESSION['guesses'];

  $remaining_letters = array_diff(range('A', 'Z'), $guesses);

  for ($i = 0; $i < $word_length; $i++) {
    if (in_array($word[$i], $guesses)) {
      echo $word[$i];
    } else {
      echo '_';
    }

    echo ' ';
  }
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hangman</title>
  <style>
    body,
    input,
    select,
    button {
      font-family: 'Segoe UI', sans-serif;
    }
  </style>
</head>

<body>
  <form method="POST">
    <select name="guess">
      <?php
        foreach ($remaining_letters as $letter) {
          echo '<option value="' . $letter . '">' . $letter . '</option>';
        }
      ?>
    </select>
    <button type="submit" name="submit">Guess</button>
  </form>
</body>

</html>