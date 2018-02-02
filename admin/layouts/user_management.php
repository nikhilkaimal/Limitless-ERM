<?php 
include "../utilities/connection.php";
include "admin_dashboard_header.php";
?>

				<script>
					$('document').ready(function(){
						var name="",id="";
						$('.edit_btn').click(function(){
							id=$(this).attr('id');
							name=$(this).attr('name');
							status=$(this).attr('status');
							$('.edit_name').val(name);
							// $('.edit_status').val(status);
						})
						$('.change_btn').click(function(e){
							e.preventDefault();
							var status=$('.edit_status').val();
							var dataString={"id":id,"name":name,"status":status,"callertype":"edittype"}
							// alert(dataString.status);
							$.ajax({
								type:"POST",
								data:dataString,
								url:"../controller/edit_status.php",
								dataType:"json",
								success:function(result){
									//alert(result);
									$('.status'+result.id).html(result.status);
								}
							})
						})
					})
				</script>
				<h2>List of Users</h2>
				<table class="table table-bordered table-hover">
					<tr>
						<th scope="col">ID</th>
						<th scope="col">Name</th>
						<th scope="col">Status</th>
						<th scope="col">Action</th>
					</tr>
					<?php
						$sql="SELECT id,name,status FROM users";
						if($result=mysqli_query($link,$sql)){
							if(mysqli_num_rows($result)>0){
								$table='';
								while($row=mysqli_fetch_array($result)){
									$table.='<tr><td class="id'.$row['id'].'">'.$row['id'].'</td><td class="user_name'.$row['id'].'">'.$row['name'].'</td><td class="status'.$row['id'].'">'.$row['status'].'</td><td><button class="edit_btn" id="'.$row['id'].'" name="'.$row['name'].'" status="'.$row['status'].'" data-toggle="modal" data-target=".myModal">Edit</button></td></tr>';
								}
								echo $table;
							}
						}
					?>
				</table>
			<div class="modal fade myModal">
				<div class="edit_div">
					<button type="button" class="close_edit_btn" aria-label="Close" data-dismiss="modal">
				    	<span>&times;</span>
					</button><br>
					<form method="POST">
						<input type="text" name="" placeholder="Name" class="form-control input-md edit_name">
						<input type="text" name="" placeholder="Status" class="form-control input-md edit_status">
					    <button class="change_btn" class="btn">Change</button>    	
	        		</form>
	        	</div>	
			</div>
		</div>
	</div>

<?php include 'admin_dashboard_footer.php' ?>