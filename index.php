<?php 
if(isset($_COOKIE['login']))
{
    header("Location: v.php");

}
else{
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WebChating</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div id='op'>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-6">
            <img src="https://static.vecteezy.com/system/resources/previews/000/561/419/original/chat-app-logo-icon-vector.jpg"  alt="">
        </div>
        <div class="col-md-6 mt-4">
            <div class="row">
                    <div class="form-group">
                    
                    <input type="number" class="form-control" required='required' maxlength="10" placeholder=" +91 Your number here..." id="in-num">

                    </div>
                    <div class="form-group">
                    <input type="submit" class="btn btn-block btn-primary " value="SEND OTP">
                    </div>
            </div>
            <div class="row">
            
                <h1 style="display:none" id='con'>30</h1>
                
            </div>
            
          

    
        </div>
        
    </div>

</div>
<div  style="display:none" class="container otp mt-1">
                    <div class="form-group">
                            
                            <input type="number" class="form-control" required='required' maxlength="4" placeholder=" otp here" id="in-otp">

                            </div>
                            <div class="form-group">
                            <input type="submit" class="btn btn-block btn-info  " value="SIGN-UP" id="sign-up">
                            </div>
                        </div>
                <div  style="display:none" class="container password mt-1">
                    <div class="form-group">
                            
                            <input type="password" class="form-control" required='required' maxlength="12" placeholder=" enter your password" id="in-password">

                            </div>
                            <div class="form-group">
                            <input type="submit" class="btn btn-block btn-warning  " value="SIGN-IN">
                            </div>
                    
                    
</div>
</div>


    
</body>
<script src="js/jQuery.js"></script>
<script src="js/bootstrap.js"></script>
<script>
    $(document).ready(function()
    {
        $('.btn-primary').on('click',function(e)
        {
            e.preventDefault();
            var num=$('#in-num').val();
           
                timer();
            $.ajax({
                url:'sendotp.php',
                type:'post',
                data:{mobile:num},
                success:function(data)
                {   
                    
                    if(data==1||data==2)
                    {    $('.btn-primary').attr('disabled', true);
                          $('#con').css({'display':'block'});
                         $('.otp').css({'display':'block'});
                         $('.password').css({'display':'none'});

                    }
                    else if(data==0)
                    {   $('.btn-primary').attr('disabled', true);
                        alert("you are already registerd");
                        $('.password').css({'display':'block'});
                    }
                }
            })
        })
        
       function timer()
        {
            var c=30;
            setInterval(function(){
                c--;
                if(c>0)
                {
                    $('#con').html(c);
                }
                else if(c==0)
                {
                    $('#con').css({'display':'none'});
                    $('.btn-primary').attr('disabled', false);
                    
                }
            },1000)

        }
        $('#sign-up').on("click",function(e)
        {   e.preventDefault();
            var otp=$('#in-otp').val();
            var num=$('#in-num').val();
            
            $.ajax({
                url:'otp-verify.php',
                type:'post',
                data:{otp:otp,mobile:num},
                success:function(data)
                {   
                    
                    $('#op').html(data);
                }
            })

        })
        
        $(document).ready(function()
        {   
               
            $(document).on('click','#save',function(e){
                e.preventDefault();
                var password=$('#password').val();
            var con_pass=$('#con-password').val();
            var u_name=$('#user_name').val();
                
                    if(password==con_pass)
                    {
                        $.ajax({
                                url:'create.php',
                                type:'post',
                                data:{password:password,uname:u_name},
                                success:function(data)
                                {
                                    window.location.href = "index.php";
                                }
                        })
                    }
                    else{
                        alert("both passwords are not same");
                    }
            })
        })
        $(document).on('click','.btn-warning',function()
        {    var num=$('#in-num').val();
            var password=$('#in-password').val();
            $.ajax({
                url:'login.php',
                type:'post',
                data:{num:num,password:password},
                success:function(data)
                {   $('body').html(data)
                   if(data==0)
                   {
                    window.location.href = "v.php";
                   }
                   else if(data==1){
                       alert("password was wrong");
                    window.location.href = "index.php";
                   }
                }
            })
        })
    
    })
</script>

</html>
<?php }?>