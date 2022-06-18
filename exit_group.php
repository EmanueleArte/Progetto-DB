<?php
  include("check_session.php");
  include("db.php");

  // controllo parametri in POST
  if(isset($_POST["idGruppo"])) {
    if($_POST["idGruppo"]!="") {
      // Uscita da un gruppo
      $sql="DELETE FROM Appartenenze_gruppi WHERE IdGruppo=? AND IdAccount=?";
      $query=$db->prepare($sql);
      $dati=array($_POST["idGruppo"], $_SESSION["loginID"]);
      $query->execute($dati);
      // Se il gruppo è vuoto lo elimino
      $sql="SELECT * FROM Appartenenze_gruppi WHERE IdGruppo=?";
      $query=$db->prepare($sql);
      $dati=array($_POST["idGruppo"]);
      $query->execute($dati);
      $ris=$query->fetchAll();
      if(count($ris)==0) {
        // Elimina messaggi del gruppo vuoto
        $sql="DELETE FROM Messaggi WHERE IdGruppo=?";
        $query=$db->prepare($sql);
        $dati=array($_POST["idGruppo"]);
        $query->execute($dati);
        // Elimina gruppo vuoto
        $sql="DELETE FROM Gruppi WHERE IdGruppo=?";
        $query=$db->prepare($sql);
        $dati=array($_POST["idGruppo"]);
        $query->execute($dati);
      }
    }
  }
  header("Location: chat.php");
?>
