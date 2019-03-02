<?php

$res = array('tag'=>'null' , 'err'=>500, 'result'=>'aj admin', "query"=>"nill");




  if (isset ($_POST['op']) && $_POST['op'] !='' ) {
  	require '../db_config.php';
  	$op=$_POST['op'];
  	$res['tag']=$op;
  	if ($op=='addInfra') {
  		$iname=mysqli_real_escape_string($db,$_POST['iname']);
  		$idesc=mysqli_real_escape_string($db,$_POST['idesc']);
  		if (mysqli_num_rows(mysqli_query($db,"SELECT `infra_id` FROM `infra` WHERE infra_name='$iname' "))==0) {

  			mysqli_query($db,"SET AUTOCOMMIT = 0");
  			mysqli_query($db,"COMMIT");
  			$insert=mysqli_query($db,"INSERT INTO `infra` (`infra_name` ,`infra_desc`) VALUES('$iname' ,'$idesc');");
  			if ($insert==1) {
  				$id=mysqli_insert_id($db);
  				if ($_FILES['image']['name'] !='' && (substr($_FILES['image']['type'],6)=='jpg' || substr($_FILES['image']['type'],6) =='jpeg' ||substr($_FILES['image']['type'], 6)=='png' )){ 

	                   $path="../uploads/infraimg/";
	                   if (!is_dir($path)) {
	                   	 mkdir($path);

	                   }
	                   $path=$path.$id.".".substr($_FILES['image']['type'], 6);
	                   // $res['query']=$path;
	                   $filename=$id.".".substr($_FILES['image']['type'],6);
	                   // print_r($filename);
	                   if (move_uploaded_file($_FILES['image']['tmp_name'], $path)) {	
	                   	mysqli_query($db,"COMMIT");
	                   	mysqli_query($db,"SET AUTOCOMMIT = 1");
	                   	$update=mysqli_query($db,"UPDATE `infra` SET `infra_image`='$filename' WHERE infra_id='$id' ");
	                   	if ($update==1) {
	                   		$res['err']=0;
	                   		$res['result']="infrastructure was added";
	                   		echo json_encode($res);
	                   	}
	                   	else{
	                   		$res['err']=1;
	                   		$res['result']="Oops..";
	                   		echo json_encode($res);
	                   	}


	                   }else{
	                   	mysqli_query($db,"ROLLBACK");
	                   	mysqli_query($db,"COMMIT");
	                   	mysqli_query($db,"SET AUTOCOMMIT=1");
	                   	$res['err']=2;
	                   	$res['result']='image upload was failed';
	                   	echo json_encode($res);
	                   }



  				   } else{
  				   	  mysqli_query($db,"ROLLBACK");
  				   	  mysqli_query($db,"COMMIT");
  				   	  mysqli_query($db,"SET AUTOCOMMIT=1");
  				   	  $res['err']=3;
  				   	  $res['result']="image file type must be jpg or png";
  				   	  echo json_encode($res);
  				   }
  					# code...
  				}else{
  					mysqli_query($db,"COMMIT");
  					mysqli_query($db,"SET AUTOCOMMIT=1");
  					$res['err']=4;
  					$res['result']="Infrastructure was not added";
  					echo json_encode($res);
  				}
  			}else{
  				$res['err']=4;
  				$res['result']="infrastructure already exist";
  				echo json_encode($res);
  			}
  		}elseif($op=='fetchInfra'){	
          $fetch=mysqli_query($db,"SELECT * FROM infra");
          if (mysqli_num_rows($fetch) > 0) {
          	   $data=array();
          	   $res['data']=array();
          	   while($ele=mysqli_fetch_array($fetch)){
          	   	$data['iname']=$ele['infra_name'];
          	   	$data['idesc']=$ele['infra_desc'];
          	   	$data['image']=$ele['infra_image'];
          	   	$data['id']=$ele['infra_id'];
          	   	$data['status']=$ele['status'];
          	   	array_push($res['data'], $data);
          	   }
          	   $res['err']=0;
          	   $res['result']="infra was loaded";
          	   echo json_encode($res);

          }else{
          	$res['err']=1;
          	$res['result']="infra was not found";
          	echo json_encode($res);
          }
         
         }elseif($op=="editInfra"){

         	$id=mysqli_real_escape_string($db,$_POST['id']);
         	$ele=mysqli_fetch_array(mysqli_query($db,"SELECT `infra_id`,`infra_name`,`infra_desc`,`infra_image` FROM infra WHERE infra_id='$id'"));
         	$res['iname']=$ele['infra_name'];
         	$res['idesc']=$ele['infra_desc'];
         	$res['image']=$ele['infra_image'];
         	$res['id']=$ele['infra_id'];
         	$res['err']=0;
         	$res['result']="loaded";
         	echo json_encode($res);
         
          }elseif($op == "updateinfras"){
                  
                $iname = mysqli_real_escape_string($db, $_POST['iname']);
			$idesc = mysqli_real_escape_string($db, $_POST['idesc']);
			$id = mysqli_real_escape_string($db, $_POST['id']);
			if (mysqli_num_rows(mysqli_query($db, "SELECT `infra_id` FROM `infra` WHERE (infra_name = '$iname' ) AND  infra_id <> '$id'")) == 0) {
			
				if (isset($_FILES['image'])) {
					if ($_FILES['image']['name'] != '' && 
							(substr($_FILES['image']['type'], 6) == 'jpg' || 
								substr($_FILES['image']['type'], 6)=='jpeg' || 
									substr($_FILES['image']['type'], 6)=='png') ) {
						$path = '../uploads/infraimg/';
						if(!is_dir($path)) {
						    mkdir($path);
						}
						$path = $path.$id.'.'.substr($_FILES['image']['type'], 6);
						$filename = $id.'.'.substr($_FILES['image']['type'], 6);
						$res['extension'] = substr($_FILES['image']['type'], 6);
						$res['filepath'] = $path;
						$imgpath = mysqli_fetch_array(mysqli_query($db, "SELECT `infra_image` FROM `infra` WHERE infra_id = '$id'"))['infra_image'];
						if (explode('.', $imgpath)[1] != substr($_FILES['image']['type'], 6)) {
							mysqli_query($db,"SET AUTOCOMMIT = 0");
							mysqli_query($db,"COMMIT");
							if (unlink('../uploads/infraimg/'.$imgpath)){
								mysqli_query($db,"COMMIT");
								mysqli_query($db,"SET AUTOCOMMIT = 1");
								if (move_uploaded_file($_FILES['image']['tmp_name'], $path)) {
									$update = mysqli_query($db, "UPDATE `infra` SET `infra_name`='$iname', `infra_desc`='$idesc',`infra_image`='$filename' WHERE infra_id = '$id'");
									if ($update == 1) {
										$res['err'] = 0;
										$res['result'] = 'User was updated';
										echo json_encode($res);																				
									}else{
										$res['err'] = 3;
										$res['result'] = 'User was not updated';
										echo json_encode($res);																				
									}
								}else{
									$res['err'] = 2;
									$res['result'] = 'Logo upload was failed';
									echo json_encode($res);														
								}               			 	# code...
                			 }else{
                			 	mysqli_query($db,"ROLLBACK");
                			 	mysqli_query($db,"COMMIT");
                			 	mysqli_query($db,"SET AUTOCOMMIT = 1");
                			 	$res['err']=3;
                			 	$res['result']="oops";
                			 	echo json_encode($res);
                			 }
                             
                		}else{
                			if (move_uploaded_file($_FILES['image']['tmp_name'], $path)) {
                			       $update=mysqli_query($db,"UPDATE `infra` SET `infra_name`='$iname' ,`infra_idesc`='$idesc',`infra_image`='$filename' WHERE infra_id='$id' ");
                			       if ($update==1) {
                			       	     $res['err']=2;
                			       	     $res['result']="infra was updated";
                			       	     echo json_encode($res);
                			       }else{
                			       	$res['err']=4;
                			       	$res['result']="ifra was not updated";
                			       	json_encode($res);
                			       }


                			       }else{
                			       	$res['err']=4;
                			       	$res['result']="photo was failed";
                			       	echo json_encode($res);
                			       }
                			}
                		}else{
                			$res['err']=1;
                			$res['result']="image must be png  or jpg";
                			echo json_encode($res);
                		}

                		
                	}else{
                		$update=mysqli_query($db,"UPDATE `infra` SET `infra_name`='$iname' ,`infra_desc`='$idesc' WHERE infra_id='$id' ");
                		if ($update==1) {
                			$res['err']=4;
                			$res['result']="infra was upadted";
                			echo json_encode($res);
                		}else{
                			$res['err']=4;
                			$res['result']="infra was not updated";
                			echo json_encode($res);
                		}
                	}
                }else{
                	$res['err']=3;
                	$res['result']='infra already exists';
                	json_encode($res);
                }
            }elseif ($op=="deleteInfra"){
            	$id=mysqli_real_escape_string($db,$_POST['id']);
            	$image=mysqli_fetch_array(mysqli_query($db,"SELECT `infra_image` FROM `infra` WHERE infra_id='$id'  "))['infra_image'];
            	mysqli_query($db,"SET AUTOCOMMIT=0");
            	mysqli_query($db,"COMMIT");
            	$delete=mysqli_query($db,"DELETE FROM `infra` WHERE infra_id='$id'");
            	if ($delete==1) {
            		if (unlink('../uploads/infraimg/' .$image)) {
            			mysqli_query($db,"COMMIT");
            			mysqli_query($db,"SET AUTOCOMMIT=1");
            			$res['err']=0;
            			$res['result']="infra was deleted";
            			echo json_encode($res);

            		}else{
            			mysqli_query($db,"ROLLBACK");
            			mysqli_query($db,"COMMIT");
            			mysqli_query($db,"SET AUTOCOMMIT = 1");
            			$res['err']=2;
            			$res['result']="infra was  unable to delete";
            			echo json_encode($res);
            		}
            	}else{
            		$res['err']=4;
            		$res['result']="some data is used";
            		echo json_encode($res);
            	}
  
            }elseif ($op=="updateInfraStatus") {
            	$id=mysqli_real_escape_string($db,$_POST['id']);

            	$status=mysqli_real_escape_string($db,$_POST['status']);

            	$update=mysqli_query($db,"UPDATE `infra` SET `status`= b'$status'  WHERE `infra_id`= '$id' ");
            	if ($update == 1) {
            		$res['err']=0;
            		if ($status==1) {
            			$res['result']='Activated';
            		}else{
            			$res['result']='Deactivated';

            		}
            		echo json_encode($res);
            		}else{
            			$res['err']=1;
            			$res['result']="try again";
            			echo json_encode($res);
            		}
            	}
            	

       	else{
 		$res['err']=404;
  			$res['result']="invalid operation";
  			json_encode($res);
  		}
  	}else{
  		$res['err']=500;
  		$res['result']="invalid request";
  		echo json_encode($res);
  	}


 ?>