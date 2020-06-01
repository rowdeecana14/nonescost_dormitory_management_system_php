<?php	
	

	if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action'])) {
		require_once "../models/model.php";
		$bed = new CRUD;
		$controller = new Database;
		session_start();

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
			$cust_id = $_POST['tenant_id'];
			$bed_id = $_POST['bed_id'];
			$room_id = $_POST['room_id'];
			$date_started = date("Y-m-d",strtotime($_POST['date_started']));
			$tenant_type = $_POST['tenant_type'];

			if($php_errors == false) {
				$sql = "INSERT INTO rent_in(cust_id, bed_id, user_id, datein) 
						VALUES ('$cust_id', '$bed_id', '$user_id', '$date_started')";
				$response = $bed->addRecord($sql);

				$sql = "UPDATE customer SET tenant_type='$tenant_type' WHERE cust_id='$cust_id'";
				$response = $bed->updateRecord($sql);

				$sql = "UPDATE bed SET availability='occupied' WHERE bed_id='$bed_id'";
				$response = $bed->updateRecord($sql);

				
				
				echo json_encode($response);
			}
			else {
				echo json_encode(true);
			}
		}

		//SELECT ROOM NO
		if($_POST['action'] == "select") {
			$php_errors = false; 

			if($controller->checkData($_POST['room_id'])) {
				$php_errors == false;
			}
			if(!$controller->cleanData($_POST['room_id'])) {
				$php_errors == true;
			}

			if($php_errors == false) {
				$room_id = $_POST['room_id'];
				$sql = "SELECT * FROM bed where room_id='$room_id'";
				
				$response = $bed->searchRecord($sql);
				echo json_encode($response);
			}
			else {
				echo json_encode(true);
			}
		} 

		//EDIT ASSIGN BED
		if($_POST['action'] == "edit") {
			$php_errors = false;
			$data = array();

			if($controller->checkData($_POST['rentin_id'])) {
				$php_errors == false;
			}
			if(!$controller->cleanData($_POST['rentin_id'])) {
				$php_errors == true;
			}

			if($php_errors == false) {
				$rentin_id = $_POST['rentin_id'];
				$sql = "SELECT rent_in.rentin_id, room.room_no, bed.bed_no, customer.fname, customer.mname, 
						customer.lname, customer.tenant_type, customer.cust_id, room.room_id, bed.bed_id, rent_in.datein FROM rent_in 
						INNER JOIN bed ON rent_in.bed_id=bed.bed_id 
						INNER JOIN room ON bed.room_id=room.room_id 
						INNER JOIN customer ON rent_in.cust_id=customer.cust_id
						WHERE rent_in.rentin_id='$rentin_id'";
				$response = $bed->searchRecord($sql);
				$room_id = $response[0]['room_id'];

				$sql = "SELECT customer.cust_id, customer.fname, customer.mname, customer.lname FROM customer LEFT JOIN rent_in ON customer.cust_id=rent_in.cust_id";
				$tenant_list = $bed->displayRecord($sql);

				$sql = "SELECT * FROM room ORDER BY room_no ASC";
				$room_list = $bed->displayRecord($sql);

				$sql = "SELECT * FROM bed where room_id='$room_id' ORDER BY bed_no";
				$bed_list = $bed->displayRecord($sql);

				echo json_encode(array('data' =>$response, 'tenant_list' => $tenant_list, 'room_list' => $room_list, 'bed_list' => $bed_list));
			}
			else {
				echo json_encode(true);
			}
		}

		//EDIT ASSIGN BED
		if($_POST['action'] == "remove") {
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
				$rentin_id = $_POST['rentin_id'];
				$sql = "SELECT * FROM rent_in WHERE rentin_id='$rentin_id'";
				$data = $bed->searchRecord($sql);

				$bed_id = $data[0]['bed_id'];
				$sql = "UPDATE bed SET availability='available' WHERE bed_id='$bed_id'";
				$response = $bed->updateRecord($sql);

				$sql = "DELETE FROM `rent_in` WHERE rentin_id='$rentin_id'";
				$response = $bed->deleteRecord($sql);

				echo json_encode($response);
			}
			else {
				echo json_encode(true);
			}

		}

		//UPDATE ASSIGN BED
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
				$rentin_id = $_POST['rentin_id'];
				$new_tenant_type = $_POST['edit_tenant_type'];
				$new_tenant_id = $_POST['edit_tenant_id'];
				$new_room_id = $_POST['edit_room_id'];
				$new_bed_id = $_POST['edit_bed_id'];
				$new_date_started = $_POST['edit_date_started'];


				$sql = "SELECT rent_in.rentin_id, rent_in.cust_id, rent_in.bed_id, bed.room_id FROM rent_in 
						INNER JOIN bed ON rent_in.bed_id=bed.bed_id WHERE rentin_id='$rentin_id'";
				$data = $bed->searchRecord($sql);
				$current_bed_id = $data[0]['bed_id'];
				$current_tenant_id = $data[0]['cust_id'];
				$current_room_id = $data[0]['room_id'];

				$sql = "UPDATE bed SET availability='available' WHERE bed_id='$current_bed_id'";
				$response = $bed->updateRecord($sql);

				$sql = "UPDATE customer SET tenant_type='' WHERE cust_id='$current_tenant_id'";
				$response = $bed->updateRecord($sql);

				$sql = "UPDATE bed SET availability='occupied' WHERE bed_id='$new_bed_id'";
				$response = $bed->updateRecord($sql);

				$sql = "UPDATE customer SET tenant_type='$new_tenant_type' WHERE cust_id='$new_tenant_id'";
				$response = $bed->updateRecord($sql);

				$sql = "UPDATE rent_in SET cust_id='$new_tenant_id', bed_id='$new_bed_id', datein='$new_date_started' WHERE rentin_id='$rentin_id'";
				$response = $bed->updateRecord($sql);
				echo json_encode($response);
			}
			else {
				echo json_encode(true);
			}

		}

	}

	//SELECT ALL ROOMS
	function selectAllBeds() {
		require_once "../../models/model.php";
		$bed = new CRUD;
		$controller = new Database;
		$html = "";
		$sql = "SELECT rent_in.rentin_id, room.room_no, bed.bed_no, customer.fname, customer.mname, 
				customer.lname, customer.tenant_type, rent_out.rentout_id FROM rent_in 
				INNER JOIN bed ON rent_in.bed_id=bed.bed_id 
				INNER JOIN room ON bed.room_id=room.room_id 
				INNER JOIN customer ON rent_in.cust_id=customer.cust_id 
				LEFT JOIN rent_out ON customer.cust_id=rent_out.cust_id
				ORDER BY room.room_no, bed.bed_no ASC";
		$data = $bed->displayRecord($sql);

		$count = 0;
		foreach ($data as $value) {
			
			$rentin_id = $value['rentin_id'];
			$name = $value['fname']." ".$value['mname']." ".$value['lname'];

			if($value['rentout_id'] == NULL) {
				$count++;
				$html = $html.'
					<tr>
						<td align="center">'.$count.'</td>
						<td>Room '.$value['room_no'].'</td>
	                    <td class="text-center">'. $value['bed_no'].'</td>
	                    <td>'.$name.'</td>
	                    <td>'.$value['tenant_type'].'</td>
	                    <td>
	                        <a class="btn btn-warning btn-xs" onclick="editAssign('.$rentin_id.')"><i class="fa fa-edit"></i> Edit</a>
	                        <a class="btn btn-danger btn-xs"  onclick="cancelAssign('.$rentin_id.')"><i class="fa fa-times-circle"></i> Cancel</a>
	                    </td>
					</tr>
				';
			}
		}

		if($count > 0) {
			return $html;
		}
		else {
			return "
				<tr>
					<td class='text-center' colspan='6'><h4>-------------------- No records available. -------------------</h4></td>
				</tr>
			";
		}
	}

	function renderTenantCat() {
		require_once "../../models/model.php";
		$tenant = new CRUD;
		$controller = new Database;
		$sql = "SELECT rent_in.rentin_id, customer.cust_id, customer.fname, customer.mname, customer.lname, rent_in.cust_id as customer_id FROM customer LEFT JOIN rent_in ON customer.cust_id=rent_in.cust_id";
		$data = $tenant->displayRecord($sql);
		$count = 0;
		$html = "<option style='background-color: gray; color:white' value='select' disabled selected>Select tenant</option>";

		foreach ($data as $value) {
			if($value['rentin_id'] == NULL) {
				$cust_id = $value['cust_id'];
				$name = $value['fname']." ".$value['mname']." ".$value['lname'];
				$html = $html."<option value='$cust_id'>".$name."</option>";
			}
		}

		return $html;
	}

	function renderRooms() { 
		require_once "../../models/model.php";
		$room = new CRUD;
		$controller = new Database;
		$sql = "SELECT * FROM room ORDER BY room_no ASC";
		$data = $room->displayRecord($sql);
		$html = "<option style='background-color: gray; color:white' value='select' disabled selected>Select room</option>";

		$count = 0;
		foreach ($data as $value) {
			$room_id = $value['room_id'];
			$html = $html."<option value='$room_id'>Room ".$value['room_no']."</option>";
		}

		return $html;
	}

?>