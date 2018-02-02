<?php

include "../utilities/connection.php";
  
if(@$_POST["next"]=="next"){

	   $array = [];

	$sql = "SELECT * from user limit 10 offset ".$_GET['counter'];

	$query=mysqli_query($link,$sql);
	while($result=mysqli_fetch_array($query))
	{
          $array[]=$result;
	}
  echo json_encode($array);
}

?>