<?php
  include("check_session.php");
  include("db.php");

  // Controllo parametri in POST
  if(isset($_POST["titolo"]) && isset($_POST["link"]) && isset($_POST["etichetta"])) {
    if($_POST["titolo"]!="" && $_POST["link"]!="") {
        // Inserimento post video nel DB
        $sql="INSERT INTO Video(Titolo, SorgenteVideo, IdAccount) VALUES (?,?,?)";
        $query=$db->prepare($sql);
        $dati=array($_POST["titolo"], $_POST["link"], $_SESSION["loginID"]);
        $query->execute($dati);
        if($_POST["etichetta"]!="-1") {
          $sql="SELECT * FROM Video ORDER BY IdVideo DESC LIMIT 1";
          $query=$db->prepare($sql);
          $dati=array($_POST["titolo"], $_POST["link"], $_SESSION["loginID"]);
          $query->execute($dati);
          $ris=$query->fetchAll();
          foreach($ris as $row) {
            // Inserimento collegamento con etichetta
            foreach($_POST["etichetta"] as $etichetta) {
              $sql="INSERT INTO Categorizzazioni_video(IdVideo, IdEtichetta) VALUES (?,?)";
              $query=$db->prepare($sql);
              $dati=array($row["IdVideo"], $etichetta);
              $query->execute($dati);
            }
          }
        }
        header("location: home.php");
    } else {
      header("location: home.php");
    }
  } else {
    header("location: home.php");
  }
?>
