<?php
  include("check_session.php");
  include("db.php");

  // controllo parametri in POST
  if(isset($_POST["messageText"])) {
    if(isset($_POST["chatID"])) {
      if($_POST["chatID"]!="" && $_POST["messageText"]!="") {
        $sql="INSERT INTO Messaggi(TestoMessaggio, IdChat, IdAccount) VALUES (?,?,?)";
        $query=$db->prepare($sql);
        $dati=array($_POST["messageText"], $_POST["chatID"], $_SESSION["loginID"]);
        $query->execute($dati);
      }
    } else if(isset($_POST["groupID"])) {
      if($_POST["groupID"]!="" && $_POST["messageText"]!="") {
        $sql="INSERT INTO Messaggi(TestoMessaggio, IdGruppo, IdAccount) VALUES (?,?,?)";
        $query=$db->prepare($sql);
        $dati=array($_POST["messageText"], $_POST["groupID"], $_SESSION["loginID"]);
        $query->execute($dati);
      }
    }
  }
?>
