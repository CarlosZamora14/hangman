<?php

include "./header.php";

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
?>
  <div class="fs-3 fw-bold alert alert-danger text-center my-5" role="alert">
    <p>You have lost</p>
    <p>The word was <?php echo $word; ?></p>
    <a href="./hangman.php" class="btn btn-warning" role="button">Play again</a>
  </div>
<?php
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

?>
  <div class="container text-center mt-5 mb-3">
    <p class="state-of-play">
      <?php echo $current_state_of_play . '<br>'; ?>
    </p>
  </div>
  <?php

  if ($letters_left_to_guess === 0) {

  ?>
    <div class="fs-3 fw-bold alert alert-warning text-center mb-5" role="alert">
      <p>You won!</p>
      <a href="./hangman.php" class="btn btn-danger" role="button">Play again</a>
    </div>
<?php
    $_SESSION['games_won'] += 1;
    unset($_SESSION['word']);
  }
}
?>

<section class="container">
  <div class="row">
    <div class="col-md-6">

      <?php
      if ($_SESSION['lives'] > 0 && $letters_left_to_guess > 0) {
      ?>
        <div class="col">
          <form method="POST" class="row g-3 mb-3">
            <div class="col">
              <select class="form-select" name="guess" id="guess-select" aria-label="Choose a letter">
                <?php
                foreach ($remaining_letters as $letter) {
                  echo '<option value="' . $letter . '">' . $letter . '</option>';
                }
                ?>
              </select>
            </div>

            <div class="col-auto">
              <button type="submit" class="btn btn-primary">Guess</button>
            </div>
          </form>
        </div>
      <?php
      }
      ?>
      <div class="col mb-3">
        Canvas
      </div>
    </div>
    <div class="col-md-6">
      <ul class="list-group">
        <li class="list-group-item bg-primary">
          Scoreboard
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">
          Games won
          <span class="badge bg-primary rounded-pill">
            <?php echo $_SESSION['games_won']; ?>
          </span>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">
          Games lost
          <span class="badge bg-primary rounded-pill">
            <?php echo $_SESSION['games_lost']; ?>
          </span>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">
          Total games played
          <span class="badge bg-primary rounded-pill">
            <?php echo $_SESSION['games_won'] + $_SESSION['games_lost']; ?>
          </span>
        </li>
      </ul>
    </div>
  </div>

</section>
<?php

include "./footer.php";
