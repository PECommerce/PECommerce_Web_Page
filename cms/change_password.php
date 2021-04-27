

<?php include_once 'templates/header.php'; ?>
<?php include_once 'templates/sidebar.php'; ?>
<?php

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


<div id="content">
    <!--breadcrumbs-->
    <div id="content-header">
    </div>
    <!--End-breadcrumbs-->

    <div class="container-fluid">
        <!--Action boxes-->
                <!--End-Action boxes-->    
        <hr/>
        <!--form element start -->   
        <div class="row-fluid">  
            <div class="widget-box">
                <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
                    <h4>Change Password Form</h4>
                </div>
                <?php
    if(isset($msg) && !empty($msg)){
        echo '<center style="color:#ff0000" style="font-weight: bold"><h5>'.$msg.'</h5></center> ';
    }
    ?>
                <div class="widget-content nopadding">

                    <form action="change_password.php" method="post" class="form-horizontal form-group-lg"  accept-charset="utf-8" enctype='multipart/form-data' name="electionform" id="electionform">
                        
                        <div class="control-group">
                            <label class="control-label"><strong>Old Password * :</strong></label>
                            <div class="controls">
                                <input class="span11" style="height:35px" placeholder="Old Password" type="password" name="txtold" id="txtold" data-minlength="8"  maxlength="30"  required>
                                <span class="span10" style="color:#c1c1c1">Minimum 8 charecters required</span>
                            </div>
                            <div  class="alert alert-danger alert-dismissable field_short_headline span11" style="display:none; font-style:bold"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label"><strong>New Password * :</strong></label>
                            <div class="controls">
                                <input class="span11" style="height:35px" placeholder="New Password" type="password" name="txtpass" id="txtold" data-minlength="8"  maxlength="30"  required>
                                <span class="span10" style="color:#c1c1c1">Minimum 8 charecters required</span>
                            </div>
                            <div  class="alert alert-danger alert-dismissable field_short_headline span11" style="display:none; font-style:bold"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> </div>
                        </div>
                         <div class="control-group">
                            <label class="control-label"><strong>Confirm Password * :</strong></label>
                            <div class="controls">
                                <input class="span11" style="height:35px" placeholder="Confirm Password" type="password" name="txtcon" id="txtold" data-minlength="8"  maxlength="30"  required>
                                <span class="span10" style="color:#c1c1c1">Minimum 8 charecters required</span>
                            </div>
                            <div  class="alert alert-danger alert-dismissable field_short_headline span11" style="display:none; font-style:bold"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> </div>
                        </div>
                        
                         
   
                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary" name="save" value="1">Save</button>
                            <a href="#"><input type="button" class="btn btn-danger" value="Cancel" onclick="document.location.href = 'users.php'"></a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
        <!--form element end -->
    </div>
</div>


 <?php include_once 'templates/footer.php';

 ?>