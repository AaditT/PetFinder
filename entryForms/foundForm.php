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
      <form method="GET" action="found.php">
        <div class="component">
          <label for="type"> Pet Type </label>
          <input id="type" type="text" name="type" placeholder="Dog" required>
          <br><br>
          <label for="color"> Pet Color </label>
          <input id="color" type="text" name="color" placeholder="Brown" required>
          <br><br>
          <label for="weight"> Pet Weight, kg (Optional) </label>
          <input id="weight" type="text" name="weight" placeholder="14">
          <br><br>
          <label for="age"> Pet Age, years (Optional) </label>
          <input id="age" type="text" name="age" placeholder="12">
          <br><br>
          <label for="day">Pet Found Date</label>
          <input id="day" type="date" min="2020-01-01" max="2020-12-31" name="day" required>
          <br><br>
          <!-- Tester lat/lon: [-122.414, 37.776] -->
          <label for="lat"> Found Location Latitude (Optional) </label>
          <input id="lat" type="text" name="lat" placeholder="-79.032">
          <br><br>
          <label for="lon"> Found Location Longitude (Optional) </label>
          <input id="lon" type="text" name="lon" placeholder="36.123">
          <br>
          <p class="latlon-msg"> Having trouble with lat/lon coordinates? Use this link:<a href="https://www.latlong.net/"> https://www.latlong.net/</a></p>
          <br>
          <label for="contact"> Contact Phone Number (Please match format)</label>
          <input id="contact" type="tel" placeholder="000-000-0000" name="contact"
          pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" required>
          <br><br>
          <label for="info"> Additional Information (Optional) </label>
          <textarea name="info" id="info" rows="5" cols="50"
          placeholder="Place any additional information here"></textarea>
          <br><br>

        </div> <br>

        <input type="submit" class="enter-btn"> <br>

      </form>
    </div>
  </div>
</body>
</html>
