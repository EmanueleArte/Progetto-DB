<?php
  include("check_session.php");
  include("db.php");

  // controllo parametri in POST
  if(isset($_POST["titolo"]) && isset($_POST["link"])) {
    if($_POST["titolo"]!="" && $_POST["link"]!="") {
        // inserimento post video nel DB
        $sql="INSERT INTO Video(Titolo, SorgenteVideo, IdAccount) VALUES (?,?,?)";
        $query=$db->prepare($sql);
        $dati=array($_POST["titolo"], $_POST["link"], $_SESSION["loginID"]);
        $ris=$query->execute($dati);
        header("location: home.php");
    } else {
      header("location: home.php");
    }
  } else {
    header("location: home.php");
  }
?>
