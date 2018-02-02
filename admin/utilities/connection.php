<?php

ob_start();
ob_flush();

$servername = "localhost";
// $username = "sololimi_solo";
$username = "root";
// $password = 'Pa#$w0rd@slo';
$password = '';
$database	= "reportproject";

// Create connection
$link = mysqli_connect($servername, $username, $password);

// Check connection
if(!$link){
	die("Connection failed: " . mysqli_connect_error());
}

mysqli_select_db($link,$database);
//echo "Connection to DB Successfull";

?>
