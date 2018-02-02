<?php

include '../utilities/connection.php';
include 'admin_dashboard_header.php';

$filter_name=$_POST['filter_user'];

if($filter_name==""){
	header("Location:viewuser.php?name=empty");
	exit;
}
else{
	?>
	<h3>Details of <?php echo $filter_name; ?></h3>
	<table class="data_table">
		<thead>
			<th scope="col">Email</th>
			<th scope="col">Designation</th>
			<th scope="col">Status</th>
			<th scope="col">Action</th>
		</thead>
		<tbody>
			<?php
			$sql= 'SELECT id,name,email,designation,status FROM user where name="'.$filter_name.'"';

			if($result=mysqli_query($link,$sql)){
				if(mysqli_num_rows($result)>0){
					$data='<h3>Reports of '.$filter_name.'</h3>';
					$table='<tr>
					<th scope="col">Email</th>
					<th scope="col">Designation</th>
					<th scope="col">Status</th>
					<th scope="col">Action</th>
					';

					while($row=mysqli_fetch_array($result)){
						$table='<tr>
						<td class="email'.$row['id'].'">'.$row['email'].'</td>
        		<td class="designation'.$row['id'].'">'.$row['designation'].'</td>';
				if($row['status']==0){
					$table.='<td class="status'.$row['id'].'">Inactive</td>';
				}
				else{
					$table.='<td class="status'.$row['id'].'">Active</td>';
				}
				//<td class="status'.$row['id'].'">'.$row['status'].'</td>
				$table.='<td><button class="edit_btn" id="'.$row['id'].'" name="'.$row['name'].'" email="'.$row['email'].'" designation="'.$row['designation'].'" status="'.$row['status'].'" data-toggle="modal" data-target=".myModal">Edit</button></td>
				</tr>';
			}
			echo $table;
		}
		else{
			?>
			<div style="color:red;weight:bold;width:100%;padding:20px;font-size:20px;text-align:center;background-color:#eee">No User Found</div>
			<?php
		}
	}
}
?>

</tbody>
</table>

<script>
$('document').ready(function(){

	var name="",id="";

	$('.edit_btn').click(function(){

		id=$(this).attr('id');
		name=$(this).attr('name');
		email=$(this).attr('email');
		desig=$(this).attr('designation');
		status=$(this).attr('status');

		$('.edit_name').val(name);
		$('.edit_mail').val(email);
		$('.edit_desig').val(desig);
		$('.edit_status').val(status);

	})
	$('.change_btn').click(function(e){

		e.preventDefault();

		var status=$('.edit_status').val();
		var name=$('.edit_name').val();
		var email=$('.edit_mail').val();
		var designation=$('.edit_desig').val();
		var dataString={"id":id,"name":name,"email":email,"designation":designation,"status":status,"callertype":"edittype"};

		$.ajax({
			type:"POST",
			data:dataString,
			url:"../controller/edit_user.php",
			dataType:"json",
			success:function(result){
				$('.email'+result.id).html(result.email);
				$('.designation'+result.id).html(result.designation);
				if(result.status==0){
					$('.status'+result.id).html("Inactive");
				}
				else{
					$('.status'+result.id).html("Active");
				}
				$('.row'+result.id).attr('name',result.name);
				$('.row'+result.id).attr('email',result.email);
				$('.row'+result.id).attr('designation',result.designation);
				$('.row'+result.id).attr('status',result.status);
			}
		})
	})
});

</script>

<div class="modal fade myModal">
	<div class="edit_div">
		<button type="button" class="close_edit_btn" aria-label="Close" data-dismiss="modal">
			<span>&times;</span>
		</button><br>
		<form method="POST">
			<input type="text" name="name" placeholder="Name" class="form-control input-md edit_name">
			<input type="text" name="email" placeholder="Email" class="form-control input-md edit_mail">
			<input type="text" name="designation" placeholder="Designation" class="form-control input-md edit_desig">
			<select class="form-control input-md edit_status">
				<option value=0>Inactive</option>
				<option value=1>Active</option>
			</select>
	    <button class="change_btn btn btn-primary" style="margin-top:5px;">Change</button>
		</form>
	</div>
</div>

<?php include 'admin_dashboard_footer.php' ?>
