<?php
include "config.php";
$mobile=mysqli_real_escape_string($conn,$_POST['mobile']);
$otp=mysqli_real_escape_string($conn,$_POST['otp']);
 $sql="SELECT * FROM users WHERE user_number='{$mobile}' AND otp='$otp'";
$res=mysqli_query($conn,$sql) or die('query error');
if(mysqli_num_rows($res)>0)
{
   echo "12";
    setcookie('user',$mobile,time()+(300),'/');
    header('Location: password.php');

}
?>