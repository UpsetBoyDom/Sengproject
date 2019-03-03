<?php 

session_start();
if(isset($_SESSION["username"] )){
	if($_SESSION['role']!=2){
		header("Location: http://yushae.com/cpsc471/");
	}
	echo "Welcome " .$_SESSION["username"];
	if(isset($_POST['Logout'])){
		session_unset();
		session_destroy();
		header("Location: http://yushae.com/cpsc471/Login");
	}
}
else{
	header("Location: http://yushae.com/cpsc471/Login");
}



?>