<?php

include 'admin_dashboard_header.php';
include "../utilities/connection.php";

?>
<script>
$('document').ready(function(){
	var name,id;
	$('body').on("click",".edit_btn",function(){
		id=$(this).attr('id');
		
		usertype=$(this).attr('usertype');
		$('.edit_usertype').val(usertype);
		$('.edit_id').val(id);
	})
	var count=0;
	$('.nextas').click(function()
	{   
		count+=10;
		console.log(count);
		$.ajax({
			type:"POST",
			data:{"next":"next"},
			url:"../controller/limitcontrol.php?counter="+count,
			dataType:"json",
			success:function(result)
			{var data='';
				for(i=0;i<result.length;i++)
				{
                     data+='<tr><td class="name'+result[i].id+'">'+result[i].name+'</td></td><td class="designation'+result[i].id+'">'+result[i].designation+'</td>';
				if(result[i].usertype==0){
					data+='<td class="usertype'+result[i].id+'">User</td>';
				}
				else if(result[i].usertype==1){
				data+='<td class="usertype'+result[i].id+'">Project Manager</td>';
			         }
				     data+='<td><button class="edit_btn row'+result[i].id+'" id="'+result[i].id+'" usertype="'+result[i].usertype+'" data-toggle="modal" data-target=".myModal">Edit</button></td></tr>';
					}
					 $('.pre').remove();
                     $('#id_table').html(data);

				}
		});


	});
	$('.change_btn').click(function(e){
		e.preventDefault();
        var id=$('.edit_id').val();
		var usertype=$('.edit_usertype').val();
		var dataString={"id":id,"usertype":usertype,"callertype":"editusertype"};
		$.ajax({

			type:"POST",
			data:dataString,
			url:"../controller/edit_user.php",
			dataType:"json",
			success:function(result){



				if(result.usertype==0){
					$('.usertype'+result.id).html("User");
				}
				else if(result.usertype==1){
					$('.usertype'+result.id).html("Project Manager");
				}
				// $('.usertype'+result.id).html(result.usertype);

				$('.row'+result.id).attr('usertype',result.usertype);
				
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
<div id="filter_reports_div" style="float:left;padding:5px;max-height:50px;text-align:center;background-color:#eee">
	<form method="POST" action="../layouts/filtered_users.php">
		<label>Filter by User's name</label>
		<input type="text" name="filter_user" placeholder="Enter User's Name" class="auto">
		<input type="submit" value="Filter" class="btn-primary">
	</form>
</div>
<table id="id_table" class="table table-bordered table-hover">
	<tr>
		<th scope="col">Name</th>
		<th scope="col">Designation</th>
		<th scope="col">Usertype</th>
		<th scope="col">Action</th>
	</tr>

	<?php

	$sql="SELECT * FROM user limit 10";
	$result=mysqli_query($link,$sql);
	if(mysqli_num_rows($result)>0){
		$table='';
		while($row=mysqli_fetch_array($result))
		{
				$table.='<tr class="row'.$row['id'].' pre">
				<td class="name'.$row['id'].'" >'.$row['name'].'</td>
				<td class="designation'.$row['id'].'">'.$row['designation'].'</td>';
				
				if($row['usertype']==0){
				$table.='<td class="usertype'.$row['id'].'">User</td>';
			    }
			 else if($row['usertype']==1){
				$table.='<td class="usertype'.$row['id'].'">Project Manager</td>';
			    }


			
			$table.='</td><td><button class="edit_btn row'.$row['id'].'"usertype="'.$row['usertype'].'"id="'.$row['id'].'" data-toggle="modal" data-target=".myModal">Edit</button></td>
			</tr>';
		}
		echo $table;
	}

	?>
</table>
 <div style="text-align:center;">
				<ul class = "pager" >
							   <li><a href = "" id="left" class="leftas" style="width:100px;">Previous</a></li>
							   <li><a class="nextas" id="next" name="next"  style="width:100px;">Next</a>
							   </li>
							</ul>
 </div>
<div class="modal fade myModal">
	<div class="edit_div">
		<button type="button" class="close_edit_btn" aria-label="Close" data-dismiss="modal">
			<span>&times;</span>
		</button><br>
		<form method="POST">
			<input type="hidden" placeholder="id" name="id" class="form-control input-md edit_id">
			<select class="form-control input-md edit_usertype">
				<option value=0>User</option>
				<option value=1>Project Manager</option>
			</select>
	    <button class="change_btn btn btn-primary" style="margin-top:5px;">Change</button>
		</form>
	</div>
</div>


