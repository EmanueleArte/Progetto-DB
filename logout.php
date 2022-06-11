<?php
  date_default_timezone_set("Europe/Rome");
  include('check_session.php');
  include('db.php');

  // eliminazione loginID
  session_destroy();

  // eliminazione cookies
  /*foreach($_COOKIE as $key => $value){
    setcookie($key, "", time() - (3600*24), '/');
  }*/

  header ("location: login.php");
?>
