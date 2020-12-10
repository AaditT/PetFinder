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

<html>
<head>
  <link rel="stylesheet" href="../style/style.css">
</head>
<body>
  <a href="../index.php"> &lt; Home </a> <br> <br>
  <h1> Hello, <?php echo $displayName ?> </h1>
  <h2> My entries </h2>
  <?php
  $conn = new mysqli($servername, $username, $pwd, $db);
  if ($conn->connect_error)
  {
    die("Connection failed: " . $conn->connect_error);
  }
  $sql = "SELECT id, type, color, weight, age, day, lat, lon,
  contact, info, account_id, display FROM found WHERE display=1 AND account_id=$account_id";

  $result = $conn->query($sql);

  ?>



  <table class="table table-striped pet-table">
    <thead>
      <h2 class="found-field"> Found Pets </h2>
      <a style="padding-left: 10%;" href="../entryForms/foundForm.php"> Add a found pet </a>
      <tr>
        <th>Type</th>
        <th>Color</th>
        <th>Weight</th>
        <th>Age</th>
        <th>Day Found</th>
        <th>Latitude</th>
        <th>Longitude</th>
        <th>Contact Number</th>
        <th>Additonal Info</th>
        <th>Remove</th>
      </tr>
    </thead>
    <tbody>
      <?php
      if ($result->num_rows > 0)
      {
        while ($row = $result->fetch_assoc())
        {
          $pet_id = $row["id"];
          $type = $row["type"];
          $color = $row["color"];
          $weight = $row["weight"];
          $age = $row["age"];
          $day = $row["day"];
          $lat = $row["lat"];
          $lon = $row["lon"];
          $info = $row["info"];
          $contact = $row["contact"];
          $account_id = $row["account_id"];
          $customURL = "../moreInfo.php?type=$type&color=$color"
          . "&weight=$weight&age=$age&day=$day"
          . "&lat=$lat&lon=$lon&contact=$contact"
          . "&info=$info";
          $removeURL = "removeFoundEntry.php?id=$pet_id";


          // This is the code that creates the missing pet table
          echo "<tr><td>$type</td><td>$color</td><td>$weight kg</td><td>$age yrs</td><td>$day</td><td>$lat ".
          "</td><td>$lon</td><td>$contact</td><td><a href='$customURL'>View</a></td><td><a href='$removeURL'>Remove</a></td></tr>";

        }
      } else {
        echo "<p style='padding-left: 10%;'> No entries </p>";
      }
      $conn->close();
      ?>
    </tbody>
  </table> <br><br>
  <table class="table table-striped pet-table">
    <thead>
      <h2 class="missing-field"> Missing Pets </h2>
      <a style="padding-left: 10%;" href="../entryForms/missingForm.php"> Add a missing pet </a>
      <tr>
        <th>Type</th>
        <th>Color</th>
        <th>Weight</th>
        <th>Age</th>
        <th>Day Found</th>
        <th>Latitude</th>
        <th>Longitude</th>
        <th>Contact Number</th>
        <th>Additonal Info</th>
        <th>Remove</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $conn = new mysqli($servername, $username, $pwd, $db);
      if ($conn->connect_error)
      {
        die("Connection failed: " . $conn->connect_error);
      }
      $msql = "SELECT id, type, color, weight, age, day, lat, lon,
      contact, info, account_id, display FROM missing WHERE display=1 AND account_id=$account_id";
      $mresult = $conn->query($msql);
      if ($mresult->num_rows > 0)
      {
        while ($row = $mresult->fetch_assoc())
        {
          $pet_id = $row["id"];
          $type = $row["type"];
          $color = $row["color"];
          $weight = $row["weight"];
          $age = $row["age"];
          $day = $row["day"];
          $lat = $row["lat"];
          $lon = $row["lon"];
          $info = $row["info"];
          $contact = $row["contact"];
          $account_id = $row["account_id"];
          $customURL = "moreInfo.php?type=$type&color=$color"
          . "&weight=$weight&age=$age&day=$day"
          . "&lat=$lat&lon=$lon&contact=$contact"
          . "&info=$info";
          $removeURL = "removeMissingEntry.php?id=$pet_id";


          // This is the code that creates the missing pet table
          echo "<tr><td>$type</td><td>$color</td><td>$weight kg</td><td>$age yrs</td><td>$day</td><td>$lat ".
          "</td><td>$lon</td><td>$contact</td><td><a href='$customURL'>View</a></td><td><a href='$removeURL'>Remove</a></td></tr>";

        }
      } else {
        echo "<p style='padding-left: 10%;'> No entries </p>";
      }
      $conn->close();
      ?>
    </tbody>
  </table>
  </html>
