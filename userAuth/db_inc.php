<!--
Aadit Trivedi
Web Apps, Period 2
-->


<?php

include '../config.php';
$pdo = NULL;

$dsn = 'mysql:host=' . $servername . ';dbname=' . $db;

try
{
   $pdo = new PDO($dsn, $username,  $pwd);
   $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e)
{
  # Exception handling
   echo '<p> There is an issue with the database connection </p>';
   echo '<br>';
   print_r($e);
   die();
}
