<!DOCTYPE html>
<html>
<head>
  <!-- meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- icona + titolo -->
  <link rel="icon" href="">
  <title>Sito streaming - Crea playlist</title>
  <!-- fogli di stile esterni + bootstrap -->
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/custom_style.css">
</head>
<body>

  <?php
    include("check_session.php");
    include("db.php");
  ?>

  <div class="container-fluid pt-3">
    <!-- BOTTONI STANDARD -->
    <div class="row justify-content-center mb-3">
      <button type="button" class="btn btn-outline-dark" onclick="location.href='home.php'">Home</button>
    </div>
    <div class="row justify-content-center pb-3">
      <!-- TITOLO -->
      <h2 class="titleText">Creazione playlist</h2>
    </div>
    <div class="row justify-content-center">
      <!-- PLAYLIST -->
      <div class="col-4 pt-1">
        <form method="POST" class="row justify-content-center" action="create_playlist.php">
          <!-- TITOLO -->
          <div class="input-group pb-3">
            <input type="text" class="form-control" name="titolo" placeholder="Titolo playlist" required>
          </div>
          <!-- PLAYLIST PUBBLICA -->
          <div class="input-group custom-control custom-switch pb-3 ml-2">
            <input type="checkbox" class="custom-control-input" name="pubblica" id="pubblica" value="true">
            <label class="custom-control-label" id="pubblicaLabel" for="pubblica">Playlist pubblica</label>
          </div>
          <button class="btn btn-primary">Crea</button>
        </form>
      </div>
    </div>
  </div>

  <script src="js/functions.js"></script>
  
  <!-- js per bootstrap -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>
