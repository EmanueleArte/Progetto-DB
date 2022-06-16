<!DOCTYPE html>
<html>
<head>
  <!-- meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- icona + titolo -->
  <link rel="icon" href="">
  <title>Sito streaming - Info</title>
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
        // Dati base
        foreach($ris as $row) {
          echo '<div class="mb-2">Username: '. $row["Username"] .'</div>
                <div class="mb-2">Mail: '. $row["Mail"] .'</div>
                <div class="mb-2">Canale: '. $canaleStr .'</div>';
          if($canale) {
            echo '<div class="mb-2">Numero iscritti: '. $row["NumeroIscritti"] .'</div>';
            echo '<button type="button" class="btn btn-outline-dark btn-sm mt-2 mb-2 mr-3" onclick="location.href=\'miei_video.php\'">Miei video</button>';
            echo '<button type="button" class="btn btn-outline-dark btn-sm mt-2 mb-2 mr-3" onclick="location.href=\'miei_post.php\'">Miei post</button>';
          } else {
            echo '<button type="button" class="btn btn-outline-dark btn-sm mt-2 mb-2 mr-3" onclick="confirmChannel()">Attiva canale</button>';
          }
          echo '<button type="button" class="btn btn-outline-dark btn-sm mt-2 mb-2" onclick="location.href=\'mie_playlist.php\'">Mie playlist</button>';

          // Canale più simile a me per video piaciuti (se la playlist video piaciuti è pubblica)
          echo '<div>Account più simile a te per video piaciuti:';
          $sql="SELECT Username, Canale, count(a1.IdAccount) AS num FROM Accounts a1, Playlists p1, Composizioni_playlists c1 WHERE a1.IdAccount=p1.IdAccount AND p1.IdPlaylist=c1.IdPlaylist AND p1.Pubblica=1 AND p1.TipoPlaylist=2 
                AND a1.IdAccount!=? AND c1.IdVideo=ANY(SELECT c2.IdVideo FROM Playlists p2, Composizioni_playlists c2 WHERE p2.IdPlaylist=c2.IdPlaylist AND p2.TipoPlaylist=2 AND p2.IdAccount=?)
                GROUP BY a1.IdAccount ORDER BY num DESC LIMIT 1";
          $query=$db->prepare($sql);
          $dati=array($_SESSION["loginID"], $_SESSION["loginID"]);
          $query->execute($dati);
          $ris=$query->fetchAll();
          if(count($ris)==0) {
            echo '<p class="text-muted">Non ci sono account con i tuoi stessi interessi.</p>';
          }
          $pubbl="";
          foreach($ris as $row) {
            if($row["Canale"]) {
              echo '<div class="mt-2 mb-2"><button type="button" class="btn btn-outline-primary btn-sm" onclick="location.href=\'canale.php?canale='. $row["Username"] .'\'">'. $row["Username"] .'</button></div>';
            } else {
              echo '<div class="mt-2 mb-2"><button type="button" class="btn btn-outline-primary btn-sm">'. $row["Username"] .'</button></div>';
            }
          }
          echo '</div>';
          $sql="SELECT * FROM Playlists WHERE IdAccount=? AND TipoPlaylist=2";
          $query=$db->prepare($sql);
          $dati=array($_SESSION["loginID"]);
          $query->execute($dati);
          $ris=$query->fetchAll();
          foreach($ris as $row) {
            if($row["Pubblica"]) {
              $pubbl="checked";
            }
          }
          // Switch playlist likes pubblica
          echo '<div class="custom-control custom-switch mb-2">
                  <input type="checkbox" class="custom-control-input" id="likesSwitch" onclick="switchLikesPubbl()" '. $pubbl .'>
                  <label class="custom-control-label" id="likesSwitchLabel" for="likesSwitch">Playlist video piaciuti pubblica</label>
                </div>';
          
          // Canali seguiti
          echo '<div>Canali seguiti:<div>';
          $sql="SELECT * FROM Accounts a, Iscrizioni i WHERE a.IdAccount=i.IdCanale AND i.IdIscritto=?";
          $query=$db->prepare($sql);
          $dati=array($_SESSION["loginID"]);
          $query->execute($dati);
          $ris=$query->fetchAll();
          foreach($ris as $row) {
            echo '<button type="button" class="btn btn-outline-primary btn-sm mr-3 mt-2" onclick="location.href=\'canale.php?canale='. $row["Username"] .'\'">'. $row["Username"] .'</button>';
          }
          echo '</div></div>';
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
