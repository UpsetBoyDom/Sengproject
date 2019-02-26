<?php 

session_start();
if(isset($_SESSION["username"] )){
	echo "Welcome " .$_SESSION["username"];
	if(isset($_POST['Logout'])){
		session_unset();
		session_destroy();
		header("Location: http://yushae.com/Login");
	}
}
else{
	header("Location: http://yushae.com/Login");
}



?>