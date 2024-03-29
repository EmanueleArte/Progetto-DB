<!DOCTYPE html>
<html>
<head>
  <!-- meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- icona + titolo -->
  <link rel="icon" href="">
  <title>Sito streaming - Canale</title>
  <!-- fogli di stile esterni + bootstrap -->
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/custom_style.css">
</head>
<body>

  <?php
    include("check_session.php");
    include("db.php");
    include("check_canale.php");

    if(!isset($_GET["canale"])) {
        header("Location: home.php");
    }
  ?>

  <!-- spazio home -->
  <div class="container-fluid pt-3">
    <!-- intestazione (BOTTONI) -->
    <div class="row justify-content-center">
      <?php
        echo '<button type="button" class="btn btn-outline-dark mr-3" onclick="location.href=\'chat.php?username='. $_GET["canale"] .'\'">Chat</button>';
      ?>
      <button type="button" class="btn btn-outline-dark" onclick="location.href='home.php'">Home</button>
    </div>
    <div class="row justify-content-center">
      <div class="col-10">
        <h1>Canale: <?php echo $_GET["canale"]; ?></h1>
        <h4>Iscritti: 
        <?php
          $idCanale;
          // Ottiene idCanale
          $sql="SELECT * FROM Accounts WHERE Username=?";
          $query=$db->prepare($sql);
          $dati=array($_GET["canale"]);
          $query->execute($dati);
          $ris=$query->fetchAll();
          foreach($ris as $row) {
            echo $row["NumeroIscritti"];
            $idCanale=$row["IdAccount"];
          }
          // Tasto iscrizione
          $sql="SELECT * FROM Iscrizioni i WHERE IdCanale=? AND IdIscritto=?";
          $query=$db->prepare($sql);
          $dati=array($idCanale, $_SESSION["loginID"]);
          $query->execute($dati);
          $ris=$query->fetchAll();
          if(count($ris)>0) {
            echo '<button type="button" class="btn btn-primary ml-4" onclick="location.href=\'iscrizione.php?canale='. $_GET["canale"] .'&iscrizione=0\'">Iscritto</button>';
          } else {
            if($row["IdAccount"]!=$_SESSION["loginID"]) {
              echo '<button type="button" class="btn btn-outline-primary ml-4" onclick="location.href=\'iscrizione.php?canale='. $_GET["canale"] .'&iscrizione=1\'">Iscriviti</button>';
            }
          }
          // Tasto per vedere video piaciuti, se pubblici
          $sql="SELECT * FROM Accounts a JOIN Playlists p ON a.IdAccount=p.IdAccount WHERE a.IdAccount=? AND p.Pubblica=1 AND p.TipoPlaylist=2";
          $query=$db->prepare($sql);
          $dati=array($idCanale);
          $query->execute($dati);
          $ris=$query->fetchAll();
          if(count($ris)>0) {
            echo '<button type="button" class="btn btn-outline-primary btn-sm ml-4" onclick="location.href=\'playlist.php?id='. $ris[0]["IdPlaylist"] .'&utente='. $_GET["canale"] .'&nome=Video piaciuti\'">Video piaciuti di '. $_GET["canale"] .'</button>';
          }
        ?>
        </h4>
        <h2 class="titleText mt-3">Post scritti</h2>
        <div class="row">
          <?php
          // Dati dei post
          $sql="SELECT * FROM Post_Scritti s, Accounts a WHERE a.IdAccount=s.IdAccount AND a.Username=? ORDER BY s.DataPubblicazione DESC";
          $query=$db->prepare($sql);
          $dati=array($_GET["canale"]);
          $query->execute($dati);
          $ris=$query->fetchAll();
          foreach($ris as $row) {
            echo '<div class="card m-3 card-post" style="width: 16rem;">
                    <div class="card-body card-post" onclick="location.href=\'post.php?postID='.$row["IdPost"].'\'">
                      <h5 class="card-title card-post">'. $row["Titolo"] .'</h5>
                      <p class="card-text card-post">
                        <small class="text-muted">Pubblicato il: '. $row["DataPubblicazione"] .'</small><br>
                        '. $row["TestoPost"] .'<br>
                      </p>
                    </div>
                  </div>';
          }
          ?>
        </div>
        <h2 class="titleText mt-3">Video</h2>
        <div id="postVideo" class="row">
          <?php
          // Dati del video
          $sql="SELECT * FROM Video v JOIN Accounts a ON v.IdAccount=a.IdAccount WHERE a.Username=? ORDER BY v.DataPubblicazione DESC";
          $query=$db->prepare($sql);
          $dati=array($_GET["canale"]);
          $query->execute($dati);
          $ris=$query->fetchAll();
          foreach($ris as $row) {
            // Dati eventuale visualizzazione del video da parte dell'utente attuale
            $sql="SELECT * FROM Video v, Visualizzazioni vis, Accounts a WHERE v.IdVideo=vis.IdVideo AND a.IdAccount=vis.IdAccount AND vis.IdAccount=? AND v.IdVideo=?";
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
                        <small class="text-muted">Pubblicato il: '. $row["DataPubblicazione"] .'</small><br>
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
