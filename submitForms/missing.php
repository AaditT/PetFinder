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
    echo "<a href='../index.php'> Return Home </a><br>";
    echo "<p> Entered info: </p>";
    echo "<p> Type: $type </p>";
    echo "<p> Color: $color </p>";
    echo "<p> Weight: $weight </p>";
    echo "<p> Age: $age </p>";
    echo "<p> Day Missing: $day </p>";
    echo "<p> Latitude: $lat </p>";
    echo "<p> Longitude: $lon </p>";
    echo "<p> Contact: $contact </p>";
    echo "<p> Info: $info </p>";
  } else {
    echo "<p> Error: " . $sql . "</p>" . $conn->error;
  }
  $conn->close();
?>
