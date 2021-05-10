

<?php include_once 'templates/header.php'; ?>
<?php include_once 'templates/sidebar.php'; ?>
<?php
if($_SESSION["user_type"]=="Seller")
{
    
        header("Location: users.php");
    
}

if(isset($_POST["save"])){
        // Insert query

    $username = mysqli_real_escape_string($conn,$_POST["txtusername"]);
    $f_name=mysqli_real_escape_string($conn,$_POST["txtf_name"]);
    $l_name=mysqli_real_escape_string($conn,$_POST["txtl_name"]);
    $pass = mysqli_real_escape_string($conn,md5($_POST["txtpass"]));
    $pass1 = mysqli_real_escape_string($conn,md5($_POST["txtpass1"]));
    $contact =  $_POST["txtcontact"];
    $address = mysqli_real_escape_string($conn,$_POST["txtaddress"]);
    $email=mysqli_real_escape_string($conn,$_POST["txtemail"]);
    $type=$_POST["txtType"];
    
    if($pass!=$pass1)
    {
        $msg = "Password and Confirm Password do not match. Please Try again.";
    }else{
        $sqlcheck="select user_id from tbl_users where username='".$username."'";
        $s=mysqli_query($conn,$sqlcheck);    
        if(mysqli_num_rows($s)>0)
    {
        $msg = "This user is already exists. Please try another name";
    }else{
        $sqlInsert = "insert into tbl_users (username,first_name,last_name,email_id,contact,address,pass,user_type) values('".$username."','".$f_name."','".$l_name."','".$email."','".$contact."','".$address."','".$pass."','".$type."')";    
        if(mysqli_query($conn,$sqlInsert))
        {
           header("Location: users.php");
        }else{
            $msg.="Error".  mysqli_error($conn);
        }
    }  
}
}

?>


<div id="content">
    <!--breadcrumbs-->
    <div id="content-header">
        <div id="breadcrumb"> <a href="users.php" title="Go to Users" class="tip-bottom"><i class="icon-home"></i> Users</a><a href="user_add.php">Add User</a></div>
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
                    <h4>Users Add Form</h4>
                </div>
                <?php
    if(isset($msg) && !empty($msg)){
        echo '<center style="color:#ff0000" style="font-weight: bold"><h5>'.$msg.'</h5></center> ';
    }
    ?>
                <div class="widget-content nopadding">

                                        <form action="user_add.php" method="post" class="form-horizontal form-group-lg"  accept-charset="utf-8" enctype='multipart/form-data' name="electionform" id="electionform">
                        
                        <div class="control-group">
                            <label class="control-label"><strong>Username* :</strong></label>
                            <div class="controls">
                                <input class="span11" style="height:35px" placeholder="Username" type="text" name="txtusername" id="txtusername" data-minlength="5"  maxlength="30" value="<?php echo $_POST["txtusername"]; ?>" required>
                                <span class="span10" style="color:#c1c1c1">Maximum 30 charecters allowed</span>
                            </div>
                            <div  class="alert alert-danger alert-dismissable field_short_headline span11" style="display:none; font-style:bold"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> </div>
                        </div>  
                        <div class="control-group">
                            <label class="control-label"><strong>First Name* :</strong></label>
                            <div class="controls">
                                <input class="span11" style="height:35px" placeholder="First Name" type="text" name="txtf_name" id="txtf_name" data-minlength="5"  maxlength="30" value="<?php echo $_POST["txtf_name"]; ?>" required>
                                <span class="span10" style="color:#c1c1c1">Maximum 30 charecters allowed</span>
                            </div>
                            <div  class="alert alert-danger alert-dismissable field_short_headline span11" style="display:none; font-style:bold"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> </div>
                        </div>
                        
                         <div class="control-group">
                            <label class="control-label"><strong>Last Name* :</strong></label>
                            <div class="controls">
                                <input class="span11" style="height:35px" placeholder="Last Name" type="text" name="txtl_name" id="txtl_name" data-minlength="5"  maxlength="30" value="<?php echo $_POST["txtl_name"]; ?>" required>
                                <span class="span10" style="color:#c1c1c1">Maximum 30 charecters allowed</span>
                            </div>
                            <div  class="alert alert-danger alert-dismissable field_short_headline span11" style="display:none; font-style:bold"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> </div>
                        </div>  
                        
                        <div class="control-group">
                            <label class="control-label"><strong>Email ID* :</strong></label>
                            <div class="controls">
                                <input class="span11" style="height:35px" placeholder="Email ID" type="email" name="txtemail" id="txtemail" data-minlength="10"  maxlength="200" value="<?php echo $_POST["txtemail"]; ?>" required>
                                <span class="span10" style="color:#c1c1c1">Maximum 200 charecters allowed</span>
                            </div>
                            <div  class="alert alert-danger alert-dismissable field_short_headline span11" style="display:none; font-style:bold"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> </div>
                        </div> 
                                            
                        <div class="control-group">
                            <label class="control-label"><strong>Contact No. * :</strong></label>
                            <div class="controls">
                                <input class="span11" style="height:35px" placeholder="Contact No." type="number" name="txtcontact" id="txtcontact" data-minlength="10"  maxlength="10" value="<?php echo $_POST["txtcontact"]; ?>" required>
                            </div>
                            <div  class="alert alert-danger alert-dismissable field_short_headline span11" style="display:none; font-style:bold"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> </div>
                        </div> 
                                            
                        <div class="control-group">
                            <label class="control-label"><strong>Address* :</strong></label>
                            <div class="controls">
                                <textarea name="txtaddress" rows="8" cols="60"><?php echo $_POST["txtaddress"]; ?></textarea>

                            </div>
                        </div>
                                  
                         <div class="control-group">
                            <label class="control-label"><strong>Password * :</strong></label>
                            <div class="controls">
                                <input class="span11" style="height:35px" placeholder="Password" type="password" name="txtpass" id="txtpass" data-minlength="8" required>
                                <span class="span10" style="color:#c1c1c1">Minimum 8 charecters required</span>
                            </div>
                            <div  class="alert alert-danger alert-dismissable field_short_headline span11" style="display:none; font-style:bold"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> </div>
                        </div> 
                        
                        <div class="control-group">
                            <label class="control-label"><strong>Confirm Password * :</strong></label>
                            <div class="controls">
                                <input class="span11" style="height:35px" placeholder="Confirm Password" type="password" name="txtpass1" id="txtpass1" data-minlength="8" required>
                                <span class="span10" style="color:#c1c1c1">Minimum 8 charecters required</span>
                            </div>
                            <div  class="alert alert-danger alert-dismissable field_short_headline span11" style="display:none; font-style:bold"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> </div>
                        </div>                    

                        <div class="control-group">
                            <label class="control-label"><strong>User Type* :</strong></label>
                            <div class="controls">
                                <select class="span11" style="height:35px" id="txtType" name="txtType" required>
                                    <option value="Buyer" style="font-weight: bold" <?php if( $_POST["txtType"]=="Buyer") 
                                        echo"selected";
                                    if(isset($_POST["txtType"]) && !empty($_POST["txtType"]) )
                                            echo "selected";
                                    ?>>Buyer</option>
                                    <option value="Seller" style="font-weight: bold" <?php if( $_POST["txtType"]=="Seller") echo"selected"; ?>>Seller</option>
                                    <option value="Admin" style="font-weight: bold" <?php if( $_POST["txtType"]=="Admin") echo"selected"; ?>>Admin</option>
                                </select>
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


 <?php include_once 'templates/footer.php'; ?>
