<?php

include './functions.php';
include './header.php';

setup_game();
handle_guess();

$remaining_letters = array_diff(range('A', 'Z'), $_SESSION['guesses']);
$letter_map = array_fill_keys(range('A', 'Z'), false);
foreach ($remaining_letters as $letter) {
  $letter_map[$letter] = true;
}

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
  <div class="row mx-0">
    <?php
    if ($_SESSION['lives'] > 0 && $letters_left_to_guess > 0) {
      include './form.php';
    }
    ?>
  </div>
  <div class="row g-5 mb-5 mx-0">
    <div class="col-md-6 text-center">
      <canvas width="350" height="300" id="canvas"></canvas>
    </div>
    <?php
    list($rating, $color) = calculate_rating();
    include './scoreboard.php';
    ?>
  </div>

</section>
<?php

include './footer.php';
