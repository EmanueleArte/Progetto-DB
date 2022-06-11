<?php
  include("check_session.php");
  include("db.php");

  // controllo parametri in POST
  if(isset($_POST["idPost"])) {
    if($_POST["idPost"]!="") {
      // Incrementa NumeroLike (ma lo fa sempre perchè non c'è la relazione tra account e post piaciuti)
      $sql="UPDATE Scritti SET NumeroLike=NumeroLike+1 WHERE IdPost=?";
      $query=$db->prepare($sql);
      $dati=array($_POST["idPost"]);
      $query->execute($dati);
    }
  }
?>
