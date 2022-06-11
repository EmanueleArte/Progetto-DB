<?php
  include("check_session.php");
  include("db.php");

  // controllo parametri in POST
  if(isset($_POST["titolo"]) && isset($_POST["testo"])) {
    if($_POST["titolo"]!="" && $_POST["testo"]!="") {
        // inserimento post scritto nel DB
        $sql="INSERT INTO Scritti(Titolo, TestoPost, IdAccount) VALUES (?,?,?)";
        $query=$db->prepare($sql);
        $dati=array($_POST["titolo"], $_POST["testo"], $_SESSION["loginID"]);
        $ris=$query->execute($dati);
        header("location: home.php");
    } else {
      header("location: home.php");
    }
  } else {
    header("location: home.php");
  }
?>
