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
      // Checks if user is logged in

      session_start();
      if(!isset($_SESSION['username'])) {
        header("Location: ../userAuth/loginForm.html");
      } else {
        $displayName = $_SESSION['name'];
        $account_id = $_SESSION['username'];
      }

      $message = "";
      $target_path = null;
      $savePath = null;

      $type = $_POST["type"];
      
      $day = $_POST["day"];
      $lat = $_POST["lat"];
      $lon = $_POST["lon"];
      $contact = $_POST["contact"];
      $info = $_POST["info"];


      $conn = new mysqli($servername, $username, $pwd, $db);
      if ($conn->connect_error)
      {
        die("Connection failed: " . $conn->connect_error);
      }




      if (
        (isset($_FILES['file'])) &&
        (
          (basename( $_FILES['file']['name']) != "") ||
          (basename( $_FILES['file']['name']) != null)
          )
          )
          {
            $target_path = "imageUploads/";
            $target_path = $target_path . time() . '_' . basename( $_FILES['file']['name']);
            if(move_uploaded_file($_FILES['file']['tmp_name'], $target_path)) {
              $message = "The file ".  basename( $_FILES['file']['name']).
              " has been uploaded";
            } else{
              $message = "There was an error uploading the file, please try again!";
            }
            $savePath = "http://www.petfinder.epizy.com/entryForms/" . $target_path;

          } else {
            echo "<p class='label'> No image provided... </p><br><br>";
          }


          $displaySetting = TRUE;
          $sql = "INSERT INTO `found` (`type`, `day`, `lat`, `lon`, `contact`, `info`, `account_id`, `display`, `filepath`) VALUES
          ('$type', '$day', '$lat', '$lon', '$contact', '$info', '$account_id', '$displaySetting', '$savePath')";
          if ($conn->query($sql) === TRUE) {
            if ($savePath != null) {
              echo "<img src='$savePath' width='20%' height='auto'><br><br>";
            }
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
