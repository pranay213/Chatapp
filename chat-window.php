<?php 
include 'config.php';
if(isset($_POST['u_id']))
{
 $rec_id=mysqli_real_escape_string($conn,$_POST['u_id']) ;
}
else{
    $rec_id=$_COOKIE['rec_id'];
}
 $sql="SELECT * FROM chating_db WHERE my_id='{$_COOKIE['my_id']}' AND rec_id='{$rec_id}' ";
 setcookie('rec_id','',time()-(60*60*24*365),"/");
 setcookie('rec_id',$rec_id,time()+(60*60*24*365),"/");
 $search="SELECT user_name FROM users WHERE user_id='{$rec_id}'";
 $res12=mysqli_query($conn,$search) or die ("error user details");
 if(mysqli_num_rows($res12)>0)
 {
     $details=mysqli_fetch_assoc($res12);
 }
 
?>
<div class="head">
          <div class="col-9">
          <i class="far fa-arrow-alt-circle-left back mt-2 pr-3"></i>
          
              
              <img class="mt-2 " style="width:30px; height:30px"src="https://i.pinimg.com/originals/51/f6/fb/51f6fb256629fc755b8870c801092942.png" alt="">
              <p class="ml-3 mt-1"><?php echo $details['user_name']?></p>
          
          </div>
         
         <div class="col-3">

          </div>
         
</div>
<div class="body">
    <?php 
       
        $res=mysqli_query($conn,$sql) or die("error query connection");
        while($row=mysqli_fetch_assoc($res))
        {
    ?>
            <?php if($row['rec_msg']!='')
            {?>
        <div class="row left-chat mt-2 ml-3">
            <div class="tri-left">

            </div>    
             <p><?php echo $row['rec_msg']?></p>
         
        </div>
        <div class="space">

        </div>
        <?php }?>
        <?php if($row['my_msg']!='')
        {?>
        <div class="row right-chat mt-2 mr-3">
            <div class="tri-right">

            </div>
             <p>
             <?php echo $row['my_msg'];?>
             </p>
         
        </div>
       <div class="space">
            
        </div>
        <?php }
        }?>
       

        
       
        
        
</div>
 <div class="chat-box p-2 ">
            <div class="form-group">
                <input type="text" class="form-control" id='msg' autocomplete="off">
            </div>
            <i  style="font-size:30px" class="fas fa-paper-plane mt-1"></i>
        </div>
