<!--Aadit Trivedi-->
<html lang="en">
<head>
    <meta charset='utf-8' />
    <title></title>
    <meta name='viewport' content='initial-scale=1,maximum-scale=1,user-scalable=no' />
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">

    <script src='https://api.tiles.mapbox.com/mapbox-gl-js/v1.12.0/mapbox-gl.js'></script>
    <link href='https://api.tiles.mapbox.com/mapbox-gl-js/v1.12.0/mapbox-gl.css' rel='stylesheet' />
    <link rel="stylesheet" href="style/style.css">
    <script src='config.js'>
      console.log(config);
    </script>
    <style>
      body {
        margin: 0;
        padding: 0;
        padding-bottom: 100px;
      }
      #map {
        margin: auto;
        top: 0;
        bottom: 0;
        width: 80%;
        height: 30%;
        border-radius: 20px;
        border-style: solid;
      }
      .found-marker {
        background-image: url('img/found-pet-icon.png');
        background-size: cover;
        width: 50px;
        height: 50px;
        border-radius: 50%;
        cursor: pointer;
      }
      .missing-marker {
        background-image: url('img/missing-pet-icon.png');
        background-size: cover;
        width: 50px;
        height: 50px;
        border-radius: 50%;
        cursor: pointer;
      }
      .mapboxgl-popup {
        max-width: 200px;
      }

      .mapboxgl-popup-content {
        text-align: center;
        font-family: 'Open Sans', sans-serif;
      }
      .pet-table {
        width: 80%;
        margin: auto;
        border-style: solid;
        border-radius: 20px;
      }
      h1 {
        text-align: center;
        margin-top: 20px;
        margin-bottom: 20px;
      }
      .home {
        margin-left: 25px;
      }
      h2 {
        margin-left: 10%;
        padding-left: 20px;
        font-size: 20px;
      }
      .missing-field {
        background-color: #ffcdc7;
        border-radius: 20px;
        width: 220px;
      }
      .found-field {
        background-color: #C6E8C4;
        border-radius: 20px;
        width: 200px;
      }
      a {
        padding-left: 10%
      }
      a:visited {
        text-decoration: none;
      }

      td {
        text-align: center;
      }

    </style>
</head>
<body>
  <h1> PetFinder </h1>
  <div id='map'></div>
