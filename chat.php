<!DOCTYPE html>
<html>
<head>
  <!-- meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- icona + titolo -->
  <link rel="icon" href="">
  <title>Sito streaming - Chat</title>
  <!-- fogli di stile esterni + bootstrap -->
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/custom_style.css">
</head>
<body style="overflow: hidden">

  <?php
    include("check_session.php");
    include("db.php");
    #include("check_canale.php");
  ?>

  <!-- spazio chat -->
  <div class="container-fluid pt-3 h-100">
    <!-- intestazione (BOTTONI) -->
    <div class="row justify-content-center">
      <button type="button" class="btn btn-outline-dark mr-3" onclick="location.href='home.php'">Home</button>
    </div>
    <div class="row justify-content-center h-100">
      <div id="chatLeft" class="col-3 float-left" style="overflow: auto; height:90%">
        <h2 class="titleText mt-3">Chat</h2>
        <div id="chats" class="column" style="overflow: auto">
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
            echo '<div class="card card-post m-3" style="width: 16rem;">
                    <div class="card-body card-post" onclick="location.href=\'chat.php?chatID='.$row["IdChat"].'\'">
                      <h5 class="card-title card-post">'.$risAltro["Username"].'</h5>
                    </div>
                  </div>';
          }
        ?>
          <div class="form-group mb-3 ml-3" style="width: 16rem;">
            <p class="ml-2">Inizia una nuova chat:</p>
            <input type="text" id="createChatText" class="form-control" onkeydown="new function(){
              if(event.key === 'Enter') window.location.href='chat.php?username='+document.getElementById('createChatText').value;
            }" placeholder="Username" required>
          </div>
        </div>
        <h2 class="titleText mt-3">Gruppi</h2>
        <div id="groups" class="column" style="overflow: auto">
        <?php
          // Gruppi
          $sql="SELECT * FROM Appartenenze_Gruppi WHERE IdAccount=".$_SESSION["loginID"];
          $query=$db->prepare($sql);
          $query->execute();
          $ris=$query->fetchAll();
          foreach($ris as $row) {
            $sql="SELECT * FROM Gruppi WHERE IdGruppo=".$row["IdGruppo"];
            $query=$db->prepare($sql);
            $query->execute();
            $risAltro=$query->fetch();
            echo '<div class="card card-post m-3" style="width: 16rem;">
                    <div class="card-body card-post" onclick="location.href=\'chat.php?groupID='.$row["IdGruppo"].'\'">
                      <h5 class="card-title card-post">'.$risAltro["NomeGruppo"].'</h5>
                    </div>
                  </div>';
            }
          echo '<button type="button" class="btn btn-primary ml-4" onclick="location.href=\'creazioneGruppo.php\'">Nuovo Gruppo</button>';
        ?>
        </div>
        </div>
        <div id="chatRight" class="container-fluid row col-9 float-right h-100 mb-3 pl-5 pr-5">
        <?php
          // Messaggi chat
          if(isset($_GET["chatID"])){
            $id=$_GET["chatID"];
            // Controllo appartenenza alla chat
            $sql="SELECT * FROM Chats WHERE IdChat=".$id;
            $query=$db->prepare($sql);
            $query->execute();
            $ris=$query->fetch();
            if($ris == null || ($_SESSION["loginID"] != $ris["IdAccount1"] && $_SESSION["loginID"] != $ris["IdAccount2"])){
              // Se l'id chat non esiste o l'account non ne fa parte
              echo '<h2 class="titleText mt-3">ID chat non valido</h2>';
            } else {
              // Se l'id chat � valido
              if($ris["IdAccount1"] == $_SESSION["loginID"]) {
                $altroId = $ris["IdAccount2"];
              } else {
                  $altroId = $ris["IdAccount1"];
              }
              // Cerco il nome dell'altro utente nella chat
              $sql="SELECT * FROM Accounts WHERE IdAccount=".$altroId;
              $query=$db->prepare($sql);
              $query->execute();
              $ris=$query->fetch();
              echo '<h2 class="titleText mt-3">'.$ris["Username"].'</h2>
                    <div id="messagesField" class="row w-100 pl-3 pr-3 pt-3" style="height: 69%; overflow: auto">';
              // Trovo i messaggi appartenenti alla chat
              $sql="SELECT * FROM Messaggi WHERE IdChat=".$id." ORDER BY DataInvio";
              $query=$db->prepare($sql);
              $query->execute();
              $ris=$query->fetchAll();
              foreach($ris as $msg) {
                if($msg["IdAccount"] != $_SESSION["loginID"]){
                  // Messaggio inviato dall'altro
                  echo '<div class="w-100">
                          <div class="card mb-2 w-auto" style="display:inline-block">
                            <div class="card-body w-auto">
                              <p class="card-text" style="display:inline-block">
                                '.$msg["TestoMessaggio"].'
                              </p><br>
                              <small class="text-muted">'. $msg["DataInvio"] .'</small>
                            </div>
                          </div>
                        </div>';
                } else {
                  // Messaggio inviato da s� stessi
                  echo '<div class="w-100">
                          <div class="card mb-2 w-auto float-right bg-light" style="display:inline-block">
                            <div class="card-body w-auto">
                              <p class="card-text float-right" style="display:inline-block; text-align:right">
                                '.$msg["TestoMessaggio"].'
                              </p><br>
                              <small class="text-muted float-right mb-3">'. $msg["DataInvio"] .'</small>
                            </div>
                          </div>
                        </div>';
                }
              }
              echo '</div>
                    <div class="form-group w-100 mb-3">
                      <input type="text" id="messageText" class="form-control" onkeydown="sendMessageChat()" placeholder="Scrivi un messaggio" required>
                    </div>';
            }
          }
          // Messaggi gruppo
          else if(isset($_GET["groupID"])){
            $idGruppo=$_GET["groupID"];
            // Controllo appartenenza al gruppo
            $sql="SELECT * FROM Gruppi WHERE IdGruppo=".$idGruppo;
            $query=$db->prepare($sql);
            $query->execute();
            $gruppo=$query->fetch();
            if($gruppo == null) {
              // Se l'id gruppo non esiste
              echo '<h2 class="titleText mt-3">ID gruppo non valido</h2>';
            } else {
              // Controllo se l'utente appartiene al gruppo
              $sql="SELECT * FROM Appartenenze_Gruppi WHERE IdAccount=".$_SESSION["loginID"]." AND IdGruppo=".$idGruppo;
              $query=$db->prepare($sql);
              $query->execute();
              $ris=$query->fetch();
              if($ris != null) {
                // Se l'id gruppo � valido
                echo '<h2 class="titleText mt-3">'.$gruppo["NomeGruppo"].'</h2>';
                // Trovo chi fa parte del gruppo
                $sql="SELECT * FROM Appartenenze_Gruppi ag, Accounts a WHERE a.IdAccount = ag.IdAccount AND ag.IdGruppo=".$idGruppo;
                $query=$db->prepare($sql);
                $query->execute();
                $ris=$query->fetchAll();
                echo '<div class="d-flex w-100" style="height: 3%">
                        <form method="POST" action="exit_group.php">
                          <input type="hidden" name="idGruppo" value="'. $gruppo["IdGruppo"] .'">
                          <button class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="right" title="Se esci dal gruppo non potrai rientrarci">Esci dal gruppo</button>
                        </form>
                      </div>';
                echo '<div class="d-flex w-100" style="height: 3%">Membri:&nbsp';
                foreach($ris as $key=>$row) {
                  echo '<span class="badge badge-pill badge-primary mr-1">'. $row["Username"] .'</span>';
                  /*echo '<p>'. $row["Username"];
                  if($key > -1) echo ',&nbsp';
                  echo '</p>';*/
                }
                echo '</div>
                      <div id="messagesField" class="row w-100 pl-3 pr-3 pt-3" style="height: 60%; overflow: auto">';
                // Trovo i messaggi appartenenti al gruppo
                $sql="SELECT * FROM Messaggi m, Accounts a WHERE a.IdAccount = m.IdAccount AND m.IdGruppo=".$idGruppo." ORDER BY m.DataInvio";
                $query=$db->prepare($sql);
                $query->execute();
                $ris=$query->fetchAll();
                foreach($ris as $msg) {
                  if($msg["IdAccount"] != $_SESSION["loginID"]){
                    // Messaggio inviato da altri
                    echo '<div class="w-100">
                            <div class="card mb-2 w-auto" style="display:inline-block">
                              <div class="card-body w-auto">
                                <small class="text-muted">'. $msg["Username"] .'</small><br>
                                <p class="card-text" style="display:inline-block">
                                  '.$msg["TestoMessaggio"].'
                                </p><br>
                                <small class="text-muted">'. $msg["DataInvio"] .'</small>
                              </div>
                            </div>
                          </div>';
                  } else {
                    // Messaggio inviato da s� stessi
                    echo '<div class="w-100">
                            <div class="card mb-2 w-auto float-right bg-light" style="display:inline-block; text-align:right">
                              <div class="card-body w-auto">
                                <p class="card-text float-right" style="display:inline-block text-align:center">
                                  '.$msg["TestoMessaggio"].'
                                </p><br>
                                <small class="text-muted float-right mb-3">'. $msg["DataInvio"] .'</small>
                              </div>
                            </div>
                          </div>';
                  }
                }
                echo '</div>
                      <div class="form-group w-100 mb-3">
                        <input type="text" id="messageText" class="form-control" onkeydown="sendMessageGroup()" placeholder="Scrivi un messaggio" required>
                      </div>';
              }
            }
          }
          // Creazione chat
          else if(isset($_GET["username"])){
            $sql="SELECT * FROM Accounts WHERE Username='".$_GET["username"]."'";
            $query=$db->prepare($sql);
            $query->execute();
            $ris=$query->fetch();
            if($ris!=null){
              $id=$ris["IdAccount"];
              $sql="SELECT * FROM Chats WHERE IdAccount1=? AND IdAccount2=?";
              $query=$db->prepare($sql);
              $dati=array($id, $_SESSION["loginID"]);
              $query->execute($dati);
              $ris1=$query->fetch();
              $dati=array($_SESSION["loginID"], $id);
              $query->execute($dati);
              $ris2=$query->fetch();
              if($ris1 != null && $ris1!=""){
                header("location: chat.php?chatID=".$ris1["IdChat"]);
              } else if($ris2 != null && $ris2!=""){
                header("location: chat.php?chatID=".$ris2["IdChat"]);
              } else if($id != $_SESSION["loginID"]){
                $sql="INSERT INTO Chats(IdAccount1, IdAccount2) VALUES (?,?)";
                $query=$db->prepare($sql);
                $dati=array($_SESSION["loginID"], $id);
                $query->execute($dati);
                $sql="SELECT LAST_INSERT_ID()";
                $query=$db->prepare($sql);
                $ris=$query->execute();
                header("location: chat.php?username=".$_GET["username"]);
              }
            }
          }
        ?>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="js/functions.js"></script>
  
  <!-- js per bootstrap -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
  <script>
    $(function () {
      $('[data-toggle="tooltip"]').tooltip()
    })
  </script>
</body>
</html>
