<div class="modal fade" id="reset-modal" tabindex="-1" aria-labelledby="reset-modal-Label" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="reset-modal-label">Caution</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Do you really want to reset the scoreboard?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Cancel</button>
        <form method="POST" action="./hangman.php">
          <button type="submit" class="btn btn-danger" name="reset">Reset scoreboard</button>
        </form>
      </div>
    </div>
  </div>
</div>