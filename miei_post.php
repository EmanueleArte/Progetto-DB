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

  <!-- spazio home -->
  <div class="container-fluid pt-3">
    <!-- intestazione (BOTTONI) -->
    <div class="row justify-content-center">
      <button type="button" class="btn btn-outline-dark mr-3" onclick="location.href='info.php'">Info</button>
      <button type="button" class="btn btn-outline-dark mr-3" onclick="location.href='home.php'">Home</button>
    </div>
    <div class="row justify-content-center">
      <div id="homePosts" class="col-10">
        <h2 class="titleText mt-3">Miei post scritti</h2>
        <div class="row">
        <?php
          // Dati dei post
          $sql="SELECT * FROM Scritti s, Accounts a WHERE a.IdAccount=s.IdAccount AND a.IdAccount=? ORDER BY DataPubblicazione DESC";
          $query=$db->prepare($sql);
          $dati=array($_SESSION["loginID"]);
          $query->execute($dati);
          $ris=$query->fetchAll();
          foreach($ris as $row) {
            echo '<div class="card m-3" style="width: 16rem;">
                    <div class="card-body">
                      <h5 class="card-title">'. $row["Titolo"] .'</h5>
                      <p class="card-text">
                        <small class="text-muted">Pubblicato il: '. $row["DataPubblicazione"] .'<br>da: '. $row["Username"] .'</small><br>
                        '. $row["TestoPost"] .'<br>
                        <!-- '. $row["NumeroLike"] .' <i class="fa fa-thumbs-up"></i> -->
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
