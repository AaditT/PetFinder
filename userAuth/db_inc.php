<!--
Aadit Trivedi
Web Apps, Period 2
-->

<?php

# My SQL Info
$host = 'localhost';
$user = 'Pet_Us3r';
$passwd = 'i89oUYsl0X8sgo3c';
$schema = 'pet_find';
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
