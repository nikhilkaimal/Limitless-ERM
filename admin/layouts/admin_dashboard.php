<?php

include '../utilities/connection.php';
include 'admin_dashboard_header.php';

?>

<div class="col-lg-3 col-sm-6 col-md-6 col-xs-12">
	<div class="boxs top_report_chart l-amber" style="height:150px;">
		<div class="boxs-body">
			<h1 class="mt-0">
				<?php
				$sql="SELECT id,name,status FROM user";
				if($result=mysqli_query($link,$sql)){
					if(mysqli_num_rows($result)>0){
						$table='';
						$user_count=mysqli_num_rows($result);
						$table.='<tr><td>'.$user_count.'</td></tr>';
						echo $table;
					}
				}
				?>
			</h1>
			<p>Total No. of Users</p>
		</div>
	</div>
</div>

<div class="col-lg-3 col-sm-6 col-md-6 col-xs-12">
	<div class="boxs top_report_chart l-blue" style="height:150px;">
		<div class="boxs-body">
			<h1 class="mt-0">
				<?php
				$sql='SELECT * FROM report';
				if($result=mysqli_query($link,$sql)){
					if(mysqli_num_rows($result)>0){
						$table='';

						$report_count=(mysqli_num_rows($result));

						$table.='<td>'.($report_count).'</td></tr>';

						echo $table;
					}
				}
				?>
			</h1>
			<p>Total no. of reports submitted till now</p>
		</div>
	</div>
</div>

<div class="col-lg-3 col-sm-6 col-md-6 col-xs-12">
	<div class="boxs top_report_chart l-green" style="height:150px;">
		<div class="boxs-body">
			<h1 class="mt-0">
				<?php
				$date = date('Y/m/d', strtotime("-1 day"));
				$from=$date.' 00:00:00';
				$to=$date.' 23:59:59';
				$sql='SELECT userid,reporttitle,description FROM report where reportdate between"'.$from.'" and "'.$to.'"';
				if($result=mysqli_query($link,$sql)){
					if(mysqli_num_rows($result)>0){

						$table='';

						$report_count=(mysqli_num_rows($result));

						$table.='<td>'.($report_count).'</td></tr>';

						echo $table;
					}
					else{
						$table='';
						$table.='<td>-</td></tr>';
						echo $table;
					}
				}
				?>
			</h1>
			<p> No of reports submitted on <?php echo date('d/m/Y', strtotime("-1 day")); ?></p>
		</div>
	</div>
</div>

<?php include 'admin_dashboard_footer.php' ?>
