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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/chat.css">
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>

    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="/bub.scss">
    <title>Chat</title>
</head>
<body>
  <div class="container-fluid chat-div">
      <div class="head">
          <div class="col-9">
          <p>ChatApp</p>
          </div>
         
          <div class="col-3">
          <i class="fas fa-search"></i>
          <div class="icon">
          <i class="fas fa-ellipsis-v ic"></i>
          </div>
          </div>
         
      </div>
      <div class="body">
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
                
                <li>
                <img src="https://i.pinimg.com/originals/51/f6/fb/51f6fb256629fc755b8870c801092942.png" alt="">
                <p data-id=<?php echo $fr[$i]?>><?php  echo $dr[$j]?></p>
                </li>
              <?php }?>
            
            
             
             

            
              

          </ul>
        <div class="add-user">
        <i class="fas fa-plus-square"></i>
        </div>
      </div>
  </div>

  <script src="js/fontawesome.js"></script>
  <script src="js/jQuery.js"></script>
  <script src="js/bootstrap.js"></script>
  <script>
     $(document).ready(function()
     {
        $('.add-user').on("click",function()
      {     $.ajax({
          url:"add-user.php",
          type:'post',
          success:function(data)
          {
            $('.chat-div').html(data)
            $('.add-user').css({"display":"none"});
          }
      })

      })
      $(document).on('click','.back',function(){
        $.ajax({
          url:"v.php",
          type:'post',
          success:function(data)
          {
            $('body').html(data)
            
           
          }
      })
     })
     $(document).on('click',".add-n-c",function()
     {
         $.ajax({
             url:'add-contact.php',
             type:'post',
             success:function(data)
             {
                 $('.body').html(data)
             }
         })
     })
     $('ul li p').on('click',function()
     { var u_id=$(this).data('id');
     
       $.ajax({
         url:"chat-window.php",
         type:'post',
         data:{u_id:u_id},
         success:function(data)
         {
           $('.chat-div').html(data);
         }
       })
     })
     })
     $(document).on('click','.fa-paper-plane',function(e)
     {
      e.preventDefault();
      var msg=$('#msg').val();
      $.ajax({
        url:'insert-msg.php',
        type:'post',
        data:{msg:msg},
        success:function(data)
        {
          chatload()
          
        }
      })
     
     })
     $(document).on('click','.fa-ellipsis-v',function()
      {
        $.ajax({
          url:'submenu.php',
          type:'post',
          success:function(data)
          {
            $('.icon').html(data);
          }
        })
        
      })
      $(document).on('click','.log-out',function()
      {
        $.ajax({
          url:'logout.php',
          type:'post',
          success:function(data)
          {
            window.location.href = "v.php";
          }
        })
      })
      $(document).on("click",'.fa-arrow-right',function()
      {
        var add_num=$('#add-num').val();
       
        $.ajax({
          url:'contact-add.php',
          type:'post',
          data:{add_num:add_num},
          success:function(data)
          {
            window.location.href = "v.php";
          }
        })
      })
      function chatload()
      {
        $.ajax({
         url:"chat-window.php",
         type:'post',
        
         success:function(data)
         {
           $('.chat-div').html(data);
         }
       })
       sendRequest();
      }
      function sendRequest(){
    $.ajax({
        url: "chat-window.php",
        success: 
        function(result){
            $('.chat-div').html(result); //insert text of test.php into your div
            setTimeout(function(){
                sendRequest(); //this will send request again and again;
            }, 10000);
        }
    });
}

  </script>
</body>
</html>
<?php }
else
header("Location: index.php");
?>
