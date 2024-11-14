<?php
// add a new user to the database. requires input from register_new_user.php
error_reporting(E_ALL);
ini_set('displa_errors', 1);

include "db_connect.php";
$new_username = $_GET['username'];
$new_password1 = $_GET['password'];
$new_password2 = $_GET['password-confirm'];

$hashed_password = password_hash($new_password1, PASSWORD_DEFAULT);

echo "<h2>Trying to add a new user " . $new_username . " pw = " . $new_password1 . " and " . $new_password2 . "</h2>";

if ($new_password1 != $new_password2) {
	echo "The passwords do not match. Please try again.";
	exit;
}

preg_match('/[0-9]+/', $new_password1, $matches);
if (sizeof($matches) == 0) {
	echo "The password must have at least one number<br>";
	exit;
}

preg_match('/[!@#$%^&*()]+/', $new_password1, $matches);
if (sizeof($matches) == 0) {
	echo "The password must have at least one special character like !@#$%^&*()<br>";
	exit;
}

if (strlen($new_password1) <= 8) {
	echo "The password must be at least 8 characters long<br>";
	exit;
}

// check to see if this username has already been registered
$sql = "SELECT * FROM users WHERE user_name = '$new_username'";
$result = $mysqli->query($sql) or die (mysqli_error($mysqli));

if ($result->num_rows > 0) {
	echo "The username " . $new_username . " is already in use. Try another.";
	exit;
}
else {
	// add the new user
	$sql = "INSERT INTO users (user_id, user_name, password, email_address, admin_role) VALUES (null, '$new_username', '$hashed_password', null, 0)";
	$result = $mysqli->query($sql) or die (mysqli_error($mysqli));
	if ($result) {
		echo "Registration success";
	}
	else {
		echo "Something went wrong. Not registered.";
	}
}

echo "<a href='index.php'>Return to main</a>";
?>
