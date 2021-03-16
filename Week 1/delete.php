<?php

session_start();
require('connect.php');

if(isset($_GET['id'])) {
  $result = $pdo->query('DELETE FROM profile WHERE profile_id=' . $_GET['id']);
  
  header('Location: ../index.php');
  return;
}

?>
