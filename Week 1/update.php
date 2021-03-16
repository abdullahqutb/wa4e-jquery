<?php
  session_start();
  require_once("connect.php");
  echo "here";

  if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $result = $pdo->query('SELECT profile_id FROM profile WHERE profile_id = "' . $_GET["id"] . '"');
    if ($row = $result->fetch()) {
      $result = $pdo->query('UPDATE misc SET first_name=' . $_GET["first_name"] . ', last_name=' . $_GET["last_name"] . ', email=' . $_GET["email"] . ', headline=' . $_GET["headline"] . ', summary=' . $_GET["summary"] . 'WHERE profile_id = "' . $_GET["id"] . '"');
      header("Location: index.php");
      exit;
    } else {
      echo "Something went wrong!";
    }
  } else {
    echo "hellloo";
  }

?>
