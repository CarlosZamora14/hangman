<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hangman</title>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
    }
  </style>
</head>

<body>
</body>

</html>

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

$word = $_SESSION['word'];
$word_length = strlen($word);
$guesses = $_SESSION['guesses'];

for ($i = 0; $i < $word_length; $i++) {
  if (in_array($word[$i], $guesses)) {
    echo $word[$i];
  } else {
    echo '_';
  }

  echo ' ';
}
?>