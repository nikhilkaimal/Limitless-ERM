<?php

include '../utilities/connection.php';

if(@$_POST["adduser"]=="Add User"){

  $username=$_REQUEST['name'];
	$password=$_REQUEST['pass'];
	$email=$_REQUEST['email'];
	$usertype=$_REQUEST['usertype'];
	$designation=$_REQUEST['designation'];
	$projectname=$_REQUEST['projectname'];
	$status=$_REQUEST['status'];
	$addedon=$_REQUEST['addedon'];

  $sql = "INSERT INTO user(name,email,password,designation,projectname,status,Addedon,usertype) VALUES ('$username','$email','$password','$designation','$projectname','$status','$addedon','$usertype')";

  $query = mysqli_query($link,$sql);

  if($query){
    ?>
		<script>
			alert("Hi,user is added successfully");
			window.location.replace("../layouts/adduser.php");
		</script>
		<?php
	}
}

?>
