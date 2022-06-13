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

    if(!$canale) {
      header("Location: home.php");
    }
  ?>

  <div class="container-fluid pt-3">
    <!-- BOTTONI -->
    <div class="row justify-content-center">
      <button type="button" class="btn btn-outline-dark mr-3" onclick="location.href='info.php'">Info</button>
      <button type="button" class="btn btn-outline-dark" onclick="location.href='home.php'">Home</button>
    </div>
    <div class="row justify-content-center">
      <div class="col-10">
        <h2 class="titleText mt-3">Miei video</h2>
        <div id="mieiVideo" class="row">
        <?php
          // Dati del video
          $sql="SELECT * FROM Video WHERE IdAccount=?";
          $query=$db->prepare($sql);
          $dati=array($_SESSION["loginID"]);
          $query->execute($dati);
          $ris=$query->fetchAll();
          foreach($ris as $row) {
            // Dati eventuale visualizzazione del video da parte dell'utente attuale
            $sql="SELECT * FROM Video v, Visualizzazioni vis, Accounts a WHERE v.IdVideo=vis.IdVideo AND a.IdAccount=vis.IdAccount AND vis.IdAccount=? AND vis.IdVideo=?";
            $query=$db->prepare($sql);
            $dati=array($_SESSION["loginID"], $row["IdVideo"]);
            $query->execute($dati);
            $risVis=$query->fetchAll();
            $tempoVis=-1;
            $creator;
            foreach($risVis as $vis) {
              $tempoVis=$vis["TempoVisualizzazione"];
              $creator=$vis["Username"];
            }
            echo '<div class="card card-video m-3" style="width: 16rem;">
                    <div class="card-body card-video" onclick="location.href=\'video.php?id='. $row["IdVideo"] .'&titolo='. $row["Titolo"] .'&video='. $row["SorgenteVideo"] .'&time='. $tempoVis .'\'">
                      <h5 class="card-title card-video">'. $row["Titolo"] .'</h5>
                      <p class="card-text card-video">
                        <small class="text-muted">Pubblicato il: '. $row["DataPubblicazione"] .'<br>da: '. $creator .'</small><br>
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
