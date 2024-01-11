  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <script src="./js/canvas.js"></script>
  <script>
    const tooltipList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
    tooltipList.forEach(elem => new bootstrap.Tooltip(elem));

    hangman(<?php echo $_SESSION['lives']; ?>);

    const buttons = document.querySelectorAll('.letter-button');
    buttons.forEach(btn => {
      btn.addEventListener('click', function() {
        const id = this.getAttribute('id');
        const formData = new FormData();
        formData.append('guess', id);

        fetch('/functions.php', {
          method: 'POST',
          body: formData,
        }).then(() => {
          window.location.reload();
        });
      });
    });
  </script>
</body>

</html>