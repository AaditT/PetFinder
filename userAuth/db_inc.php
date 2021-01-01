<!--
Aadit Trivedi
Web Apps, Period 2
-->

<?php

# My SQL Info
$host = 'localhost';
$user = 'petfinder_user';
$passwd = 'B1yzGnrtqYUJnL8j';
$schema = 'petfinder_AT';
$pdo = NULL;

$dsn = 'mysql:host=' . $host . ';dbname=' . $schema;

try
{
   $pdo = new PDO($dsn, $user,  $passwd);
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
