<?php
   $host = "localhost";
$user = "X31896175";
$pass = "X31896175";
$dbna = "X31896175";
$table = "users";

$dbc = mysqli_connect($host, $user, $pass, $dbna);
if(mysqli_connect_errno()){
	echo "Failed to connect to MySQL (" . mysqli_connect_error() . ")";
}else{
   session_start();
   
   $user_check = $_SESSION['login_user'];
   
   $ses_sql = mysqli_query($dbc,"select UserName from users where UserName = '$user_check' ");
   
   $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
   
   $login_session = $row['UserName'];
   
   if(!isset($_SESSION['login_user'])){
      header("location:login.php");
   }
}
?>