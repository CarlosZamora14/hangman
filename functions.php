<?php

function setup_game() {
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
}

function handle_guess() {
  if (isset($_POST['guess'])) {
    if (!in_array($_POST['guess'], $_SESSION['guesses'])) {
      if (stripos($_SESSION['word'], $_POST['guess']) === false) {
        $_SESSION['lives'] -= 1;
      }

      array_push($_SESSION['guesses'], $_POST['guess']);
    } else {
      include './repeated_letter.php';
    }
  }
}

function current_state_of_play() {
  $current_state_of_play = '';
  $word_length = strlen($_SESSION['word']);

  for ($i = 0; $i < $word_length; $i++) {
    $current_state_of_play .= in_array($_SESSION['word'][$i], $_SESSION['guesses']) ? $_SESSION['word'][$i] : '_';
    $current_state_of_play .= ' ';
  }

  include './state_of_play.php';
  return substr_count($current_state_of_play, '_');
}
