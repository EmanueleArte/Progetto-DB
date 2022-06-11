<?php
  include("check_session.php");
  include("db.php");

  
  $sql="UPDATE Accounts SET Canale=1, NumeroIscritti=0 WHERE IdAccount=?";
  $query=$db->prepare($sql);
  $dati=array($_SESSION["loginID"]);
  $query->execute($dati);
  header("location: info.php");
      
?>
