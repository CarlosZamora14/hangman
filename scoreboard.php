<div class="col-md-6">
  <ul class="list-group">
    <li class="list-group-item bg-primary">
      Scoreboard
    </li>
    <li class="list-group-item d-flex justify-content-between align-items-center">
      Correct guesses
      <span class="badge bg-primary rounded-pill">
        <?php echo $_SESSION['correct_guesses']; ?>
      </span>
    <li class="list-group-item d-flex justify-content-between align-items-center">
      Incorrect guesses
      <span class="badge bg-primary rounded-pill">
        <?php echo $_SESSION['incorrect_guesses']; ?>
      </span>
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
    <li class="list-group-item d-flex align-items-center justify-content-between">
      <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#reset-modal">
        Reset scoreboard
      </button>

      <div class="btn btn-outline-<?php echo $color; ?>" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Your rating is calculated based on your percentage of correct guesses">
        Rating: <?php echo $rating; ?>
      </div>
    </li>
  </ul>
</div>
<?php include './reset_modal.php'; ?>