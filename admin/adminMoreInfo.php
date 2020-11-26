<!--Aadit Trivedi-->
<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="../style/style.css">
</head>
<body>
  <h1> More Info </h1>
  <a href="../index.php"> &lt; Home </a> <br>
  <a href="admin.php"> &lt; Back </a> <br> <br>
<div class="outer-component">
  <div class="more-info-component">
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
  echo "<p class='label'> Type</p><p class='value'> $type </p><br><br>";
  echo "<p class='label'> Color</p>:<p class='value'> $color </p><br><br>";
  echo "<p class='label'> Weight (kg)</p>:<p class='value'> $weight </p><br><br>";
  echo "<p class='label'> Age (yrs)</p>:<p class='value'> $age </p><br><br>";
  echo "<p class='label'> Day<p class='value'> $day </p><br><br>";
  echo "<p class='label'> Latitude</p>:<p class='value'> $lat </p><br><br>";
  echo "<p class='label'> Longitude</p>:<p class='value'> $lon </p><br><br>";
  echo "<p class='label'> Contact Number</p>:<p class='value'> $contact </p><br><br>";
  echo "<p class='label'> Additional Info</p>:<p class='value'> $info </p><br><br>";


?>
</div>
</div>
</body>
</html>
