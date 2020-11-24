<?php
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
  $servername = "localhost";
  $username = "root";
  $pwd = "";
  $db = "pet_find";
  $conn = new mysqli($servername, $username, $pwd, $db);
  if ($conn->connect_error)
  {
    die("Connection failed: " . $conn->connect_error);
  }
  $sql = "INSERT INTO `missing` (`type`, `color`, `weight`, `age`, `day`, `lat`, `lon`, `contact`, `info`) VALUES
  ('$type', '$color', '$weight', '$age', '$day', '$lat', '$lon', '$contact', '$info')";
  if ($conn->query($sql) === TRUE) {
    echo "<p> New missing pet added successfully. </p>";
  } else {
    echo "<p> Error: " . $sql . "</p>" . $conn->error;
  }
  $conn->close();
?>
