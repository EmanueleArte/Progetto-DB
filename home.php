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

  <!-- spazio home -->
  <div class="container-fluid pt-3">
    <!-- intestazione (BOTTONI) -->
    <div class="row justify-content-center">
      <?php 
        if($canale) {
          echo '<button type="button" class="btn btn-outline-dark mr-3" onclick="location.href=\'create_post.php\'">Crea nuovo post</button>';
        }
      ?>
      <button type="button" class="btn btn-outline-dark mr-3" onclick="location.href='info.php'">Info</button>
      <button type="button" class="btn btn-outline-dark mr-3" onclick="location.href='cronologia.php'">Cronologia</button>
      <button type="button" class="btn btn-outline-dark mr-3" onclick="location.href='video_piaciuti.php'">Video piaciuti</button>
      <button type="button" class="btn btn-outline-dark mr-3" onclick="location.href='logout.php'">Logout</button>
      <button type="button" class="btn btn-outline-dark" onclick="location.href='chat.php'">Chat</button>
    </div>
    <div class="row justify-content-center">
      <div id="homePosts" class="col-10">
        <form method="POST" class="mt-2" style="width: 100%" action="ricerca.php">
          <!-- RICERCA -->
          <div class="row align-items-center justify-content-center">
            <div class="form-group col-7 mt-3">
              <input type="text" id="cerca" class="form-control" name="cerca" placeholder="Inserisci nome canale o titolo video" required>
            </div>
            <button id="bottoneCerca" class="btn btn-primary" value="">Cerca</button>
          </div>
        </form>
        <!-- POST SCRITTI -->
        <h2 class="titleText mt-3">Post scritti</h2>
        <div id="postScritti" class="row">
        <?php
          // Dati dei post
          $sql="SELECT * FROM Post_Scritti s, Accounts a WHERE a.IdAccount=s.IdAccount ORDER BY DataPubblicazione DESC LIMIT 4";
          $query=$db->prepare($sql);
          $query->execute();
          $ris=$query->fetchAll();
          foreach($ris as $row) {
            echo '<div class="card m-3" style="width: 16rem;">
                    <div class="card-body">
                      <h5 class="card-title">'. $row["Titolo"] .'</h5>
                      <p class="card-text">
                        <small class="text-muted">Pubblicato il: '. $row["DataPubblicazione"] .'<br>da:<button type="button" class="btn btn-outline-primary btn-sm mini" onclick="location.href=\'canale.php?canale='. $row["Username"] .'\'">'. $row["Username"] .'</button></small><br>
                        '. $row["TestoPost"] .'<br>
                      </p>
                    </div>
                  </div>';
          }
        ?>
        </div>
        <!-- VIDEO -->
        <h2 class="titleText mt-3">Video</h2>
        <div id="postVideo" class="row">
        <?php
          // Dati del video
          $sql="SELECT * FROM Video v JOIN Accounts a ON v.IdAccount=a.IdAccount ORDER BY DataPubblicazione DESC LIMIT 12";
          $query=$db->prepare($sql);
          $query->execute();
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
              //$creator=$vis["Username"];
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
        ?>
        </div>
      </div>
    </div>
  </div>

  <script src="js/functions.js"></script>
  <script>
    function cardOnClick(id, titolo, video, time, creator) {
      if(event.target.tagName.toLowerCase() == "button"){
        location.href="canale.php?canale=" + creator;
      } else {
        location.href="video.php?id=" + id + "&titolo=" + titolo + "&video=" + video + "&time=" + time;
      }
    }
  </script>
  
  <!-- js per bootstrap -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>
