<?php
$host = "127.0.0.1";
$user = "root";
$password = "";
$database = "eschool_database";

//Database Connection
$conn = new mysqli($host, $user, $password, $database);

//Verify Connection
if ($conn -> connect_error){
	die("Cannot connect to the database at this time, pleease try again later" . "" . mysqli_connect_error);
	}
?>