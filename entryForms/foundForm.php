<!--Aadit Trivedi-->
<!DOCTYPE html>
<html lang="en">
<head>
  <title> Pets </title>
  <link href="../style/style.css" rel="stylesheet">
</head>
<?php
// Checks if user is logged in

session_start();
if(!isset($_SESSION['username'])) {
  header("Location: ../userAuth/loginForm.html");
} else {
  $displayName = $_SESSION['name'];
}
?>
<body>
  <h1> Hi <?php echo $displayName . "," ?> report a pet you found! </h1>
  <a href="../index.php"> &lt; Home </a> <br> <br>
  <div class="form-outer">
    <div class="entry-form">
      <form method="POST" action="found.php" enctype="multipart/form-data">
        <div class="component">
          <label for="type"> Pet Type </label>
          <input id="type" type="text" name="type" placeholder="Dog" required>
          <br><br>

          <label for="day">Pet Found Date</label>
          <input id="day" type="date" min="2020-01-01" max="2020-12-31" name="day" required>
          <br><br>
          <!-- Tester lat/lon: [-122.414, 37.776] -->
          <label for="lat"> Found Location Latitude (Optional) </label>
          <input id="lat" type="text" name="lat" placeholder="37">
          <br><br>
          <label for="lon"> Found Location Longitude (Optional) </label>
          <input id="lon" type="text" name="lon" placeholder="-121">
          <br><br>
          <p class="latlon-msg"> Having trouble with lat/lon coordinates? Use this link:<a href="https://www.latlong.net/"> https://www.latlong.net/</a></p>
          <br>
          <label for="contact"> Contact Phone Number (Please match format)</label>
          <input id="contact" type="tel" placeholder="000-000-0000" name="contact" required>
          <br><br>
          <label for="info"> Additional Information (Optional) </label>
          <textarea name="info" id="info" rows="5" cols="50"
          placeholder="Color, weight, age, etc."></textarea>
          <p><label for="file">Upload image of pet</label><br />
        <input type="file" name="file" id="file" /></p>

          <br><br>

         <br>

        <input type="submit" class="enter-btn"> <br>

      </form>
    </div>
  </div>
</body>
</html>
