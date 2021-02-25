<?php 
if(isset($_COOKIE['user']))
{


?>

    <div class="container-fluid mt-5">
        <div class="form-group">
            <input type="text" class="form-control" id='user_name' placeholder="username">
        </div>
        <div class="form-group">
            <input type="password" class="form-control" id="password" placeholder="password">
        </div>
        <div class="form-group">
            <input type="password" class="form-control" id="con-password" placeholder="confirmpassword">
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-block btn-primary" id="save">
        </div>
    </div>
    
    



<?php
}?>