<?php
$host = "localhost";
$user = "X31896175";
$pass = "X31896175";
$dbna = "X31896175";
$table = "users";

$dbc = mysqli_connect($host, $user, $pass, $dbna);
if(mysqli_connect_errno()){
	echo "Failed to connect to MySQL (" . mysqli_connect_error() . ")";
}else
{
session_start();

 if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      
      $myusername = mysqli_real_escape_string($dbc,$_POST['UserName']);
      $mypassword = mysqli_real_escape_string($dbc,$_POST['pass']); 
      
      $sql = "SELECT permissions FROM users WHERE UserName = '$myusername' and pass = '$mypassword'";
      $result = mysqli_query($dbc,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      $active = $row['permissions'];
      
      $count = mysqli_num_rows($result);
      
      // If result matched $myusername and $mypassword, table row must be 1 row
		
      if($count == 1) {
         $_SESSION['login_user'] = $myusername;
		 
         if ($active == 0) {
		header("location:customerPage.php");
	} else if ($active == 1){
		header("location:staffPage.php");
	}else {
		$error = "There is an issue with the permissions of your account, please contact an admininstrator";
	}
      }else {
         $error = "Your Login Name or Password is invalid";
      }
   }
}
?>

<!DOCTYPE html>
<html lang="en">
<html>
   
   <head>
      <title>Login Page</title>
	  
      <link rel = "stylesheet" type = "text/css" href = "./../css/navbar.css" />
	  
      <style type = "text/css">
         body {
            font-family:Arial, Helvetica, sans-serif;
            font-size:14px;
         }
         label {
            font-weight:bold;
            width:100px;
            font-size:14px;
         }
         .box {
            border:#666666 solid 1px;
         }
      </style>
      
   </head>
   
   <body>
	<nav>
		<ul id = "navbar">
		  <li class = "navElement"><a class="inactive" href=".././homepage.html">Home</a></li>
		  <li class = "navElement"><a class="inactive" href=".././help.html">Help</a></li>
		  <li class = "navElement"><a class="active" href="login.php">Login</a></li>
		  <li class = "navElement"><a class="inactive" href=".././aboutUs/html">About Us</a></li>
		</ul>
	</nav>
      <div align = "center">
		<div style = "margin-top:30px">
         <div style = "width:300px; border: solid 1px #333333; " align = "left">
            <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>Login</b></div>
				
            <div style = "margin:30px">
               
               <form action = "" method = "post">
                  <label>UserName  :</label><input type = "text" value = "UserName" name = "UserName" class = "box"/><br /><br />
                  <label>Password  :</label><input type = "password"value = "Password" name = "pass" class = "box" /><br/><br />
                  <input type = "submit" value = " Submit "/><br />
               </form>
               
               <div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div>
					
            </div>
				
         </div>
			
      </div>

   </body>
</html>
