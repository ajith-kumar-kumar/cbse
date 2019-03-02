<?php
//	error_reporting(0);
	$res = array('tag' => 'null', 'err'=> 500, 'result'=>'Contact Technical Team',"query"=>"nill");
if (isset($_POST['op']) && $_POST['op'] != '') {
		require '../db_config.php';
		$op = $_POST['op'];
		$res['tag'] = $op;
		if ($op == 'addslider') {
			$scap = mysqli_real_escape_string($db, $_POST['scap']);
			$sscap = mysqli_real_escape_string($db, $_POST['sscap']);
			if (mysqli_num_rows(mysqli_query($db, "SELECT `s_id` FROM `slider` WHERE s_cap = '$scap' ")) == 0) {
				mysqli_query($db,"SET AUTOCOMMIT = 0");
				mysqli_query($db,"COMMIT");
				$insert = mysqli_query($db, "INSERT INTO `slider` (`s_cap`, `s_sub`) VALUES ('$scap','$sscap');");
				if ($insert == 1) {
					$id = mysqli_insert_id($db);
					if ($_FILES['image']['name'] != '' && 
							(substr($_FILES['image']['type'], 6) == 'jpg' || substr($_FILES['image']['type'], 6)=='jpeg' || substr($_FILES['image']['type'], 6)=='png') ) {
						$path = '../uploads/sliderimage/';
						if(!is_dir($path)) {
						    mkdir($path);
						}
						$path = $path.$id.'.'.substr($_FILES['image']['type'], 6);
						$res['query']=$path;
						$filename = $id.'.'.substr($_FILES['image']['type'], 6);
						if (move_uploaded_file($_FILES['image']['tmp_name'], $path)) {
								mysqli_query($db,"COMMIT");
								mysqli_query($db,"SET AUTOCOMMIT = 1");
								$update = mysqli_query($db, "UPDATE `slider` SET `s_image`= '$filename' WHERE s_id = '$id'");
								if ($update == 1) {
									$res['err'] = 0;
									$res['result'] = 'User was added';
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
					$res['result'] = 'User was not added';
					echo json_encode($res);																				
				}
			}else{
				$res['err'] = 4;
				$res['result'] = 'User Already Exist';
				echo json_encode($res);													
			}
		}elseif ($op =='fetchslider') {
			$fetch = mysqli_query($db, "SELECT * FROM slider");
			if (mysqli_num_rows($fetch) > 0) {
				$data = array();
				$res['data'] = array();
				while ($ele = mysqli_fetch_array($fetch)) {
					$data['id'] = $ele['s_id'];
					$data['scap'] = $ele['s_cap'];
					$data['sscap'] = $ele['s_sub'];

					$data['image'] = $ele['s_image'];
					$data['status'] = $ele['status'];
					
					array_push($res['data'], $data); 
				}
				$res['err'] = 0;
				$res['result'] = 'User was loaded';
				echo json_encode($res);
			}else{
				$res['err'] = 1;
				$res['result'] = 'User was not found';
				echo json_encode($res);				
			}
		}elseif ($op == 'updateStatus') {
			$id = mysqli_real_escape_string($db, $_POST['id']);
			$status = mysqli_real_escape_string($db, $_POST['status']);
			$update = mysqli_query($db , "UPDATE `slider` SET `status`= b'$status' WHERE s_id = '$id'");
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
		}elseif ($op =='deleteslider') {
			$id = mysqli_real_escape_string($db, $_POST['id']);
						// $image = mysqli_fetch_array(mysqli_query($db, "SELECT `image` FROM `user` WHERE uid = '$id'"))['image'];

			$image = mysqli_fetch_array(mysqli_query($db, "SELECT `s_image` FROM `slider` WHERE s_id = '$id'"))['s_image'];
			 // print_r($image);
			mysqli_query($db,"SET AUTOCOMMIT = 0");
			mysqli_query($db,"COMMIT");
			$delete = mysqli_query($db , "DELETE FROM `slider` WHERE s_id = '$id' ");
			if ($delete == 1) {
				if (unlink('../uploads/sliderimage/'.$image)) {
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
		}elseif ($op =='editslider') {
			$id = mysqli_real_escape_string($db , $_POST['id']);
			$ele = mysqli_fetch_array(mysqli_query($db, "SELECT `s_id`, `s_cap`, `s_sub`, `s_image` FROM  `slider` WHERE s_id ='$id';"));
			$res['scap'] = $ele['s_cap'];
			$res['sscap'] = $ele['s_sub'];

			$res['image'] = $ele['s_image'];
			
			$res['id'] = $ele['s_id'];
			$res['err'] = 0;
			$res['result'] = 'Loaded';
			echo json_encode($res);
		}elseif ($op =='updateslider') {
			$scap = mysqli_real_escape_string($db, $_POST['scap']);
			$sscap = mysqli_real_escape_string($db, $_POST['sscap']);
			$id = mysqli_real_escape_string($db, $_POST['id']);
			if (mysqli_num_rows(mysqli_query($db, "SELECT `s_id` FROM `slider` WHERE (s_cap = '$scap' ) AND  s_id <> '$id'")) == 0) {
			
				if (isset($_FILES['image'])) {
					if ($_FILES['image']['name'] != '' && 
							(substr($_FILES['image']['type'], 6) == 'jpg' || 
								substr($_FILES['image']['type'], 6)=='jpeg' || 
									substr($_FILES['image']['type'], 6)=='png') ) {
						$path = '../uploads/sliderimage/';
						if(!is_dir($path)) {
						    mkdir($path);
						}
						$path = $path.$id.'.'.substr($_FILES['image']['type'], 6);
						$filename = $id.'.'.substr($_FILES['image']['type'], 6);
						$res['extension'] = substr($_FILES['image']['type'], 6);
						$res['filepath'] = $path;
						$imgpath = mysqli_fetch_array(mysqli_query($db, "SELECT `s_image` FROM `slider` WHERE s_id = '$id'"))['s_image'];
						if (explode('.', $imgpath)[1] != substr($_FILES['image']['type'], 6)) {
							mysqli_query($db,"SET AUTOCOMMIT = 0");
							mysqli_query($db,"COMMIT");
							if (unlink('../uploads/sliderimage/'.$imgpath)){
								mysqli_query($db,"COMMIT");
								mysqli_query($db,"SET AUTOCOMMIT = 1");
								if (move_uploaded_file($_FILES['image']['tmp_name'], $path)) {
									$update = mysqli_query($db, "UPDATE `slider` SET `s_cap`='$scap', `s_sub`='$sscap',`s_image`='$filename' WHERE s_id = '$id'");
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
								$update = mysqli_query($db, "UPDATE `slider` SET `s_cap`='$scap', `s_sub`='$sscap',`s_image`='$filename' WHERE s_id = '$id'");
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
					$update = mysqli_query($db, "UPDATE `slider` SET `$s_cap`='$scap', `s_sub`='$sscap' WHERE s_id = '$id'");
					if ($update == 1) {
						$res['err'] = 0;
						$res['result'] = 'User was updated';
						echo json_encode($res);																				
					}else{
						$res['err'] = 3;
						$res['result'] = 'User was not updated';
						echo json_encode($res);																				
					}
				}
			}else{
				$res['err'] = 4;
				$res['result'] = 'User Already Exist';
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
