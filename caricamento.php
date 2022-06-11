<?php
  session_start();
  include("db.php");

  // controllo parametri in POST
  if(isset($_POST["username"]) && isset($_POST["password"])) {
    if($_POST["username"]!="" && $_POST["password"]!="") {
      //$sql="SELECT * FROM Accounts WHERE Username='" . $_POST["username"] . "'";
      //$ris=$db->query($sql);
      $sql="SELECT * FROM Accounts WHERE Username=?";
      $query=$db->prepare($sql);
      $dati=array($_POST["username"]);
      $query->execute($dati);
      $ris=$query->fetchAll();
      $account;
      // risultato query per username
      foreach($ris as $row) {
        $account=$row;
      }
      // cookies per ricompilazione automatica form
      setcookie("username", $_POST["username"], strtotime("+1 day"));
      setcookie("pw", $_POST["password"], strtotime("+1 day"));
      // verifica password
      if(password_verify($_POST["password"], $account["Password"])) {
        $_SESSION["loginID"]=$account["IdAccount"];
        header("location: home.php");
      } else {
        header("location: login.php");
      }
    } else {
      header("location: login.php");
    }
  } else {
    header("location: login.php");
  }
?>
