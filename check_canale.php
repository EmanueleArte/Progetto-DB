<?php
  include("db.php");

  
  $sql="SELECT * FROM Accounts WHERE IdAccount=?";
  $query=$db->prepare($sql);
  $dati=array($_SESSION["loginID"]);
  $query->execute($dati);
  $ris=$query->fetchAll();
  $canale=0;
  // risultato query per IdAccount
  foreach($ris as $row) {
    $canale=$row["Canale"];
  }
      
?>
