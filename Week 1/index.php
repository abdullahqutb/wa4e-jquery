<?php
// Initialize the session
session_start();
require("connect.php");

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sayed Abdullah Qutb's Resume Registry</title>

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"
    integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
</head>

<body>

  <div class="mt-1 container" style="margin-top: 50px;">
    <h1 class="center">Sayed Abdullah Qutb's Resume Registry</h1>
    <div style="margin-top: 20px;">
      <?php
      if (!isset($_SESSION["logged_in"]) || $_SESSION['logged_in'] !== true) {
        echo'<a href="login.php">Please log in</a>';
      } else {
        echo'<a href="logout.php">Logout</a><br>';
        echo'<a href="add.php">Add New Entry</a>';
      } ?>

    </div>
    <div>
      <form id="form" method="POST">
        <table class="table" style="margin-top: 50px;">
          <tr>
            <th>First Name</th>
            <th>Headline</th>
            <th>Details</th>
            <th>Delete</th>
          </tr>
          <?php
          $result = $pdo->query('SELECT * FROM profile');
          while ($row = $result->fetch()) {
            echo "<tr><td>" . $row['first_name'] . "</td><td>" . $row['headline'] . "</td>
            <td><button formaction='view.php' onclick='viewRow(this.value)' value='" . $row['profile_id'] . "'>View</button></td>
            <td><button formaction='delete.php' onclick='deleteRow()' value='asdf'>Delete</button></td>
            <input type='hidden' value='" . $row['profile_id'] . "'>
            </tr>";
          }
        ?>
        </table>
        <input type="hidden" id="selected_id" name="selected_id">
      </form>
    </div>
  </div>

  <script>
  function viewRow(id) {
    alert(id);
    var form = document.getElementById('form');
    document.getElementById('selected_id').value = id;
  }
  </script>
</body>

</html>
