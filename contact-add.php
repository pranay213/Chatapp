<?php
include "config.php";
$add_num=mysqli_real_escape_string($conn,$_POST['add_num']);
$sql="SELECT user_id FROM users WHERE user_number='{$add_num}'";
$res=mysqli_query($conn,$sql) or die("query error ");;


$usr= (mysqli_fetch_assoc($res));
 
if(mysqli_num_rows($res)>0)
{$check="SELECT friend_id FROM friend_list WHERE my_id='{$_COOKIE['my_id']}' AND friend_id='{$usr['user_id']}'";
  $check_res=mysqli_query($conn,$check ) or die("error query params");
  if(mysqli_num_rows($check_res)>0)
  {

  }
  else{
    if($usr['user_id']!=$_COOKIE['my_id'])
    {
       $sql1="INSERT INTO friend_list(friend_id,my_id) VALUES('{$usr['user_id']}','{$_COOKIE['my_id']}') ";
       $sql3="INSERT INTO friend_list(my_id,friend_id) VALUES('{$usr['user_id']}','{$_COOKIE['my_id']}') ";
      $res2=mysqli_query($conn,$sql1) or die("adding contact error");
      $res3=mysqli_query($conn,$sql3) or die("adding contact error");
    }
    
  }
}
else{
 echo "0";
}
?>