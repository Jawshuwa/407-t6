<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

// modify these settings according to the account on your database server.
//$host = "localhost";
$host = $_ENV["DB_HOST"];
$port = "3306";
//$username = "root";
$username = $_ENV["DB_USERNAME"];
//$user_pass = "root";
$user_pass = $_ENV["DB_PASSWORD"];
// $database_in_use = "JokesPart1";
$database_in_use = $_ENV["DATABASE"];


$mysqli = new mysqli($host, $username, $user_pass, $database_in_use);
if ($mysqli->connect_error) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
echo $mysqli->host_info . "<br>";

?>
