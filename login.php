<?php
ob_start();
require_once 'templates/header.php';
if(isset($_SESSION["user_id"]) && !empty($_SESSION["user_id"]))
{
    header("Location: index.php");
}
if(isset($_POST["login_submit_btn"])){
    $username = mysqli_real_escape_string($conn,$_POST["username"]);
    $password = mysqli_real_escape_string($conn,md5($_POST["password"]));
    if(!empty($username) && !empty($password)){
        $sqlcheck="select user_id,user_type,first_name,active from tbl_users where username='".$username."' and pass='".$password."'";
        
        $s=mysqli_query($conn,$sqlcheck);
        
        $rdata  = mysqli_fetch_assoc($s);
        $msg="";
        if(mysqli_num_rows($s)> 0)
        {
            $_SESSION["user_id"]=$rdata["user_id"];
            $_SESSION["user_name"]=$rdata["first_name"];
            $_SESSION["user_type"]=$rdata["user_type"];
            if($rdata["active"]=='0')
            {
                
                $sql="update tbl_users set active='1' where user_id=".$_SESSION["user_id"];
                mysqli_query($conn, $sql);
       
                $chan="update tbl_items t set t.status='Y' where t.seller_id=".$_SESSION["user_id"];
                $ch=mysqli_query($conn,$chan);
            }
            header("Location: index.php");
        }
        else
        {
            $msg = "Incorrect Username or password. Please try again.";
        }
    }
    else{
        $msg = "Please enter Username or password!";
    }
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
             $sqlcheck="select user_id,user_type,first_name from tbl_users where username='".$username."' and pass='".$pass."'";
        
            $s=mysqli_query($conn,$sqlcheck);
        
            $rdata  = mysqli_fetch_assoc($s);
            $_SESSION["user_id"]=$rdata["user_id"];
            $_SESSION["user_name"]=$rdata["first_name"];
            $_SESSION["user_type"]=$rdata["user_type"];
           
            header("Location: index.php");
        }else{
            $msg.="Error".  mysqli_error($conn);
        }
    }  
}
}

?>
	
	<section ><!--form-->
		<div class="container">
			<div class="row">
				<div class="col-sm-4 col-sm-offset-1">
					<div class="login-form"><!--login form-->
						<h2 class="title text-center" >Login to your account</h2>
                                                <?php
                    if(isset($msg) && !empty($msg)){
                        echo '<center style="color:#ff0000">'.$msg.'</center> ';
                    }
                    ?>
						<form action="login.php" method="post">
							<input type="text" name="username" placeholder="Userame" />
							<input type="password" name="password" placeholder="Password" />
							
							<button type="submit" name="login_submit_btn" value="Login" class="btn btn-default">Login</button>
						</form>
					</div><!--/login form-->
				</div>
				<div class="col-sm-1">
					<h2 class="or">OR</h2>
				</div>
				<div class="col-sm-4">
					<div class="signup-form"><!--sign up form-->
						<h2 class="title text-center">New User Signup!</h2>
						<form action="login.php" method="post" class="form-horizontal form-group-lg"  accept-charset="utf-8" enctype='multipart/form-data' name="electionform" id="electionform">
                        
                        <div class="control-group">
                            <div class="controls">
                                <input class="span11" style="height:35px" placeholder="Username" type="text" name="txtusername" id="txtusername" data-minlength="5"  maxlength="30" value="<?php echo $_POST["txtusername"]; ?>" required>
                                <span class="span10" style="color:#c1c1c1"></span>
                            </div>
                            <div  class="alert alert-danger alert-dismissable field_short_headline span11" style="display:none; font-style:bold"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> </div>
                        </div>  
                        <div class="control-group">
                            <div class="controls">
                                <input class="span11" style="height:35px" placeholder="First Name" type="text" name="txtf_name" id="txtf_name" data-minlength="5"  maxlength="30" value="<?php echo $_POST["txtf_name"]; ?>" required>
                                <span class="span10" style="color:#c1c1c1"></span>
                            </div>
                            <div  class="alert alert-danger alert-dismissable field_short_headline span11" style="display:none; font-style:bold"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> </div>
                        </div>
                        
                         <div class="control-group">
                            <div class="controls">
                                <input class="span11" style="height:35px" placeholder="Last Name" type="text" name="txtl_name" id="txtl_name" data-minlength="5"  maxlength="30" value="<?php echo $_POST["txtl_name"]; ?>" required>
                                <span class="span10" style="color:#c1c1c1"></span>
                            </div>
                            <div  class="alert alert-danger alert-dismissable field_short_headline span11" style="display:none; font-style:bold"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> </div>
                        </div>  
                        
                        <div class="control-group">
                            <div class="controls">
                                <input class="span11" style="height:35px" placeholder="Email ID" type="email" name="txtemail" id="txtemail" data-minlength="10"  maxlength="200" value="<?php echo $_POST["txtemail"]; ?>" required>
                                <span class="span10" style="color:#c1c1c1"></span>
                            </div>
                            <div  class="alert alert-danger alert-dismissable field_short_headline span11" style="display:none; font-style:bold"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> </div>
                        </div> 
                                            
                        <div class="control-group">
                            <div class="controls">
                                <input class="span11" style="height:35px" placeholder="Contact No." type="number" name="txtcontact" id="txtcontact" data-minlength="10"  maxlength="10" value="<?php echo $_POST["txtcontact"]; ?>" required>
                            </div>
                            <div  class="alert alert-danger alert-dismissable field_short_headline span11" style="display:none; font-style:bold"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> </div>
                        </div> 
                                            
                        <div class="control-group">
                            <div class="controls">
                                <textarea name="txtaddress" placeholder="Address" rows="8" cols="60"><?php echo $_POST["txtaddress"]; ?></textarea>

                            </div>
                        </div>
                                  
                         <div class="control-group" style="padding-top: 10px;">
                            <div class="controls">
                                <input class="span11" style="height:35px" placeholder="Password" type="password" name="txtpass" id="txtpass" data-minlength="8" required>
                                <span class="span10" style="color:#c1c1c1"></span>
                            </div>
                            <div  class="alert alert-danger alert-dismissable field_short_headline span11" style="display:none; font-style:bold"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> </div>
                        </div> 
                        
                        <div class="control-group">
                            <div class="controls">
                                <input class="span11" style="height:35px" placeholder="Confirm Password" type="password" name="txtpass1" id="txtpass1" data-minlength="8" required>
                                <span class="span10" style="color:#c1c1c1"></span>
                            </div>
                            <div  class="alert alert-danger alert-dismissable field_short_headline span11" style="display:none; font-style:bold"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> </div>
                        </div>                    

                        <div class="control-group">
                            <div class="controls">
                                <select class="span11" style="height:35px" id="txtType" name="txtType" required>
                                    <option value="Buyer" style="font-weight: bold" <?php if( $_POST["txtType"]=="Buyer") 
                                        echo"selected";
                                    if(isset($_POST["txtType"]) && !empty($_POST["txtType"]) )
                                            echo "selected";
                                    ?>>Buyer</option>
                                    <option value="Seller" style="font-weight: bold" <?php if( $_POST["txtType"]=="Seller") echo"selected"; ?>>Seller</option>
                                </select>
                            </div>
                            <div  class="alert alert-danger alert-dismissable field_short_headline span11" style="display:none; font-style:bold"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> </div>
                        </div> 
   
                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary" name="save" value="1">Save</button>
                        </div>
                    </form>
                                                <br />                   
					</div><!--/sign up form-->
				</div>
			</div>
		</div>
	</section><!--/form-->
	
	<?php
require_once 'templates/footer.php';

?>