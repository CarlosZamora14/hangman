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