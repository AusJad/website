<?php
$host = "localhost";
$user = "X31896175";
$pass = "X31896175";
$dbna = "X31896175";
$table = "users";

$dbc = mysqli_connect($host, $user, $pass, $dbna);
if(mysqli_connect_errno()){
	echo "Failed to connect to MySQL (" . mysqli_connect_error() . ")";
}
?>