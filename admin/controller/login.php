<?php

session_start();

include '../utilities/connection.php';

if(@$_POST['login_btn']=='Login'){ 
	$username=$_REQUEST['username'];
	$password=$_REQUEST['password'];
	// echo "Email: ".$email;

	$sql = "select * from admin where username ='".$username."' AND password ='".$password."'";

	$query	=	mysqli_query($link,$sql);  

   	$count	=	mysqli_num_rows($query);

  	$rows	=	mysqli_fetch_array($query);
  
	if($count==1){
		
		$_SESSION['sessionId']				=	$rows['id'];
 		$_SESSION['userSessionName']		=	$rows['username'];
 		$_SESSION['userSessionPassword']	=	$rows['password'];

 		header("Location: ../layouts/admin_dashboard.php");
 		exit;
  	}
  	else{
		header("Location: ../index.php?status=fail");
		exit; 
  	}
}

if(@$_GET["caller"]=="logout")
{
	unset($_SESSION["userSessionName"]);
	// unset($_SESSION["id"]);
	session_unset(); 
	//echo $_SESSION["usersessionname"];
	session_destroy(); 
	header("Location: ../index.php"); 
	exit;
}

?>
