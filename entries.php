<html lang="en">
<head>
    <meta charset='utf-8' />
    <title></title>
    <meta name='viewport' content='initial-scale=1,maximum-scale=1,user-scalable=no' />
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <script src='https://api.tiles.mapbox.com/mapbox-gl-js/v1.12.0/mapbox-gl.js'></script>
    <link href='https://api.tiles.mapbox.com/mapbox-gl-js/v1.12.0/mapbox-gl.css' rel='stylesheet' />
    <link href='https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css' rel='stylesheet'/>
    <link href="https://fonts.googleapis.com/css2?family=Nunito&display=swap" rel="stylesheet">

    <style>
      body {
        margin: 0;
        padding: 0;
      }
      #map {
        margin: auto;
        top: 0;
        bottom: 0;
        width: 50%;
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
        width: 50%;
        margin: auto;
        border-style: solid;
        border-radius: 20px;
      }
      h1 {
        font-family: 'Nunito', sans-serif;
        text-align: center;
        margin-top: 20px;
        margin-bottom: 20px;
      }
      .home {
        margin-left: 25px;
      }
      h2 {
        margin-left: 25%;
        padding-left: 20px;
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
    </style>
</head>
<body>
  <h1> View all entries </h1>
  <a href="index.html" class="home"> &lt; Home </a> <br>
  <div id='map'></div>
<?php
  $foundpetjson = "
  {type: 'FeatureCollection',
  features: [";
  $servername = "192.168.64.2";
  $username = "petfinder";
  $pwd = "weHhQMCRFZAn5FcW";
  $db = "pet_find";
  $conn = new mysqli($servername, $username, $pwd, $db);
  if ($conn->connect_error)
  {
    die("Connection failed: " . $conn->connect_error);
  }
  $sql = "SELECT type, color, time_found, found_lat, found_lon,
  contact_number FROM found";
  $result = $conn->query($sql); ?>

  <br>
  <br>


  <table class="table table-striped pet-table">
    <thead>
      <h2 class="found-field"> Found Pets </h2>
      <tr>
        <th scope="col">Type</th>
        <th scope="col">Color</th>
        <th scope="col">Day Found</th>
        <th scope="col">Latitude</th>
        <th scope="col">Longitude</th>
        <th scope="col">Contact Number</th>
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
      $timeFound = $row["time_found"];
      $foundLat = $row["found_lat"];
      $foundLon = $row["found_lon"];
      $contactNumber = $row["contact_number"];
      echo "<tr><td>$type</td><td>$color</td><td>$timeFound</td><td>$foundLat
      </td><td>$foundLon</td><td>$contactNumber</td></tr>";
      $foundpetjson = $foundpetjson .
      "{
        type: 'Feature',
        geometry: {
          type: 'Point',
          coordinates: [$foundLat, $foundLon]
        },
        properties: {
          title: '$type',
          description: 'Contact No.: $contactNumber'
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
  $servername = "192.168.64.2";
  $username = "petfinder";
  $pwd = "weHhQMCRFZAn5FcW";
  $db = "pet_find";
  $conn = new mysqli($servername, $username, $pwd, $db);
  if ($conn->connect_error)
  {
    die("Connection failed: " . $conn->connect_error);
  }
  $sql = "SELECT type, color, last_seen_time, last_seen_lat, last_seen_lon,
  contact_number FROM missing";
  $mresult = $conn->query($sql); ?>


  <table class="table table-striped pet-table">
    <thead>
      <br>
      <h2 class="missing-field"> Missing Pets </h2>
      <tr>
        <th scope="col">Type</th>
        <th scope="col">Color</th>
        <th scope="col">Last Seen Time</th>
        <th scope="col">Latitude</th>
        <th scope="col">Longitude</th>
        <th scope="col">Contact Number</th>
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
      $timeFound = $row["last_seen_time"];
      $foundLat = $row["last_seen_lat"];
      $foundLon = $row["last_seen_lon"];
      $contactNumber = $row["contact_number"];
      echo "<tr><td>$type</td><td>$color</td><td>$timeFound</td><td>$foundLat
      </td><td>$foundLon</td><td>$contactNumber</td></tr>";
      $missingpetjson = $missingpetjson .
      "{
        type: 'Feature',
        geometry: {
          type: 'Point',
          coordinates: [$foundLat, $foundLon]
        },
        properties: {
          title: '$type',
          description: 'Contact No.: $contactNumber'
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
mapboxgl.accessToken = 'pk.eyJ1IjoiYWFkaXQxMjMiLCJhIjoiY2tjOWR0MXdnMTY1bjJ3cXBubmN1Z2E0ayJ9.GtgrMOfGeP3QJ7x-4ep62A';

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
