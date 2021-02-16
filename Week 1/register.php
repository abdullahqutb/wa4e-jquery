<?php

require_once("connect.php");

if ($_SERVER["REQUEST_METHOD"] == 'POST') {
  $email = $_POST['email'];
  $password = $_POST['password'];
  $result = $pdo->query("SELECT * FROM users WHERE email = '" . $email . "'");
  if ($row = $result->fetch()) {
    echo "Email Already Exists";
  } else {
    $crypted = password_hash($password, PASSWORD_DEFAULT);
  
    $stmt = $pdo->prepare("INSERT INTO users (email, password) VALUES (:email, :password)");
    $success = $stmt->execute(array(':email' => $email, ':password' => $crypted));
    if ($success) {
      header('Location: login.php');
    } else {
      echo $stmt->errorCode();
    }
  }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
</head>
<body>
<div class="container" style="margin-top: 100px;">
  <form action="register.php" method="POST">
    <div class="form-group">
      <label for="email">Email</label>
      <input type="email" id="email" name="email" class="form-control">
    </div>
    <div class="form-group">
      <label for="password">Email</label>
      <input type="password" id="password" name="password" class="form-control">
    </div>
    <button type="submit">REGISTER</button>
  </form>
</div>
  
</body>
</html>