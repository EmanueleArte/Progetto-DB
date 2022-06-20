<?php
  include("check_session.php");
  include("db.php");

  // controllo parametri in POST
  if(isset($_POST["commentText"]) && isset($_POST["videoID"])) {
      if($_POST["commentText"]!="" && $_POST["videoID"]!="") {
        $sql="INSERT INTO Commenti(TestoCommento, IdVideo, IdAccount) VALUES (?,?,?)";
        $query=$db->prepare($sql);
        $dati=array($_POST["commentText"], $_POST["videoID"], $_SESSION["loginID"]);
        $query->execute($dati);
      }
  }
  if(isset($_POST["commentText"]) && isset($_POST["postID"])) {
      if($_POST["commentText"]!="" && $_POST["postID"]!="") {
        $sql="INSERT INTO Commenti(TestoCommento, IdPost, IdAccount) VALUES (?,?,?)";
        $query=$db->prepare($sql);
        $dati=array($_POST["commentText"], $_POST["postID"], $_SESSION["loginID"]);
        $query->execute($dati);
      }
  }
?>
