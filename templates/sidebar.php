<?php
ob_start();
$uri_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$uri_segments = explode('/', $uri_path);
?>
<section>
    <div class="container">
			<div class="row">
				<div class="col-sm-3">
					<div class="left-sidebar">
						<h2>Account</h2>
						<div class="panel-group category-products" id="accordian"><!--category-productsr-->
							<div class="panel panel-default">
								<div class="panel-heading">
									 <h4 class="panel-title"><a href="details.php" <?php echo (isset($uri_segments[2]) && ($uri_segments[2] == 'details.php'))? ' style="color: orange;"' : '' ?>>My Profile</a></h4>
								</div>
							</div>
							<div class="panel panel-default">
								<div class="panel-heading">
                                                                    <h4 class="panel-title"><a href="edit.php" <?php echo (isset($uri_segments[2]) && ($uri_segments[2] == 'edit.php'))? ' style="color: orange;"' : '' ?>>Edit</a></h4>
								</div>
							</div>
							<div class="panel panel-default">
								<div class="panel-heading">
                                                                    <h4 class="panel-title"><a href="change_password.php" <?php echo (isset($uri_segments[2]) && ($uri_segments[2] == 'change_password.php'))? ' style="color: orange;"' : '' ?>>Change Password</a></h4>
								</div>
							</div>
							<div class="panel panel-default">
								<div class="panel-heading">
                                                                    <h4 class="panel-title"><a href="booking.php" <?php echo (isset($uri_segments[2]) && ($uri_segments[2] == 'booking.php'))? ' style="color: orange;"' : '' ?>>My Bookings</a></h4>
								</div>
							</div>
                                                    <div class="panel panel-default">
								<div class="panel-heading">
                                                                    <h4 class="panel-title"><a href="delete.php" <?php echo (isset($uri_segments[2]) && ($uri_segments[2] == 'delete.php'))? ' style="color: orange;"' : '' ?>>Deactivate Account</a></h4>
								</div>
							</div>
                                                    <?php
                                                    if($_SESSION["user_type"]=="Seller")
                                                    {
                                                     echo '<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title"><a href="cms" target="_blank">Seller CMS</a></h4>
								</div>
							</div>';
                                                    }
                                                             ?>
						</div><!--/category-products-->
					
						
						
					</div>
				</div>
				
				<!--/recommended_items-->
					
