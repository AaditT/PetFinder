<!--Aadit Trivedi-->
<html lang="en">
<head>
  <meta charset='utf-8' />
  <title>PetFinder</title>
  <meta name='viewport' content='initial-scale=1,maximum-scale=1,user-scalable=no' />
  <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Assistant&family=Dosis:wght@300;500&family=Poppins:wght@300;600&display=swap" rel="stylesheet">
  <script src='https://api.tiles.mapbox.com/mapbox-gl-js/v1.12.0/mapbox-gl.js'></script>
  <link href='https://api.tiles.mapbox.com/mapbox-gl-js/v1.12.0/mapbox-gl.css' rel='stylesheet' />
  <script src='config.js'></script>
  <style>
  body {
    margin: 0;
    padding: 0;
    padding-bottom: 100px;
  }
  h1 {
    font-family: 'Poppins', sans-serif;
    text-align: center;
    margin-top: 20px;
    margin-bottom: 20px;
  }
  h2 {
    font-family: 'Assistant', sans-serif;
    margin-left: 10%;
    padding-left: 20px;
    font-size: 20px;
  }
  a, a:visited, a:link, a:after {
    font-family: 'Assistant', sans-serif;
    padding-left: 10%;
    text-decoration: none;
    text-decoration: none;
    color: #489df7;
  }

  td {
    text-align: center;
  }
  p, td {
    font-family: 'Assistant', sans-serif;
  }
  th {
    font-family: 'Assistant', sans-serif;
    background-color: #a6e3ff;
    border-radius: 5px;
  }
  #map {
    margin: auto;
    top: 0;
    bottom: 0;
    width: 80%;
    height: 250px;
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
    width: 200px;
  }

  .mapboxgl-popup-content {
    text-align: center;
    font-family: 'Poppins', sans-serif;
  }
  .pet-table {
    width: 80%;
    margin: auto;
    border-style: solid;
    border-radius: 5px;
  }




  .missing-field {
    background-color: #ffcdc7;
    border-radius: 20px;
    width: 150px;
  }
  .found-field {
    background-color: #C6E8C4;
    border-radius: 20px;
    width: 150px;
  }



  </style>
</head>
<body>

  <h1> PetFinder </h1>
  <div id='map'></div>
  <?php

  require('config.php');
  $foundpetjson = "
  {type: 'FeatureCollection',
    features: [";

    $conn = new mysqli($servername, $username, $pwd, $db);
    if ($conn->connect_error)
    {
      die("Connection failed: " . $conn->connect_error);
    }
    $sql = "SELECT type, color, weight, age, day, lat, lon,
    contact, info, display FROM found WHERE display = 1";
    $result = $conn->query($sql);
    ?>

    <br>
    <br>

    <div class="report">
      <?php
      session_start();
      	if(isset($_SESSION['username'])) {
          $displayName = $_SESSION['name'];
          echo '<p style="padding-left:10%;"> Signed in as: ' . $displayName . '</p>';
          echo'<a href="userProfile/myProfile.php"> My Profile </a> <br><br>';
        } else {
          echo '<p style="padding-left:10%;"> Not signed in </p>';
          echo '<a href="userAuth/loginForm.html"> Login </a><br>';
          echo '<a href="userAuth/signupForm.html"> Signup </a><br><br>';
        }
      ?>
      <a href="entryForms/foundForm.php"> Report a found pet </a> <br>
      <a href="entryForms/missingForm.php"> Report a missing pet </a> <br> <br>
    </div>


    <table class="table table-striped pet-table">
      <thead>
        <h2 class="found-field"> Found Pets </h2>
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


            // This is the code that creates the missing pet table
            echo "<tr><td>$type</td><td>$color</td><td>$weight kg</td><td>$age yrs</td><td>$day</td><td>$lat ".
            "</td><td>$lon</td><td>$contact</td><td><a href='$customURL'>View</a></td></tr>";

            // This is the code that creates the JSON for the found pet pins
            // for the map

            $foundpetjson = $foundpetjson .
            "{
              type: 'Feature',
              geometry: {
                type: 'Point',
                coordinates: [$lat, $lon]
              },
              properties: {
                title: '$type',
                description: '<b> Color </b>: $color <br><b> Weight </b>: $weight <br><b> Age </b>: $age <br><b> Day Found </b>: $day <br><b> Contact </b>: $contact'
              }
            },";

          }
          $foundpetjson = $foundpetjson . "]};";
        } else {
          echo "<p style='padding-left:10%;'> No entries </p>";
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
                  $moreInfoURL = "moreInfo.php?type=$type&color=$color"
                  . "&weight=$weight&age=$age&day=$day"
                  . "&lat=$lat&lon=$lon&contact=$contact"
                  . "&info=$info";




                  // This is the code that creates the missing pet table
                  echo "<tr><td>$type</td><td>$color</td><td>$weight kg</td><td>$age yrs</td><td>$day</td><td>$lat
                  </td><td>$lon</td><td>$contact</td><td><a href='$moreInfoURL'>View</a></td></tr>";

                  // This is the code that creates the JSON for the missing pet pins
                  // for the map
                  $missingpetjson = $missingpetjson .
                  "{
                    type: 'Feature',
                    geometry: {
                      type: 'Point',
                      coordinates: [$lat, $lon]
                    },
                    properties: {
                      title: '$type',
                      description: '<b> Color </b>: $color <br><b> Weight </b>: $weight <br><b> Age </b>: $age <br><b> Day Found </b>: $day <br><b> Contact </b>: $contact'
                    }
                  },";


                }
                $missingpetjson = $missingpetjson . "]};";
              } else {
                echo "<p style='padding-left:10%;'> No entries </p>";
              }
              $conn->close();
              ?>

              <script>
              // Amazing tutorial : https://docs.mapbox.com/help/tutorials/custom-markers-gl-js/
              mapboxgl.accessToken = config.MAPBOX_API_KEY;

              // This is the JS code that creates the map
              var map = new mapboxgl.Map({
                container: 'map',
                style: 'mapbox://styles/mapbox/light-v10',
                center: [-96, 37.8],
                zoom: 3
              });

              var foundgeojson = <?php echo $foundpetjson ?>;
              var missinggeojson = <?php echo $missingpetjson ?>;

              // add markers to map
              foundgeojson.features.forEach(function(marker) {

                // create a HTML element for each feature
                var el = document.createElement('div');
                el.className = 'found-marker';

                // This is for the map element of found pets
                new mapboxgl.Marker(el)
                .setLngLat(marker.geometry.coordinates)
                .setPopup(new mapboxgl.Popup({ offset: 25 })
                .setHTML('<h3>' + marker.properties.title + '</h3><p>' + marker.properties.description + '</p>'))
                .addTo(map);
              });
              missinggeojson.features.forEach(function(marker) {

                // create a HTML element for each feature
                var ell = document.createElement('div');
                ell.className = 'missing-marker';

                // This is for the amp element of missing pets
                new mapboxgl.Marker(ell)
                .setLngLat(marker.geometry.coordinates)
                .setPopup(new mapboxgl.Popup({ offset: 25 }) // add popups
                .setHTML('<h3>' + marker.properties.title + '</h3><p>' + marker.properties.description + '</p>'))
                .addTo(map);
              });
            </script>



          </tbody>
        </table>

        <br> <br> <a href='admin/adminLogin.php'>Admin</a>
      </body>
      </html>
