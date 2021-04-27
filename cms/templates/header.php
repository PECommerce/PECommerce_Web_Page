<?php 
session_start();

require_once __DIR__."/../config/config.php";
require_once __DIR__."/../config/connection.php";
require_once __DIR__."/../config/functions.php";

if(!isset($_SESSION["user_id"]) || empty($_SESSION["user_id"])){
    header("Location: index.php");
}
 elseif($_SESSION["user_type"]=="Buyer") {
     
     header("Location: ".BASEURL);
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>PECOMMERCE CMS</title>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" href="assets/bootstrap.min.css?v=1.3" />
        <link rel="stylesheet" href="assets/bootstrap-responsive.min.css?v=1.3" />
        <link rel="stylesheet" href="assets/datepicker.css?v=1.3" />
        <link rel="stylesheet" href="assets/jquery.datetimepicker.min.css?v=1.3" />
        
        <link rel="stylesheet" href="assets/select2.css?v=1.3" />
        <link rel="stylesheet" href="assets/matrix-style.css?v=1.3" />
        <link rel="stylesheet" href="assets/matrix-media.css?v=1.3" />
        
        <!--<link rel="stylesheet" href="" />-->
        <link href="assets/font-awesome.css?v=1.3" rel="stylesheet" />
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>
        <script>var BASEJSURL = "http://localhost/";</script>
        
    </head>
    <body>  
        
        <!--Header-part-->
        <div id="header">
            <h1><a href="users.php"> <?php if($_SESSION["user_type"]!="Admin") 
                echo 'SELLER CMS';
            else
                echo 'ADMIN CMS';
            ?></a></h1>
        </div>
        <!--close-Header-part--> 
        <!--top-Header-menu-->
        <div id="user-nav" class="navbar navbar-inverse">

            <ul class="nav">
                <li  class="dropdown" id="profile-messages" ><a title="" href="#" data-toggle="dropdown" data-target="#profile-messages" class="dropdown-toggle"><i class="icon icon-user"></i>  <span class="text">Welcome <?php echo $_SESSION["user_name"]; ?></span><b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="<?php echo ROOT . "change_password.php" ?>"><i class="icon-key"></i> Change Password</a></li>
                        <?php
                        if($_SESSION["user_type"]=="Seller")
                        {
                        echo '<li><a href="'.BASEURL.'" target="_blank"><i class="icon-key"></i> Shopping Page</a></li>';
                        }
                                ?>
                        <li><a href="<?php echo ROOT . "logout.php" ?>"><i class="icon-key"></i> Log Out</a></li>
                    </ul>
                </li>
            </ul>
        </div>
     
        <!--close-top-serch-->
