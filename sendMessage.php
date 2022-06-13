<?php
  include("check_session.php");
  include("db.php");

  // controllo parametri in POST
  if(isset($_POST["chatID"]) && isset($_POST["messageText"]) {
    if($_POST["chatID"]!="" && $_POST["messageText"]!="") {
      // Ottenimento idLikes
      $sql="SELECT * FROM Playlists WHERE IdAccount=? AND TipoPlaylist=?";
      $query=$db->prepare($sql);
      $dati=array($_SESSION["loginID"], 2);
      $query->execute($dati);
      $ris=$query->fetchAll();
      $idLikes;
      foreach($ris as $row) {
        $idLikes=$row["IdPlaylist"];
      }
      // Controlla se il video è già tra i piaciuti
      $sql="SELECT * FROM Composizioni_playlists WHERE IdPlaylist=? AND IdVideo=?";
      $query=$db->prepare($sql);
      $dati=array($idLikes, $_POST["idVideo"]);
      $query->execute($dati);
      $ris=$query->fetchAll();
      if (count($ris)>0) {
        // Eliminazione da video piaciuti
        $sql="DELETE FROM Composizioni_playlists WHERE IdPlaylist=? AND IdVideo=?";
        $query=$db->prepare($sql);
        $dati=array($idLikes, $_POST["idVideo"]);
        $query->execute($dati);
        // Decrementa NumeroLike
        $sql="UPDATE Video SET NumeroLike=NumeroLike-1 WHERE IdVideo=?";
        $query=$db->prepare($sql);
        $dati=array($_POST["idVideo"]);
        $query->execute($dati);
      } else {
        // Aggiunta a video piaciuti
        $sql="INSERT INTO Composizioni_playlists(IdPlaylist, IdVideo) VALUES (?,?)";
        $query=$db->prepare($sql);
        $dati=array($idLikes, $_POST["idVideo"]);
        $query->execute($dati);
        // Incrementa NumeroLike
        $sql="UPDATE Video SET NumeroLike=NumeroLike+1 WHERE IdVideo=?";
        $query=$db->prepare($sql);
        $dati=array($_POST["idVideo"]);
        $query->execute($dati);
      }
    }
  }
?>
