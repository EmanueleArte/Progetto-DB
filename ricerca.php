<?php
  include("check_session.php");
  include("db.php");

  // controllo parametri in POST
  if(isset($_POST["cerca"])) {
    if($_POST["cerca"]!="") {
      // Risultati ricerca canali
      $sql="SELECT * FROM Accounts WHERE Canale=1 AND Username LIKE ?";
      $query=$db->prepare($sql);
      $dati=array("%".$_POST["cerca"]."%");
      $query->execute($dati);
      $ris=$query->fetchAll();
      foreach($ris as $row) {
        echo $row["Username"];
      }
      // Risultati ricerca video
      $sql="SELECT * FROM Video WHERE Titolo LIKE ?";
      $query=$db->prepare($sql);
      $dati=array("%".$_POST["cerca"]."%");
      $query->execute($dati);
      $ris=$query->fetchAll();
      foreach($ris as $row) {
        echo $row["Titolo"];
      }
    }
  }
?>
