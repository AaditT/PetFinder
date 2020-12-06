<!--
Aadit Trivedi
Web Apps, Period 2
-->

<?php
# Styling purposes
echo "
<head>
	<link rel='stylesheet' href='../style/style.css'>
</head>
";
session_start();

require 'db_inc.php';
require 'account_class.php';

$account = new Account();
$login = FALSE;
if (isset($_REQUEST['username'])) {
	$username = trim($_REQUEST['username']);
}
if (isset($_REQUEST['passwd'])) {
	$passwd = trim($_REQUEST['passwd']);
}
if (!empty($username) && !empty($passwd)) {
		try {
			$login = $account->login($username, $passwd);
		}
		catch (Exception $e)
		{
			echo $e->getMessage();
			die();
		}

		# This runs if the login has been successful
		if ($login) {
			$_SESSION['username']=$account->getId();
			$_SESSION['name']=$account->getName();

			echo '<h1> Hello, '. $account->getName() . '</h1>';
			echo '
			<div class="outer-component">
		    <div class="more-info-component">
			<a href="index.html"> Home </a>
			<p> Login successful. </p>
			';
			echo '<p> Account ID: ' . $account->getId() . '</p>';
			echo '<p> Account Username: ' . $account->getName() . '</p>';
			$account->sessionLogin();
			echo '<br>';
			echo '<a href="../index.php"> Go to PetFinder </a>';
			echo '</div></div>';
		}

		# This runs if the login is not successful
		else {
			echo '<a href="../index.php"> Continue as guest (cannot report pets) </a>';
			echo '<p style="color:red">
			Login failed: Invalid username or password.</p>';
			echo '<br>';
			echo "<a href='loginForm.html'> Login Again </a>";
			echo '<br>';
			echo "<a href='signupForm.html'> Create an Account </a>";
		}
}
else {
  echo 'Please enter both your username and password';
}
