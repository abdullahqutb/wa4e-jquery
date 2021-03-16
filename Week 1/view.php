<?php
// Initialize the session
session_start();
require("connect.php");

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"
    integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
  <title>Sayed Abdullah Qutb's Resume Registry</title>
</head>

<body>

  <div class="mt-1 container" style="margin-top: 50px;">
    <h1 class="center">Sayed Abdullah Qutb's Resume Registry</h1>
    <div style="margin-top: 20px;">
      <?php
      if (!isset($_SESSION["logged_in"]) || $_SESSION['logged_in'] !== true) {
        header('Location: login.php');
      } else {
        $result = $pdo->query('SELECT * FROM profile WHERE profile_id=' . $_GET['id']);
        $row = $result->fetch();
      } ?>

    </div>
    <div>
      <div class="form-group">
        <label for="first_name">First Name</label>
        <input disabled type="text" id="first_name" name="first_name" class="form-control" value="<?php echo $row['first_name']; ?>">
      </div>
      <div class="form-group">
        <label for="last_name">Last Name</label>
        <input disabled type="text" id="last_name" name="last_name" class="form-control" value="<?php echo $row['last_name']; ?>">
      </div>
      <div class="form-group">
        <label for="email">Email</label>
        <input disabled type="email" id="email" name="email" class="form-control" value="<?php echo $row['email']; ?>">
      </div>
      <div class="form-group">
        <label for="headline">Headline</label>
        <input disabled type="text" id="headline" name="headline" class="form-control" value="<?php echo $row['headline']; ?>">
      </div>
      <div class="form-group">
        <label for="summary">Summary</label>
        <textarea disabled name="summary" id="summary" cols="30" rows="5" class="form-control"><?php echo $row['summary']; ?></textarea>
      </div>
      <a href="../index.php" class="btn btn-primary">HOME</a>
    </div>
  </div>


</body>

</html>
