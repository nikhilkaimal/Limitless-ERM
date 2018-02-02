<?php


include "../utilities/connection.php";

if(@$_POST["callertype"]=="edittype"){
	$id=$_POST["id"];
	$status=$_POST["status"];
	$name=$_POST["name"];
	$email=$_POST["email"];
	$designation=$_POST["designation"];

	$sql='UPDATE user SET name="'.$name.'", email="'.$email.'", designation="'.$designation.'", status="'.$status.'" where id="'.$id.'"';

	$query=mysqli_query($link,$sql);
	echo json_encode($_POST);
}
if(@$_POST["callertype"]=="editusertype"){
	
	$id=$_POST["id"];
	
	
	$usertype=$_POST["usertype"];
	

	$sql='UPDATE user SET usertype="'.$usertype.'" where id="'.$id.'"';

	$query=mysqli_query($link,$sql);
	echo json_encode($_POST);
}

?>
