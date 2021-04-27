<?php
require_once 'templates/header.php';
require_once 'templates/sidebar.php';
$id="";
if(isset($_GET["id"]) && !empty($_GET["id"]))
{
    $id=$_GET["id"];
}
 else {
    $id=$_SESSION["user_id"];
}
$sqlcheck="select * from tbl_users where user_id=".$id;
$res=mysqli_query($conn,$sqlcheck);
$row= mysqli_fetch_assoc($res);
?>
<div class="col-sm-9 padding-right">
    <div class="left-sidebar"><!--/product-information-->
								
                                                            <h2>Account Details</h2>
								
								<div class="widget-content nopadding">
                    <form class="form-horizontal form-group-lg">
                        
                        <div class="control-group">
                            <label class="control-label"><strong><h4>Name :</h4></strong></label>
                                <label class="text-right" style="padding-top: 5px; font-weight: normal; word-spacing: 3px">
                                <h4 style="font-weight: normal; color: dimgrey"><?php 
                                    echo $row["first_name"]." ".$row["last_name"];
                                ?>
                                </h4>
                                </label>
                            <div  class="alert alert-danger alert-dismissable field_short_headline span11" style="display:none; font-style:bold"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label"><strong><h4>Email ID :</h4></strong></label>
                                <label class="text-left" style="padding-top: 5px; font-weight: normal; word-spacing: 3px">
                                    <h4 style="font-weight: normal; color: dimgrey">
                                <?php 
                                    echo $row["email_id"];
                                ?>
                                    </h4>
                                </label>
                            <div  class="alert alert-danger alert-dismissable field_short_headline span11" style="display:none; font-style:bold"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label"><strong><h4>Contact No.  :</h4></strong></label>
                            
                                <label class="text-left" style="padding-top: 5px; font-weight: normal; word-spacing: 3px">
                                    <h4 style="font-weight: normal; color: dimgrey">
                                <?php 
                                    echo $row["contact"];
                                ?>
                                    </h4>
                                </label>
                       
                            <div  class="alert alert-danger alert-dismissable field_short_headline span11" style="display:none; font-style:bold"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> </div>
                        </div>
                         <div class="control-group">
                             <label class="control-label"><strong><h4>Address :</h4></strong></label>
                                <label class="text-left" style="padding-top: 5px; font-weight: normal; word-spacing: 3px">
                                    <h4 style="font-weight: normal; color: dimgrey">
                                <?php 
                                    echo $row["address"];
                                ?>
                                    </h4>
                                </label>
                  
                        </div>
                         <div class="control-group" <?php if($_SESSION["user_type"]!="Admin") echo 'style="display: none;"';  ?>>
                             <label class="control-label"><strong><h4>User Type :</h4></strong></label>
                         
                                <label class="text-left" style="padding-top: 5px; font-weight: normal; word-spacing: 3px">
                                    <h4 style="font-weight: normal; color: dimgrey">
                                <?php 
                                    echo $row["user_type"];
                                ?>
                                    </h4>
                                </label>
                            
                                            
                </div>
                                            </form>

								
    </div>
</div>
</div>
</div>
</div>

</section>
		
	<?php
require_once 'templates/footer.php';
?>