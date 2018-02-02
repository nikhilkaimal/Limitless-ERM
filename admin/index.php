<?php

include 'layouts/index_header.php';

if(@$_GET['status']=='fail'){
		?>
		<script>
			$('document').ready(function(){
				alert("Invalid Username or Password !");
			})
		</script>
		<?php
	}

?>

<body>
	<!-- Header -->
	<header class="header" id="top">
		<div class="text-vertical-center">
			<div class="login">
				<div class=" well login">
					<form class="login1" action="controller/login.php" method="POST">
						<div style="color:white"><h2><b>Admin Login</b></h2></div>
						<input type="text" name="username" placeholder="Username" required="required" />
						<input type="password" name="password" placeholder="Password" required="required" />
						<button type="submit" name="login_btn" value="Login" class="btn btn-primary btn-block btn-large" >Login</button>
					</form>
				</div>
			</div>
		</div>
	</header>
