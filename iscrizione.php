<?php
  include("check_session.php");
  include("db.php");

  // controllo parametri in POST
  if(isset($_GET["canale"]) && isset($_GET["iscrizione"])) {
    if($_GET["canale"]!="" && $_GET["iscrizione"]!="") {
      if($_GET["iscrizione"]=="0") {
        // Ottiene idCanale
        $sql="SELECT * FROM Accounts WHERE Username=?";
        $query=$db->prepare($sql);
        $dati=array($_GET["canale"]);
        $query->execute($dati);
        $ris=$query->fetchAll();
        $idCanale;
        foreach($ris as $row) {
          $idCanale=$row["IdAccount"];
        }
        // Elimina iscrizione
        $sql="DELETE FROM Iscrizioni WHERE IdCanale=? AND IdIscritto=?";
        $query=$db->prepare($sql);
        $dati=array($idCanale, $_SESSION["loginID"]);
        $query->execute($dati);
      } else {
        // Ottiene idCanale
        $sql="SELECT * FROM Accounts WHERE Username=?";
        $query=$db->prepare($sql);
        $dati=array($_GET["canale"]);
        $query->execute($dati);
        $ris=$query->fetchAll();
        $idCanale;
        foreach($ris as $row) {
          $idCanale=$row["IdAccount"];
        }
        // Inserisce un'iscrizione a un canale
        $sql="INSERT INTO Iscrizioni(IdCanale, IdIscritto) VALUES (?,?)";
        $query=$db->prepare($sql);
        $dati=array($idCanale, $_SESSION["loginID"]);
        $query->execute($dati);
      }
    }
  }
  header("Location: canale.php?canale=". $_GET["canale"]);
?>
