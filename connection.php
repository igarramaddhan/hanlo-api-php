<?php
define('HOST','127.0.0.1');
define('USER','root');
 //sesuaikan nama user
define('PASS','my-secret');
 //sesuaiakan nama password
define('DB','post');//sesuaiakan naman database
$conn = mysqli_connect(HOST,USER,PASS,DB) or die('Unable to Connect');
date_default_timezone_set("Asia/Jakarta");
?>
