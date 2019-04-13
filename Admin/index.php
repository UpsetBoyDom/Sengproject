<?php 
/**
 * @author Yushae Raza
 * March 16, 2019
 * SENG 300 Project iteration 2
 * php file Account page of Admin user
 * 
 */ 
	include '../Scripts/loggout(admin).php';
 ?>
 
 <!DOCTYPE html>
 <html>
 <head>
<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <link href='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css' rel='stylesheet' />

	<link rel="stylesheet" type="text/css" href="../Styles/style.css?v1.05">
	<script type="text/javascript" src="../Scripts/loader.js"></script>
	<script type="text/javascript" src="../Scripts/nav.js"></script>
	<script type="text/javascript" src="../Scripts/admin.js"></script>


 </head>
 <body>

 
 <div id="content">
 <h1>Admin</h1>
 <div class="navb"></div><br>
 <br>
 

 <div class="Admin" >
 	
   <div >
   	<div class="row">
   		<div class="col">
   	<button class="btn btn-primary sub" onclick="view_patients()">View Patients</button>
   </div>
   <div class="col">
   	<button class="btn btn-primary sub" onclick="view_nurses()">View Nurses</button>
   </div>
   <div class="col">
   	<button class="btn btn-primary sub" onclick="view_doctors()">View Doctors</button>
   </div>

   	</div>
   </div>

 </div>

 <div class="patients table  " id="patients_table">
<h3 class="patient heading">Patients</h3>
 <table  id="patient" class="table">
 <thead>
 <tr>
 	<th scope="col">User Id</th>
 	<th scope="col">Full Name</th>
 	<th scope="col">Email</th>
 	<th scope="col">Address</th>
 	<th scope="col">Provice</th>
 	<th scope="col">City</th>
 	<th scope="col">Country</th>
 	<th scope="col">Postal</th>
 	<th scope="col">Health Card</th>

 </tr>
 </thead>
 </table>

 </div>
 <div class="patients table  " id="docters_table" style="display: none;">
<h3 class="patient heading">Doctors</h3>
 <table  id="doctors" class="table">
 <thead>
 <tr>
 	<th scope="col">User Id</th>
 	<th scope="col">Full Name</th>
 	<th scope="col">Email</th>
 	<th scope="col">Address</th>
 	<th scope="col">Provice</th>
 	<th scope="col">City</th>
 	<th scope="col">Country</th>
 	<th scope="col">Postal</th>
 	<th scope="col">department</th>

 </tr>
 </thead>
 </table>

 </div>
 <div class="patients table  " id="nurses_table" style="display: none;">
<h3 class="patient heading">Nurses</h3>
 <table  id="nurses" class="table">
 <thead>
 <tr>
 	<th scope="col">User Id</th>
 	<th scope="col">Full Name</th>
 	<th scope="col">Email</th>
 	<th scope="col">Address</th>
 	<th scope="col">Provice</th>
 	<th scope="col">City</th>
 	<th scope="col">Country</th>
 	<th scope="col">Postal</th>
 	<th scope="col">department</th>

 </tr>
 </thead>
 </table>

 </div>


 </div>
 </body>
 </html>