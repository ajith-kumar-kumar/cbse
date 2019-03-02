<?php
//	error_reporting(0);
	$res = array('tag' => 'null', 'err'=> 500, 'result'=>'Contact Technical Team',"query"=>"nill");
if (isset($_POST['op']) && $_POST['op'] != '') {
		require '../db_config.php';
		$op = $_POST['op'];
		$res['tag'] = $op;
		if ($op == 'addabout') {
			$aname = mysqli_real_escape_string($db, $_POST['aname']);
			$adesc = mysqli_real_escape_string($db, $_POST['adesc']);
			if (mysqli_num_rows(mysqli_query($db, "SELECT `a_id` FROM `about` WHERE a_name = '$aname' AND a_desc='$adesc' ")) == 0) {
				mysqli_query($db,"SET AUTOCOMMIT = 0");
				mysqli_query($db,"COMMIT");
				$insert = mysqli_query($db, "INSERT INTO `about` (`a_name`, `a_desc`) VALUES ('$aname','$adesc');");
				if ($insert == 1) {
					$id = mysqli_insert_id($db);
					if ($_FILES['image']['name'] != '' && 
							(substr($_FILES['image']['type'], 6) == 'jpg' || substr($_FILES['image']['type'], 6)=='jpeg' || substr($_FILES['image']['type'], 6)=='png') ) {
						$path = '../uploads/aboutimage/';
						if(!is_dir($path)) {
						    mkdir($path);
						}
						$path = $path.$id.'.'.substr($_FILES['image']['type'], 6);
						$res['query']=$path;
						$filename = $id.'.'.substr($_FILES['image']['type'], 6);
						if (move_uploaded_file($_FILES['image']['tmp_name'], $path)) {
								mysqli_query($db,"COMMIT");
								mysqli_query($db,"SET AUTOCOMMIT = 1");
								$update = mysqli_query($db, "UPDATE `about` SET `a_image`= '$filename' WHERE a_id = '$id'");
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
		}elseif ($op =='fetchabout') {
			$fetch = mysqli_query($db, "SELECT * FROM about");
			if (mysqli_num_rows($fetch) > 0) {
				$data = array();
				$res['data'] = array();
				while ($ele = mysqli_fetch_array($fetch)) {
					$data['id'] = $ele['a_id'];
					$data['aname'] = $ele['a_name'];
					$data['adesc'] = $ele['a_desc'];

					$data['image'] = $ele['a_image'];
					$data['status'] = $ele['status'];
					
					array_push($res['data'], $data); 
				}
				$res['err'] = 0;
				$res['result'] = 'faculty was loaded';
				echo json_encode($res);
			}else{
				$res['err'] = 1;
				$res['result'] = 'faculty was not found';
				echo json_encode($res);				
			}
		}elseif ($op == 'updateStatus') {
			$id = mysqli_real_escape_string($db, $_POST['id']);
			$status = mysqli_real_escape_string($db, $_POST['status']);
			$update = mysqli_query($db , "UPDATE `about` SET `status`= b'$status' WHERE a_id = '$id'");
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
		}elseif ($op =='deleteabout') {
			$id = mysqli_real_escape_string($db, $_POST['id']);
						// $image = mysqli_fetch_array(mysqli_query($db, "SELECT `image` FROM `user` WHERE uid = '$id'"))['image'];

			$image = mysqli_fetch_array(mysqli_query($db, "SELECT `a_image` FROM `about` WHERE a_id = '$id'"))['a_image'];
			 // print_r($image);
			mysqli_query($db,"SET AUTOCOMMIT = 0");
			mysqli_query($db,"COMMIT");
			$delete = mysqli_query($db , "DELETE FROM `about` WHERE a_id = '$id' ");
			if ($delete == 1) {
				if (unlink('../uploads/aboutimage/'.$image)) {
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
		}elseif ($op =='editabout') {
			$id = mysqli_real_escape_string($db , $_POST['id']);
			$ele = mysqli_fetch_array(mysqli_query($db, "SELECT `a_id`, `a_name`, `a_desc`, `a_image` FROM `about` WHERE a_id ='$id';"));
			$res['aname'] = $ele['a_name'];
			$res['adesc'] = $ele['a_desc'];

			$res['image'] = $ele['a_image'];
			
			$res['id'] = $ele['a_id'];
			$res['err'] = 0;
			$res['result'] = 'Loaded';
			echo json_encode($res);
		}elseif ($op =='updateabout') {
			$aname = mysqli_real_escape_string($db, $_POST['aname']);
			$adesc = mysqli_real_escape_string($db, $_POST['adesc']);
			$id = mysqli_real_escape_string($db, $_POST['id']);
			if (mysqli_num_rows(mysqli_query($db, "SELECT `a_id` FROM `about` WHERE (a_name = '$aname' ) AND  a_id <> '$id'")) == 0) {
			
				if (isset($_FILES['image'])) {
					if ($_FILES['image']['name'] != '' && 
							(substr($_FILES['image']['type'], 6) == 'jpg' || 
								substr($_FILES['image']['type'], 6)=='jpeg' || 
									substr($_FILES['image']['type'], 6)=='png') ) {
						$path = '../uploads/aboutimage/';
						if(!is_dir($path)) {
						    mkdir($path);
						}
						$path = $path.$id.'.'.substr($_FILES['image']['type'], 6);
						$filename = $id.'.'.substr($_FILES['image']['type'], 6);
						$res['extension'] = substr($_FILES['image']['type'], 6);
						$res['filepath'] = $path;
						$imgpath = mysqli_fetch_array(mysqli_query($db, "SELECT `a_image` FROM `about` WHERE a_id = '$id'"))['a_image'];
						if (explode('.', $imgpath)[1] != substr($_FILES['image']['type'], 6)) {
							mysqli_query($db,"SET AUTOCOMMIT = 0");
							mysqli_query($db,"COMMIT");
							if (unlink('../uploads/aboutimage/'.$imgpath)){
								mysqli_query($db,"COMMIT");
								mysqli_query($db,"SET AUTOCOMMIT = 1");
								if (move_uploaded_file($_FILES['image']['tmp_name'], $path)) {
									$update = mysqli_query($db, "UPDATE `about` SET `a_name`='$aname', `a_desc`='$adesc',`a_image`='$filename' WHERE a_id = '$id'");
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
								$update = mysqli_query($db, "UPDATE `about` SET `a_name`='$aname', `a_desc`='$adesc',`a_image`='$filename' WHERE a_id = '$id'");
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
					$update = mysqli_query($db, "UPDATE `about` SET `a_name`='$aname', `a_desc`='$adesc' WHERE a_id = '$id'");
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
