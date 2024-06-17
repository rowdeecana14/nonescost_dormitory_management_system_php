<?php	
	

	if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action'])) {
		require_once "../models/model.php";
		$room = new CRUD;
		$controller = new Database;
		session_start();
		date_default_timezone_set('Asia/Manila');

		//INSERT NEW ROOM 
		if($_POST['action'] == "insert") {
			
			$php_errors = false; 
			
			foreach($_POST as $key => $value) {
			  if($controller->checkData($_POST[$key])) {
			  	$php_errors == false;
			  }
			  if(!$controller->cleanData($_POST[$key])) {
			  	$php_errors == true; 
			  }
			}

			$user_id = $_SESSION['DMMS_userid'];
			$room_no = $_POST['room_no'];
			$room_description = $_POST['room_description'];
			$no_of_bed = $_POST['no_of_bed'];
			$student_rate = $_POST['student_rate'];
			$faculty_rate = $_POST['faculty_rate'];
			$other_rate = $_POST['other_rate'];
			$availability = "available";
			$response = false;

			if($php_errors == false) {
				$sql = "SELECT * FROM room WHERE room_no='$room_no'";
				$total = $room->totalRow($sql);

				if($total == 0) {
					$sql = "INSERT INTO room(room_no, details, total_bed, student_rate, faculty_rate, other_rate) 
						VALUES ('$room_no', '$room_description', '$no_of_bed', '$student_rate', '$faculty_rate', '$other_rate')";
					$room_id = $room->insertLastId($sql);

					for($bed_no = 1; $bed_no <= $no_of_bed; $bed_no++) {
						$sql = "INSERT INTO bed(bed_no, availability, room_id) VALUES ('$bed_no', '$availability', '$room_id')";
						$response = $room->addRecord($sql);
					}
					
					$date =  date("Y-m-d h:i:s");
					$message = "Add room ".$room_no;
					$action = "Add";
					userLogs($message, $action, $date, $user_id);

					echo json_encode(array('php_error' =>false, 'message' =>'Room '.$room_no.' is successfully saved.'));
				}
				else {
					echo json_encode(array('php_error' =>true, 'message' =>'Room '.$room_no.' is already exist.'));
				}
				
			}
			else {
				echo json_encode(array('php_error' =>true, 'message' =>''));
			}
		}


		//SEARCH TOTAL BED
		if($_POST['action'] == "search_total_bed") {
			$php_errors = false;
			$data = array();

			foreach($_POST as $key => $value) {
			  if($controller->checkData($_POST[$key])) {
			  	$php_errors == false;
			  }
			  if(!$controller->cleanData($_POST[$key])) {
			  	$php_errors == true; 
			  }
			}

			if($php_errors == false) {
				$room_id = $_POST['room_id'];
				$sql = "SELECT * FROM bed WHERE room_id='$room_id' and availability='occupied' ORDER BY bed_no DESC";
				$response = $room->searchRecord($sql);
				echo json_encode($response);
			}
			else {
				echo json_encode(true);
			}
		}


		//SEARCH ROOM
		if($_POST['action'] == "search") {
			$php_errors = false;
			$data = array();

			if($controller->checkData($_POST['input'])) {
				$php_errors == false;
			}
			if(!$controller->cleanData($_POST['input'])) {
				$php_errors == true;
			}

			if($php_errors == false) {
				$room_no = $_POST['input'];
				$sql = "SELECT * FROM room WHERE room_no='$room_no'";
				$response = $room->searchRecord($sql);
				echo json_encode($response);
			}
			else {
				echo json_encode(true);
			}
		}

		//EDIT ROOM
		if($_POST['action'] == "edit") {
			$php_errors = false;
			$data = array();

			if($controller->checkData($_POST['input'])) {
				$php_errors == false;
			}
			if(!$controller->cleanData($_POST['input'])) {
				$php_errors == true;
			}

			if($php_errors == false) {
				$room_id = $_POST['input'];
				$sql = "SELECT * FROM room INNER JOIN bed ON room.room_id=bed.room_id WHERE room.room_id='$room_id' GROUP BY room.room_id";
				$response = $room->searchRecord($sql);
				echo json_encode($response);
			}
			else {
				echo json_encode(true);
			}
		}

		//VIEW ROOM
		if($_POST['action'] == "view-room") {
			$php_errors = false;
			
			foreach($_POST as $key => $value) {
			  if($controller->checkData($_POST[$key])) {
			  	$php_errors == false;
			  }
			  if(!$controller->cleanData($_POST[$key])) {
			  	$php_errors == true;
			  }
			}

			if($php_errors == false) {
				$room_id = $_POST['room_id'];
				$sql = "SELECT * FROM room 
						INNER JOIN bed ON room.room_id=bed.room_id 
						INNER JOIN rent_in ON bed.bed_id=rent_in.bed_id 
						INNER JOIN customer ON rent_in.cust_id=customer.cust_id
						WHERE room.room_id='$room_id'
						GROUP BY rent_in.rentin_id ORDER BY bed_no ASC";
				$response = $room->displayRecord($sql);
				echo json_encode($response);
			}
			else {
				echo json_encode(true);
			}
		}

		//UPDATE ROOM DETAILS
		if($_POST['action'] == "update") {
			
			$php_errors = false;
			
			foreach($_POST as $key => $value) {
			  if($controller->checkData($_POST[$key])) {
			  	$php_errors == false;
			  }
			  if(!$controller->cleanData($_POST[$key])) {
			  	$php_errors == true;
			  }
			}

			if($php_errors == false) {

				$data = array(
					'room_id' => $_POST['edit_room_id'],
					'room_no' =>  $_POST['edit_room_no'],
					'orig_room_no' => $_POST['orig_room_no'],
					'room_details' => $_POST['edit_room_description'],
					'no_of_bed' => $_POST['edit_no_of_bed'],
					'student_rate' => $_POST['edit_student_rate'],
					'faculty_rate' => $_POST['edit_faculty_rate'],
					'other_rate' => $_POST['edit_other_rate']
				);

				$user_id = $_SESSION['DMMS_userid'];
				$date =  date("Y-m-d h:i:s");
				updateResponse($room, $data, $user_id, $date);
				
			}
			else {
				echo json_encode(true);
			}
		}
	}

	//UPDATE FUNCTION RESPONSE
	function updateResponse($room, $data, $user_id, $date) {
		
		$room_id = $data['room_id'];
		$room_no = $data['room_no'];
		$orig_room_no = $data['orig_room_no'];
		$room_details = $data['room_details'];
		$no_of_bed = $data['no_of_bed'];
		$student_rate = $data['student_rate'];
		$faculty_rate = $data['faculty_rate'];
		$other_rate = $data['other_rate'];

		$message = "Update room ".$room_no;
		$action = "Update";

		$sql = "SELECT * FROM room WHERE room_no='$room_no'";
		$data = $room->searchRecord($sql);
	
		$sql = "SELECT * FROM bed WHERE room_id='$room_id' and availability='occupied' ORDER BY bed_no DESC";
		$data2 = $room->searchRecord($sql);

		if(count($data) == 0) {
			$sql = "DELETE  FROM `bed` WHERE room_id='$room_id'";
			$room->deleteRecord($sql);
			for($bed_no = 1; $bed_no <= $no_of_bed; $bed_no++) {
				$sql = "INSERT INTO bed(bed_no, availability, room_id) VALUES ('$bed_no', 'available', '$room_id')";
				$room->addRecord($sql);
			}

			$sql = "UPDATE room SET room_no='$room_no', details='$room_details', total_bed='$no_of_bed',
		 		student_rate='$student_rate', faculty_rate='$faculty_rate', other_rate='$other_rate'  
				WHERE room_id='$room_id'";
			$response = $room->updateRecord($sql);

			userLogs($message, $action, $date, $user_id);
			echo json_encode(array('php_error' =>false, 'message' =>'Record is successfully updated.'));
		}
		else {

			$orig_total_bed = $data[0]['total_bed'];
			$total_occupied_bed = 0;

			if(count($data2) > 0) {
				$total_occupied_bed = $data2[0]['bed_no'];
			}

			//IF ORIGINAL ROOM NO IS EQUAL TO SELECTED ROOM NO
			if($data[0]['room_no'] == $orig_room_no) {

				//IF ORIGINAL BED IS LESS THAN TO A NEW BED SELECTED
				if($orig_total_bed >  $no_of_bed) {
					//Remove row in bed table

					if($total_occupied_bed < $no_of_bed) {
						for($bed_no = ($no_of_bed + 1); $bed_no <= $orig_total_bed; $bed_no++ ) {
							$sql = "DELETE FROM `bed` WHERE bed_no='$bed_no'";
							$room->deleteRecord($sql);
						}

						$sql = "UPDATE room SET room_no='$room_no', details='$room_details', total_bed='$no_of_bed',
				  		student_rate='$student_rate', faculty_rate='$faculty_rate', other_rate='$other_rate'  
					 	WHERE room_id='$room_id'";
					 	$response = $room->updateRecord($sql);

					 	userLogs($message, $action, $date, $user_id);
					 	echo json_encode(array('php_error' =>false, 'message' =>'Record is successfully updated.'));
					}
					else {
						echo json_encode(array('php_error' =>true, 'message' =>' Assign total of bed more than '.$total_occupied_bed.'.'));
					}
					
				}
				//IF ORIGINAL BED IS GREATER THAN TO A NEW BED SELECTED
				else if($orig_total_bed <  $no_of_bed) {
					//insert a new row in bed table
					for($bed_no = ($orig_total_bed + 1); $bed_no <= $no_of_bed; $bed_no++ ) {
						$sql = "INSERT INTO bed(bed_no, availability, room_id) VALUES ('$bed_no', 'available', '$room_id')";
						$room->addRecord($sql);
					}

					$sql = "UPDATE room SET room_no='$room_no', details='$room_details', total_bed='$no_of_bed',
			  		student_rate='$student_rate', faculty_rate='$faculty_rate', other_rate='$other_rate'  
				 	WHERE room_id='$room_id'";
				 	$response = $room->updateRecord($sql);

				 	userLogs($message, $action, $date, $user_id);
				 	echo json_encode(array('php_error' =>false, 'message' =>'Record is successfully updated.'));
				}
				else {
					//OTHERWISE IF ORIGINAL BED IS EQUAL TO NEW BED SELECTED UPDATE DETAILS
					$sql = "UPDATE room SET room_no='$room_no', details='$room_details', total_bed='$no_of_bed',
			  		student_rate='$student_rate', faculty_rate='$faculty_rate', other_rate='$other_rate'  
				 	WHERE room_id='$room_id'";
				 	$response = $room->updateRecord($sql);

				 	userLogs($message, $action, $date, $user_id);
				 	echo json_encode(array('php_error' =>false, 'message' =>'Record is successfully updated.'));
				}
				
			}
			else {
				echo json_encode(array('php_error' =>true, 'message' =>'Room '.$room_no.' is already exist.'));
			}
		}
	}

	//SELECT ALL ROOMS
	function selectAllRoom() {
		require_once "../../models/model.php";
		$room = new CRUD;
		$controller = new Database;
		$html = "";
		$sql = "SELECT * FROM room INNER JOIN bed ON room.room_id=bed.room_id GROUP BY bed.room_id ORDER BY room.room_no ASC";
		$data = $room->displayRecord($sql);

		$count = 0;
		foreach ($data as $value) {
			$count++;
			$availability = '<center><span class="fa fa-check"></center></span>';
			$room_id = $value['room_id'];

			$sql2 = "SELECT * FROM bed WHERE availability='available' and room_id='$room_id'";
			$total_available = $room->totalRow($sql2);
			$total_occupied = $value['total_bed'] - $total_available;

			if($total_available == 0) {
				$availability = '<center><span class="fa fa-times-circle"></center></span>';
			}


			$html = $html.'
				<tr>
					<td align="center">'.$count.'</td>
                    <td> Room '. $value['room_no'].'</td>
                    <td>'.$value['details'].'</td>
                    <td>'.$value['student_rate'].'</td>
                    <td>'.$value['faculty_rate'].'</td>
                    <td>'.$value['other_rate'].'</td>
                   	<td class="text-center">'.$value['total_bed'].'</td>
                    <td class="text-center">'.$total_occupied.'</td>
                    <td class="text-center">'.$total_available.'</td>
                    <td>'.$availability.'</td>
                    <td>
                        <a class="btn btn-warning btn-xs" onclick="editRoom('.$room_id.')"><i class="fa fa-edit"></i> Edit</a>
                        <a class="btn btn-primary btn-xs"  onclick="viewRoom('.$room_id.')"><i class="fa fa-folder"></i> View</a>
                    </td>
				</tr>
			';
		}

		if(count($data) > 0) {
			return $html;
		}
		else {
			return "
				<tr>
					<td class='text-center' colspan='11'><h4>-------------------- No records available. -------------------</h4></td>
				</tr>
			";
		}
	}

	function selectAllRoomHidden() {
		require_once "../../models/model.php";
		$room = new CRUD;
		$controller = new Database;
		$html = "";
		$sql = "SELECT * FROM room INNER JOIN bed ON room.room_id=bed.room_id GROUP BY bed.room_id ORDER BY room.room_no ASC";
		$data = $room->displayRecord($sql);

		$count = 0;
		foreach ($data as $value) {
			$count++;
			$availability = '<center>/</center></span>';
			$room_id = $value['room_id'];

			$sql2 = "SELECT * FROM bed WHERE availability='available' and room_id='$room_id'";
			$total_available = $room->totalRow($sql2);
			$total_occupied = $value['total_bed'] - $total_available;

			if($total_available == 0) {
				$availability = '<center>X</span>';
			}


			$html = $html.'
				<tr>
					<td align="center">'.$count.'</td>
                    <td> Room '. $value['room_no'].'</td>
                    <td>'.$value['details'].'</td>
                    <td>'.$value['student_rate'].'</td>
                    <td>'.$value['faculty_rate'].'</td>
                    <td>'.$value['other_rate'].'</td>
                   	<td class="text-center">'.$value['total_bed'].'</td>
                    <td class="text-center">'.$total_occupied.'</td>
                    <td class="text-center">'.$total_available.'</td>
                    <td>'.$availability.'</td>
				</tr>
			';
		}

		if(count($data) > 0) {
			return $html;
		}
		else {
			return "
				<tr>
					<td class='text-center' colspan='10'><h4>-------------------- No records available. -------------------</h4></td>
				</tr>
			";
		}
	}

	function userLogs($message, $action, $date, $user_id) {
		$database = new Database;
		$crud = new CRUD;
		$sql = "INSERT INTO user_logs (message, action, date, user_id) VALUES ('$message', '$action', '$date', '$user_id')";
		$crud->addRecord($sql);
	}

	
?>