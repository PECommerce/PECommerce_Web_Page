<?php
session_start();
include "config/connection.php";
if(!isset($_SESSION["user_id"]) || empty($_SESSION["user_id"])){
    header("Location: items.php");
}


$id = $_GET["id"];
if($_SESSION["user_type"]=="Seller")
{
    $sqlcheck="select item_id from tbl_items where seller_id= ".$_SESSION["user_id"]." and item_id= ".$id;
    $result = mysqli_query($conn,$sqlcheck);
    if (mysqli_num_rows($result) == 0)
    {
        header("Location: users.php");
        exit;
    }
}

// Delete Query
$select="select * from tbl_items where item_id=".$id;
$result=mysqli_query($conn,$select);
$row = mysqli_fetch_array($result);

$sqlUpdate = "delete tbl_items , tbl_booked from tbl_items left join tbl_booked on (tbl_items.item_id=tbl_booked.item_id) where tbl_items.item_id=".$id;
$d = mysqli_query($conn,$sqlUpdate);
if($d)
{
    @unlink("Images/".$row["image"]);
    header("Location: items.php");
}else{
    die("Error".  mysqli_error($conn));
}

