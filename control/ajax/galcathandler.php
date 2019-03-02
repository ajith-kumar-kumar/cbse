<?php 

$res= array('tag' =>'nill' , 'err'=>0 ,'result'=>'ajith', 'query'=>'nill');


if (isset($_POST['op']) && $_POST['op']!='' ) {
	
	require '../db_config.php';
	$op=$_POST['op'];
	$res['tag']=$op;
	if ($op=='galcat') {
		
     $gname=mysqli_real_escape_string($db,$_POST['gname']);
     $gdesc=mysqli_real_escape_string($db,$_POST['gdesc']);

     if (mysqli_num_rows(mysqli_query($db, "SELECT `gid` FROM `galcat` WHERE galname = '$gname' ")) == 0) {
     	 mysqli_query($db,"SET AUTOCOMMIT= 0");	

     	  mysqli_query($db,"COMMIT");
    $insert = mysqli_query($db, "INSERT INTO `galcat` (`galname`, `galdesc`) VALUES ('$gname','$gdesc');");
				if ($insert == 1) {
					$id = mysqli_insert_id($db);
					if ($_FILES['image']['name'] != '' && 
							(substr($_FILES['image']['type'], 6) == 'jpg' || substr($_FILES['image']['type'], 6)=='jpeg' || substr($_FILES['image']['type'], 6)=='png') ) {
						$path = '../uploads/galcatimage/';
						if(!is_dir($path)) {
						    mkdir($path);
						}
						$path = $path.$id.'.'.substr($_FILES['image']['type'], 6);
						$res['query']=$path;
						$filename = $id.'.'.substr($_FILES['image']['type'], 6);
						if (move_uploaded_file($_FILES['image']['tmp_name'], $path)) {
								mysqli_query($db,"COMMIT");
								mysqli_query($db,"SET AUTOCOMMIT = 1");
								$update = mysqli_query($db, "UPDATE `galcat` SET `image`= '$filename' WHERE gid = '$id'");
								if ($update == 1) {
									$res['err'] = 0;
									$res['result'] = 'category was added';
									echo json_encode($res);																				
								}else{
									$res['err'] = 5;
									$res['result'] = 'Try once again...';
									echo json_encode($res);												
								}
						}else{
							mysqli_query($db,"ROLLBACK");
							mysqli_query($db,"COMMIT");
							mysqli_query($db,"SET AUTOCOMMIT = 1");
							$res['err'] = 2;
							$res['result'] = 'Logo upload was failed';
							echo json_encode($res);														
						}
					}else{
						mysqli_query($db,"ROLLBACK");
						mysqli_query($db,"COMMIT");
						mysqli_query($db,"SET AUTOCOMMIT = 1");
						$res['err'] = 1;
						$res['result'] = 'A logo must be a Image File';
						echo json_encode($res);									
					}
				}else{
					mysqli_query($db,"COMMIT");
					mysqli_query($db,"SET AUTOCOMMIT = 1");
					$res['err'] = 3;
					$res['result'] = 'category was not added';
					echo json_encode($res);																				
				}
			}else{
				$res['err'] = 4;
				$res['result'] = 'category Already Exist';
				echo json_encode($res);													
			}
		}elseif ($op =='fetchcat') {
			$fetch = mysqli_query($db, "SELECT * FROM galcat");
			if (mysqli_num_rows($fetch) > 0) {
				$data = array();
				$res['data'] = array();
				while ($ele = mysqli_fetch_array($fetch)) {
					$data['id'] = $ele['gid'];
					$data['gname'] = $ele['galname'];
					$data['gdesc'] = $ele['galdesc'];

					$data['image'] = $ele['image'];
					$data['status'] = $ele['status'];
					
					array_push($res['data'], $data); 
				}
				$res['err'] = 0;
				$res['result'] = 'gallery was loaded';
				echo json_encode($res);
			}else{
				$res['err'] = 1;
				$res['result'] = 'gallery was not found';
				echo json_encode($res);				
			}
		}elseif ($op == 'updateStatus') {
			$id = mysqli_real_escape_string($db, $_POST['id']);
			$status = mysqli_real_escape_string($db, $_POST['status']);
			$update = mysqli_query($db , "UPDATE `galcat` SET `status`= b'$status' WHERE gid = '$id'");
			if ($update == 1) {
				$res['err'] = 0;
				if ($status == 1) {
					$res['result'] = 'Activated';
				}else{
					$res['result'] = 'Deactivated';
				}
				echo json_encode($res);
			}else{
				$res['err'] = 1;
				$res['result'] = 'Try once again';
				echo json_encode($res);				
			}
		}elseif ($op =='deletecat') {
			$id = mysqli_real_escape_string($db, $_POST['id']);
						// $image = mysqli_fetch_array(mysqli_query($db, "SELECT `image` FROM `user` WHERE uid = '$id'"))['image'];

			$image = mysqli_fetch_array(mysqli_query($db, "SELECT `image` FROM `galcat` WHERE gid = '$id'"))['image'];
			 // print_r($image);
			mysqli_query($db,"SET AUTOCOMMIT = 0");
			mysqli_query($db,"COMMIT");
			$delete = mysqli_query($db , "DELETE FROM `galcat` WHERE gid = '$id' ");
			if ($delete == 1) {
				if (unlink('../uploads/galcatimage/'.$image)) {
					mysqli_query($db,"COMMIT");
					mysqli_query($db,"SET AUTOCOMMIT = 1");
					$res['err'] = 0;
					$res['result'] = 'User was Deleted';
					echo json_encode($res);
				}else{
					mysqli_query($db,"ROLLBACK");
					mysqli_query($db,"COMMIT");
					mysqli_query($db,"SET AUTOCOMMIT = 1");
					$res['err'] = 2;
					$res['result'] = 'Oops!!! Something went wrong...';
					echo json_encode($res);				
				}
			}else{
				$res['err'] = 1;
				$res['result'] = 'Some other data use this User...';
				echo json_encode($res);				
			}
		}elseif ($op =='editcat') {
			$id = mysqli_real_escape_string($db , $_POST['id']);
			$ele = mysqli_fetch_array(mysqli_query($db, "SELECT `gid`, `galname`, `galdesc`,`image` FROM `galcat` WHERE gid ='$id';"));
			$res['gname'] = $ele['galname'];
			$res['gdesc'] = $ele['galdesc'];

			$res['image'] = $ele['image'];
			
			$res['id'] = $ele['gid'];
			$res['err'] = 0;
			$res['result'] = 'Loaded';
			echo json_encode($res);
		}elseif ($op =='updatecat') {
			$gname = mysqli_real_escape_string($db, $_POST['gname']);
			$gdesc = mysqli_real_escape_string($db, $_POST['gdesc']);
			$id = mysqli_real_escape_string($db, $_POST['id']);
			if (mysqli_num_rows(mysqli_query($db, "SELECT `gid` FROM `galcat` WHERE (galname = '$gname' ) AND  gid <> '$id'")) == 0) {
			
				if (isset($_FILES['image'])) {
					if ($_FILES['image']['name'] != '' && 
							(substr($_FILES['image']['type'], 6) == 'jpg' || 
								substr($_FILES['image']['type'], 6)=='jpeg' || 
									substr($_FILES['image']['type'], 6)=='png') ) {
						$path = '../uploads/galcatimage/';
						if(!is_dir($path)) {
						    mkdir($path);
						}
						$path = $path.$id.'.'.substr($_FILES['image']['type'], 6);
						$filename = $id.'.'.substr($_FILES['image']['type'], 6);
						$res['extension'] = substr($_FILES['image']['type'], 6);
						$res['filepath'] = $path;
						$imgpath = mysqli_fetch_array(mysqli_query($db, "SELECT `image` FROM `galcat` WHERE gid = '$id'"))['image'];
						if (explode('.', $imgpath)[1] != substr($_FILES['image']['type'], 6)) {
							mysqli_query($db,"SET AUTOCOMMIT = 0");
							mysqli_query($db,"COMMIT");
							if (unlink('../uploads/galcatimage/'.$imgpath)){
								mysqli_query($db,"COMMIT");
								mysqli_query($db,"SET AUTOCOMMIT = 1");
								if (move_uploaded_file($_FILES['image']['tmp_name'], $path)) {
									$update = mysqli_query($db, "UPDATE `galcat` SET `galname`='$gname', `galdesc`='$gdesc',`image`='$filename' WHERE gid = '$id'");
									if ($update == 1) {
										$res['err'] = 0;
										$res['result'] = 'category was updated';
										echo json_encode($res);																				
									}else{
										$res['err'] = 3;
										$res['result'] = 'category was not updated';
										echo json_encode($res);																				
									}
								}else{
									$res['err'] = 2;
									$res['result'] = 'Logo upload was failed';
									echo json_encode($res);														
								}
							}else{
								mysqli_query($db,"ROLLBACK");
								mysqli_query($db,"COMMIT");
								mysqli_query($db,"SET AUTOCOMMIT = 1");
								$res['err'] = 5;
								$res['result'] = 'Oops!!! Something went wrong...';
								echo json_encode($res);				
							}
						}else{
							if (move_uploaded_file($_FILES['image']['tmp_name'], $path)) {
								$update = mysqli_query($db, "UPDATE `galcat` SET `galname`='$gname', `galdesc`='$gdesc',`image`='$filename' WHERE gid = '$id'");
								if ($update == 1) {
									$res['err'] = 0;
									$res['result'] = 'category was updated';
									echo json_encode($res);																				
								}else{
									$res['err'] = 3;
									$res['result'] = 'category was not updated';
									echo json_encode($res);																				
								}
							}else{
								$res['err'] = 2;
								$res['result'] = 'Photo upload was failed';
								echo json_encode($res);														
							}							
						}
					}else{
						$res['err'] = 1;
						$res['result'] = 'A Photo must be a Image File';
						echo json_encode($res);									
					}				
				}else{
					$update = mysqli_query($db, "UPDATE `galcat` SET `galname`='$gname', `galdesc`='$gdesc' WHERE gid = '$id'");
					if ($update == 1) {
						$res['err'] = 0;
						$res['result'] = 'category was updated';
						echo json_encode($res);																				
					}else{
						$res['err'] = 3;
						$res['result'] = 'category was not updated';
						echo json_encode($res);																				
					}
				}
			}else{
				$res['err'] = 4;
				$res['result'] = 'category Already Exist';
				echo json_encode($res);													
			}			
		}


		else{
			$res['err'] = 404;
			$res['result'] = 'Invalid operation';
			echo json_encode($res);
		}
	}else{
			$res['err'] = 500;
			$res['result'] = 'Invalid Request';
			echo json_encode($res);		
	}



?>
