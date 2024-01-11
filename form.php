<div class="col-md-8 col-lg-6 letter-buttons">
  <?php
  foreach ($letter_map as $letter => $value) {
  ?>
    <button type="button" class="btn btn-<?php echo $value ? "primary" : "dark"; ?>
      letter-button" <?php echo $value ? "" : "disabled"; ?> id="<?php echo $letter; ?>">
      <?php echo $letter ?>
    </button>
  <?php
  }
  ?>
</div>