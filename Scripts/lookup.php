<?php
	include '../Scripts/config.php';
	if(isset($_POST['patient'])){
 	


	 	$sql=("SELECT * FROM `Regular`");
	 	$test=array();
	 	$result = $connection -> query($sql);
	 	while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
	 		
	 		$sql2 = ("SELECT `UserId`,`Name`,`Email`,`Address`,`Province`,`City`,`Country`,`Postal` FROM Users WHERE UserId = ('".$row['USERID']."')");
	 		$result2=  $connection->query($sql2);
	 		while($row2= $result2->fetch_array(MYSQLI_ASSOC) ){
	 			$col= $row2;
	 			$col['Healthcardno']= $row['Health_CareCard'];
	 			$test[]=$col;
	 		}
	 	}
	 	echo json_encode($test);
	 }
 	?>