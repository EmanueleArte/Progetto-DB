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
  ?>

  <div class="container-fluid pt-3">
    <!-- intestazione -->
    <div class="row justify-content-center">
      <button type="button" class="btn btn-outline-dark" onclick="location.href='home.php'">Home</button>
    </div>
    <div class="row justify-content-center">
      <div class="col-10">
        <h2 class="titleText mt-3">Cronologia</h2>
        <div id="cronologia" class="row">
        <?php
          // Ottenimento idCronologia
          $sql="SELECT * FROM Playlists WHERE IdAccount=? AND TipoPlaylist=?";
          $query=$db->prepare($sql);
          $dati=array($_SESSION["loginID"], 1);
          $query->execute($dati);
          $ris=$query->fetchAll();
          $idCronologia;
          foreach($ris as $row) {
            $idCronologia=$row["IdPlaylist"];
          }
          // Ottenimento cronologia
          $sql="SELECT * FROM Video WHERE IdVideo IN (SELECT IdVideo FROM Composizioni_playlists WHERE IdPlaylist=?)";
          $query=$db->prepare($sql);
          $dati=array($idCronologia);
          $query->execute($dati);
          $ris=$query->fetchAll();
          foreach($ris as $row) {
            // Dati eventuale visualizzazione del video da parte dell'utente attuale
            $sql="SELECT * FROM Video v JOIN Visualizzazioni vis ON v.IdVideo=vis.IdVideo WHERE vis.IdAccount=? AND vis.IdVideo=?";
            $query=$db->prepare($sql);
            $dati=array($_SESSION["loginID"], $row["IdVideo"]);
            $query->execute($dati);
            $risVis=$query->fetchAll();
            $tempoVis=-1;
            foreach($risVis as $vis) {
              $tempoVis=$vis["TempoVisualizzazione"];
            }
            echo '<div class="card m-3" style="width: 18rem;">
                    <div class="card-body" onclick="location.href=\'video.php?id='. $row["IdVideo"] .'&titolo='. $row["Titolo"] .'&video='. $row["SorgenteVideo"] .'&time='. $tempoVis .'\'">
                      <h5 class="card-title">'. $row["Titolo"] .'</h5>
                      <p class="card-text">
                        '. $row["NumeroLike"] .' <i class="fa fa-thumbs-up mr-3"></i>
                        '. $row["NumeroVisualizzazioni"] .' <i class="fa fa-eye"></i>
                      </p>
                    </div>
                  </div>';
          }
        ?>
        </div>
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
