<?php 
 define('DB_USER','localhost');
 define('DB_HOST','root');
 define('DB_PASS','');
 define('DB_NAME','admin');

 $con = mysqli_connect(DB_USER, DB_HOST, DB_PASS, DB_NAME) or die("Couldn't connect");

?>