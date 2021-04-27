<?php
ini_set("display_errors",1);
error_reporting(E_ERROR);


$host = "localhost";
$username = "root";
$password = "root";
$dbName = "mydb";


$conn = mysqli_connect($host,$username,$password,$dbName);

if(!$conn){
    die ("Coneection error:-". mysqli_connect_error());
}
