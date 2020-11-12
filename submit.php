<!-- Aadit Trivedi -->
<!-- Tester -->
<?php
  # Getting data from report found pet form
  $petType = $_GET["pet-type"];
  $petColor = $_GET["pet-color"];
  $foundDate = $_GET["found-date"];
  $foundLat = $_GET["lat"];
  $foundLon = $_GET["lon"];
  $contact = $_GET["number"];
  echo $petType;
  echo $petColor;
  echo $foundDate;
  echo $foundLat;
  echo $contact;
?>
