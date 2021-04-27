

<?php include_once 'templates/header.php'; ?>
<?php include_once 'templates/sidebar.php'; ?>
<?php
if (isset($_POST["save"])) {
    // Insert query

    $name = mysqli_real_escape_string($conn,$_POST["txtname"]);
    $description = mysqli_real_escape_string($conn,$_POST["txtdescription"]);
    $price = $_POST["txtprice"];
    $newprice = ceil($price * 1.05);
    $msg = "";
    $sqlInsert = "insert into tbl_items (seller_id,name,description,price,new_price) values('" . $_SESSION["user_id"] . "','" . $name . "','" . $description . "'," . $price . "," . $newprice . ")";
    $a = mysqli_query($conn, $sqlInsert);
    $id=mysqli_insert_id($conn);
    if (isset($_FILES["txtImage"])) {
        $img_info = pathinfo($_FILES["txtImage"]["name"]);
        if ($img_info["extension"] == "jpg" || $img_info["extension"] == "png" || $img_info["extension"] == "jpeg") {
            copy($_FILES["txtImage"]["tmp_name"], "Images/" . $id . "." . $img_info["extension"]);
             $imginsert="update tbl_items set image='".$id.".".$img_info["extension"]."'where item_id=" . $id;
             $re=mysqli_query($conn, $imginsert);
        } else {
            $msg .= "Error. Please Insert only images";
        }
    }
    if ($a) {
        header("Location: items.php");
    } else {
        $msg .= "Error" . mysqli_error($conn);
        echo $sqlInsert;
    }
}
?>


<div id="content">
    <!--breadcrumbs-->
    <div id="content-header">
        <div id="breadcrumb"> <a href="items.php" title="Go to Items" class="tip-bottom"><i class="icon-home"></i> Items</a><a href="item_add.php">Add Item</a></div>
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
                    <h4>Items Add Form</h4>
                </div>
                <?php
    if(isset($msg) && !empty($msg)){
        echo '<center style="color:#ff0000" style="font-weight: bold"><h5>'.$msg.'</h5></center> ';
    }
    ?>
                <div class="widget-content nopadding">

                                        <form action="item_add.php" method="post" class="form-horizontal form-group-lg"  accept-charset="utf-8" enctype='multipart/form-data' name="electionform" id="electionform">
                        
                        <div class="control-group">
                            <label class="control-label"><strong>Name* :</strong></label>
                            <div class="controls">
                                <input class="span11" style="height:35px" placeholder="Name" type="text" name="txtname" id="txtName" data-minlength="5"  maxlength="300" value="<?php echo $_POST["txtname"]; ?>" required>
                                <span class="span10" style="color:#c1c1c1">Maximum 300 charecters allowed</span>
                            </div>
                            <div  class="alert alert-danger alert-dismissable field_short_headline span11" style="display:none; font-style:bold"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> </div>
                        </div> 
                                            <div class="control-group">
                            <label class="control-label"><strong>Description* :</strong></label>
                            <div class="controls">
                                <textarea name="txtdescription" rows="8" cols="60"><?php echo $_POST["txtdescription"]; ?></textarea>

                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label"><strong>Price* :</strong></label>
                            <div class="controls">
                                <input class="span11" style="height:35px" placeholder="Price" type="number" name="txtprice" id="txtf_name" data-minlength="1"  maxlength="6" value="<?php echo $_POST["txtprice"]; ?>" required>
                                <span class="span10" style="color:#c1c1c1">Enter Price</span>
                            </div>
                            <div  class="alert alert-danger alert-dismissable field_short_headline span11" style="display:none; font-style:bold"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> </div>
                        </div>
                        
                          <div class="control-group">
                            <label class="control-label"><strong>Image* :</strong></label>
                            <div class="controls">
                               <input type="file" name="txtImage" class="form-control" id="multiFiles" style="opacity:10" />
                                
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


 <?php include_once 'templates/footer.php'; ?>