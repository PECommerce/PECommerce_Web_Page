<?php
session_start();
include "config/connection.php";
include "config/config.php";
if(!isset($_SESSION["user_id"]) || empty($_SESSION["user_id"])){
    header("Location: index.php");
    exit;
}

$id = $_GET["id"];
if($_SESSION["user_id"]!=$id && $_SESSION["user_type"]=="Seller")
{
    header("Location: users.php");
    exit;
}
 $sql="update tbl_users set active='0' where user_id=".$id;
       mysqli_query($conn, $sql);
       
       $chan="update tbl_items t set t.status='N' where t.seller_id=".$id;
       $ch=mysqli_query($conn,$chan);
       if($_SESSION["user_type"]=="Seller")
       {
           session_unset();
        session_destroy();
       }
       header("Location: index.php");
?>