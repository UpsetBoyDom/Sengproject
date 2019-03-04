<?php
/**
 * @author Yushae Raza
 * March 25, 2019
 * SENG 300 Project iteration 1
 * php file to connect to the database
 * 
 */

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