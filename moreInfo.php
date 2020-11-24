<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="style/style.css">
</head>
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
  // Below code for debugging purposes
  // echo "<tr><td>$type</td><td>$color</td><td>$weight</td><td>$age</td><td>$day</td><td>$lat
  // </td><td>$lon</td><td>$contact</td></tr>";
  echo "<p> Type: $type </p>";
  echo "<p> Color: $color </p>";
  echo "<p> Weight: $weight </p>";
  echo "<p> Age: $age </p>";
  echo "<p> Day: $day </p>";
  echo "<p> Lat: $lat </p>";
  echo "<p> Lon: $lon </p>";
  echo "<p> Contact: $contact </p>";
  echo "<p> Info: $info </p>";


?>
</html>
