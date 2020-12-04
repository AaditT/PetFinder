<!--Aadit Trivedi-->
<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="../style/style.css">
</head>
<body>
  <h1> New found pet added successfully </h1>
  <a href="../index.php"> &lt; Home </a> <br> <br>
  <div class="outer-component">
    <div class="more-info-component">

      <?php
      require('../config.php');
      $type = $_GET["type"];
      $color = $_GET["color"];
      $weight = $_GET["weight"];
      $age = $_GET["age"];
      $day = $_GET["day"];
      $lat = $_GET["lat"];
      $lon = $_GET["lon"];
      $contact = $_GET["contact"];
      $info = $_GET["info"];
      // echo "<tr><td>$type</td><td>$color</td><td>$weight</td><td>$age</td><td>$day</td><td>$lat
      // </td><td>$lon</td><td>$contact</td></tr>";

      $conn = new mysqli($servername, $username, $pwd, $db);
      if ($conn->connect_error)
      {
        die("Connection failed: " . $conn->connect_error);
      }
      $sql = "INSERT INTO `found` (`type`, `color`, `weight`, `age`, `day`, `lat`, `lon`, `contact`, `info`) VALUES
      ('$type', '$color', '$weight', '$age', '$day', '$lat', '$lon', '$contact', '$info')";
      if ($conn->query($sql) === TRUE) {
        echo "<p class='label'> Type</p><p class='value'> $type </p><br><br>";
        echo "<p class='label'> Color</p>:<p class='value'> $color </p><br><br>";
        echo "<p class='label'> Weight (kg)</p>:<p class='value'> $weight </p><br><br>";
        echo "<p class='label'> Age (yrs)</p>:<p class='value'> $age </p><br><br>";
        echo "<p class='label'> Day<p class='value'> $day </p><br><br>";
        echo "<p class='label'> Latitude</p>:<p class='value'> $lat </p><br><br>";
        echo "<p class='label'> Longitude</p>:<p class='value'> $lon </p><br><br>";
        echo "<p class='label'> Contact Number</p>:<p class='value'> $contact </p><br><br>";
        echo "<p class='label'> Additional Info</p>:<p class='value'> $info </p><br><br>";
      } else {
        echo "<p> Error: " . $sql . "</p> <br>" . $conn->error;
      }
      $conn->close();
      ?>
    </div>
  </div>
</body>
</html>
