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