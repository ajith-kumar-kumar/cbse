<?php 

$res= array('tag' =>'nill' , 'err'=>0 ,'result'=>'ajith', 'query'=>'nill');


if (isset($_POST['op']) && $_POST['op']!='' ) {
	
	require '../db_config.php';
	$op=$_POST['op'];
	$res['tag']=$op;
	if ($op=='gal') {	
		
     $cat=mysqli_real_escape_string($db,$_POST['cat']);

     // if (mysqli_num_rows(mysqli_query($db, "SELECT `galid` FROM `gallery` WHERE galname = '$gname' ")) == 0) {
     	 // mysqli_query($db,"SET AUTOCOMMIT= 0");	

     	 //  mysqli_query($db,"COMMIT");
    $insert = mysqli_query($db, "INSERT INTO `gallery` (`gcat`) VALUES ('$cat');");
				if ($insert == 1) {
					$id = mysqli_insert_id($db);

					
					if ($_FILES['image']['name'] != '' && 
							(substr($_FILES['image']['type'], 6) == 'jpg' || substr($_FILES['image']['type'], 6)=='jpeg' || substr($_FILES['image']['type'], 6)=='png') ) {
						$path = '../uploads/galimage/';
						if(!is_dir($path)) {
						    mkdir($path);
						}
						$path = $path.$id.'.'.substr($_FILES['image']['type'], 6);
						$res['query']=$path;

						$filename = $id.'.'.substr($_FILES['image']['type'], 6);

						
						if (move_uploaded_file($_FILES['image']['tmp_name'], $path)) {
								 mysqli_query($db,"COMMIT");
								mysqli_query($db,"SET AUTOCOMMIT = 1");
								for ($count =0; count($_FILES['image']['type']); $count++)
						          {
								$update = mysqli_query($db, "UPDATE `gallery` SET `image`= '$filename' WHERE galid = '$id'");
										}
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
			// }else{
			// 	$res['err'] = 4;
			// 	$res['result'] = 'category Already Exist';
			// 	echo json_encode($res);													
		
		}elseif ($op =='fetchgal') {
			$fetch = mysqli_query($db, "SELECT * FROM gallery");
			if (mysqli_num_rows($fetch) > 0) {
				$data = array();
				$res['data'] = array();
				while ($ele = mysqli_fetch_array($fetch)) {
					$data['id'] = $ele['galid'];
					$data['gcat'] = $ele['gcat'];

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
			$update = mysqli_query($db , "UPDATE `gallery` SET `status`= b'$status' WHERE galid = '$id'");
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
		}elseif ($op =='deletegal') {
			$id = mysqli_real_escape_string($db, $_POST['id']);
						// $image = mysqli_fetch_array(mysqli_query($db, "SELECT `image` FROM `user` WHERE uid = '$id'"))['image'];

			$image = mysqli_fetch_array(mysqli_query($db, "SELECT `image` FROM `gallery` WHERE galid = '$id'"))['image'];
			 // print_r($image);
			mysqli_query($db,"SET AUTOCOMMIT = 0");
			mysqli_query($db,"COMMIT");
			$delete = mysqli_query($db , "DELETE FROM `gallery` WHERE galid = '$id' ");
			if ($delete == 1) {
				if (unlink('../uploads/galimage/'.$image)) {
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
		}elseif ($op =='editgal') {
			$id = mysqli_real_escape_string($db , $_POST['id']);
			$ele = mysqli_fetch_array(mysqli_query($db, "SELECT `galid`, `gcat`,`image` FROM `gallery` WHERE galid ='$id';"));
			$res['gcat'] = $ele['gcat'];

			$res['image'] = $ele['image'];
			
			$res['id'] = $ele['galid'];

			$res['err'] = 0;
			$res['result'] = 'Loaded';
			echo json_encode($res);
		// }elseif ($op =='updategal') {
		// 	$cat = mysqli_real_escape_string($db, $_POST['cat']);
		// 	$id = mysqli_real_escape_string($db, $_POST['id']);
			
			
		// 		if (isset($_FILES['image'])) {
		// 			if ($_FILES['image']['name'] != '' && 
		// 					(substr($_FILES['image']['type'], 6) == 'jpg' || 
		// 						substr($_FILES['image']['type'], 6)=='jpeg' || 
		// 							substr($_FILES['image']['type'], 6)=='png') ) {
		// 				$path = '../uploads/galimage/';
		// 				if(!is_dir($path)) {
		// 				    mkdir($path);
		// 				}
		// 				$path = $path.$id.'.'.substr($_FILES['image']['type'], 6);
		// 				$filename = $id.'.'.substr($_FILES['image']['type'], 6);
		// 				$res['extension'] = substr($_FILES['image']['type'], 6);
		// 				$res['filepath'] = $path;
		// 				$imgpath = mysqli_fetch_array(mysqli_query($db, "SELECT `image` FROM `gallery` WHERE galid = '$id'"))['image'];
		// 				if (explode('.', $imgpath)[1] != substr($_FILES['image']['type'], 6)) {
		// 					mysqli_query($db,"SET AUTOCOMMIT = 0");
		// 					mysqli_query($db,"COMMIT");
		// 					if (unlink('../uploads/galimage/'.$imgpath)){
		// 						mysqli_query($db,"COMMIT");
		// 						mysqli_query($db,"SET AUTOCOMMIT = 1");
		// 						if (move_uploaded_file($_FILES['image']['tmp_name'], $path)) {
		// 							$update = mysqli_query($db, "UPDATE `gallery` SET `galcat`='$cat',`image`='$filename' WHERE galid = '$id'");
		// 							if ($update == 1) {
		// 								$res['err'] = 0;
		// 								$res['result'] = 'category was updated';
		// 								echo json_encode($res);																				
		// 							}else{
		// 								$res['err'] = 3;
		// 								$res['result'] = 'category was not updated';
		// 								echo json_encode($res);																				
		// 							}
		// 						}else{
		// 							$res['err'] = 2;
		// 							$res['result'] = 'Logo upload was failed';
		// 							echo json_encode($res);														
		// 						}
		// 					}else{
		// 						mysqli_query($db,"ROLLBACK");
		// 						mysqli_query($db,"COMMIT");
		// 						mysqli_query($db,"SET AUTOCOMMIT = 1");
		// 						$res['err'] = 5;
		// 						$res['result'] = 'Oops!!! Something went wrong...';
		// 						echo json_encode($res);				
		// 					}
		// 				}else{
		// 					if (move_uploaded_file($_FILES['image']['tmp_name'], $path)) {
		// 						$update = mysqli_query($db, "UPDATE `gallery` SET `galcat`='$cat',`image`='$filename' WHERE galid = '$id'");
		// 						if ($update == 1) {
		// 							$res['err'] = 0;
		// 							$res['result'] = 'category was updated';
		// 							echo json_encode($res);																				
		// 						}else{
		// 							$res['err'] = 3;
		// 							$res['result'] = 'category was not updated';
		// 							echo json_encode($res);																				
		// 						}
		// 					}else{
		// 						$res['err'] = 2;
		// 						$res['result'] = 'Photo upload was failed';
		// 						echo json_encode($res);														
		// 					}							
		// 				}
		// 			}else{
		// 				$res['err'] = 1;
		// 				$res['result'] = 'A Photo must be a Image File';
		// 				echo json_encode($res);									
		// 			}				
		// 		}else{
		// 			$update = mysqli_query($db, "UPDATE `gallery` SET `galcat`='$cat' WHERE galid = '$id'");
		// 			if ($update == 1) {
		// 				$res['err'] = 0;
		// 				$res['result'] = 'category was updated';
		// 				echo json_encode($res);																				
		// 			}else{
		// 				$res['err'] = 3;
		// 				$res['result'] = 'category was not updated';
		// 				echo json_encode($res);																				
		// 			}
		// 		}
		// 	}else{
		// 		$res['err'] = 4;
		// 		$res['result'] = 'category Already Exist';
		// 		echo json_encode($res);													
		// 	}			
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
