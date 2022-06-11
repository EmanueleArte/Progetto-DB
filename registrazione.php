<?php
  session_start();
  include("db.php");

  // controllo parametri in POST
  if(isset($_POST["mail"]) && isset($_POST["username"]) && isset($_POST["password"])) {
    if($_POST["mail"]!="" && $_POST["username"]!="" && $_POST["password"]!="") {
      $sql="SELECT * FROM Accounts WHERE Username=?";
      $query=$db->prepare($sql);
      $dati=array($_POST["username"]);
      $query->execute($dati);
      $ris=$query->fetchAll();
      if (count($ris)>0) {
        // Cookies per ricompilazione automatica form
        setcookie("usernameReg", $_POST["username"], strtotime("+1 day"));
        setcookie("mail", $_POST["mail"], strtotime("+1 day"));
        header("location: login.php");
      } else {
        // Inserimento nuovo account nel DB
        $sql="INSERT INTO Accounts(Username, Mail, Password, Canale) VALUES (?,?,?,?)";
        $query=$db->prepare($sql);
        $datiAccount=array($_POST["username"], $_POST["mail"], password_hash($_POST["password"],PASSWORD_DEFAULT), 0);
        $query->execute($datiAccount);
        // Id account appena creato
        $sql="SELECT * FROM Accounts ORDER BY IdAccount DESC LIMIT 1";
        $query=$db->prepare($sql);
        $query->execute();
        $ris=$query->fetchAll();
        $idAccount;
        foreach($ris as $row) {
          $idAccount=$row["IdAccount"];
        }
        // Creazione cronologia e video piaciuti
        $sql="INSERT INTO Playlists(Pubblica, TipoPlaylist, IdAccount) VALUES (0,1,?), (0,2,?)";
        $query=$db->prepare($sql);
        $datiAccount=array($idAccount, $idAccount);
        $ris=$query->execute($datiAccount);
        $_SESSION["loginID"]=$idAccount;
        header("location: home.php");
      }
    } else {
      header("location: login.php");
    }
  } else {
    header("location: login.php");
  }
?>
