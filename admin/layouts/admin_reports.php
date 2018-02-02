<?php

include '../utilities/connection.php';
include 'admin_dashboard_header.php';

if(@$_GET['fields']=="empty"){
	?>
	<script>
	alert("Fields empty, please input atleast one field !");
	</script>
	<?php
}
?>

<div>
	<span style="font-size:25px;">
		Reports
	</span>
	<span style="color:orange;">
		(of
		<?php
			$show_date=date('d/m/Y', strtotime("-1 day"));
			$prev_date=date('Y/m/d', strtotime("-1 day"));
			echo $show_date;
		?>
		)
	</span>
</div>

<div id="filter_reports_div" style="float:left;padding:5px;text-align:center;background-color:#eee">
	<form method="POST" action="../layouts/filtered_reports.php">
		<label>Filter by User's name</label>
		<input type="text" name="filter_user" placeholder="Enter User's Name" class="auto">
		<label>Filter by Date</label>
		<input type="date" name="filter_date" placeholder="Enter Date">
		<input type="submit" value="Filter" style="background-color:grey;color:white;">
	</form>
</div>

<a href="../controller/report_excel.php?users=many&date=<?php echo $prev_date; ?>" class="excel_btn" style="padding:5px;text-align:center;">
	<button class="btn" style="background-color:green;float:right;border-radius:0px;color:white;">Download All Reports</button>
</a>

<script type="text/javascript">

$(function(){

	$(".auto").autocomplete({
		source: "../utilities/search.php?db=report",
		minLength: 2
	});

});
</script>

<table class="table table-bordered table-hover">
	<tr>
		<th scope="col">Name</th>
		<th scope="col">Report Title</th>
		<th scope="col">Report Description</th>
		<th scope="col">Submitted on</th>
	</tr>

	<?php
	$date = date('Y/m/d', strtotime("-1 day"));
	$from=$date.' 00:00:00';
	$to=$date.' 23:59:59';
	$sql = 'SELECT u1.id,u1.name, r1.reporttitle, r1.description, r1.reportdate FROM report r1 INNER JOIN user u1 ON r1.userid=u1.id where reportdate between"'.$from.'" and "'.$to.'"';
	if($result=mysqli_query($link,$sql)){
		if(mysqli_num_rows($result)>0){
			$table='';
			while($row=mysqli_fetch_array($result)){
				$table.='<tr><td class="id'.$row['id'].'">'.$row['name'].'</td><td class="report_title'.$row['id'].'">'.$row['reporttitle'].'</td><td class="report_description'.$row['id'].'">'.$row['description'].'</td><td class="report_date'.$row['id'].'">'.date('d-M-Y', strtotime($row['reportdate'])).'</td></tr>';
			}
			echo $table;
		}
		else{
			$table='';
			$table.='<tr style="color:red;"><td>No Reports Found</td></tr>';
			echo $table;
		}
	}
?>

</table>

<?php include 'admin_dashboard_footer.php' ?>
