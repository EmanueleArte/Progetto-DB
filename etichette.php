<!DOCTYPE html>
<html>
<head>
  <!-- meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- icona + titolo -->
  <link rel="icon" href="">
  <title>Sito streaming - Cerca Etichette</title>
  <!-- fogli di stile esterni + bootstrap -->
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/custom_style.css">
</head>
<body>

  <?php
    include("check_session.php");
    include("db.php");
  ?>

  <!-- spazio home -->
  <div class="container-fluid pt-3">
    <!-- intestazione (BOTTONI) -->
    <div class="row justify-content-center">
      <button type="button" class="btn btn-outline-dark mr-3" onclick="location.href='info.php'">Info</button>
      <button type="button" class="btn btn-outline-dark mr-3" onclick="location.href='home.php'">Home</button>
      <button type="button" class="btn btn-outline-dark mr-3" onclick="location.href='cronologia.php'">Cronologia</button>
      <button type="button" class="btn btn-outline-dark mr-3" onclick="location.href='video_piaciuti.php'">Video piaciuti</button>
      <button type="button" class="btn btn-outline-dark" onclick="location.href='logout.php'">Logout</button>
    </div>
    <div class="row justify-content-center">
      <div id="homePosts" class="col-10">
        <?php
          $sql="SELECT * FROM Etichette";
          $query=$db->prepare($sql);
          $query->execute();
          $ris=$query->fetchAll();
          echo '<div class="row ml-2 mt-4 justify-content-center"><p>';
          foreach($ris as $etichetta) {
            echo '<span onclick="location.href=\'etichette.php?etichetta='.$etichetta["NomeEtichetta"].'\'" class="badge badge-pill badge-success mr-1">'. $etichetta["NomeEtichetta"] .'</span>';
          }
          echo '</p></div>';
          if(isset($_GET["etichetta"])) {
            echo '<h2 class="titleText mt-3">Video con l\'etichetta '.$_GET["etichetta"].'</h2>
            <div class="row">';
            // Video per etichetta cliccata
            $sql="SELECT * FROM Categorizzazioni_Video cv, Etichette e, Video v, Accounts a WHERE a.IdAccount=v.IdAccount AND v.IdVideo=cv.IdVideo AND cv.IdEtichetta=e.IdEtichetta AND e.NomeEtichetta LIKE ?";
            $query=$db->prepare($sql);
            $dati=array("%".$_GET["etichetta"]."%");
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
              $creator=$row["Username"];
              foreach($risVis as $vis) {
                $tempoVis=$vis["TempoVisualizzazione"];
              }
              echo '<div class="card card-video m-3" style="width: 16rem;">
                      <div class="card-body card-video" onclick="cardOnClick(\''. $row["IdVideo"] .'\',\''. $row["Titolo"] .'\',\''. $row["SorgenteVideo"] .'\',\''. $tempoVis .'\',\''. $creator .'\')">
                        <h5 class="card-title card-video">'. $row["Titolo"] .'</h5>
                        <p class="card-text card-video">
                          <small class="text-muted">Pubblicato il: '. $row["DataPubblicazione"] .'<br>da:<button type="button" class="btn btn-outline-primary btn-sm mini">'. $creator .'</button></small><br>
                          '. $row["NumeroLike"] .' <i class="fa fa-thumbs-up mr-3"></i>
                          '. $row["NumeroVisualizzazioni"] .' <i class="fa fa-eye"></i>
                        </p>
                      </div>
                    </div>';
            }
          }else{
            echo '<h2 class="titleText mt-3">Seleziona un\'etichetta</h2>';
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