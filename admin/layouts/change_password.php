<?php include 'admin_dashboard_header.php' ?>











<div class="row">
    <div class="col-lg-12">
                    <h1 class="page-header">Change Password</h1>
                     
                
                
                </div>
                <form method="POST" action="../controller/change_pswd.php" style="max-width:550px;">
                <div class="form-group">
                    <label for="oldpassword" class="col-sm-3 control-label oldpswd">Old Password</label>
                    <div class="col-sm-9">
                        <input type="text" name="oldpass" placeholder=" password" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label for="newpassword" class="col-sm-3 control-label newpswd">New Password</label>
                    <div class="col-sm-9">
                        <input type="text" name="newpass" placeholder="new password" class="form-control">
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="col-sm-9 col-sm-offset-3">
                        <input name="changepassword" value="Change Password"  type="submit" class="btn btn-primary btn-block changepassword">
                    </div>
                </div>
            </form> <!-- /form
        
                </div>