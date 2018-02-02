<?php

include"../utilities/connection.php";

if($_POST['page']=="viewuser"){
	$strlimit = $_POST['strlimit'];
	$sql = 'SELECT id,name,email,designation,status FROM user limit 7 offset '.$strlimit;
}
if($_POST['page']=="filtered_reports"){
	$date=$_POST['date'];
	$from=$date.' 00:00:00';
	$to=$date.' 23:59:59';
	$strlimit = $_POST['strlimit'];
	$sql = 'SELECT u1.id,u1.name, r1.reporttitle, r1.description, r1.reportdate FROM report r1 INNER JOIN user u1 ON r1.userid=u1.id where reportdate between"'.$from.'" and "'.$to.'"limit 5 offset '.$strlimit;
}

$array = array();

$query = mysqli_query($link,$sql);

while($row=mysqli_fetch_array($query)){
	$array[] = $row;
}

echo json_encode($array);

?>
