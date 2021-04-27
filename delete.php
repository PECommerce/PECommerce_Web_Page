<?php
ob_start();
require_once 'templates/header.php';
require_once 'templates/sidebar.php';
if(isset($_POST["save"])){
  
       $sql="update tbl_users set active='0' where user_id=".$_SESSION["user_id"];
       mysqli_query($conn, $sql);
       
       $chan="update tbl_items t set t.status='N' where t.seller_id=".$_SESSION["user_id"];
       $ch=mysqli_query($conn,$chan);
       
       session_unset();
        session_destroy();
        header("Location: index.php");
       
}

?>
<div class="col-sm-9">
    <div class="features_items"><!--features_items-->
						<h2 class="title text-center">Deactivate Account</h2>
                        <h4 style=" text-align: center; padding-right: 15px">Are You Sure You want to deactivate your account. This will not have any effect on your bookings. To activate your account you have login again.</h4>
                       <div class="signup-form">
                           <form action="delete.php" method="post" class="form-horizontal form-group-lg"  accept-charset="utf-8" enctype='multipart/form-data' name="electionform" id="electionform">
                        <div class="form-actions" >
                            <div class="col-sm-6">
                                <div class="col-sm-3"><button type="submit" class="btn btn-primary" name="save" value="1">Sure</button></div>
                                <div class="col-sm-3 float-sm-right"><a href='details.php'><button type="button" class="btn btn-primary" name="cancel" value="1">Cancel</button></a></div>
                            </div>    
                        </div>
                            </form>
                       </div>

					</div><!--/sign up form-->
				</div>
</div>
</div>

</section>
		
	<?php
require_once 'templates/footer.php';
?>