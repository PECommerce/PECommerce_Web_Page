<?php 
session_start();

require_once __DIR__."/config/connection.php";

if(isset($_GET["sid"]) && !empty($_GET["sid"])){
    echo $sqlInsert = "update tbl_users set active='".$_GET["s"]."' where user_id=".$_GET["sid"];    
        if(mysqli_query($conn,$sqlInsert))
        {
            echo json_encode(array("id" => $_GET["sid"], "status" => $_GET["s"]));
        }else{
            $msg.="Error".  mysqli_error($conn);
        }
    
}

exit;