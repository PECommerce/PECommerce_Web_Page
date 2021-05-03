	<?php
        $sqlcheck="select address from tbl_users where username='admin'";
$res=mysqli_query($conn,$sqlcheck);
 $rdata  = mysqli_fetch_assoc($res);
?>
	<footer id="footer"><!--Footer-->
		<div class="footer-top">
			<div class="container">
				<div class="row">
					<div class="col-sm-2">
						<div class="companyinfo">
							<h2><span>PEC</span>ommerce</h2>
							<p></p>
						</div>
					</div>
					
					<div class="col-sm-3" style="float:right; text-align: right; " >
						<div class="address" >
							<img src="images/home/map.png" alt="" />
							<p style="color: black; font-weight: bold"><?php echo $rdata["address"]; ?></p>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<div class="footer-widget">
			<div class="container">
				<div class="row">
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>Service</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="contact_us.php">Contact Us</a></li>
                                                                <?php
                                                                if(isset($_SESSION["user_id"]) && !empty($_SESSION["user_id"]))
                                                                {
								echo '<li><a href="booking.php">Bookings</a></li>';
                                                                }
 else {
     echo '<li><a href="login.php">Login</a></li>';
 }
 if(isset($_SESSION["user_id"]) && !empty($_SESSION["user_id"]) && $_SESSION["user_type"]=="Seller")
 {
     echo '<li><a href="cms" target="_blank">Seller CMS</a></li>';
 }
                                                                        ?>
								<li><a href="about_us.php"> About Us</a></li>
							</ul>
						</div>
					</div>
					
					<div class="col-sm-3 col-sm-offset-1" style="float:right; text-align: right; ">
						<div class="single-widget">
							<h2>About PECommerce</h2>
                                                        
								
								<p style="color: darkgray;">This is a site for EAD+DBMS Project. <br />No information on this site is correct.</p>
							
						</div>
					</div>
					
				</div>
			</div>
		</div>
		
		<div class="footer-bottom">
			<div class="container">
				<div class="row">
					<p class="pull-left">Copyright © 2021 PECommerce. All rights reserved.</p>
					<p class="pull-right">Designed by <span><a href="about_us.php">PECobians</a></span></p>
				</div>
			</div>
		</div>
		
	</footer><!--/Footer-->
	

  
    <script src="js/jquery.js"></script>
	<script src="js/price-range.js"></script>
    <script src="js/jquery.scrollUp.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.prettyPhoto.js"></script>
    <script src="js/main.js"></script>
</body>
</html>
