<?php
  include("check_session.php");
  include("db.php");

  // controllo parametri in POST
  if(isset($_POST["pubblica"])) {
    if($_POST["pubblica"]!="") {
      $sql="SELECT * FROM Playlists WHERE IdAccount=? AND TipoPlaylist=2";
      $query=$db->prepare($sql);
      $dati=array($_SESSION["loginID"]);
      $query->execute($dati);
      $ris=$query->fetchAll();
      foreach($ris as $row) {
        if($_POST["pubblica"]=="true") {
          // Rende video piaciuti privati
          $dati=array(1, $row["IdPlaylist"]);
        } else {
          // Rende video piaciuti pubblici
          $dati=array(0, $row["IdPlaylist"]);
        }
        $sql="UPDATE Playlists SET Pubblica=? WHERE IdPlaylist=?";
        $query=$db->prepare($sql);
        $query->execute($dati);
      }
    }
  }
?>
