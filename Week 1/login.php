<?php
session_start();

if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
  header('location: index.php');
  exit;
}

require_once("connect.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $email = $_POST['email'];
  $password = $_POST['password'];
  
  $stmt = $pdo->prepare('SELECT * FROM users WHERE email = :email');
  $stmt->execute(array( ':email' => $email));
  $row = $stmt->fetch(PDO::FETCH_ASSOC);
  if ($check = password_verify($password, $row['password'])) {
    // echo $row['email'];
    $_SESSION['logged_in'] = true;
    $_SESSION['user_id'] = $row['user_id'];
    $_SESSION['name'] = $row['name'];
    $_SESSION['email'] = $row['email'];
    header("Location: index.php");
  } else {
    echo "Check email and password again";
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sayed Abdullah Qutb's Resume Registry</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
</head>
<body>

<div class="mt-1 container" style="margin-top: 50px;">
  <h1 class="center">Sayed Abdullah Qutb's Resume Registry</h1>
  <div>
    <form action="login.php" method="POST">
      <div class="form-group">
        <label for="email">Email</label>
        <input type="text" id="email" name="email" class="form-control" placeholder="Enter your email">
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" class="form-control" placeholder="Enter your password">
      </div>
      <button type="submit" onclick="return doValidate()">LOGIN</button>
    </form>
  </div>
</div>
  
<script>
  function doValidate() {
    console.log('Validating...');
    try {
        pw = document.getElementById('password').value;
        console.log("Validating pw = " + pw);
        if (pw == null || pw == "") {
            alert("Both fields must be filled out");
            return false;
        }
        email = document.getElementById('email').value;
        if (email.indexOf('@') == -1) {
          alert("Not a valid email!");
          return false;
        }
        return true;
    } catch(e) {
        return false;
    }
    return false;
  }
</script>
</body>
</html>