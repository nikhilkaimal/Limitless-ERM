<?php

include 'connection.php';

if(@$_GET['db']=='user'){
	if (isset($_GET['term'])){
		$return_arr = array();
		try {
		    $conn = new PDO("mysql:host=".$servername.";dbname=".$database, $username, $password);
		    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		    $stmt = $conn->prepare('SELECT name FROM user WHERE name LIKE :term');

		    $stmt->execute(array('term' => $_GET['term'].'%'));

		    while($row = $stmt->fetch()) {
		        $return_arr[] =  $row['name'];
		    }
		} catch(PDOException $e) {
		    echo 'ERROR: ' . $e->getMessage();
		}
	    /* Toss back results as json encoded array. */
	    echo json_encode($return_arr);
	}
}
if(@$_GET['db']=='report'){
	if (isset($_GET['term'])){
		$sql=
		$return_arr = array();
		try {
		    $conn = new PDO("mysql:host=".$servername.";dbname=".$database, $username, $password);
		    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		    //$stmt = $conn->prepare('SELECT u1.id,r1.id,u1.name FROM user u1 inner join report r1 WHERE name LIKE :term and r1.userid=u1.id');
		    $stmt = $conn->prepare('SELECT name FROM user WHERE name LIKE :term');

		    $stmt->execute(array('term' => $_GET['term'].'%'));

		    while($row = $stmt->fetch()) {
		        $return_arr[] =  $row['name'];
		    }
		} catch(PDOException $e) {
		    echo 'ERROR: ' . $e->getMessage();
		}
	    /* Toss back results as json encoded array. */
	    echo json_encode($return_arr);
	}
}
?>
