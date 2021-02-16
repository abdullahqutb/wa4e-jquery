<?php
  session_start();
  require_once("connect.php");

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $result = $pdo->query('SELECT email FROM profile WHERE email = "' . $_POST["email"] . '"');
    if ($row = $result->fetch()) {
      echo "Email already exists!";
      // header("Location: add.php");
      // exit;
    } else {
      $stmt = $pdo->prepare("INSERT INTO profile (user_id, first_name, last_name, email, headline, summary) VALUES (:user_id, :first_name, :last_name, :email, :headline, :summary)");
  
      $success = $stmt->execute(array(':user_id' => $_SESSION['user_id'], ':first_name' => htmlentities($_POST['first_name']), ':last_name' => htmlentities($_POST['last_name']), ':email' => htmlentities($_POST['email']), ':headline' => htmlentities($_POST['headline']), ':summary' => htmlentities($_POST['summary'])));
  
      if ($success) {
        header("Location: index.php");
        exit;
      } else {
        echo "Something went wrong!";
      }
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
  <div class="container" style="margin-top: 100px;">
  <h1 class="center">Sayed Abdullah Qutb's Resume Registry</h1>
    <form action="add.php" method="POST">
      <div class="form-group">
        <label for="first_name">First Name</label>
        <input type="text" id="first_name" name="first_name" class="form-control">
      </div>
      <div class="form-group">
        <label for="last_name">Last Name</label>
        <input type="text" id="last_name" name="last_name" class="form-control">
      </div>
      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" class="form-control">
      </div>
      <div class="form-group">
        <label for="headline">Headline</label>
        <input type="text" id="headline" name="headline" class="form-control">
      </div>
      <div class="form-group">
        <label for="summary">Summary</label>
        <textarea name="summary" id="summary" cols="30" rows="5" class="form-control"></textarea>
      </div>
      <button type="submit" onclick="return doValidate();" class="btn">ADD</button>
    </form>
  </div>

  <script>
    function doValidate() {
      firstName = document.getElementById('first_name').value;
      lastName = document.getElementById('last_name').value;
      headline = document.getElementById('headline').value;
      email = document.getElementById('email').value;
      summary = document.getElementById('summary').value;
      if (firstName == "" || lastName == "" || headline == "" || email == "" || summary == "") {
        alert("All fields are required!");
        return false;
      }
      if (email.indexOf('@') == -1) {
        alert("Email in the wrong format, check again!");
        return false;
      }
      return true;
    }
  </script>
</body>

</html>