<!DOCTYPE html>
<html>
<head>
  <!-- meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- icona + titolo -->
  <link rel="icon" href="">
  <title>Sito streaming - Post</title>
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
    <!-- BOTTONI STANDARD -->
    <div class="row justify-content-center mb-1">
      <button type="button" class="btn btn-outline-dark" onclick="location.href='home.php'">Home</button>
    </div>
    <div class="row justify-content-center pt-4 w-100">
      <!--div class="row justify-content-center pb-3">
        <h2 class="titleText"></h2>
      </div-->
      <div class="row justify-content-center pb-4 w-75">
        <div class="card w-100">
          <div class="card-body w-100">
            <?php
              $sql="SELECT * FROM Post_scritti ps, Accounts a WHERE a.IdAccount=ps.IdAccount AND ps.IdPost=".$_GET["postID"];
              $query=$db->prepare($sql);
              $query->execute();
              $ris=$query->fetch();
              echo '<h2 class="card-title">'.$ris["Titolo"].'</h2>
                    <p class="card-text">
                      <small class="text-muted">Pubblicato il: '. $ris["DataPubblicazione"] .'&nbspda:<button type="button" class="btn btn-outline-primary btn-sm mini" onclick="location.href=\'canale.php?canale='. $ris["Username"] .'\'">'. $ris["Username"] .'</button></small><br>
                      '. $ris["TestoPost"] .'<br>
                    </p>';
            ?>
          </div>
        </div>
      </div>
      <div class="w-75">
        <div class="form-group w-80">
          <input type="text" id="commentText" class="form-control" onkeydown="sendPostComment()" placeholder="Lascia un commento" required>
        </div>
        <div id='commentsField'>
          <?php
            $sql="SELECT * FROM Commenti c, Accounts a WHERE a.IdAccount=c.IdAccount AND c.IdPost=".$_GET["postID"];
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
                          </p>
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

  <script src="js/functions.js"></script>
  <!-- js per bootstrap -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>
