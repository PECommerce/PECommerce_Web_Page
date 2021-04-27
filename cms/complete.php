<?php
session_start();
include "config/connection.php";
if(!isset($_SESSION["user_id"]) || empty($_SESSION["user_id"])){
    header("Location: items.php");
}


$id = $_GET["id"];
if($_SESSION["user_type"]=="Seller")
{
    $sqlcheck="select booked_id from tbl_booked b left join tbl_items t on(b.item_id=t.item_id) where t.seller_id= ".$_SESSION["user_id"]." and b.item_id= ".$id;
    $result = mysqli_query($conn,$sqlcheck);
    if (mysqli_num_rows($result) == 0)
    {
        header("Location: users.php");
        exit;
    }
}


$sqlUpdate = "update tbl_booked set order_status='C' where item_id= ".$id;
$d = mysqli_query($conn,$sqlUpdate);
if($d)
{
    header("Location: booking.php");
}else{
    die("Error".  mysqli_error($conn));
}

