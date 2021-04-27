<?php
session_start();
include "config/connection.php";
if(!isset($_SESSION["user_id"]) || empty($_SESSION["user_id"])){
    header("Location: booking.php");
}


$id = $_GET["id"];
if($_SESSION["user_type"]=="Seller")
{
    $sqlcheck="SELECT b.booked_id,t.item_id,u.user_id,u1.user_id as sel FROM tbl_booked b 
    left join tbl_users u on(b.buyer_id=u.user_id)
    left join tbl_items t on(b.item_id=t.item_id)
    left join tbl_users u1 on(t.seller_id=u1.user_id) where b.booked_id=".$id." and (u.user_id = ".$_SESSION["user_id"]." or u1.user_id = ".$_SESSION["user_id"].")";
    $result = mysqli_query($conn,$sqlcheck);
    if (mysqli_num_rows($result) == 0)
    {
        header("Location: users.php");
        exit;
    }
}

$sqlUpdate = "delete from tbl_booked where booked_id=".$id;
$k="update tbl_items t left join tbl_booked b on (t.item_id=b.item_id) set t.status='Y' where b.booked_id=".$id;
$a=mysqli_query($conn,$k);
$d = mysqli_query($conn,$sqlUpdate);
if($d)
{
    header("Location: booking.php");
}else{
    die("Error".  mysqli_error($conn));
}

