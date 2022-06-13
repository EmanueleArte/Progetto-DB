<!DOCTYPE html>
<html>
<head>
  <!-- meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- icona + titolo -->
  <link rel="icon" href="">
  <title>Chat</title>
  <!-- fogli di stile esterni + bootstrap -->
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/custom_style.css">
</head>
<body>

  <?php
    include("check_session.php");
    include("db.php");
    #include("check_canale.php");
  ?>

  <!-- spazio home -->
  <div class="container-fluid pt-3">
    <!-- intestazione (BOTTONI) -->
    <div class="row justify-content-center">
      <button type="button" class="btn btn-outline-dark mr-3" onclick="location.href='home.php'">Home</button>
    </div>
    <div class="row justify-content-center">
      <div id="homePosts" class="col-10">
        <h2 class="titleText mt-3">Chat</h2>
        <div id="chat" class="row">
        <?php
          // Chat aperte
          $sql="SELECT * FROM Chats c WHERE c.IdAccount1=".$_SESSION["loginID"]." OR c.IdAccount2=".$_SESSION["loginID"];
          $query=$db->prepare($sql);
          $query->execute();
          $ris=$query->fetchAll();
          foreach($ris as $row) {
            if($row["IdAccount1"] == $_SESSION["loginID"]) {
                $altroId = $row["IdAccount2"];
            } else {
                $altroId = $row["IdAccount1"];
            }
            $sql="SELECT * FROM Accounts WHERE IdAccount=".$altroId;
            $query=$db->prepare($sql);
            $query->execute();
            $risAltro=$query->fetch();
            echo '<div class="card m-3" style="width: 16rem;">
                    <div class="card-body" onclick="location.href=\'chat.php?chatID='.$row["IdChat"].'\'">
                      <h5 class="card-title">Chat</h5>
                      <p class="card-text">
                        '.$risAltro["Username"].'
                      </p>
                    </div>
                  </div>';
          }
        ?>
        </div>
        <?php
          // Messaggi chat
          if(isset($_GET["chatID"])){
                $id=$_GET["chatID"];
                /*$sql="SELECT * FROM Accounts WHERE IdAccount=".$id;
                  $query=$db->prepare($sql);
                  $query->execute();
                  $ris=$query->fetch();*/
                echo '<h2 class="titleText mt-3"> Una Chat :)</h2>
                <div id="" class="row">';
                $sql="SELECT * FROM Messaggi WHERE IdChat=".$id." ORDER BY DataInvio";
                  $query=$db->prepare($sql);
                  $query->execute();
                  $ris=$query->fetchAll();
                  foreach($ris as $msg) {
                      echo '<div class="card m-3" style="width: 16rem;">
                        <div class="card-body">
                          <p class="card-text">
                            '.$msg["TestoMessaggio"].'
                          </p><br><small class="text-muted">'. $msg["DataInvio"] .'
                        </div>
                      </div>';
                  }
          }
          // Messaggi gruppo
          if(isset($_GET["groupID"])){
                $id=$_GET["groupID"];
          }
          
          /*foreach($ris as $row) {
            echo '<div class="card card-video m-3" style="width: 16rem;">
                    <div class="card-body card-video" onclick="location.href=\'video.php?id='. $row["IdVideo"] .'&titolo='. $row["Titolo"] .'&video='. $row["SorgenteVideo"] .'&time='. $tempoVis .'\'">
                      <h5 class="card-title card-video">'. $row["Titolo"] .'</h5>
                      <p class="card-text card-video">
                        <small class="text-muted">Pubblicato il: '. $row["DataPubblicazione"] .'<br>da:<button type="button" class="btn btn-outline-primary btn-sm mini" onclick="location.href=\'canale.php?canale='. $creator .'\'">'. $creator .'</button></small><br>
                        '. $row["NumeroLike"] .' <i class="fa fa-thumbs-up mr-3"></i>
                        '. $row["NumeroVisualizzazioni"] .' <i class="fa fa-eye"></i>
                      </p>
                    </div>
                  </div>';
          }*/
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
