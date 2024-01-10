<?php

include './header.php';
include './functions.php';

setup_game();
handle_guess();

$remaining_letters = array_diff(range('A', 'Z'), $_SESSION['guesses']);

if ($_SESSION['lives'] <= 0) {
  include './you_lost_message.php';
  $_SESSION['games_lost'] += 1;
  unset($_SESSION['word']);
} else {
  $letters_left_to_guess = current_state_of_play();

  if ($letters_left_to_guess === 0) {

    include './you_won_message.php';

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
        include './form.php';
      }
      ?>
      <div class="col mb-3 text-center">
        <canvas width="350" height="300" id="canvas"></canvas>
      </div>
    </div>
    <?php include './scoreboard.php'; ?>
  </div>

</section>
<?php

include './footer.php';
