<?php
  //DATABASE
  try {
    $hostname = "localhost";
    $dbname = "sito_streaming";
    $user = "root";
    $pass = "root";
    $db = new PDO ("mysql:host=$hostname;dbname=$dbname", $user, $pass);
  } catch (PDOException $e) {
    echo "Errore: " . $e->getMessage();
    die();
  }
?>
