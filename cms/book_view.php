<?php include_once 'templates/header.php'; ?>
<?php include_once 'templates/sidebar.php'; ?>
<?php

$id= $_GET["id"];
date_default_timezone_set('Asia/Kolkata');
if($_SESSION["user_type"]=="Seller")
{
    $sqlcheck="SELECT b.booked_id,b.order_status,t.item_id,u.user_id,u1.user_id as sel FROM tbl_booked b 
    left join tbl_users u on(b.buyer_id=u.user_id)
    left join tbl_items t on(b.item_id=t.item_id)
    left join tbl_users u1 on(t.seller_id=u1.user_id) where b.booked_id=".$id." and (u.user_id = ".$_SESSION["user_id"]." or u1.user_id = ".$_SESSION["user_id"].")";
    $result = mysqli_query($conn,$sqlcheck);
    if (mysqli_num_rows($result) == 0)
        header("Location: users.php");
}
$sql = "SELECT b.booked_id,b.order_status,u.first_name,u.last_name,t.name,b.created,u1.first_name as seller_fname,u1.last_name as seller_lname FROM tbl_booked b 
    left join tbl_users u on(b.buyer_id=u.user_id)
    left join tbl_items t on(b.item_id=t.item_id)
    left join tbl_users u1 on(t.seller_id=u1.user_id) where booked_id=".$id;
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($result);

$k="";
        if($row["order_status"] == "P")
        {
            $k="Pending";
        }
        else {
     
     $k="Completed";
    }
        

?>


<div id="content">
    <!--breadcrumbs-->
    <div id="content-header">
        <div id="breadcrumb"> <a href="booking.php" title="Go to Booking" class="tip-bottom"><i class="icon-home"></i> Bookings</a><a href="book_view.php?id=<?php echo $id;?>">Booking View Form</a></div>
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
                    <h4>Booking View Form</h4>
                </div>
                <div class="widget-content nopadding">
                    <form class="form-horizontal form-group-lg">
                        
                        <div class="control-group">
                            <label class="control-label"><strong>Item Name :</strong></label>
                            <div class="controls">
                                <label class="text-left" style="padding-top: 5px; font-weight: normal; word-spacing: 3px">
                                <?php 
                                    echo $row["name"];
                                ?>
                                </label>
                            </div>
                            <div  class="alert alert-danger alert-dismissable field_short_headline span11" style="display:none; font-style:bold"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label"><strong>Seller Name :</strong></label>
                            <div class="controls">
                                <label class="text-left" style="padding-top: 5px; font-weight: normal; word-spacing: 3px">
                                <?php 
                                    echo $row["seller_fname"]." ".$row["seller_lname"];
                                ?>
                                </label>
                            </div>
                            <div  class="alert alert-danger alert-dismissable field_short_headline span11" style="display:none; font-style:bold"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label"><strong>Buyer Name :</strong></label>
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
                            <label class="control-label"><strong>Order Status :</strong></label>
                            <div class="controls">
                                <label class="text-left" style="padding-top: 5px; font-weight: normal; word-spacing: 3px">
                                <?php 
                                    echo $k;
                                ?>
                                </label>
                            </div>
                            <div  class="alert alert-danger alert-dismissable field_short_headline span11" style="display:none; font-style:bold"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> </div>
                        </div>
                         <div class="control-group">
                            <label class="control-label"><strong>Date Created :</strong></label>
                            <div class="controls">
                                <label class="text-left" style="padding-top: 5px; font-weight: normal; word-spacing: 3px">
                                <?php 
                                    echo $row["created"];
                                ?>
                                </label>
                            </div>
                            <div  class="alert alert-danger alert-dismissable field_short_headline span11" style="display:none; font-style:bold"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> </div>
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