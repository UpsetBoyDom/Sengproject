<?php 
/**
 * @author Yushae Raza
 * Seng300 Project Iteration 2 Group 4
 * Create a admin session for user
 */
session_start();
if(isset($_SESSION["username"] )){
	if($_SESSION['role']!=2){//if succesful login as admin redirect to main page
		header("Location: http://yushae.com/Seng300/");
	}
	echo "Welcome " .$_SESSION["username"];
	if(isset($_POST['Logout'])||isset($_GET['Logout'])){//if user logs out end session and redirect to login page
		session_unset();
		session_destroy();
		header("Location: http://yushae.com/Seng300/Login");
	}
}
else{//redirect user to main login page
	header("Location: http://yushae.com/Seng300/Login");
}



?>