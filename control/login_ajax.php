<?php 
error_reporting(0);

 require 'db_config.php';


$result = array('tag' =>'null' , 'err'=>0, 'res'=>'ajith' );




	$name=mysqli_real_escape_string($db,$_POST['name']);
	$pass=mysqli_real_escape_string($db,$_POST['pass']);
	echo $name;
	echo $pass;
	//$salted="mgl4yt".$_POST['pass']."fdsf";
	//$hashed=hash('sha512', $salted);
	//echo $hashed;

// $query="INSERT INTO admin (name,pass) VALUES( '$name', '$hashed') ";
	
	
  $query="SELECT * FROM admin  WHERE name='$name' AND pass='$pass'";
  $res=mysqli_query($db,$query);

 if($res==1)
{
$result['res']='success';
$result['err']=1;
echo json_encode($result);
 }else{
 	$result['res']='failed';
 	$result['err']=4;
 	echo json_encode($result);
 }


?>