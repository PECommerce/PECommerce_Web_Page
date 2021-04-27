<?php
session_start();


require_once __DIR__."/../cms/config/config.php";
require_once __DIR__."/../cms/config/connection.php";
require_once "functions.php";



$sqlcheck="select contact,email_id from tbl_users where username='admin'";
$res=mysqli_query($conn,$sqlcheck);
 $rdata  = mysqli_fetch_assoc($res);
 if($_SESSION["user_type"]=="Admin")
 {
     header("Location: cms");
 }
 $uri_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$uri_segments = explode('/', $uri_path);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>PECommerce</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/prettyPhoto.css" rel="stylesheet">
    <link href="css/price-range.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
	<link href="css/main.css" rel="stylesheet">
	<link href="css/responsive.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
    <link rel="shortcut icon" href="images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
    
</head><!--/head-->

<body>
	<header id="header"><!--header-->
		<div class="header_top"><!--header_top-->
			<div class="container">
				<div class="row">
					<div class="col-sm-6 ">
						<div class="contactinfo">
							<ul class="nav nav-pills">
								<li><a href="tel:+91<?php echo $rdata["contact"]; ?>"><i class="fa fa-phone"></i> +91 <?php echo $rdata["contact"]; ?></a></li>
								<li><a href="mailto:<?php echo $rdata["email_id"]; ?>"><i class="fa fa-envelope"></i> <?php echo $rdata["email_id"]; ?></a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="social-icons pull-right">
							<ul class="nav navbar-nav">
								<li><a href=""><i class="fa fa-facebook"></i></a></li>
								<li><a href=""><i class="fa fa-twitter"></i></a></li>
								<li><a href=""><i class="fa fa-linkedin"></i></a></li>
								<li><a href=""><i class="fa fa-dribbble"></i></a></li>
								<li><a href=""><i class="fa fa-google-plus"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header_top-->
		
		<div class="header-middle"><!--header-middle-->
			<div class="container">
				<div class="row">
					<div class="col-md-4 clearfix">
							<div class="companyinfo">
                                                            <a href="./"><h2><span>PEC</span>ommerce</h2></a>
							<p></p>
                                                        </div>
						
						
						
					</div>
					<div class="col-md-8 clearfix">
						<div class="shop-menu clearfix pull-right">
							<ul class="nav navbar-nav">
                                                            <?php
                                                            if(!isset($_SESSION["user_id"]) || empty($_SESSION["user_id"])){
                                                                 echo '
								<li><a href="login.php"><i class="fa fa-lock"></i> Login / New Users Signup</a></li>
                                                                <li><a href="about_us.php"><i class="fa fa-cloud"></i> About Us</a></li>
                                                                ';
                                                               }
                                                            else{
								
                                                                echo '<li><a href="details.php"><i class="fa fa-user"></i> Account</a></li>
								<li><a href="booking.php"><i class="fa fa-shopping-cart"></i> Booked Items</a></li>
                                                                <li><a href="about_us.php"><i class="fa fa-cloud"></i> About Us</a></li>
                                                                <li><a href="logout.php"><i class="fa fa-sign-out"></i> Log Out</a></li>
                                                                ';
                                                            }
                                                                        ?>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-middle-->
	
		<div class="header-bottom"><!--header-bottom-->
			<div class="container">
				<div class="row">
					<div class="col-sm-9">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
						</div>
						<div class="mainmenu pull-left">
							<ul class="nav navbar-nav collapse navbar-collapse">
								<li><a href="index.php"  class="<?php echo ((isset($uri_segments[2]) && ($uri_segments[2] == 'index.php' || $uri_segments[2]=="product_details.php" || $uri_segments[2]=="book_item.php")) || !isset($uri_segments[2]) || empty($uri_segments[2]))? 'active' : '' ?>">Items</a></li>
                                                                <?php
                                                                if(isset($_SESSION["user_id"]) && !empty($_SESSION["user_id"])){
                                                                if (isset($uri_segments[2]) && ($uri_segments[2] == "details.php" || $uri_segments[2]=="edit.php" || $uri_segments[2]=="change_password.php" || $uri_segments[2]=="booking.php" || $uri_segments[2]=="delete.php")){
								echo '<li class="dropdown"><a href="details.php" class="active">Account<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        <li><a href="details.php">My Profile</a></li>
										<li><a href="edit.php">Edit</a></li> 
										<li><a href="change_password.php">Change Password</a></li> 
										<li><a href="booking.php">My Bookings</a></li> 
                                                                                <li><a href="delete.php">Deactivate Account</a></li> 
										
                                    </ul>
                                                                </li> ';}
 else {
     echo '<li class="dropdown"><a href="details.php">Account<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        <li><a href="details.php">My Profile</a></li>
										<li><a href="edit.php">Edit</a></li> 
										<li><a href="change_password.php">Change Password</a></li> 
										<li><a href="booking.php">My Bookings</a></li> 
                                                                                <li><a href="delete.php">Deactivate Account</a></li> 
										
                                    </ul>
                                                                </li> ';
                                                                }}
                                                                else{
                                                                    if(isset($uri_segments[2]) && $uri_segments[2]=="login.php"){
                                                                    echo '<li><a href="login.php"  class="active">Login</a></li>';
                                                                    }
                                                                    else
                                                                    {
                                                                        echo '<li><a href="login.php">Login</a></li>';
                                                                    }
                                                                }
                                                                        ?>
								
                              
								<li><a href="contact_us.php" class="<?php echo (isset($uri_segments[2]) && ($uri_segments[2] == 'contact_us.php'))? 'active' : '' ?>">Contact</a></li>
                                                                
							</ul>
						</div>
					</div>
					<div class="col-sm-3">
                                            <?php
                                            $uri_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

                                            $uri_segments = explode('/', $uri_path);
                                            if($uri_segments[2]!="booking.php")
                                            {
                                            echo '<form action="index.php">
                                               <div class="search_box pull-right">
                                                    <input type="text" placeholder="Search"  name="filter_name" id="filter_name"  value = "'.$_GET["filter_name"].'"/>';
                                            }
                                            else
                                            {
                                                echo '<form action="booking.php">
                                               <div class="search_box pull-right">
                                                    <input type="text" placeholder="Search"  name="filter_name" id="filter_name"  value = "'.$_GET["filter_name"].'"/>';
                                            }
                                                     ?>
                                            
						</div>
                                                </form>
					</div>
				</div>
				</div>
			</div>
	</header>
	
	