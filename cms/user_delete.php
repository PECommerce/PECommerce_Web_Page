<?php
session_start();
include "config/connection.php";

if(!isset($_SESSION["user_id"]) || empty($_SESSION["user_id"])){
    header("Location: index.php");
}

$id = $_GET["id"];
if($_SESSION["user_id"]!=$id && $_SESSION["user_type"]=="Seller")
{
    header("Location: users.php");
    exit;
}

if(!empty($id)){
    $select="select * from tbl_items where seller_id=".$id;
    $result=mysqli_query($conn,$select);
    $sqlchan="delete tbl_items , tbl_booked from tbl_items left join tbl_booked on (tbl_items.item_id=tbl_booked.item_id) where tbl_items.seller_id=".$id;
    $s=mysqli_query($conn,$sqlchan);
     while ($row = mysqli_fetch_array($result)) {
         @unlink("Images/".$row["image"]);
     }
    $k="update tbl_items t left join tbl_booked b on (t.item_id=b.item_id) set t.status='Y' where b.buyer_id=".$id;
    $y=mysqli_query($conn,$k);
    $sqlup = "delete from tbl_booked where buyer_id=".$id;
    $f=mysqli_query($conn,$sqlup);
    $sqlUpdate = "delete from tbl_users where user_id=".$id;
    $d = mysqli_query($conn,$sqlUpdate);
    if($d)
    {
        if($_SESSION["user_type"]=="Seller")
        {
            session_unset();
        session_destroy();

        header("Location: index.php");

        }
 else {
        header("Location: users.php");
 }
    }else{
        die("Error".  mysqli_error($conn));
    }
}else{
    header("Location: users.php");
}   

