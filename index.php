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
      echo 'You have already guessed the letter ' . $_POST['guess'] . '<br>';
    }
  }

  $word = $_SESSION['word'];
  $guesses = $_SESSION['guesses'];
  $remaining_letters = array_diff(range('A', 'Z'), $guesses);

  if ($_SESSION['lives'] <= 0) {
    echo 'You have lost' . '<br>';
    echo 'The word was ' . $word . '<br>';
    $_SESSION['games_lost'] += 1;
    unset($_SESSION['word']);
  } else {
    $current_state_of_play = '';
    $word_length = strlen($word);

    for ($i = 0; $i < $word_length; $i++) {
      $current_state_of_play .= in_array($word[$i], $guesses) ? $word[$i] : '_';
      $current_state_of_play .= ' ';
    }

    $letters_left_to_guess = substr_count($current_state_of_play, '_');
    echo $current_state_of_play . '<br>';

    if ($letters_left_to_guess === 0) {
      echo 'You won!' . '<br>';
      $_SESSION['games_won'] += 1;
      unset($_SESSION['word']);
    }
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
  <?php
    if ($_SESSION['lives'] > 0 && $letters_left_to_guess > 0) {
  ?>
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
  <?php
    }
  ?>
</body>

</html>