
<?php
include '../Scripts/config.php';
if(isset($_POST['name'])){
	echo $_POST['name'];
}
$errmsg="";
function send_email($email,$username,$token){
	$subject = "Email Verification";
	$message="<html>
	<head></head>
	<body> <p> please verify your email
	<a href='http://yushae.com/Seng300/verify?username=" . $username . "&token=" . $token . "'>link.</a>

	</p></body></html>";
	$headers[] = 'MIME-Version: 1.0';
	$headers[] = 'Content-type: text/html; charset=iso-8859-1';
	$headers[] = "From: Hospitalmangement <Hospitalmangement@yushae.com>";

	mail($email, $subject, $message, implode("\r\n", $headers));

}
if (isset($_POST["submit2"])){
  	//echo "asd";

	if(is_full()){
		
		if($_POST["password"] ==$_POST["password2"]){
			if(filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
				
					$sql = "SELECT Username FROM Users";
					$res= $connection->query($sql);
					$dublicate=false;
					while($row= $res->fetch_assoc()){
						if($row["Username"] ==$_POST["username"] ){
							$dublicate=true;
							echo "That username already exists";
							$GLOBALS['errmsg']="That username already exists";
						}
					}

					if(!$dublicate){
						$password=  password_hash($_POST['password'], PASSWORD_BCRYPT);
						$vtoken = bin2hex(openssl_random_pseudo_bytes(64));
						$sql=("INSERT INTO Users (`Username` ,`password` ,`Email`, `Name`,`Address`, `Province` ,`City`,`Country`,`Postal`,`vtoken`) VALUES('".$_POST['username']."','".$password."','".$_POST['email']."','".$_POST['Name']."','".$_POST['street']."','".$_POST['province']."','".$_POST['city']."','".$_POST['country']."','".$_POST['postal']."','".$vtoken."')");
						if($connection->query($sql)){
							$sql= "SELECT UserId FROM Users WHERE Username =('".$_POST['username']."' ) ";
							$result = $connection -> query($sql);
							$login=false;
							$correct_password=true;
							$correct_user=false;
							$userid;
							while($row = $result->fetch_assoc()) {
								$userid=$row['UserId'];
							}

							$sql= ("INSERT INTO Regular (`USERID`,`Health_CareCard`) VALUES('".$userid."','".$_POST['healthcardnumber']."')");
							if($connection->query($sql)){
								$GLOBALS['errmsg']= "Account created successfully";
								send_email($_POST['email'],$_POST['username'],$vtoken);
								header("Location: http://yushae.com/Seng300/Login");
								$connection->close();
							}
							else{
							    echo "Error: " . $sql . "<br>" . $connection->error;

							}
							
						}
						else{
							    echo "Error: " . $sql . "<br>" . $connection->error;

						}
					}

			}
			else{
			$GLOBALS['errmsg'] = "That is not a valid email";
			}
		
		}
		else{
				$GLOBALS['errmsg']= "Your Passwords dont match";
		}

	}
	else{
	
	}
}

function is_full(){
	$GLOBALS['errmsg'];
	$fields=  array("Name","username","email","password","password2","street","postal","city","province","country");
	foreach ($fields as $field) {
		if(empty($_POST[$field])){
			$GLOBALS['errmsg'].= $field." is not filled. <br>";
			return false;
		}
		else{
			return true;
		}
		# code...
	}
}





?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="../Styles/style.css?v1.05">
	
</head>
<body  onload="test.reset();">
<div id= "wrapper">
<h1>Register</h1>

<br>
<div class ="form">
<div id="message">
<?php 
if (isset($errmsg)) {
	echo $errmsg;
}



?>
</div>
<form   novalidate action="" id ="test" method="POST" autocomplete="off class="form-inpister">
	<div id = "page1">
	<label>Full Name </label>
	
	<input   class="form-inp" type="text"  name="Name" placeholder="Full Name">
	<label>UserName</label>
		<input class="form-inp" type="text"  name="username" placeholder="UserName" >
	<label>Email</label>
	<input class="form-inp" type="email"  name="email" placeholder="Email" >
	<label>Password</label>
	<input type="Password" name="password" class="form-inp" placeholder="Password">
	<label>Retype Password</label>

	<input type="Password" name="password2" class="form-inp" placeholder="Retype Password">
	<button type ="button" 	class=" subbtn" onclick="showpage2()"> Continue</button>
</div>
<div id ="page2">
	<label>Street Address</label>
		<input class="form-inp" type="text"  name="street" placeholder="Street Address" >
		<label>Postal Code </label>
		<input class="form-inp" type="text"  name="postal" placeholder="Postal Code" >
	<label>City</label>
		<input class="form-inp" type="text"  name="city" placeholder="City" >
<label>Province</label>
		<input class="form-inp" type="text"  name="province" placeholder="Province" >

	<label>Country</label>
	

		<input class="form-inp" type="text"  name="country" placeholder="Country" >
		<label>Health Card number</label>
		<input  class="form-inp" type ="number" name="healthcardnumber" placeholder="Health card number">
	<button type ="button" 	class=" subbtn" onclick="showpage1()"> Back</button><br><br>
	<input  type="submit" name="submit2" class="subbtn" value="Create Account">
</div>
</form>
<br>
<button onclick="window.location.href = 'http://yushae.com/Seng300/Login';" class="subbtn">Log in</button>
</div>
</div>
<script type="text/javascript">
	function showpage2(){
		var page1 = document.getElementById("page1");
		var page2=document.getElementById("page2");
		page1.style="display:none;";
		page2.style.display="block";
	}
	function showpage1(){
		var page1 = document.getElementById("page1");
		var page2=document.getElementById("page2");
		page1.style="display:block;";
		page2.style.display="none";
	}
</script>
</body>
</html>