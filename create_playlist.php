<?php
  include("check_session.php");
  include("db.php");

  // controllo parametri in POST
  if(isset($_POST["titolo"])) {
    if($_POST["titolo"]!="") {
        $pubblica=0;
        if($_POST["pubblica"]=="true") {
          $pubblica=1;
        }
        // inserimento post scritto nel DB
        $sql="INSERT INTO Playlists(Pubblica, NomePlaylist, TipoPlaylist, IdAccount) VALUES (?,?,?,?)";
        $query=$db->prepare($sql);
        $dati=array($pubblica, $_POST["titolo"], 0, $_SESSION["loginID"]);
        $ris=$query->execute($dati);
        header("location: home.php");
    } else {
      header("location: home.php");
    }
  } else {
    header("location: home.php");
  }
?>
