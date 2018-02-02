<?php include"../layouts/admin_dashboard_header.php";?>

<div class="row">
    <div class="col-lg-12">
       <h1 class="page-header">Add User</h1>
    </div>
	<form action="../controller/add_user.php" method="POST" style="max-width:550px;">

     <div class="form-group">
                    <label for="name" class="col-sm-3 control-label oldpswd">Name</label>
                    <div class="col-sm-9">
                        <input type="text" name="name" placeholder=" Enter the name" class="form-control" required/>
                    </div>
                </div>
                <div class="form-group">
                    <label for="Email Id" class="col-sm-3 control-label newpswd">Email Id</label>
                    <div class="col-sm-9">
                        <input type="text" name="email" placeholder="Email" class="form-control" required/>
                    </div>
                </div>
                <div class="form-group">
                    <label for="Password" class="col-sm-3 control-label newpswd">Password</label>
                    <div class="col-sm-9">
                        <input type="text" name="pass" placeholder="password" class="form-control" required/>
                    </div>
                </div>
                <div class="form-group">
                    <label for="Designation" class="col-sm-3 control-label newpswd">Designation</label>
                    <div class="col-sm-9">
                        <input type="text" name="designation" placeholder="designation" class="form-control" required/>
                    </div>
                </div>
                <div class="form-group">
                    <label for="Project name" class="col-sm-3 control-label newpswd">Project Name</label>
                    <div class="col-sm-9">
                        <input type="text" name="projectname" placeholder="project name" class="form-control" required/>
                    </div>
                </div>
                <div class="form-group">
                    <label for="Status" class="col-sm-3 control-label newpswd">Status</label>
                    <div class="col-sm-9">
                        <select style="width:100%"  name="status" class="form-control" required/>>
						  <option value="1">Active</option>
						  <option value="0">Inactive</option>
						</select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="Added on" class="col-sm-3 control-label newpswd">Added on</label>
                    <div class="col-sm-9">
                        <input type="date" name="addedon" placeholder="added on" class="form-control" required/>
                    </div>
                </div>
                <div class="form-group">
                    <label for="Usertype" class="col-sm-3 control-label newpswd"> Usertype</label>
                    <div class="col-sm-9">
                        <input type="text" name="usertype" placeholder="usertype" class="form-control" required/>
                    </div>
                </div>




                <div class="form-group">
                    <div class="col-sm-9 col-sm-offset-3">
                        <input name="adduser" value="Add User"  type="submit" class="btn btn-primary btn-block changepassword">
                    </div>
                </div>
            </form> <!-- /form
<?php include"../layouts/admin_dashboard_footer.php";?>
