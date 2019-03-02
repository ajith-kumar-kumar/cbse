<?php
//	error_reporting(0);
	$res = array('tag' => 'null', 'err'=> 500, 'result'=>'Contact Technical Team',"query"=>"nill");
if (isset($_POST['op']) && $_POST['op'] != '') {
		require '../db_config.php';
		$op = $_POST['op'];
		$res['tag'] = $op;
		if ($op == 'addactive') {
			$aname = mysqli_real_escape_string($db, $_POST['aname']);
			$adesc = mysqli_real_escape_string($db, $_POST['adesc']);
			if (mysqli_num_rows(mysqli_query($db, "SELECT `active_id` FROM `activity` WHERE active_name = '$aname' ")) == 0) {
				mysqli_query($db,"SET AUTOCOMMIT = 0");
				mysqli_query($db,"COMMIT");
				$insert = mysqli_query($db, "INSERT INTO `activity` (`active_name`, `active_desc`) VALUES ('$aname','$adesc');");
				if ($insert == 1) {
					$id = mysqli_insert_id($db);
					if ($_FILES['image']['name'] != '' && 
							(substr($_FILES['image']['type'], 6) == 'jpg' || substr($_FILES['image']['type'], 6)=='jpeg' || substr($_FILES['image']['type'], 6)=='png') ) {
						$path = '../uploads/activityimage/';
						if(!is_dir($path)) {
						    mkdir($path);
						}
						$path = $path.$id.'.'.substr($_FILES['image']['type'], 6);
						$res['query']=$path;
						$filename = $id.'.'.substr($_FILES['image']['type'], 6);
						if (move_uploaded_file($_FILES['image']['tmp_name'], $path)) {
								mysqli_query($db,"COMMIT");
								mysqli_query($db,"SET AUTOCOMMIT = 1");
								$update = mysqli_query($db, "UPDATE `activity` SET `active_image`= '$filename' WHERE active_id = '$id'");
								if ($update == 1) {
									$res['err'] = 0;
									$res['result'] = 'activity was added';
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
					$res['result'] = 'activity was not added';
					echo json_encode($res);																				
				}
			}else{
				$res['err'] = 4;
				$res['result'] = 'activity Already Exist';
				echo json_encode($res);													
			}
		}elseif ($op =='fetchactive') {
			$fetch = mysqli_query($db, "SELECT * FROM activity");
			if (mysqli_num_rows($fetch) > 0) {
				$data = array();
				$res['data'] = array();
				while ($ele = mysqli_fetch_array($fetch)) {
					$data['id'] = $ele['active_id'];
					$data['aname'] = $ele['active_name'];
					$data['adesc'] = $ele['active_desc'];

					$data['image'] = $ele['active_image'];
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
			$update = mysqli_query($db , "UPDATE `activity` SET `status`= b'$status' WHERE active_id = '$id'");
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
		}elseif ($op =='deleteactive') {
			$id = mysqli_real_escape_string($db, $_POST['id']);
						// $image = mysqli_fetch_array(mysqli_query($db, "SELECT `image` FROM `user` WHERE uid = '$id'"))['image'];

			$image = mysqli_fetch_array(mysqli_query($db, "SELECT `active_image` FROM `activity` WHERE active_id = '$id'"))['active_image'];
			 // print_r($image);
			mysqli_query($db,"SET AUTOCOMMIT = 0");
			mysqli_query($db,"COMMIT");
			$delete = mysqli_query($db , "DELETE FROM `activity` WHERE active_id = '$id' ");
			if ($delete == 1) {
				if (unlink('../uploads/activityimage/'.$image)) {
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
		}elseif ($op =='editactive') {
			$id = mysqli_real_escape_string($db , $_POST['id']);
			$ele = mysqli_fetch_array(mysqli_query($db, "SELECT `active_id`, `active_name`, `active_desc`, `active_image` FROM `activity` WHERE active_id ='$id';"));
			$res['aname'] = $ele['active_name'];
			$res['adesc'] = $ele['active_desc'];

			$res['image'] = $ele['active_image'];
			
			$res['id'] = $ele['active_id'];
			$res['err'] = 0;
			$res['result'] = 'Loaded';
			echo json_encode($res);
		}elseif ($op =='updateactive') {
			$aname = mysqli_real_escape_string($db, $_POST['aname']);
			$adesc = mysqli_real_escape_string($db, $_POST['adesc']);
			$id = mysqli_real_escape_string($db, $_POST['id']);
			if (mysqli_num_rows(mysqli_query($db, "SELECT `active_id` FROM `activity` WHERE (active_name = '$aname' ) AND  active_id <> '$id'")) == 0) {
			
				if (isset($_FILES['image'])) {
					if ($_FILES['image']['name'] != '' && 
							(substr($_FILES['image']['type'], 6) == 'jpg' || 
								substr($_FILES['image']['type'], 6)=='jpeg' || 
									substr($_FILES['image']['type'], 6)=='png') ) {
						$path = '../uploads/activityimage/';
						if(!is_dir($path)) {
						    mkdir($path);
						}
						$path = $path.$id.'.'.substr($_FILES['image']['type'], 6);
						$filename = $id.'.'.substr($_FILES['image']['type'], 6);
						$res['extension'] = substr($_FILES['image']['type'], 6);
						$res['filepath'] = $path;
						$imgpath = mysqli_fetch_array(mysqli_query($db, "SELECT `active_image` FROM `activity` WHERE active_id = '$id'"))['active_image'];
						if (explode('.', $imgpath)[1] != substr($_FILES['image']['type'], 6)) {
							mysqli_query($db,"SET AUTOCOMMIT = 0");
							mysqli_query($db,"COMMIT");
							if (unlink('../uploads/activityimage/'.$imgpath)){
								mysqli_query($db,"COMMIT");
								mysqli_query($db,"SET AUTOCOMMIT = 1");
								if (move_uploaded_file($_FILES['image']['tmp_name'], $path)) {
									$update = mysqli_query($db, "UPDATE `activity` SET `active_name`='$aname', `active_desc`='$adesc',`active_image`='$filename' WHERE active_id = '$id'");
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
								$update = mysqli_query($db, "UPDATE `activity` SET `active_name`='$aname', `active_desc`='$adesc',`active_image`='$filename' WHERE active_id = '$id'");
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
					$update = mysqli_query($db, "UPDATE `activity` SET `active_name`='$aname', `active_desc`='$adesc' WHERE active_id = '$id'");
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
