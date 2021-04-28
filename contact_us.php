<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require "vendor/autoload.php";

require_once 'templates/header.php';
$sqlcheck="select * from tbl_users where username='admin'";
$res=mysqli_query($conn,$sqlcheck);
 $rdata  = mysqli_fetch_assoc($res);
 if(isset($_POST["submit"])){
     $name=$_POST["name"];
     $email=$_POST["email"];
     $subject=$_POST["subject"];
     $message=$_POST["message"];
     $header= "From: ".$email." ". "\r\n" ;
     $msg="";
     
     
 }
 
?>
	 <div id="contact-page" class="container">
    	<div class="bg">
	    	<div class="row" style="padding-bottom: 20px">    		
	    		<div class="col-sm-12">    			   			
					<h2 class="title text-center">Contact <strong>Us</strong></h2>    			    				    				
					<div class="mapouter"><div class="gmap_canvas"><iframe width="1130" height="500" id="gmap_canvas" src="https://maps.google.com/maps?q=kapil%20eye%20hosptial&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe><a href="https://123movies-to.org"></a><br><style>.mapouter{position:relative;text-align:right;height:500px;width:1130px;}</style><a href="https://www.embedgooglemap.net">embedgooglemap.net</a><style>.gmap_canvas {overflow:hidden;background:none!important;height:500px;width:1130px;}</style></div></div>
				</div>			 		
			</div>    	
    		<div class="row">  	
	    		<div class="col-sm-8">
	    			<div class="contact-form">
	    				<h2 class="title text-center">Get In Touch</h2>
                                        <?php
                                        if(isset($_POST["submit"])){
                                        if(isset($msg) && !empty($msg))
                                        {
                                            echo '<div class="status alert alert-success">'.$msg.'</div>';
                                        }
                                        $mail = new PHPMailer(true);

try {
    //Server settings
    //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = EMAIL_USERNAME;                     //SMTP username
    $mail->Password   =  API_PASSWORD;                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 587;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail->setFrom($email, $name);
    $mail->addAddress($rdata["email_id"], $rdata["first_name"]);     //Add a recipient

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = $subject;
    $mail->Body    = $email."<br>".$message;
    //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo '<div class="status alert alert-success">We will soon get in touch with you.</div>';
} catch (Exception $e) {
    echo '<div class="status alert alert-danger">Sorry an error occured. Please try later.</div>';
}
                                       
                                        }
                                                ?>
				    	<form id="main-contact-form" class="contact-form row" name="contact-form" method="post">
				            <div class="form-group col-md-6">
				                <input type="text" name="name" class="form-control" required="required" placeholder="Name">
				            </div>
				            <div class="form-group col-md-6">
				                <input type="email" name="email" class="form-control" required="required" placeholder="Email">
				            </div>
				            <div class="form-group col-md-12">
				                <input type="text" name="subject" class="form-control" required="required" placeholder="Subject">
				            </div>
				            <div class="form-group col-md-12">
				                <textarea name="message" id="message" required="required" class="form-control" rows="8" placeholder="Your Message Here"></textarea>
				            </div>                        
				            <div class="form-group col-md-12">
				                <input type="submit" name="submit" class="btn btn-primary pull-right" value="Submit">
				            </div>
				        </form>
	    			</div>
	    		</div>
	    		<div class="col-sm-4">
	    			<div class="contact-info">
	    				<h2 class="title text-center">Contact Info</h2>
	    				<address>
	    					<p>PECommerce</p>
							<p><?php echo $rdata["address"]; ?></p>
							<p>Mobile: +91 <?php echo $rdata["contact"]; ?></p>
							<p>Email: <?php echo $rdata["email_id"]; ?></p>
	    				</address>
	    				<div class="social-networks">
	    					<h2 class="title text-center">Social Networking</h2>
							<ul>
								<li>
									<a href="#"><i class="fa fa-facebook"></i></a>
								</li>
								<li>
									<a href="#"><i class="fa fa-twitter"></i></a>
								</li>
								<li>
									<a href="#"><i class="fa fa-google-plus"></i></a>
								</li>
								<li>
									<a href="#"><i class="fa fa-youtube"></i></a>
								</li>
							</ul>
	    				</div>
	    			</div>
    			</div>    			
	    	</div>  
    	</div>	
    </div><!--/#contact-page-->
	<?php
require_once 'templates/footer.php';
?>
	