<?php

session_start();

if (isset($_POST['guess'])) {
  handle_guess();
}

if (isset($_POST['reset'])) {
  reset_scoreboard();
}

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
    if (!isset($_SESSION['correct_guesses'])) {
      $_SESSION['correct_guesses'] = 0;
    }
    if (!isset($_SESSION['incorrect_guesses'])) {
      $_SESSION['incorrect_guesses'] = 0;
    }
  }
}

function handle_guess() {
  if (isset($_POST['guess'])) {
    if (!in_array($_POST['guess'], $_SESSION['guesses'])) {
      if (stripos($_SESSION['word'], $_POST['guess']) === false) {
        $_SESSION['lives'] -= 1;
        $_SESSION['incorrect_guesses'] += 1;
      } else {
        $_SESSION['correct_guesses'] += 1;
      }

      array_push($_SESSION['guesses'], $_POST['guess']);
    } else {
      alert('You have already guessed the letter ' . $_POST['guess']);
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

function alert($message) {
  include './alert.php';
}

function reset_scoreboard() {
  $_SESSION['games_won'] = 0;
  $_SESSION['games_lost'] = 0;
  $_SESSION['correct_guesses'] = 0;
  $_SESSION['incorrect_guesses'] = 0;
  header('Location: hangman.php');
}

function calculate_rating() {
  $total_guesses = ($_SESSION['incorrect_guesses'] + $_SESSION['correct_guesses']);
  $grade = [
    [0.8, 'A', 'success'],
    [0.6, 'B', 'info'],
    [0.4, 'C', 'warning'],
    [0.2, 'D', 'danger'],
    [0.0, 'E', 'danger'],
  ];

  if ($total_guesses === 0) {
    return ['N/A', 'light'];
  }

  $percentage = $_SESSION['correct_guesses'] / $total_guesses;

  for ($i = 0; $i < count($grade); $i++) {
    if ($percentage >= $grade[$i][0]) {
      return [$grade[$i][1], $grade[$i][2]];
    }
  }
}
