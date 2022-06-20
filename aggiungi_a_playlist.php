<!DOCTYPE html>
<html>
<head>
  <!-- meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- icona + titolo -->
  <link rel="icon" href="">
  <title>Sito streaming - Aggiungi a playlist</title>
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
      <h2 class="titleText">Aggiunta di <?php echo $_GET["titolo"]; ?> a playlist</h2>
    </div>
    <div class="row justify-content-center">
      <div class="col-4 pt-1">
        <form method="POST" class="row justify-content-center" action="add_to_playlist.php">
          <?php
            echo '<input type="hidden" name="idVideo" value="'. $_GET["id"] .'">';
          ?>
          <!-- SCELTA PLAYLIST -->
          <div class="input-group pb-3 pt-1" id="etichette">
            <select class="custom-select" id="select" name="idPlaylist">
              <option value="-1" selected>Scegli...</option>
              <?php
                // Ottengo playlist dell'utente
                $sql="SELECT * FROM Playlists WHERE IdAccount=? AND TipoPlaylist=0";
                $query=$db->prepare($sql);
                $dati=array($_SESSION["loginID"]);
                $query->execute($dati);
                $ris=$query->fetchAll();
                foreach($ris as $row) {
                  $pubblica="privata";
                  if($row["Pubblica"]) {
                    $pubblica="pubblica";
                  }
                  echo '<option value="'. $row["IdPlaylist"] .'">'. $row["NomePlaylist"] .' - '. $pubblica .'</option>';
                }
              ?>
            </select>
          </div>
          <button class="btn btn-primary">Aggiungi</button>
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
