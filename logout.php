<?php 
setcookie('login','',time()-(60*60*24*365),'/');
setcookie('my_id',$my_id,time()+(60*60*24*365),'/');
setcookie('rec_id',$rec_id,time()-(60*60*24*365),"/");


?>