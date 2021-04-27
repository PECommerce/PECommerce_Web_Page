<?php include_once 'templates/header.php'; ?>
<?php include_once 'templates/sidebar.php'; ?>
<?php

$id= $_GET["id"];
date_default_timezone_set('Asia/Kolkata');
$sql = "SELECT t.item_id,u.first_name,u.last_name,t.name,t.description,t.price,t.image,t.new_price,t.status,t.created,b.booked_id FROM tbl_items t 
    left join tbl_users u on(t.seller_id=u.user_id)
    left join tbl_booked b on(t.item_id=b.item_id) where t.item_id=".$id;
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($result);


        

?>


<div id="content">
    <!--breadcrumbs-->
    <div id="content-header">
        <div id="breadcrumb"> <a href="items.php" title="Go to Items" class="tip-bottom"><i class="icon-home"></i> Items</a><a href="item_view.php?id=<?php echo $id;?>">Item View Form</a></div>
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
                    <h4>Items View Form</h4>
                </div>
                <div class="widget-content nopadding">
                    <form class="form-horizontal form-group-lg">
                        
                        <div class="control-group">
                            <label class="control-label fs-5"><strong>Item Name :</strong></label>
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
                                    echo $row["first_name"]." ".$row["last_name"];
                                ?>
                                </label>
                            </div>
                            <div  class="alert alert-danger alert-dismissable field_short_headline span11" style="display:none; font-style:bold"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label"><strong>Description  :</strong></label>
                            <div class="controls">
                                <label class="text-left" style="padding-top: 5px; font-weight: normal; word-spacing: 3px">
                                <?php 
                                    echo $row["description"];
                                ?>
                                </label>
                            </div>
                            
                        </div>
                         <div class="control-group">
                            <label class="control-label"><strong>Price :</strong></label>
                            <div class="controls">
                                <label class="text-left" style="padding-top: 5px; font-weight: normal; word-spacing: 3px">
                                <?php 
                                    echo $row["price"];
                                ?>
                                </label>
                                <div  class="alert alert-danger alert-dismissable field_short_headline span11" style="display:none; font-style:bold"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> </div>
                            </div>
                        </div>
                         <div class="control-group">
                            <label class="control-label"><strong>Booked :</strong></label>
                            <div class="controls">
                                <label class="text-left" style="padding-top: 5px; font-weight: normal; word-spacing: 3px">
                                <?php 
                                    if(isset($row["booked_id"]) && !empty($row["booked_id"]))
                                        echo "Yes";
                                    else
                                        echo "No";
                                ?>
                                </label>
                            </div>
                            <div  class="alert alert-danger alert-dismissable field_short_headline span11" style="display:none; font-style:bold"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label"><strong>Image :</strong></label>
                            <div class="controls">
                                <img src="<?php 
                                echo "Images/".$row["image"];
                                ?>" width="500" style="border: 3px solid #555;">
                            </div>
                            <div  class="alert alert-danger alert-dismissable field_short_headline span11" style="display:none; font-style:bold"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label"><strong>New Price :</strong></label>
                            <div class="controls">
                                
                            <label class="text-left" style="padding-top: 5px; font-weight: normal; word-spacing: 3px">
                                <?php 
                                    echo $row["new_price"];
                                ?>
                            </label>
                                <div  class="alert alert-danger alert-dismissable field_short_headline span11" style="display:none; font-style:bold"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> </div>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label"><strong>Status :</strong></label>
                            <div class="controls">
                                
                            <label class="text-left" style="padding-top: 5px; font-weight: normal; word-spacing: 3px">
                                <?php 
                                if ($row["status"] == "Y")
                                    echo "Available";
                                else
                                    echo "Unavailable";
                                ?>
                            </label>
                                <div  class="alert alert-danger alert-dismissable field_short_headline span11" style="display:none; font-style:bold"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> </div>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label"><strong>Date Created :</strong></label>
                            <div class="controls">
                                
                            <label class="text-left" style="padding-top: 5px; font-weight: normal; word-spacing: 3px">
                                <?php
                                    echo $row["created"];
                                ?>
                            </label>
                                <div  class="alert alert-danger alert-dismissable field_short_headline span11" style="display:none; font-style:bold"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> </div>
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