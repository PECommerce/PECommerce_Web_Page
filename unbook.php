<?php
require_once __DIR__."/cms/config/config.php";
require_once __DIR__."/cms/config/connection.php";
$id=$_GET["id"];
if(!isset($_GET["id"]) || empty($_GET["id"]))
{
    header("Location: index.php");
    exit;
}
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require "vendor/autoload.php";

$sqlk="delete from tbl_booked where item_id= ".$id;
$n=mysqli_query($conn,$sqlk);
$sql="update tbl_items set status = 'Y' where item_id= ".$id;
$k=mysqli_query($conn,$sql);
$sqlselect="select * from tbl_items t left join tbl_users u on (t.seller_id=u.user_id) where item_id= ".$id;
$ans=mysqli_query($conn,$sqlselect);
$call= mysqli_fetch_assoc($ans);
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
    $mail->addAddress($call["email_id"], $call["first_name"]." ".$call["last_name"]);     //Add a recipient

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = "Item Name:- ".$call["name"]." is Unbooked.";
    $mail->Body    = "<p>Your item <b>".$call["name"]."</b> is Unbooked.</p>";
    //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
} catch (Exception $e) {
}
header("Location: booking.php")
?>