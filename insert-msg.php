<?php 

include 'config.php';
$msg=mysqli_real_escape_string($conn,$_POST['msg']);
$rec_id=$_COOKIE['rec_id'];
$my_id=$_COOKIE['my_id'];



$sql="INSERT INTO chating_db(my_msg,my_id,rec_id) VALUES ('{$msg}','{$my_id}','{$rec_id}')";
$sql2="INSERT INTO chating_db(rec_msg,my_id,rec_id) VALUES ('{$msg}','{$rec_id}','{$my_id}')";

$res=mysqli_query($conn,$sql) or die('Query error');
$res1=mysqli_query($conn,$sql2) or did('Query error');

echo '0';
?>