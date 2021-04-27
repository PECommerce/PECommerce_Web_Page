<?php
ob_start();
if(!isset($_GET["id"]) || empty($_GET["id"]))
{
    header("Location: index.php");
}
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require "vendor/autoload.php";

require_once 'templates/header.php';
$id=$_GET["id"];
$sqlcheck="select * from tbl_booked where item_id= ".$id;
$res=mysqli_query($conn,$sqlcheck);
$cat="select * from tbl_items where item_id= ".$id." and (status='N' or seller_id= ".$_SESSION["user_id"].") ";
$catch=mysqli_query($conn,$cat);
if (mysqli_num_rows($res) > 0 || mysqli_num_rows($catch) > 0)
{
    header("Location: index.php");
    exit;
}
$sql="update tbl_items set status = 'N' where item_id= ".$id;
$k=mysqli_query($conn,$sql);
$sqlk="insert into tbl_booked (buyer_id,item_id) values(".$_SESSION["user_id"].",".$id.")";
$n=mysqli_query($conn,$sqlk);
$sqlite="select * from tbl_items t left join tbl_users u on (t.seller_id=u.user_id) where item_id= ".$id;
$ma=mysqli_query($conn,$sqlite);
$fill = mysqli_fetch_array($ma);
$bur="select * from tbl_users where user_id= ".$_SESSION["user_id"];
$buy=mysqli_query($conn,$bur);
$buyer= mysqli_fetch_assoc($buy);
$mail = new PHPMailer(true);

try {
    //Server settings
    //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = EMAIL_USERNAME;                     //SMTP username
    $mail->Password   = API_PASSWORD;                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 587;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail->setFrom(EMAIL_USERNAME, 'Admin');
    $mail->addAddress($fill["email_id"], $fill["first_name"]." ".$fill["last_name"]);     //Add a recipient

    $mail->addAttachment('cms/Images/'.$fill["image"].'');
    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = "Item Name:- ".$fill["name"]." is booked.";
    $mail->Body    = "<p>Your item <b>".$fill["name"]."</b> is booked by user, name:- <b>".$buyer["first_name"]." ".$buyer["last_name"]."</b> Email_id:- <b>".$buyer["email_id"]."</b> , Address:- <b>".$buyer["address"]."</b> , Contact:- <b>".$buyer["contact"]."</b> .</p>";
    //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
} catch (Exception $e) {
}
?>
	<div class="container text-center">
		<div class="content-404">
			<img src="images/thanks/thanks.jpg" class="img-responsive" alt="" />
			<h1><b>Thanks!</b> For Shopping with us.</h1>
			<p>You can continue your shopping experience or you can see your bookings.</p>
			<h2><a href="index.php">Shopping</a></h2>
                        <h2><a href="booking.php">Bookings</a></h2>
		</div>
	</div>

  
    <script src="js/jquery.js"></script>
	<script src="js/price-range.js"></script>
    <script src="js/jquery.scrollUp.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.prettyPhoto.js"></script>
    <script src="js/main.js"></script>
<?php
require_once 'templates/footer.php';
?>