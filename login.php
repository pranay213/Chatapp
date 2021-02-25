<?php 
include "config.php";
$num=mysqli_real_escape_string($conn,$_POST['num']);
$pass=mysqli_real_escape_string($conn,md5($_POST['password']));
  $sql="SELECT * FROM users WHERE user_number='{$num}' AND password='{$pass}'";
  $res=mysqli_query($conn,$sql) or die("query error");
$row=mysqli_num_rows($res);
if($row>0)
{
    setcookie('login',$num,time()+(60*60*24*365),'/');
    

    echo '0';
    

}
else{
    echo '1';
}
?>