<?php include "../utilities/connection.php";

session_start();

$uid=$_SESSION['sessionId'];
$newpassword=$_POST['newpass'];

$sql='SELECT password from admin where id="'.$uid.'"';
$query=mysqli_query($link,$sql);
$row=mysqli_fetch_array($query);
$dbpass=$row['password'];
if($dbpass==$_POST['oldpass']){
	$sql="UPDATE admin SET password='".$newpassword."'WHERE id='".$uid."'";
	$query=mysqli_query($link,$sql);
   ?>
   <script>
   	alert("Password is successfully changed");
   	window.location.replace("../layouts/admin_dashboard.php");
   </script>
<?php	

}else{
	?>
	<script>
   	alert("Password is not changed,Please try again!!");
   	window.location.replace("../layouts/change_password.php");
   </script>
   <?php
	
   }

   ?>