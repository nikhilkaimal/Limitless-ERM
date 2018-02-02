<?php

include "../utilities/connection.php";
include "../layouts/admin_dashboard_header.php";

if(@$_GET[name]=='empty'){
	?>
	<script>
		alert("Please enter a name!");
	</script>
	<?php
}

?>

<script>

$('document').ready(function(){

	var name,id;

	$('body').on('click','.pages1',function(){
		var value_pages   = $(this).attr('value');
		var no_of_records = $("#no_of_records").val();
		var strlimit;
		if(value_pages=="rightas"){
			var start=$('#strlimit').attr("start");
			var last=$('#strlimit').attr("last");
			strlimit=last;
			if(eval(strlimit)<eval(no_of_records)){
				$("#strlimit").attr("start",last);
				$("#strlimit").attr("last",eval(last)+5);
				var y=$("#strlimit").attr("start");
				var z=$("#strlimit").attr("last");
			}
			else{
				return false;
			}
		}
		else if(value_pages=="leftas"){
			var start=$('#strlimit').attr("start");
			strlimit=start-5;
			if(strlimit >=0){
				$("#strlimit").attr("last",start);
				$("#strlimit").attr("start",strlimit);
			}
			else{
				return false;
			}
		}
		else if(value_pages=="other"){
			other_start=$(this).attr("start");
			other_end=$(this).attr("end");
			strlimit=other_start;
			$("#strlimit").attr("last",other_end);
			$("#strlimit").attr("start",other_start);
		}
		var dataString = {strlimit:strlimit,page:"viewuser"};
		$.ajax({
			type:"POST",
			data:dataString,
			dataType:"json",
			url:"../controller/pagination.php",
			success:function(result){
				var table='';
				for(i=0;i<result.length;i++){
					table +='<tr><td class="id'+result[i].id+'">'+result[i].name+'</td><td class="email'+result[i].id+'">'+result[i].email+'</td><td class="designation'+result[i].id+'">'+result[i].designation+'</td>';
					if(result[i].status==0){
						table+='<td class="status'+result[i].id+'">Inactive</td>';
					}
					else{
						table+='<td class="status'+result[i].id+'">Active</td>';
					}
					table+='<td><button class="edit_btn row'+result[i].id+'" id="'+result[i].id+'" name="'+result[i].name+'" email="'+result[i].email+'" designation="'+result[i].designation+'" status="'+result[i].status+'" data-toggle="modal" data-target=".myModal">Edit</button></td></tr>';
				}
				$(".data_table tbody").html(table);
			}
		})
	})

	$('body').on("click",".edit_btn",function(){
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
	var count=0;

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
				$('.name'+result.id).html(result.name);
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
	$(".auto").autocomplete({
		source: "../utilities/search.php?db=user",
		minLength: 2
	});
});
</script>

<h2>List of Users</h2>

<div id="filter_reports_div" style="float:left;padding:5px;max-height:40px;text-align:center;background-color:#eee">
	<form method="POST" action="../layouts/filtered_users.php">
		<label>Filter by User's name</label>
		<input type="text" name="filter_user" placeholder="Enter User's Name" class="auto">
		<input type="submit" value="Filter" class="btn-primary">
	</form>
</div>

<table class="table table-bordered table-hover data_table">
	<thead>
		<tr>
			<th scope="col">Name</th>
			<th scope="col">Email</th>
			<th scope="col">Designation</th>
			<th scope="col">Status</th>
			<th scope="col">Action</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$sql='SELECT * FROM user limit 7';
		$result=mysqli_query($link,$sql);
		if(mysqli_num_rows($result)>0){
			$table='';
			while($row=mysqli_fetch_array($result)){
				$table.='<tr class="row'.$row['id'].' pre">
				<td class="name'.$row['id'].'" >'.$row['name'].'</td>
				<td class="email'.$row['id'].'">'.$row['email'].'</td>
				<td class="designation'.$row['id'].'">'.$row['designation'].'</td>';
				if($row['status']==0){
					$table.='<td class="status'.$row['id'].'">Inactive</td>';
				}
				else{
					$table.='<td class="status'.$row['id'].'">Active</td>';
				}
				$table.='<td><button class="edit_btn row'.$row['id'].'" id="'.$row['id'].'" name="'.$row['name'].'" email="'.$row['email'].'"designation="'.$row['designation'].'" status="'.$row['status'].'"data-toggle="modal" data-target=".myModal">Edit</button></td>
				</tr>';
			}
			echo $table;
		}
		?>
	</tbody>
</table>

<div style="text-align:center;">
  <input type="hidden" id="strlimit" value="5" start="0" last="5">
  <ul class = "pager" id="pager">
    <li>
      <a class="pages1" value="leftas" style="width:40px;cursor:pointer"><</a>
    </li>
    <?php

    $sql='SELECT * from user';
    $query = mysqli_query($link,$sql);
    $count =mysqli_num_rows($query);
    echo "<li><input type='hidden' id='no_of_records' value='".$count."'/><li>";
    for($i=1;$i<(($count/7)+(1));$i++){
      $temp=$i*5;
      echo "<li><a class='pages1' value='other' start=".($temp-5)." end=".$temp." style='width:50px;cursor:pointer'>".$i."</a></li>";
    }
    ?>
    <li>
      <a class="pages1" value="rightas" style="width:40px;cursor:pointer;">></a>
    </li>
  </ul>
</div>

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

<?php include 'admin_dashboard_footer.php'; ?>
