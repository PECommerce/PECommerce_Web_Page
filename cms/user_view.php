<?php include_once 'templates/header.php'; ?>
<?php include_once 'templates/sidebar.php'; ?>
<?php

$id= $_GET["id"];
date_default_timezone_set('Asia/Kolkata');
$sql = "select * from tbl_users where user_id=".$id;
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($result);

if($row["active"])
{
    $t.="Active";
}
 else {
    $t.="Inactive";
}
        

?>


<div id="content">
    <!--breadcrumbs-->
    <div id="content-header">
        <div id="breadcrumb"> <a href="users.php" title="Go to Users" class="tip-bottom"><i class="icon-home"></i> Users</a><a href="user_view.php?id=<?php echo $id;?>">User View Form</a></div>
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
                    <h4>Users View Form</h4>
                </div>
                <div class="widget-content nopadding">
                    <form class="form-horizontal form-group-lg">
                        
                        <div class="control-group">
                            <label class="control-label"><strong>Name :</strong></label>
                            <div class="controls">
                                <label class="text-left" style="padding-top: 5px; font-weight: normal; word-spacing: 3px">
                                <?php 
                                    echo $row["first_name"]." ".$row["last_name"];
                                ?>
                                </label>
                            </div>
                            <div  class="alert alert-danger alert-dismissable field_short_headline span11" style="display:none; font-style:bold"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label"><strong>Email ID :</strong></label>
                            <div class="controls">
                                <label class="text-left" style="padding-top: 5px; font-weight: normal; word-spacing: 3px">
                                <?php 
                                    echo $row["email_id"];
                                ?>
                                </label>
                            </div>
                            <div  class="alert alert-danger alert-dismissable field_short_headline span11" style="display:none; font-style:bold"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label"><strong>Contact No.  :</strong></label>
                            <div class="controls">
                                <label class="text-left" style="padding-top: 5px; font-weight: normal; word-spacing: 3px">
                                <?php 
                                    echo $row["contact"];
                                ?>
                                </label>
                            </div>
                            <div  class="alert alert-danger alert-dismissable field_short_headline span11" style="display:none; font-style:bold"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> </div>
                        </div>
                         <div class="control-group">
                            <label class="control-label"><strong>Address :</strong></label>
                            <div class="controls">
                                <label class="text-left" style="padding-top: 5px; font-weight: normal; word-spacing: 3px">
                                <?php 
                                    echo $row["address"];
                                ?>
                                </label>
                            </div>
                        </div>
                         <div class="control-group" <?php if($_SESSION["user_type"]!="Admin") echo 'style="display: none;"';  ?>>
                            <label class="control-label"><strong>User Type :</strong></label>
                            <div class="controls">
                                <label class="text-left" style="padding-top: 5px; font-weight: normal; word-spacing: 3px">
                                <?php 
                                    echo $row["user_type"];
                                ?>
                                </label>
                            </div>
                            <div  class="alert alert-danger alert-dismissable field_short_headline span11" style="display:none; font-style:bold"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> </div>
                        </div>
                         <div class="control-group">
                            <label class="control-label"><strong>Is Active :</strong></label>
                            <div class="controls">
                                <label class="text-left" style="padding-top: 5px; font-weight: normal; word-spacing: 3px">
                                <?php 
                                    echo $t;
                                ?>
                                </label>
                            </div>
                        </div>
                         <div class="form-actions">
                            <a href="#"><input type="button" class="btn btn-primary" value="Back" onclick="history.go(-1)" ></a>
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