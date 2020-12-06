<!--Aadit Trivedi-->
<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="../style/style.css">
</head>
<body>
  <?php
    require('../config.php');
    session_start();
      if(!isset($_SESSION['username'])) {
        header("Location: ../userAuth/loginForm.html");
      } else {
        $displayName = $_SESSION['name'];
        $account_id = $_SESSION['username'];
      }
  ?>
  <h1> Removed a Missing Entry </h1>
  <a href="../index.php"> &lt; Home </a> <br>
  <a href="myProfile.php"> &lt; Back </a> <br> <br>
  <div class="outer-component">
    <div class="more-info-component">
      <?php

      // Getting necessary data
      $id = $_GET["id"];

      require('../config.php');
      $sql = "UPDATE missing SET display=0 WHERE id=$id";
      $conn = new mysqli($servername, $username, $pwd, $db);
      if ($conn->connect_error) {
        die("<p> Issue with the connection: " . $conn->connect_error . "</p>");
      }

      if ($conn->query($sql) === TRUE) {
        echo "<p> Entry deleted successfully </p>";
      } else {
        echo "<p> Error deleting record: " . $conn->error . "</p>";
      }
      $conn->close();

      ?>
    </div>
  </div>
</body>
</html>
