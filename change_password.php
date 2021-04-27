<?php
require_once 'templates/header.php';
require_once 'templates/sidebar.php';
$id=$_SESSION["user_id"];
date_default_timezone_set('Asia/Kolkata');
$sql = "select pass from tbl_users where user_id=".$id;
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($result);

if(isset($_POST["save"])){
        // Insert query

    $old = mysqli_real_escape_string($conn,md5($_POST["txtold"]));
    $pass=mysqli_real_escape_string($conn,md5($_POST["txtpass"]));
    $con=mysqli_real_escape_string($conn,md5($_POST["txtcon"]));
    $msg="";
    if($row["pass"]==$old)
    {
        if($con==$pass)
        {
            if($pass!=$old){
                $sqlInsert = "update tbl_users set pass='".$pass."'";
                 if (mysqli_query($conn, $sqlInsert)) {
                header("Location: users.php");
            } else {
                $msg .= "Error" . mysqli_error($conn);
            }
            }
            else{
                $msg="New password can't be same as your old password";
            }
        }
        else {
            $msg="Password and Confirm password do not match";
        }
    }
    else
    {
        $msg="Old password doesn't match with current password";
    }
  
}
?>
<div class="col-sm-9">
					<!--sign up form-->
						<h2 class="title text-center">Change Password</h2>
                                                <div class="signup-form">
						<form action="login.php" method="post" class="form-horizontal form-group-lg"  accept-charset="utf-8" enctype='multipart/form-data' name="electionform" id="electionform">
                        
                        <div class="control-group">
                            <div class="controls">
                                <input class="span11" style="height:35px" placeholder="Old Password" type="password" name="txtold" id="txtold" data-minlength="8"  maxlength="30"  required>
                                <span class="span10" style="color:#c1c1c1"></span>
                            </div>
                            <div  class="alert alert-danger alert-dismissable field_short_headline span11" style="display:none; font-style:bold"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> </div>
                        </div>  
                        <div class="control-group">
                            <div class="controls">
                                <input class="span11" style="height:35px"placeholder="New Password" type="password" name="txtpass" id="txtold" data-minlength="8"  maxlength="30"  required>
                                <span class="span10" style="color:#c1c1c1"></span>
                            </div>
                            <div  class="alert alert-danger alert-dismissable field_short_headline span11" style="display:none; font-style:bold"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> </div>
                        </div>
                        
                         <div class="control-group">
                            <div class="controls">
                                <input class="span11" style="height:35px" placeholder="Confirm Password" type="password" name="txtcon" id="txtold" data-minlength="8"  maxlength="30"  required>
                                <span class="span10" style="color:#c1c1c1"></span>
                            </div>
                            <div  class="alert alert-danger alert-dismissable field_short_headline span11" style="display:none; font-style:bold"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> </div>
                        </div>  
                        
   
                        <div class="form-actions" style="padding-bottom: 30px;">
                            <button type="submit" class="btn btn-primary" name="save" value="1">Save</button>
                        </div>
                    </form>

					</div><!--/sign up form-->
				</div>
</div>
</div>

</section>
		
	<?php
require_once 'templates/footer.php';
?>