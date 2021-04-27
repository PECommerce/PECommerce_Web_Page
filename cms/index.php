<?php
session_start();

include_once 'config/connection.php';

include_once 'config/config.php';
if(isset($_SESSION["user_id"]) && !empty($_SESSION["user_id"]) && ($_SESSION["user_type"]=="Admin" || $_SESSION["user_type"]=="Seller")){
    header("Location: users.php");
}  
elseif(isset($_SESSION["user_id"]) && !empty($_SESSION["user_id"]) && $_SESSION["user_type"]=="Buyer")
{
   header("Location: ".BASEURL);
}

if(isset($_POST["login_submit_btn"])){
    
    $username = mysqli_real_escape_string($conn,$_POST["username"]);
    $password = mysqli_real_escape_string($conn,md5($_POST["password"]));
    if(!empty($username) && !empty($password)){
        $sqlcheck="select user_id,user_type,first_name,active from tbl_users where username='".$username."' and pass='".$password."'";
        
        $s=mysqli_query($conn,$sqlcheck);
        
        $rdata  = mysqli_fetch_assoc($s);
        $msg="";
        if(mysqli_num_rows($s)> 0)
        {
            $_SESSION["user_id"]=$rdata["user_id"];
            $_SESSION["user_name"]=$rdata["first_name"];
            $_SESSION["user_type"]=$rdata["user_type"];
            if($rdata["active"]=='0')
            {
                $sql="update tbl_users set active='1' where user_id=".$_SESSION["user_id"];
                mysqli_query($conn, $sql);
       
                $chan="update tbl_items t set t.status='Y' where t.seller_id=".$_SESSION["user_id"];
                $ch=mysqli_query($conn,$chan);
            }
            if($_SESSION["user_type"]=="Admin" || $_SESSION["user_type"]=="Seller" && ($_SESSION["user_type"]=="Admin" || $_SESSION["user_type"]=="Seller"))
            {
            header("Location: users.php");
            }
            if($_SESSION["user_type"]=="Buyer")
            {
                   header("Location: ".BASEURL);
            }

        }
        else
        {
            $msg = "Incorrect Username or password. Please try again.";
        }
    }else{
        $msg = "Please enter Username or password!";
    }    
}



?>
    
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>PECOMMERCE CMS</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/auth.css">
        <script src="assets/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    </head>
    <body>
        <nav class="navbar navbar-inverse">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">PECommerce Admin</a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->

            </div><!-- /.container-fluid -->
        </nav> 
    <center>
        <div class = "container">

            <div class="wrapper">
                <form class="form-signin" action="/pecommerce/cms/index.php" method="post">
                    <h3 class="form-signin-heading">Welcome Back! Please Sign In</h3>
                                    <?php
                    if(isset($msg) && !empty($msg)){
                        echo '<center style="color:#ff0000">'.$msg.'</center> ';
                    }
                    ?>
                    <hr class="colorgraph"><br>
                    <div class="form-group ">
                        <input type="text" name="username" placeholder="Username" class="form-control" value="">
                        <span class="help-block"></span>
                    </div>    
                    <div class="form-group ">
                        <input type="password" placeholder="Password" name="password" class="form-control">
                        <span class="help-block"></span>
                    </div>
                    <div class="form-group">
                    <button class="btn btn-lg btn-primary btn-block"  name="login_submit_btn" value="Login" type="Submit">Login</button>
                    </div>
                   
                </form>
                <!--<form class="form-signin" method="post" accept-charset="utf-8">
                
                    <h3 class="form-signin-heading">Welcome Back! Please Sign In</h3>
                    <hr class="colorgraph"><br>
                    
                    <input type="text" class="form-control" name="username" id="username" placeholder="Username" required="" autofocus="" />
                    <input type="password" class="form-control" name="password" id="password" placeholder="Password" required="" autofocus="" />
                    <p>
                      <label for="remember">Remember Me:</label>          <input type="checkbox" name="remember" value="1"  id="remember" />
                    </p>
                    <button class="btn btn-lg btn-primary btn-block"  name="login_submit_btn" value="Login" type="Submit">Login</button>
                   
                </form>-->  </div>
        </div>
    </center>

</body>
</html>