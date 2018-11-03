<?php
$host = "localhost";
$user = "X33111219";
$pass = "X33111219";
$dbna = "X33111219";
$table = "A2Products";

$dbc = mysqli_connect($host, $user, $pass);

if(!$dbc){
	die("Connection failed: " . mysqli_connect_error());
}
	
mysqli_select_db($dbc, $dbna);

$operator = $_POST["op"];
$amount = $_POST["no"];

if($_POST["id"] < 1000){
	$id = '0';
	if($_POST["id"] < 100){
		$id .= '0';
		if($_POST["id"] < 10){
			$id .= '0';
		}
	}
	$id .= $_POST["id"];
}
else{
	$id = $_POST['id'];
}

$query = "UPDATE $table SET InStock = ";

if($operator == "add")
	$query .= "InStock + ";
else
	$query .= "InStock - ";

$query .= "$amount WHERE ProdId = $id;";
mysqli_query($dbc, $query);

$query = "SELECT InStock FROM $table WHERE ProdId = $id;";

$result = mysqli_query($dbc, $query);

while($row = mysqli_fetch_array($result, MYSQLI_NUM)){
	echo $row[0];
}

mysqli_free_result($result);
mysqli_close($dbc);

?>