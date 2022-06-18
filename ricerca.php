<!DOCTYPE html>
<html>
<head>
  <!-- meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- icona + titolo -->
  <link rel="icon" href="">
  <title>Sito streaming - Cerca</title>
  <!-- fogli di stile esterni + bootstrap -->
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/custom_style.css">
</head>
<body>

  <?php
    include("check_session.php");
    include("db.php");
    
    if(!isset($_POST["cerca"])) {
      header("Location: home.php");
    }
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
        <form method="POST" class="mt-2" style="width: 100%" action="ricerca.php">
          <!-- RICERCA -->
          <div class="row align-items-center justify-content-center">
            <div class="form-group col-7 mt-3">
              <input type="text" id="cerca" class="form-control" name="cerca" placeholder="Inserisci nome canale, titolo video o nome playlist" required>
            </div>
            <button id="bottoneCerca" class="btn btn-primary" value="">Cerca</button>
          </div>
        </form>
        <!-- CANALI -->
        <h2 class="titleText mt-3">Risultati ricerca canali</h2>
        <div id="" class="row">
        <?php
          // Dati dei canali cercati
          $sql="SELECT * FROM Accounts WHERE Canale=1 AND Username LIKE ?";
          $query=$db->prepare($sql);
          $dati=array("%".$_POST["cerca"]."%");
          $query->execute($dati);
          $ris=$query->fetchAll();
          foreach($ris as $row) {
            echo '<div class="card m-3" style="width: 16rem;">
                    <div class="card-body">
                      <h5 class="card-title">'. $row["Username"] .'</h5>
                      <p class="card-text">
                        <small class="text-muted">Canale: <button type="button" class="btn btn-outline-primary btn-sm mini" onclick="location.href=\'canale.php?canale='. $row["Username"] .'\'">'. $row["Username"] .'</button></small><br>
                        Iscritti: '. $row["NumeroIscritti"] .'<br>
                      </p>
                    </div>
                  </div>';
          }
        ?>
        </div>
        <!-- VIDEO -->
        <h2 class="titleText mt-3">Risultati ricerca video</h2>
        <div id="postVideo" class="row">
        <?php
          // Dati dei video cercati
          $sql="SELECT * FROM Video v JOIN Accounts a ON v.IdAccount=a.IdAccount WHERE Titolo LIKE ?";
          $query=$db->prepare($sql);
          $dati=array("%".$_POST["cerca"]."%");
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
        ?>
        </div>
        <!-- PLAYLIST PUBBLICHE -->
        <h2 class="titleText mt-3">Risultati ricerca playlist</h2>
        <div class="row">
        <?php
          // Dati delle playlist cercati
          $sql="SELECT *, (SELECT count(*) FROM Playlists p2 JOIN Composizioni_playlists c ON c.IdPlaylist=p2.IdPlaylist WHERE c.IdPlaylist=p.IdPlaylist) AS numVid 
                FROM Playlists p, Accounts a WHERE a.IdAccount=p.IdAccount AND p.TipoPlaylist=3 AND p.Pubblica=1 AND p.NomePlaylist LIKE ?";
          $query=$db->prepare($sql);
          $dati=array("%".$_POST["cerca"]."%");
          $query->execute($dati);
          $ris=$query->fetchAll();
          foreach($ris as $row) {
            $pubbl="No";
            if($row["Pubblica"]) $pubbl="Sì";
            echo '<div class="card m-3 card-playlist" style="width: 16rem;" onclick="cardOnClickPlaylist(\''. $row["IdPlaylist"] .'\',\''. $row["NomePlaylist"] .'\',\''. $row["Username"] .'\')">
                    <div class="card-body card-playlist">
                      <h5 class="card-title card-playlist">'. $row["NomePlaylist"] .'</h5>
                      <p class="card-text card-playlist">
                        <small class="text-muted">Di: '. $row["Username"] .'<br>Pubblica: '. $pubbl .'</small><br>
                        Numero video presenti: '. $row["numVid"] .'<br>
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