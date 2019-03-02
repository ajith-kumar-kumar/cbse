<?php
	$res = array('tag' => 'null', 'err'=> 500, 'result'=>'Contact Technical Team',"query"=>"nill");

	if (isset($_POST['op']) && $_POST['op'] != '') {
		require '../db_config.php';
		$op = $_POST['op'];
		$res['tag'] = $op;
		if ($op == 'addFaq') {
					$fques = mysqli_real_escape_string($db, $_POST['fques']);
		$fans = mysqli_real_escape_string($db, $_POST['fans']);

			if (mysqli_num_rows(mysqli_query($db, "SELECT `f_id` FROM `faq` WHERE f_ques = '$fques'")) == 0) {
				$insert = mysqli_query($db, "INSERT INTO `faq` (`f_ques`,`f_ans`) VALUES ('$fques','$fans');");
				if ($insert == 1) {
					$res['err'] = 0;
					$res['result'] = 'faq was added';
					echo json_encode($res);																				
				}else{
					$res['err'] = 3;
					$res['result'] = 'faq was not added';
					echo json_encode($res);																				
				}
			}else{
				$res['err'] = 4;
				$res['result'] = 'faq Already Exist';
				echo json_encode($res);													
			}

		}elseif ($op =='fetchfaq') {
			$fetch = mysqli_query($db, "SELECT * FROM faq  ");
			if (mysqli_num_rows($fetch) > 0) {
				$data = array();
				$res['data'] = array();
				while ($ele = mysqli_fetch_array($fetch)) {
					$data['id'] = $ele['f_id'];
					$data['fques'] = $ele['f_ques'];
					$data['fans'] = $ele['f_ans'];

					$data['status'] = $ele['status'];
					array_push($res['data'], $data); 
				}
				$res['err'] = 0;
				$res['result'] = 'faq was loaded';
				echo json_encode($res);
			}else{
				$res['err'] = 1;
				$res['result'] = 'faq was not found';
				echo json_encode($res);				
			}
		}elseif ($op == 'updateStatus') {
			$id = mysqli_real_escape_string($db, $_POST['id']);
			$status = mysqli_real_escape_string($db, $_POST['status']);
			$update = mysqli_query($db , "UPDATE `faq` SET `status`= b'$status' WHERE f_id = '$id'");
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
		}elseif ($op =='deletefaq') {
			$id = mysqli_real_escape_string($db, $_POST['id']);
			$delete = mysqli_query($db , "DELETE FROM `faq` WHERE f_id = '$id' ");
			if ($delete == 1) {
				$res['err'] = 0;
				$res['result'] = 'Lot was Deleted';
				echo json_encode($res);
			}else{
				$res['err'] = 1;
				$res['result'] = 'Some other data use this Lot...';
				echo json_encode($res);				
			}
		}elseif ($op =='editfaq') {
			$id = mysqli_real_escape_string($db , $_POST['id']);
			$ele = mysqli_fetch_array(mysqli_query($db, "SELECT `f_id`, `f_ques`, `f_ans` ,`status` FROM `faq` WHERE f_id ='$id';"));
			$res['fques'] = $ele['f_ques'];
		   $res['fans'] = $ele['f_ans'];

			$res['id'] = $ele['f_id'];
			$res['err'] = 0;
			$res['result'] = 'Loaded';
			echo json_encode($res);
		}elseif ($op =='updateFaq') {
			$id = mysqli_real_escape_string($db , $_POST['id']);
			$fques=mysqli_real_escape_string($db, $_POST['fques']);
			$fans = mysqli_real_escape_string($db , $_POST['fans']);
			if (mysqli_num_rows(mysqli_query($db, "SELECT * FROM `faq` WHERE f_ques = '$fques'")) == 0) {
				$update = mysqli_query($db , "UPDATE `faq` SET `f_ques`= '$fques',`f_ans`='$fans' WHERE f_id = '$id'");
				if ($update == 1) {
					$res['err'] = 0;
					$res['result'] = 'faq was Updated';
					echo json_encode($res);
				}else{
					$res['err'] = 1;
					$res['result'] = 'Try once again';
					echo json_encode($res);				
				}			
			}else{
				$res['err'] = 4;
				$res['result'] = 'faq Already Exist';
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
