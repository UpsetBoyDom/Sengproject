<?php

$servername="localhost";
$username="root";
$password= "yus123";
$database= "Hospital Managment";
$connection = new mysqli($servername, $username, $password, $database);
if ($connection->connect_error) {
	die("Connection Failed: " . $connection->connect_error);
	echo $connection->connect_error;
}
?>