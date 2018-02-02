<?php
 	session_start();
 	if($_SESSION["userSessionName"]=="")
	{
		header("Location: ../index.php");
	}
?>

<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">

  <link rel="stylesheet" href="../css/admin_dash_bootstrap.min.css">
  <link rel="stylesheet" href="../css/metisMenu.min.css" >
  <link rel="stylesheet" href="../css/sb-admin-2.css" >
  <link rel="stylesheet" href="../css/morris.css">
  <link rel="stylesheet" type="text/css" href="../css/admin_dash_font-awesome.min.css">
  <link rel="stylesheet" href="../css/admin_dashboard.css">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.1/themes/base/minified/jquery-ui.min.css" type="text/css">
  <link rel="stylesheet" href="../css/manjeet_sir_falcon.css" type="text/css">

  <script src="../js/jquery.min.js"></script>
  <script src="../js/admin_dash_bootstrap.min.js"></script>
  <script src="../js/raphael.min.js"></script>
	<script src="../js/morris.min.js"></script>
	<script src="../js/morris-data.js"></script>
	<script src="../js/sb-admin-2.js"></script>
  <script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
  <script type="text/javascript" src="http://code.jquery.com/ui/1.10.1/jquery-ui.min.js"></script>
</head>
<body>
  <div id="wrapper" style="background-color:#00b9f5">
		<nav class="navbar navbar-default navbar-static-top" role="navigation"  style="margin-bottom: 0;background-color: #00b9f5; border-bottom: 2px solid #eee;">
        <!--Navbar-->
        <a class="navbar-brand" href="admin_dashboard.php">
         <img style="margin-left:-15px " src="../img/logo.png" class=" img-rounded" alt="">
        </a>
        <ul class="nav navbar-top-links navbar-right">
          <li >
            <span id="time" class="btn btn">
            <?php
            date_default_timezone_set('Asia/Kolkata');
            ?>
            <script type="text/javascript">
              var timestamp = '<?php time(); ?>';
              function updateTime(){
                $('#time').html(Date(timestamp).split('GMT')[0]);
                timestamp++;
              }
              setInterval(updateTime);
              setInterval(updateTime,1000);
            </script>
          </span>
          </li>
          <li>
            <?php
            echo "Welcome ".$_SESSION['userSessionName'];
          	?>
          </li>
          <li>
            <span class="btn"  style="background-color:#84b54c">
          	<a href="../controller/login.php?caller=logout" style="color"><b>Logout</b></a></span>
          </li>
        </ul>
      </nav>
        <!--Sidebar-->
      <div class="navbar-default sidebar" role="navigation" style="margin-top:0;background-color: #00b9f5; width:200px">
        <div class="sidebar-nav navbar-collapse">
          <ul class="nav" id="side-menu">
            <li>
              <a id="report_tab" href="admin_reports.php">Reports</a>
            </li>
            <li>
              <a id="user_mngmnt_tab" class="dropdown-toggle" href="user_management.php" data-toggle="dropdown">User Management</a>
              <ul class="dropdown-menu">
                <li style="width:200px">
                  <a href="../layouts/adduser.php">Add User</a>
                </li>
                <li style="width:200px">
                  <a href="../layouts/viewuser.php">View Users</a>
                </li>
              </ul>
            </li>
            <li>
              <a id="project_tab" href="project_management.php">Project Management</a>
            </li>
            <li>
              <a id="settings_tab" class="dropdown-toggle" href="../views/usermanage.php" data-toggle="dropdown">Settings</a>
              <ul class="dropdown-menu">
                <li style="width:200px"><a href="../layouts/change_password.php">Change Password</a></li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
		<div id="page-wrapper" style="padding: 10px; margin-left:200">
