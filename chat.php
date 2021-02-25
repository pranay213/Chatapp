<?php 
if(isset($_COOKIE['login']))
{
  include "config.php";
  $check="SELECT user_id,user_name FROM users WHERE user_number='{$_COOKIE['login']}' ";
  $user_check=mysqli_query($conn,$check) or die('error checking');
  $friends=mysqli_fetch_assoc($user_check);
  $sql_check="SELECT user_id, user_number,user_name FROM users ";
  $search=mysqli_query($conn,$sql_check) or die("error searching id");
  
  $my_id=$friends['user_id'];
  setcookie('my_id',$my_id,time()+(60*60*24*365),'/');
  

?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Chat</title>
	<link rel="stylesheet" href="css/style2.css">
	
</head>
<body>
	<div class="container">
		<div class="chat">
			<div class="chat-header">
				<div class="profile">
					<div class="left">
						
						<h2>Whatsapp</h2>
						
					</div>
					<div class="right">
						
					</div>
				</div>
			</div>
			<div class="chatbox">
				<div class="contacts">
                    <ul>
                    <?php 
            
            $sql="SELECT friend_id FROM friend_list WHERE my_id='{$my_id}'";
            $res=mysqli_query($conn,$sql) or die("query success");
            $fr= array();
            $us= array();
            if(mysqli_num_rows($res)>0)
            {
             
            while($row2=mysqli_fetch_assoc($res))
            {
             $fr[]=$row2['friend_id'];
            }
              
             
            }
            $count=count($fr);
           
           
            $dr=array();
              while($mr=mysqli_fetch_assoc($search))
              {
                
                  $dr[$mr['user_id']]= $mr['user_name'];
                
              }
              $count2=count($dr);
              for($i=0;$i<$count;$i++)
              { $j=$fr[$i];
                 ?>
                        <li class='contact'>
                            <img src="img/pp.png" alt="">
                            <p data-id=<?php echo $fr[$i]?>><?php  echo $dr[$j]?></p>
                        </li>
                        <?php }?>
                    </ul>
                    
                </div>

				
			</div>

			<div class="chat-footer">
				
			</div>
		</div>
	</div>
	
</body>
</html>
<?php }?>
