<!--Aadit Trivedi-->
<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="../style/style.css">
</head>
<body>
  <h1> Admin Page </h1>
  <a href="../index.php"> &lt; Home </a> <br> <br>
  <div class="outer-component">
    <?php
    include 'adminConfig.php';
    // This avoids error on the admin page
    if (isset($_POST["username"])) {
      $username = $_POST["username"];
    }
    else {
      $username = "";
    }
    if (isset($_POST["pwd"])) {
      $password = $_POST["pwd"];
    }
    else {
      $password = "";
    }

    // This makes sure that the admin is logged in
    // Or if the user wants to go back to the admin page
    if ((($username != $adminUsername) ||
    ($password != $adminPassword))
    &&
    (!isset($_GET["back"]))
  ) {
    header('Location: adminLogin.php');
  }

  // Connecting to the database
  $servername = "localhost";
  $username = "root";
  $pwd = "";
  $db = "pet_find";
  $conn = new mysqli($servername, $username, $pwd, $db);
  if ($conn->connect_error)
  {
    die("Connection failed: " . $conn->connect_error);
  }
  // SQL query to display the pet entries
  $sql = "SELECT id, type, color, weight, age, day, lat, lon,
  contact, info, display FROM missing WHERE display = 1";
  $mresult = $conn->query($sql);
  ?>


  <!-- Creating the table of missing pets -->
  <table class="table table-striped pet-table">
    <thead>
      <br>
      <h2 class="missing-field"> Missing Pets </h2>
      <tr>
        <th>Type</th>
        <th>Color</th>
        <th>Weight</th>
        <th>Age</th>
        <th>Last Seen Day</th>
        <th>Latitude</th>
        <th>Longitude</th>
        <th>Contact Number</th>
        <th>Additional Info</th>
        <th>Delete Entry</th>
      </tr>
    </thead>
    <tbody>

      <?php
      if ($mresult->num_rows > 0)
      {
        while ($row = $mresult->fetch_assoc())
        {
          $id = $row["id"];
          $type = $row["type"];
          $color = $row["color"];
          $weight = $row["weight"];
          $age = $row["age"];
          $day = $row["day"];
          $lat = $row["lat"];
          $lon = $row["lon"];
          $contact = $row["contact"];
          $info = $row["info"];
          $moreInfoURL = "adminMoreInfo.php?type=$type&color=$color"
          . "&weight=$weight&age=$age&day=$day"
          . "&lat=$lat&lon=$lon&contact=$contact"
          . "&info=$info";
          $removeEntryURL = "adminRemoveMissingEntry.php?type=$type&color=$color"
          . "&weight=$weight&age=$age&day=$day"
          . "&lat=$lat&lon=$lon&contact=$contact"
          . "&info=$info&id=$id";

          // This is the code that creates the missing pet table
          echo "<tr><td>$type</td><td>$color</td><td>$weight kg</td><td>$age yrs</td><td>$day</td><td>$lat
          </td><td>$lon</td><td>$contact</td><td><a href='$moreInfoURL'>View</a></td>
          <td><a href='$removeEntryURL'>Remove </a></td>
          </tr>";



        }
      } else {
        echo "<p> No entries </p>";
      }
      $conn->close();
      ?>
    </tbody>
    <?php

    // Connecting to the database
    require('../config.php');
    $conn = new mysqli($servername, $username, $pwd, $db);
    if ($conn->connect_error)
    {
      die("Connection failed: " . $conn->connect_error);
    }
    $sql = "SELECT id, type, color, weight, age, day, lat, lon,
    contact, info, display FROM found WHERE display = 1";
    $mresult = $conn->query($sql);
    ?>

    <!-- Creating the table of found pets -->
    <table class="table table-striped pet-table">
      <thead>
        <br>
        <h2 class="found-field"> Found Pets </h2>
        <tr>
          <th>Type</th>
          <th>Color</th>
          <th>Weight</th>
          <th>Age</th>
          <th>Last Seen Day</th>
          <th>Latitude</th>
          <th>Longitude</th>
          <th>Contact Number</th>
          <th>Additional Info</th>
          <th>Delete Entry</th>
        </tr>
      </thead>
      <tbody>

        <?php
        if ($mresult->num_rows > 0)
        {
          while ($row = $mresult->fetch_assoc())
          {
            $id = $row["id"];
            $type = $row["type"];
            $color = $row["color"];
            $weight = $row["weight"];
            $age = $row["age"];
            $day = $row["day"];
            $lat = $row["lat"];
            $lon = $row["lon"];
            $contact = $row["contact"];
            $info = $row["info"];
            $moreInfoURL = "adminMoreInfo.php?type=$type&color=$color"
            . "&weight=$weight&age=$age&day=$day"
            . "&lat=$lat&lon=$lon&contact=$contact"
            . "&info=$info";
            $removeEntryURL = "adminRemoveFoundEntry.php?type=$type&color=$color"
            . "&weight=$weight&age=$age&day=$day"
            . "&lat=$lat&lon=$lon&contact=$contact"
            . "&info=$info&id=$id";

            // This is the code that creates the missing pet table
            echo "<tr><td>$type</td><td>$color</td><td>$weight kg</td><td>$age yrs</td><td>$day</td><td>$lat
            </td><td>$lon</td><td>$contact</td><td><a href='$moreInfoURL'>View</a></td>
            <td><a href='$removeEntryURL'>Remove </a></td>
            </tr>";



          }
        } else {
          echo "<p> No entries </p>";
        }
        $conn->close();
        ?>

      </div>
    </body>
    </html>