<?php
  $foundpetjson = "
  {type: 'FeatureCollection',
  features: [";
  $servername = "localhost";
  $username = "root";
  $pwd = "";
  $db = "pet_find";
  $conn = new mysqli($servername, $username, $pwd, $db);
  if ($conn->connect_error)
  {
    die("Connection failed: " . $conn->connect_error);
  }
  $sql = "SELECT type, color, weight, age, day, lat, lon,
  contact, info FROM found";
  $result = $conn->query($sql);
  ?>

  <br>
  <br>
  <div class="report">
    <a href="foundForm.php"> Report a found pet </a> <br>
    <a href="missingForm.php"> Report a missing pet </a> <br> <br>
  </div>


  <table class="table table-striped pet-table">
    <thead>
      <h2 class="found-field"> Found Pets </h2>
      <tr>
        <th scope="col">Type</th>
        <th scope="col">Color</th>
        <th scope="col">Weight</th>
        <th scope="col">Age</th>
        <th scope="col">Last Seen Time</th>
        <th scope="col">Latitude</th>
        <th scope="col">Longitude</th>
        <th scope="col">Contact Number</th>
        <th scope="col">Additonal Info</th>
      </tr>
    </thead>
    <tbody>
  <?php
  if ($result->num_rows > 0)
  {
    while ($row = $result->fetch_assoc())
    {
      $type = $row["type"];
      $color = $row["color"];
      $weight = $row["weight"];
      $age = $row["age"];
      $day = $row["day"];
      $lat = $row["lat"];
      $lon = $row["lon"];
      $info = $row["info"];
      $contact = $row["contact"];
      $customURL = "moreInfo.php?type=$type&color=$color"
      . "&weight=$weight&age=$age&day=$day"
      . "&lat=$lat&lon=$lon&contact=$contact"
      . "&info=$info";
      echo "<tr><td>$type</td><td>$color</td><td>$weight</td><td>$age</td><td>$day</td><td>$lat ".
      "</td><td>$lon</td><td>$contact</td><td><a href='$customURL'>View</a></td></tr>";
      $foundpetjson = $foundpetjson .
      "{
        type: 'Feature',
        geometry: {
          type: 'Point',
          coordinates: [$lat, $lon]
        },
        properties: {
          title: '$type',
          description: 'Contact No.: $contact'
        }
      },";

    }
    $foundpetjson = $foundpetjson . "]};";
  } else {
    echo "No entries";
  }
  $conn->close();
?>

<?php
  $missingpetjson = "
  {type: 'FeatureCollection',
  features: [";
  $servername = "localhost";
  $username = "root";
  $pwd = "";
  $db = "pet_find";
  $conn = new mysqli($servername, $username, $pwd, $db);
  if ($conn->connect_error)
  {
    die("Connection failed: " . $conn->connect_error);
  }
  $sql = "SELECT type, color, weight, age, day, lat, lon,
  contact, info FROM missing";
  $mresult = $conn->query($sql); ?>


  <table class="table table-striped pet-table">
    <thead>
      <br>
      <h2 class="missing-field"> Missing Pets </h2>
      <tr>
        <th scope="col">Type</th>
        <th scope="col">Color</th>
        <th scope="col">Weight</th>
        <th scope="col">Age</th>
        <th scope="col">Last Seen Time</th>
        <th scope="col">Latitude</th>
        <th scope="col">Longitude</th>
        <th scope="col">Contact Number</th>
        <th scope="col">Additional Info</th>
      </tr>
    </thead>
    <tbody>
  <?php
  if ($result->num_rows > 0)
  {
    while ($row = $mresult->fetch_assoc())
    {
      $type = $row["type"];
      $color = $row["color"];
      $weight = $row["weight"];
      $age = $row["age"];
      $day = $row["day"];
      $lat = $row["lat"];
      $lon = $row["lon"];
      $contact = $row["contact"];
      $customURL = "moreInfo.php?type=$type&color=$color"
      . "&weight=$weight&age=$age&day=$day"
      . "&lat=$lat&lon=$lon&contact=$contact"
      . "&info=$info";
      echo "<tr><td>$type</td><td>$color</td><td>$weight</td><td>$age</td><td>$day</td><td>$lat
      </td><td>$lon</td><td>$contact</td><td><a href='$customURL'>View</a></td></tr>";
      $missingpetjson = $missingpetjson .
      "{
        type: 'Feature',
        geometry: {
          type: 'Point',
          coordinates: [$lat, $lon]
        },
        properties: {
          title: '$type',
          description: 'Contact No.: $contact'
        }
      },";


    }
    $missingpetjson = $missingpetjson . "]};";
  } else {
    echo "No entries";
  }
  $conn->close();
?>

<script>
// Amazing tutorial : https://docs.mapbox.com/help/tutorials/custom-markers-gl-js/
mapboxgl.accessToken = config.MAPBOX_API_KEY;

var map = new mapboxgl.Map({
  container: 'map',
  style: 'mapbox://styles/mapbox/light-v10',
  center: [-96, 37.8],
  zoom: 3
});

// code from the next step will go here!
var foundgeojson = <?php echo $foundpetjson ?>;
var missinggeojson = <?php echo $missingpetjson ?>;
// add markers to map
foundgeojson.features.forEach(function(marker) {

  // create a HTML element for each feature
  var el = document.createElement('div');
  el.className = 'found-marker';

  // make a marker for each feature and add to the map
  new mapboxgl.Marker(el)
    .setLngLat(marker.geometry.coordinates)
    .setPopup(new mapboxgl.Popup({ offset: 25 }) // add popups
    .setHTML('<h3>' + marker.properties.title + '</h3><p>' + marker.properties.description + '</p>'))
    .addTo(map);
});
missinggeojson.features.forEach(function(marker) {

  // create a HTML element for each feature
  var ell = document.createElement('div');
  ell.className = 'missing-marker';

  // make a marker for each feature and add to the map
  new mapboxgl.Marker(ell)
    .setLngLat(marker.geometry.coordinates)
    .setPopup(new mapboxgl.Popup({ offset: 25 }) // add popups
    .setHTML('<h3>' + marker.properties.title + '</h3><p>' + marker.properties.description + '</p>'))
    .addTo(map);
});
</script>



</tbody>
</table>


</body>
</html>
