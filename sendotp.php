<?php
include "config.php"; 
$mobile=mysqli_real_escape_string($conn,$_POST['mobile']);
if(strlen($mobile)==10)
{
 $sql="SELECT user_number FROM users WHERE user_number='{$mobile}' AND reg_status=1  ";
$res=mysqli_query($conn,$sql) or die("query error");
$check="SELECT user_number FROM users WHERE user_number='{$mobile}'";
$result=mysqli_query($conn,$check) or die ("result error");
$check_2=mysqli_num_rows($result);
if(mysqli_num_rows($res)>0)
{
    echo '0';
}
else{
if(!isset($_COOKIE['otp'])&&(!$check_2>0))
{ 
    


    $randnum=(rand(1000,9999));
    
    setcookie('otp', $randnum, time() + (120), "/");
    $sql1="INSERT INTO users(user_number,otp) values('{$mobile}',$randnum)";
    $res2=mysqli_query($conn,$sql1) or die("query failed");
    
    $field = array(
      "sender_id" => "FSTSMS",
      "language" => "english",
      "route" => "qt",
      "numbers" => "$mobile",
      "message" => "43042",
      "variables" => "{#AA#}",
      "variables_values" => "$randnum"
  );
  
  $curl = curl_init();
  
  curl_setopt_array($curl, array(
    CURLOPT_URL => "https://www.fast2sms.com/dev/bulk",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_SSL_VERIFYHOST => 0,
    CURLOPT_SSL_VERIFYPEER => 0,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => json_encode($field),
    CURLOPT_HTTPHEADER => array(
      "authorization: e2Eo9jmY1rDF4RxOBgCVwW6NdcIiKXyTZGStuqpQ8AUJzhsl7kAKIZTXLNeR08PFxS5lyWhsqwjtinrz",
      "cache-control: no-cache",
      "accept: */*",
      "content-type: application/json"
    ),
  ));
  
  $response = curl_exec($curl);
  $err = curl_error($curl);
  
   curl_close($curl);
  
   if ($err) {
     echo "cURL Error #:" . $err;
   } else {
     echo 1;
   
  
   }
      
    
   
    
     
}
else{
    echo "2";
}
}
}
else {
    echo "enter proper number";
}

?>

 