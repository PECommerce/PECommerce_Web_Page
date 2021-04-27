<?php
require_once 'templates/header.php';
require_once 'templates/sidebar.php';
if(isset($_POST["save"])){
        // Insert query

    $username = mysqli_real_escape_string($conn,$_POST["txtusername"]);
    $f_name=mysqli_real_escape_string($conn,$_POST["txtf_name"]);
    $l_name=mysqli_real_escape_string($conn,$_POST["txtl_name"]);
    $contact =  $_POST["txtcontact"];
    $address = mysqli_real_escape_string($conn,$_POST["txtaddress"]);
    $email=mysqli_real_escape_string($conn,$_POST["txtemail"]);
    $type=$_POST["txtType"];
    
   
        $sqlcheck="select user_id from tbl_users where username='".$username."'";
        $s=mysqli_query($conn,$sqlcheck);    
        $rdata  = mysqli_fetch_assoc($s);
        if(mysqli_num_rows($s)>0 && $rdata["user_id"] != $id) 
    {
        $msg = "This user is already exists. Please try another name";
    }else{
        $sqlInsert = "update tbl_users set username='".$username."',first_name='".$f_name."',last_name='".$l_name."',email_id='".$email."',contact='".$contact."',address='".$address."',user_type='".$type."',created='".date("Y-m-d H:i:s")."' where user_id=".$id;    
        if(mysqli_query($conn,$sqlInsert))
        {
           header("Location: users.php");
        }else{
            $msg.="Error".  mysqli_error($conn);
        }
    }  
}
$sqlcheck="select * from tbl_users where user_id=".$_SESSION["user_id"];
$res=mysqli_query($conn,$sqlcheck);
$row= mysqli_fetch_assoc($res);
?>
<div class="col-sm-9">
					<!--sign up form-->
						<h2 class="title text-center">Edit Details</h2>
                                                <div class="signup-form">
						<form action="edit.php" method="post" class="form-horizontal form-group-lg"  accept-charset="utf-8" enctype='multipart/form-data' name="electionform" id="electionform">
                        
                        <div class="control-group">
                            <div class="controls">
                                <input class="span11" style="height:35px" placeholder="Username" type="text" name="txtusername" id="txtusername" data-minlength="5"  maxlength="30" value="<?php 
                                if(isset($_POST["txtusername"]) && !empty($_POST["txtusername"]))
                                    echo $_POST["txtusername"];
                                else {
                                    echo $row["username"]; 
                                }
                                ?>" required>
                                <span class="span10" style="color:#c1c1c1"></span>
                            </div>
                            <div  class="alert alert-danger alert-dismissable field_short_headline span11" style="display:none; font-style:bold"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> </div>
                        </div>  
                        <div class="control-group">
                            <div class="controls">
                                <input class="span11" style="height:35px" placeholder="First Name" type="text" name="txtf_name" id="txtf_name" data-minlength="5"  maxlength="30" value="<?php 
                                if(isset($_POST["txtusername"]) && !empty($_POST["txtusername"]))
                                    echo $_POST["txtf_name"];
                                else {
                                    echo $row["first_name"]; 
                                }
                                ?>" required>
                                <span class="span10" style="color:#c1c1c1"></span>
                            </div>
                            <div  class="alert alert-danger alert-dismissable field_short_headline span11" style="display:none; font-style:bold"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> </div>
                        </div>
                        
                         <div class="control-group">
                            <div class="controls">
                                <input class="span11" style="height:35px" placeholder="Last Name" type="text" name="txtl_name" id="txtl_name" data-minlength="5"  maxlength="30" value="<?php 
                                if(isset($_POST["txtusername"]) && !empty($_POST["txtusername"]))
                                    echo $_POST["txtl_name"];
                                else {
                                    echo $row["last_name"]; 
                                }
                                ?>" required>
                                <span class="span10" style="color:#c1c1c1"></span>
                            </div>
                            <div  class="alert alert-danger alert-dismissable field_short_headline span11" style="display:none; font-style:bold"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> </div>
                        </div>  
                        
                        <div class="control-group">
                            <div class="controls">
                                <input class="span11" style="height:35px" placeholder="Email ID" type="email" name="txtemail" id="txtemail" data-minlength="10"  maxlength="200" value="<?php 
                                if(isset($_POST["txtusername"]) && !empty($_POST["txtusername"]))
                                    echo $_POST["txtemail"];
                                else {
                                    echo $row["email_id"]; 
                                }
                                ?>" required>
                                <span class="span10" style="color:#c1c1c1"></span>
                            </div>
                            <div  class="alert alert-danger alert-dismissable field_short_headline span11" style="display:none; font-style:bold"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> </div>
                        </div> 
                                            
                        <div class="control-group">
                            <div class="controls">
                                <input class="span11" style="height:35px" placeholder="Contact No." type="number" name="txtcontact" id="txtcontact" data-minlength="10"  maxlength="10" value="<?php 
                                if(isset($_POST["txtusername"]) && !empty($_POST["txtusername"]))
                                    echo $_POST["txtcontact"];
                                else {
                                    echo $row["contact"]; 
                                }
                                ?>" required>
                            </div>
                            <div  class="alert alert-danger alert-dismissable field_short_headline span11" style="display:none; font-style:bold"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> </div>
                        </div> 
                                            
                        <div class="control-group">
                            <div class="controls">
                                <textarea name="txtaddress" placeholder="Address" rows="8" cols="60"><?php 
                                if(isset($_POST["txtusername"]) && !empty($_POST["txtusername"]))
                                    echo $_POST["txtaddress"];
                                else {
                                    echo $row["address"]; 
                                }
                                ?></textarea>

                            </div>
                        </div>
                                                   

                       <?php if($_SESSION["user_type"]!="Admin") 
                       {
                            $b="";
                            $s="";
                            
                            if($row["user_type"]=="Buyer")
                                $b="selected";
                            if( $row["user_type"]=="Seller")
                                $s="selected";
                           
                            
                        echo '<div class="control-group" style="padding-top: 10px;">
                            
                            <div class="controls" >
                                <select class="span11" style="height:35px" id="txtType" name="txtType"  required>
                                    <option value="Buyer" style="font-weight: bold" '.$b.' >Buyer</option>
                                    <option value="Seller" style="font-weight: bold" '.$s.'>Seller</option>
                                </select>
                            </div>
                            <div  class="alert alert-danger alert-dismissable field_short_headline span11" style="display:none; font-style:bold"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> </div>
                        </div> ';
                       }
            ?>
   
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