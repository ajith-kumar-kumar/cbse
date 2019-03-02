<?php
require 'constant.php';
$db=mysqli_connect (LOCALHOST,DB_USER,DB_PASS,DB_NAME);
if (!$db) {
	echo "connection failed".mysqli_error($db);
}
else{
	//echo "connected";
}
 ?>
