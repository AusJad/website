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
$page = $_POST["pa"];

$query = "SELECT ProdID, ProdName, ProdPrice, Weight, InStock FROM $table WHERE ";
switch ($searchBy){
	case "name":
		$query .= "ProdName LIKE '%$searchQu%' ";
		break;
	case "category":
		$query .= "Category LIKE '%$searchQu%' ";
		break;
	case "price":
		$searchCon = $_POST["searchCon"];
		$query .= "ProdPrice $searchCon $searchQu ";
		break;
	default:
		break;
}

$query .= "ORDER BY ProdName;";

$result = mysqli_query($dbc, $query);
switch($page){ 
	case "unr":
		while($row = mysqli_fetch_array($result, MYSQLI_NUM)){
			echo '<div id="resultBox"><img src="images/'.$row[0].'.jpg" id="pImg" alt="product"><br><span id="pName">'.$row[1].', '.$row[3].'</span><span id="pPrice">$'.$row[2].'</span><div class="inStock" id="s'.$row[0].'">'.$row[4].'</div></div>';
		}
		break;
	case "cus":
		while($row = mysqli_fetch_array($result, MYSQLI_NUM)){
			echo '<div id="resultBox"><img src=".././images/'.$row[0].'.jpg" id="pImg" alt="product"><br>
			<span id="pName">'.$row[1].', '.$row[3].'</span>
			<button type="button" id="buyButton" onclick="valInc(1, \'sub\', document.querySelector(\'#s'.$row[0].'\'), '.$row[0].');">Buy</button>
			<span id="pPrice">$'.$row[2].'</span>
			<div class="inStock" id="s'.$row[0].'">'.$row[4].'</div></div>';
		}
		break;
	case "sta":
		while($row = mysqli_fetch_array($result, MYSQLI_NUM)){
			echo '<div id="resultBox"><img src=".././images/'.$row[0].'.jpg" id="pImg" alt="product"><br>
			<span id="pName">'.$row[1].', '.$row[3].'</span>
			<div class="orderMenu" style="position:absolute;width:95%;margin:auto;bottom:3%;">
			<input type="text" class="order" id="i'.$row[0].'"></input>
			<select name="oper" class="oper" id="o'.$row[0].'"><option value="add">More</option><option value="sub">Less</option></select>
			<button type="button" onclick="valInc(document.querySelector(\'#i'.$row[0].'\').value, document.querySelector(\'#o'.$row[0].'\').value, document.querySelector(\'#s'.$row[0].'\'), '.$row[0].');">Order</button></div>
			<span id="pPrice">$'.$row[2].'</span>
			<div class="inStock" id="s'.$row[0].'">'.$row[4].'</div></div>';}
		break;
	default:
		break;
}
mysqli_free_result($result);
mysqli_close($dbc);

?>