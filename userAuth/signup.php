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
if (isset($_REQUEST['username'])) {
	$passwd = trim($_REQUEST['passwd']);
}

if (!empty($username) && !empty($passwd)) {
	try
	{
		# Creates the new account
		$newId = $account->addAccount($username, $passwd);
	}
	catch (Exception $e)
	{
		echo $e->getMessage();
		die();
	}

	# New account has been created
	echo '<div class="form-outer">
    <div class="entry-form">';
	echo '<p> Successfully created new account </p>';
	echo '<p> Your User ID: ' . $newId . '</p>';
	echo '<p> Your Username: ' . $username . '</p>';
	echo '</div></div>';
}
else {
	echo '<div class="form-outer">
    <div class="entry-form">';
	echo '<p> Please enter both your username and password </p>';
	echo '</div></div>';
}

# Giving the user the option to login
echo "<br>";
echo "<a href='loginForm.html'> Login </a>";
?>
