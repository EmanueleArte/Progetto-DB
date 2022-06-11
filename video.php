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
<body onload="onYouTubeIframeAPI()">

  <?php
    include("check_session.php");
    include("db.php");
  ?>

  <div class="container-fluid pt-3">
    <!-- BOTTONI STANDARD -->
    <div class="row justify-content-center">
      <button type="button" class="btn btn-outline-dark" onclick="location.href='home.php'">Home</button>
    </div>
    <div class="row justify-content-center pt-4">
      <div>
        <div class="row justify-content-center pb-3">
          <h2 class="titleText"><?php echo $_GET["titolo"]; ?></h2>
        </div>
        <div class="row justify-content-center pb-3">
          <div id="ytplayer" style="border-radius: 1rem"></div>
        </div>
        <div class="row ml-2">
          <?php
            // Controlla se è la prima visualizzazione per l'account attuale
            $primaVis=1;
            if ($_GET["time"]!=-1) {
              $primaVis=0;
            }
            // Numero visualizzazioni e like
            $sql="SELECT * FROM Video WHERE IdVideo=?";
            $query=$db->prepare($sql);
            $dati=array($_GET["id"]);
            $query->execute($dati);
            $ris=$query->fetchAll();
            foreach($ris as $row) {
              $vis=$row["NumeroVisualizzazioni"];
              if($primaVis) {
                $vis++;
              }
              // Ottenimento idLikes
              $sql="SELECT * FROM Playlists WHERE IdAccount=? AND TipoPlaylist=?";
              $query=$db->prepare($sql);
              $dati=array($_SESSION["loginID"], 2);
              $query->execute($dati);
              $risP=$query->fetchAll();
              $idLikes;
              foreach($risP as $rowP) {
                $idLikes=$rowP["IdPlaylist"];
              }
              // Controlla se il video è già tra i piaciuti
              $sql="SELECT * FROM Composizioni_playlists WHERE IdPlaylist=? AND IdVideo=?";
              $query=$db->prepare($sql);
              $dati=array($idLikes, $_GET["id"]);
              $query->execute($dati);
              $risV=$query->fetchAll();
              $classLike="";
              if (count($risV)>0) {
                $classLike="liked";
              }
              echo '<p class="">
                      <p id="nLike" class="'. $classLike .'">'. $row["NumeroLike"] .' <i class="fa fa-thumbs-up mr-3" onclick="addLike()"></i></p>
                      <p id="nVis">'. $vis .' <i class="fa fa-eye"></i></p>
                    </p>';
            }
          ?>
        </div>
      </div>
    </div>
  </div>

  <script type="text/javascript" id="www-widgetapi-script" src="https://s.ytimg.com/yts/jsbin/www-widgetapi-vflS50iB-/www-widgetapi.js" async=""></script>
  <script src="https://www.youtube.com/player_api"></script>
  <script src="js/functions.js"></script>
  <!-- js per bootstrap -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>
