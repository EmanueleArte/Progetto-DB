<?php
  include("check_session.php");
  include("db.php");

  // controllo parametri in POST
  header("home.php");
  if(isset($_POST["username"])) {
    if($_POST["username"]!="") {
      // cerco id account
      $sql="SELECT * FROM Accounts WHERE Username=".$_POST["username"];
      header($sql);
      $query=$db->prepare($sql);
      $ris=$query->execute();
      if($ris!=null){
        $id=$ris["idAccount"];
        $sql="SELECT * FROM Chats WHERE IdAccount1=? AND IdAccount2=?";
        $query=$db->prepare($sql);
        $dati=array($id, $_SESSION["loginID"]);
        $ris1=$query->execute($dati);
        $dati=array($_SESSION["loginID"], $id);
        $ris2=$query->execute($dati);
        if(count($ris1) == 1){
          //header("location: chat.php?chatID".$ris1["IdChat"]);
        } else if(count($ris2) == 1){
          //header("location: chat.php?chatID".$ris2["IdChat"]);
        } else{
          $sql="INSERT INTO Chats(IdAccount1, IdAccount2) VALUES (?,?)";
          $query=$db->prepare($sql);
          $dati=array($_SESSION["loginID"], $id);
          $query->execute($dati);
          /*$sql="SELECT LAST_INSERT_ID()";
          $query=$db->prepare($sql);
          $ris=$query->execute();
          header("location: chat.php?chatID=".$ris);*/
        }
      }
    }
  }
?>
