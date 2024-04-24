<?php

include 'credentials.php';

$conn = new PDO(
  'mysql:host=localhost;dbname='.DB_NAME.';charset=utf8',
  DB_NAME,
  DB_PASSWORD
);

if (isset($_GET['beer_id'])) {
    $beerid = $_GET['beer_id'];
    $user = json_decode($_SESSION['username'], true);
    $userid = $_SESSION['user_id'];

    $sql = "SELECT * FROM Favorites WHERE user_id = $userid AND beer_id = $beerid";
    $res = $conn -> query($sql);
    $records = $res -> fetchAll(PDO::FETCH_ASSOC);

    if (count($records) == 0) {
        $sql = "INSERT INTO Favorites (user_id, beer_id) VALUES ($userid, $beerid)";
        //$conn -> query($sql);
    } else {
        $sql = "DELETE FROM Favorites WHERE user_id = $userid AND beer_id = $beerid";
        //$conn -> query($sql);
    }

    //$sql = "DELETE FROM Favorites WHERE user_id = $userid AND beer_id = $beerid";
    $conn -> query($sql);
    $conn = null;

  }
  
  $ref = $_SERVER["HTTP_REFERER"];

  if (strpos($ref, 'favorites.php') !== false) {
    header('Location: favorites.php');
  } else {
    header('Location: products.php');
  }
