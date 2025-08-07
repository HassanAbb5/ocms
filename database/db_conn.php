<?php 

	$servername ='localhost';
	$username ='root';
	$password ='';
	$dbname= 'ocms';


	$db_conn= mysqli_connect($servername, $username, $password, $dbname);

	 //check connection
	 if (!$db_conn) {
	 	die("connection failed: " . mysqli_connect_error());
	 }
 ?>