<?php
  //SESSION UTENTE LOGGATO
  session_start();
  if(!isset($_SESSION["loginID"])) {
    header("Location: login.php");
  }
?>
