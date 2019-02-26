<?php
include '../config.php';
if(isset($_GET["username"] )&& isset($_GET["token"])){
	$username=$_GET["username"];
	$vtoken=$_GET["token"];
	$sql= "SELECT * FROM  Users WHERE Username=('".$username."')";
	$result= $connection ->query($sql);
	$same_token=false;
	$user_exit=false;


	while($row = $result->fetch_assoc()) {
		if($row['Username']==$username){
			echo "yes";
			$user_exit=true;
		}
		if($row['vtoken']== $vtoken){
			
			$same_token=true;
		}
	}
	if($user_exit && $same_token){
		echo "email succesfully verified";
		$sql = "UPDATE Users SET verified = 1 WHERE Username=('".$username."')";
		$result = $connection->query($sql);
		$sql = "UPDATE Users SET vtoken =   NULL   WHERE Username=('".$username."')";
		$result = $connection->query($sql);
	}


}


?>

<!DOCTYPE html>
<html>
<head>
	<title>Congrats it worked2 </title>
</head>
<body>

</body>
</html>>