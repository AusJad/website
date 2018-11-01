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
$searchQu = htmlspecialchars($_POST["search"]);
$searchBy = $_POST["searchBy"];

$query = "SELECT ProdID, ProdName, ProdPrice, Weight FROM $table WHERE ";
switch ($searchBy){
	case "name":
		$query .= "ProdName LIKE '%$searchQu%';";
		break;
	case "category":
		$query .= "Category LIKE '%$searchQu%';";
		break;
	case "price":
		$searchCon = $_POST["searchCon"];
		$query .= "ProdPrice $searchCon $searchQu;";
		break;
	default:
		break;
}

$result = mysqli_query($dbc, $query);

while($row = mysqli_fetch_array($result, MYSQLI_NUM)){
	for($i = 0; $i < count($row) - 1; $i++){
			echo "$row[$i] | ";
	}
	echo "$row[$i]<br>";
}

mysqli_free_result($result);
mysqli_close($dbc);

?>