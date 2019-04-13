<?php

include '../Scripts/config.php';

/**
 * Get the appointments for the database for the logged in user
 * @param $meh
 * @param $connection the connection to the database
 * @param $userid the userid 
 */
function  getAppointments($meh,$connection,$userid)
{		
		$sql = "SELECT * FROM Appoinments WHERE pid = $userid";
		$data=array();
	 	$result=$connection->query($sql);
	 		while($row = $result->fetch_assoc()) {
		  	$ap=array();
		  	$ap['id']=$row['Id'];
		  	$ap['title']=$row['title'];
		  	$ap['description']=$row['Description'];
		  	$ap['end']=$row['end'];
		  	$ap['start']=$row['start'];
		  	$data_events[]= $ap;		
	   }
	    return json_encode(array("events" => $data_events));
	 }


/**
 * Get the appointments for all patients and doctors
 * @param $meh 	
 * @param $connection	connection to the database
 */	 
function  getAppointmentsAdmin($meh,$connection)
	{
		
		$sql = "SELECT * FROM Appoinments ";
		$data=array();
	 	$result=$connection->query($sql);
	 		while($row = $result->fetch_assoc()) {
		  	$ap=array();
		  	$ap['id']=$row['Id'];
		  	$ap['title']=$row['title'];
		  	$ap['description']=$row['Description'];
		  	$ap['end']=$row['end'];
		  	$ap['start']=$row['start'];
		  	$data_events[]= $ap;
	   }
	    return json_encode(array("events" => $data_events));
	 }

if(isset($_POST['meh']))
{
	if(isset($_SESSION["role"]))
	{
		$role = $_SESSION["role"];
		if($role=="2"){
			echo getAppointmentsAdmin($_POST['meh'],$connection);
		}
		else{

			if(isset($_SESSION["id"]))
			{
                $work = $_SESSION["id"];
                  echo getAppointments($_POST['meh'],$connection,$work);		
            }
	       }
}
}


?>