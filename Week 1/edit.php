<?php
session_start();
include('connect.php');


if (isset($_GET['first_name']) && isset($_GET['first_name']) && isset($_GET['last_name']) && isset($_GET['email'])
    && isset($_GET['headline'])) {
      echo "hek";

    if (strpos($_GET['email'], '@') === false) {
        $_SESSION['error'] = 'Bad Email';
        echo "error";
    } else {
      echo "no errror";

        $sql = "UPDATE Profile SET first_name = :first_name, last_name = :last_name,email=:email,headline=:headline,summary=:summary
            WHERE profile_id = :profile_id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array(
                ':first_name' => $_GET['first_name'],
                ':last_name' => $_GET['last_name'],
                ':email' => $_GET['email'],
                ':headline' => $_GET['headline'],
                ':summary' => $_GET['summary'],
                ':profile_id' => $_GET['id'])
        );
        $_SESSION['success'] = 'Record updated';
        header('Location: ../index.php');
        return;
    }
}

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
      <form method="GET">
        <div class="form-group">
          <label for="first_name">First Name</label>
          <input type="text" id="first_name" name="first_name" class="form-control" value="<?php echo $row['first_name']; ?>">
        </div>
        <div class="form-group">
          <label for="last_name">Last Name</label>
          <input type="text" id="last_name" name="last_name" class="form-control" value="<?php echo $row['last_name']; ?>">
        </div>
        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" id="email" name="email" class="form-control" value="<?php echo $row['email']; ?>">
        </div>
        <div class="form-group">
          <label for="headline">Headline</label>
          <input type="text" id="headline" name="headline" class="form-control" value="<?php echo $row['headline']; ?>">
        </div>
        <div class="form-group">
          <label for="summary">Summary</label>
          <textarea name="summary" id="summary" cols="30" rows="5" class="form-control"><?php echo $row['summary']; ?></textarea>
        </div>
        <input type="hidden" id="id" name="id" value="<?php echo $row['profile_id']; ?>">
        <button type="submit" class="btn">UPDATE</button>
      </form>
    </div>
  </div>


</body>

</html>
