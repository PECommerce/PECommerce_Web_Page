

<?php include_once 'templates/header.php'; ?>
<?php include_once 'templates/sidebar.php'; ?>
<?php

$id= $_GET["id"];
date_default_timezone_set('Asia/Kolkata');
if($_SESSION["user_type"]=="Seller")
{
    $sqlcheck="select item_id from tbl_items where seller_id= ".$_SESSION["user_id"]." and item_id= ".$id;
    $result = mysqli_query($conn,$sqlcheck);
    if (mysqli_num_rows($result) == 0)
        header("Location: users.php");
}
$sql = "select * from tbl_items where item_id=".$id;
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($result);

if(isset($_POST["save"])){
        // Insert query

    $name = mysqli_real_escape_string($conn,$_POST["txtname"]);
    $description=mysqli_real_escape_string($conn,$_POST["txtdescription"]);
    $price=$_POST["txtprice"];
    $status=$_POST["txtstatus"];
    $newprice = $price*1.05;
    $msg="";
    
   if(isset($_FILES["txtImage"]))
                {
                    $img_info=pathinfo($_FILES["txtImage"]["name"]);
                    if ($img_info["extension"] == "jpg" || $img_info["extension"] == "png" || $img_info["extension"] == "jpeg") {
                         @unlink("Images/".$row["image"]);
                        
                        copy($_FILES["txtImage"]["tmp_name"], "Images/" . $id.".".$img_info["extension"]);
                        $imginsert="update tbl_items set image='".$id.".".$img_info["extension"]."'where item_id=" . $id;
                        $re=mysqli_query($conn, $imginsert);
        } else {
            $msg .= "Error. Please Insert only images";
        }
    }
    $sqlInsert = "update tbl_items set name='" . $name . "',description='" . $description . "',price=" . $price . ",status='" . $status . "',new_price=" . $newprice . ",created='" . date("Y-m-d H:i:s") . "' where item_id=" . $id;
            if (mysqli_query($conn, $sqlInsert)) {
                header("Location: items.php");
            } else {
                $msg .= "Error" . mysqli_error($conn);
            }
}

        

?>


<div id="content">
    <!--breadcrumbs-->
    <div id="content-header">
        <div id="breadcrumb"> <a href="items.php" title="Go to Items" class="tip-bottom"><i class="icon-home"></i> Items</a><a href="item_edit.php">Update Items</a></div>
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
                    <h4>Items Update Form</h4>
                </div>
                <?php
    if(isset($msg) && !empty($msg)){
        echo '<center style="color:#ff0000" style="font-weight: bold"><h5>'.$msg.'</h5></center> ';
    }
    ?>
                <div class="widget-content nopadding">

                                        <form action="item_edit.php?id=<?php echo $id;?>" method="post" class="form-horizontal form-group-lg"  accept-charset="utf-8" enctype='multipart/form-data' name="electionform" id="electionform">
                        
                        <div class="control-group">
                            <label class="control-label"><strong>Name* :</strong></label>
                            <div class="controls">
                                <input class="span11" style="height:35px" placeholder="Name" type="text" name="txtname" id="txtname" data-minlength="5"  maxlength="30" value="<?php 
                                if(isset($_POST["txtname"]) && !empty($_POST["txtname"]))
                                    echo $_POST["txtname"];
                                else {
                                    echo $row["name"]; 
                                }
                                ?>" required>
                                <span class="span10" style="color:#c1c1c1">Maximum 30 charecters allowed</span>
                            </div>
                            <div  class="alert alert-danger alert-dismissable field_short_headline span11" style="display:none; font-style:bold"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> </div>
                        </div>
                                            <div class="control-group">
                            <label class="control-label"><strong>Description* :</strong></label>
                            <div class="controls">
                                <textarea name="txtdescription" rows="8" cols="60"><?php 
                                if(isset($_POST["txtname"]) && !empty($_POST["txtname"]))
                                    echo $_POST["txtdescription"];
                                else {
                                    echo $row["description"]; 
                                }
                                ?></textarea>

                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label"><strong>Price* :</strong></label>
                            <div class="controls">
                                <input class="span11" style="height:35px" placeholder="Price" type="number" name="txtprice" id="txtprice" data-minlength="1"  maxlength="6" value="<?php 
                                if(isset($_POST["txtname"]) && !empty($_POST["txtname"]))
                                    echo $_POST["txtprice"];
                                else {
                                    echo $row["price"]; 
                                }
                                ?>" required>
                                <span class="span10" style="color:#c1c1c1">Enter Price</span>
                            </div>
                            <div  class="alert alert-danger alert-dismissable field_short_headline span11" style="display:none; font-style:bold"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> </div>
                        </div>
                        
                         <div class="control-group">
                            <label class="control-label"><strong>Image* :</strong></label>
                            <div class="controls">
                               <input type="file" name="txtImage" class="form-control" id="multiFiles" style="opacity:10" />
                                <?php if (!empty($row["image"])) { ?>
                                <div id="profileimg">
                                    <span id="imag1"><img src="Images/<?php echo $row["image"]; ?>" width="500" style="border: 3px solid #555;"></span>                                    
                                </div>
                            <?php } else { ?>
                                <div id="profileimg"></div>
                            <?php } ?>
                            </div>
                            <div  class="alert alert-danger alert-dismissable field_short_headline span11" style="display:none; font-style:bold"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> </div>
                        </div>
                       
                          
                      
                        <div class="control-group">
                            <label class="control-label"><strong>Status* :</strong></label>
                            <div class="controls">
                                <select class="span11" style="height:35px" id="txtType" name="txtstatus" required>
                                    <option value="" style="font-weight: bold">Select</option>
                                    <option value="Y" style="font-weight: bold" <?php if( $row["status"]=="Y") echo"selected"; ?>>Available</option>
                                    <option value="N" style="font-weight: bold" <?php if( $row["status"]=="N") echo"selected"; ?>>Unavailable</option>
                                </select>
                            </div>
                            <div  class="alert alert-danger alert-dismissable field_short_headline span11" style="display:none; font-style:bold"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> </div>
                        </div> 
                                            
   
                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary" name="save" value="1">Save</button>
                            <a href="#"><input type="button" class="btn btn-danger" value="Cancel" onclick="document.location.href = 'items.php'"></a>
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