<!DOCTYPE html>
<html>
<head>
  <!-- meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- icona + titolo -->
  <link rel="icon" href="">
  <title>Sito streaming</title>
  <!-- fogli di stile esterni + bootstrap -->
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/custom_style.css">
</head>
<body>

  <?php
    include("check_session.php");
    include("db.php");
    include("check_canale.php");
  ?>

  <script>
    function confirmChannel() {
      let text = "La trasformazione di un account base a canale è irreversibile.\nContinuare?";
      if(confirm(text)==true) {
        location.href='attiva_canale.php';
      }
    }
  </script>

  <!-- Spazio info -->
  <div class="container-fluid pt-3">
    <!-- BOTTONI STANDARD -->
    <div class="row justify-content-center">
      <button type="button" class="btn btn-outline-dark" onclick="location.href='home.php'">Home</button>
    </div>
    <div id="infoDiv" class="row justify-content-center mt-4">
      <div class="col shadow p-3" style="border-radius: 10px 10px 10px 10px; margin: auto; max-width: 570px">
      <?php
        $canaleStr="No";
        if($canale) $canaleStr="Sì";
        foreach($ris as $row) {
          echo '<div class="mb-2">Username: '. $row["Username"] .'</div>
                <div class="mb-2">Mail: '. $row["Mail"] .'</div>
                <div class="mb-2">Canale: '. $canaleStr .'</div>';
          if($canale) {
            echo '<div class="mb-2">Numero iscritti: '. $row["NumeroIscritti"] .'</div>';
            echo '<button type="button" class="btn btn-outline-dark btn-sm mt-2 mb-2 mr-3" onclick="location.href=\'miei_video.php\'">Miei video</button>';
            echo '<button type="button" class="btn btn-outline-dark btn-sm mt-2 mb-2" onclick="location.href=\'miei_post.php\'">Miei post</button>';
          } else {
            echo '<button type="button" class="btn btn-outline-dark btn-sm mt-2 mb-2" onclick="confirmChannel()">Attiva canale</button>';
          }
        }
      ?>
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
