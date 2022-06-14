<!DOCTYPE html>
<html>
<head>
  <!-- meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- icona + titolo -->
  <link rel="icon" href="">
  <title>Sito streaming - Video</title>
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
            $sql="SELECT * FROM Video v JOIN Accounts a ON v.IdAccount=a.IdAccount WHERE IdVideo=?";
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
              echo '<p>
                      <p class="text-muted mr-3">Pubblicato il: '. $row["DataPubblicazione"] .' da: <button type="button" class="btn btn-outline-primary btn-sm mini" onclick="location.href=\'canale.php?canale='. $row["Username"] .'\'">'. $row["Username"] .'</button><br></p>
                      <p id="nLike" class="'. $classLike .'">'. $row["NumeroLike"] .' <i class="fa fa-thumbs-up mr-3" onclick="addLikeVideo(\'nLike\')"></i></p>
                      <p id="nVis">'. $vis .' <i class="fa fa-eye"></i></p>
                    </p></div>';
              // Etichette video
              $sql="SELECT * FROM Etichette e JOIN Categorizzazioni_video c ON e.IdEtichetta=c.IdEtichetta WHERE c.IdVideo=?";
              $query=$db->prepare($sql);
              $dati=array($row["IdVideo"]);
              $query->execute($dati);
              $risC=$query->fetchAll();
              echo '<div class="row ml-2"><p>Etichette: ';
              foreach($risC as $etichetta) {
                echo '<span class="badge badge-pill badge-success mr-1">'. $etichetta["NomeEtichetta"] .'</span>';
              }
              echo '</p>';
            }
          ?>
        </div>
        <div>
        </div>
          <div class="form-group w-100">
            <input type="text" id="commentText" class="form-control" onkeydown="sendComment()" placeholder="Lascia un commento" required>
          </div>
          <div id='commentsField'>
            <?php
              $sql="SELECT * FROM Commenti c, Accounts a WHERE a.IdAccount=c.IdAccount AND c.IdVideo=".$_GET["id"];
              $query=$db->prepare($sql);
              $query->execute();
              $ris=$query->fetchAll();
              foreach($ris as $commento) {
                echo '<div class="w-100">
                        <div class="card m-2 w-auto">
                          <div class="card-body w-auto">
                            <h6 class="card-title">'.$commento["Username"].'</h6>
                            <p class="card-text">
                              '.$commento["TestoCommento"].'
                            </p><br>
                            <small class="text-muted">'. $commento["DataCommento"] .'</small>
                          </div>
                        </div>
                      </div>'
                ;
              }
            ?>
          </div>
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
