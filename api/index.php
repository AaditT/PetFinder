<?php
# https://codewithchris.com/iphone-app-connect-to-mysql-database/
include '../config.php';
// Create connection
$con=mysqli_connect($servername,$username,$pwd,$db);

// Check connection
if (mysqli_connect_errno())
{
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$foundSQL = "SELECT * FROM found WHERE display = 1";

// Check if there are results
if ($result = mysqli_query($con, $foundSQL))
{
	// If so, then create a results array and a temporary one
	// to hold the data
	$foundArray = array();
	$tempArray = array();

	// Loop through each row in the result set
	while($row = $result->fetch_object())
	{
		// Add each row into our results array
		$tempArray = $row;
	    array_push($foundArray, $tempArray);
	}

	// Finally, encode the array to JSON and output the results
}

$missingSQL = "SELECT * FROM missing WHERE display = 1";

// Check if there are results
if ($result = mysqli_query($con, $missingSQL))
{
	// If so, then create a results array and a temporary one
	// to hold the data
	$missingArray = array();
	$tempArray = array();

	// Loop through each row in the result set
	while($row = $result->fetch_object())
	{
		// Add each row into our results array
		$tempArray = $row;
	    array_push($foundArray, $missingArray);
	}

	// Finally, encode the array to JSON and output the results
}

$fullArray = array_merge($foundArray, $missingArray);
echo json_encode($fullArray);

// Close connections
mysqli_close($con);
?>
