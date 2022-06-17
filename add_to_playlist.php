<?php
  include("check_session.php");
  include("db.php");

  // controllo parametri in POST
  if(isset($_POST["idVideo"]) && isset($_POST["idPlaylist"])) {
    if($_POST["idVideo"]!="" && $_POST["idPlaylist"]!="") {
      // Aggiunge video a playlist
      $sql="INSERT INTO Composizioni_playlists(IdPlaylist, IdVideo) VALUES (?,?)";
      $query=$db->prepare($sql);
      $dati=array($_POST["idPlaylist"], $_POST["idVideo"]);
      $query->execute($dati);
    }
  }
  header("Location: home.php");
?>
