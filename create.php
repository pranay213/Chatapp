<?php 
if(isset($_COOKIE['user']))
{
include 'config.php';
$uname=mysqli_real_escape_string($conn,$_POST['uname']);
$pass=mysqli_real_escape_string($conn,md5($_POST['password']));
$mobile=$_COOKIE['user'];
 echo $reg="UPDATE users SET user_name='{$uname}',password='{$pass}' WHERE user_number='{$mobile}'";
$res=mysqli_query($conn,$reg) or die("error  query connection");
$register="UPDATE users SET reg_status=1 WHERE user_number='{$mobile}' ";
$res2=mysqli_query($conn,$register) or die ("register error");

setcookie('user',$mobile,time()-(300),'/');

}
?>