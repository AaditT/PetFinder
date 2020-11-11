<!DOCTYPE html>
<html lang="en">
<head>
  <title> Pets </title>
  <link href="style/reports.css" rel="stylesheet">
</head>
<body>
  <h1> Report a pet you found! </h1>
  <a href="index.html"> &lt; Home </a> <br> <br>
  <form method="GET" name="partnershipForm" action="submit.php">
    <div class="component">
      <p class="question"> Pet Info </p>
      <p> Please enter some info.</p>
      <label for="pet-type"> Pet Type </label>
      <input id="pet-type" type="text" name="pet-type" placeholder="Dog"><br><br>
      <label for="pet-color"> Pet Color </label>
      <input id="pet-color" type="text" name="pet-color" placeholder="Brown"><br><br>

      <label for="found-date">Pet Found Date</label>
      <input id="found-date" type="date" min="2020-01-01" max="2020-12-31" name="found-date">
      <br><br>
      <!-- Tester lat/lon: [-122.414, 37.776] -->
      <label for="lat"> Found Location Latitude </label>
      <input id="lat" type="text" name="lat" placeholder="-79.032"><br><br>
      <label for="lon"> Found Location Longitude </label>
      <input id="lon" type="text" name="lon" placeholder="36.123"><br><br>

      <label for="number"> Contact Phone Number (Please match format)</label>
      <input id="number" type="tel" placeholder="000-000-0000" name="number"
      pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}"> <br><br>

    </div> <br>

    <input type="submit" class="enter-btn"> <br>

  </form>
</body>
</html>
