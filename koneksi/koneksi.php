<?php  

error_reporting(0);

//Database Configuration
$db_name 	= "psb";
$host		= "localhost";
$username	= "nuril";
$password	= "Nuril#1234";

//make connection to database
$conn 		= mysqli_connect($host,$username,$password,$db_name) or die("Database connection error!");


?>
