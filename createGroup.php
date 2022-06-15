<!DOCTYPE html>
<html>
  <?php
    include("check_session.php");
    include("db.php");

    // controllo parametri in POST
    if(isset($_POST["usernames"]) && isset($_POST["groupName"])) {
      if($_POST["groupName"]!="") {
        $usernames = explode(",", $_POST["usernames"]);
        $sql="SELECT * FROM Accounts WHERE IdAccount=".$_SESSION["loginID"];
        $query=$db->prepare($sql);
        $query->execute();
        $login=$query->fetch();
        foreach($usernames as $i=>$u) {
          $sql="SELECT * FROM Accounts WHERE Username='".$u."'";
          $query=$db->prepare($sql);
          $query->execute();
          $ris=$query->fetch();
          if($ris=="" || $ris["Username"] == $login["Username"]){
            unset($usernames[$i]);
          }
        }
        if(count($usernames) > 0){
          $sql="INSERT INTO Gruppi(NomeGruppo) VALUES (?)";
          $query=$db->prepare($sql);
          $dati=array($_POST["groupName"]);
          $query->execute($dati);
          $id=$db->lastInsertId();
          array_push($usernames, $login["Username"]);
          foreach($usernames as $u){
            $sql="SELECT * FROM Accounts WHERE Username='".$u."'";
            $query=$db->prepare($sql);
            $query->execute();
            $ris=$query->fetch();
            $sql="INSERT INTO Appartenenze_Gruppi(IdGruppo, IdAccount) VALUES (?,?)";
            $query=$db->prepare($sql);
            $dati=array($id, $ris["IdAccount"]);
            $query->execute($dati);
          }
          header("location: chat.php?groupID=".$id);
        }
        else header("location: chat.php");
      }
      else header("location: chat.php");
    }
    else header("location: chat.php");
  ?>
</html>
