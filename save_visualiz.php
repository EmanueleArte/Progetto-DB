<?php
  include("check_session.php");
  include("db.php");

  // controllo parametri in POST
  if(isset($_POST["idVideo"]) && isset($_POST["tempoVis"]) && isset($_POST["durata"])) {
    if($_POST["idVideo"]!="" && $_POST["tempoVis"]!="" && $_POST["durata"]!="") {
      $sql="SELECT * FROM Visualizzazioni WHERE IdAccount=? AND IdVideo=?";
      $query=$db->prepare($sql);
      $dati=array($_SESSION["loginID"], $_POST["idVideo"]);
      $query->execute($dati);
      $ris=$query->fetchAll();
      if (count($ris)>0) {
        if($_POST["durata"]-$_POST["tempoVis"]<3) {
          // Azzera tempo di visualizzazione perchè il video è finito
          $dati=array(0, $_SESSION["loginID"], $_POST["idVideo"]);
        } else {
          // Update tempo di visualizzazione
          $dati=array($_POST["tempoVis"], $_SESSION["loginID"], $_POST["idVideo"]);
        }
        $sql="UPDATE Visualizzazioni SET TempoVisualizzazione=? WHERE IdAccount=? AND IdVideo=?";
        $query=$db->prepare($sql);
        $query->execute($dati);
      } else {
        // Inserisce una nuova visualizzazione
        $sql="INSERT INTO Visualizzazioni(IdAccount, IdVideo, TempoVisualizzazione) VALUES (?,?,?)";
        $query=$db->prepare($sql);
        $dati=array($_SESSION["loginID"], $_POST["idVideo"], $_POST["tempoVis"]);
        $query->execute($dati);
        $sql="UPDATE Video SET NumeroVisualizzazioni=NumeroVisualizzazioni+1 WHERE IdVideo=?";
        $query=$db->prepare($sql);
        $dati=array($_POST["idVideo"]);
        $query->execute($dati);
        // Ottenimento idCronologia
        $sql="SELECT * FROM Playlists WHERE IdAccount=? AND TipoPlaylist=?";
        $query=$db->prepare($sql);
        $dati=array($_SESSION["loginID"], 1);
        $query->execute($dati);
        $ris=$query->fetchAll();
        $idCronologia;
        foreach($ris as $row) {
          $idCronologia=$row["IdPlaylist"];
        }
        // Aggiunta a cronologia
        $sql="INSERT INTO Composizioni_playlists(IdPlaylist, IdVideo) VALUES (?,?)";
        $query=$db->prepare($sql);
        $dati=array($idCronologia, $_POST["idVideo"]);
        $query->execute($dati);
      }
    }
  }
?>
