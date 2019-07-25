<?php 
$servername = "localhost";
 
$username = "root";
 
$password = "";
 
$dbname = "trotot";
 
$con = mysqli_connect($servername,$username,$password,$dbname);
if($con){
    $setLang=mysqli_query($con, "SET NAMES 'utf8'");
}
else{
    die("Kết nối thất bại!".mysqli_connect_error());
}
 ?>
