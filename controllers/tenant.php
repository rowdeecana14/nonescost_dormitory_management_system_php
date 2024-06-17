<?php	
	

	if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action'])) {
		require_once "../models/model.php";
		$tenant = new CRUD;
		$controller = new Database;
		session_start();
		date_default_timezone_set('Asia/Manila');

		//INSERT NEW TENANT
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
			$date_reg = date("Y-m-d");
			$barcode = $_POST['barcode'];
			$fname = $_POST['first_name'];
			$mname = $_POST['middle_name'];
			$lname = $_POST['last_name'];
			$address = $_POST['address'];
			$bdate = $_POST['birth_date'];
			$gender = $_POST['gender'];
			$civil_status = $_POST['civil_status'];
			$contact = $_POST['contact_no'];
			$email = $_POST['email'];

			$mother = $_POST['mother'];
			$mother_occ = $_POST['mother_occ'];
			$father = $_POST['father'];
			$father_occ = $_POST['father_occ'];
			$parent_address = $_POST['parent_address'];
			$parent_email = $_POST['parent_email'];
			$parent_contact = $_POST['parent_contact'];


			if($php_errors == false) {
				$sql = "INSERT INTO customer(barcode, fname, mname, lname, address, bdate, gender, civil_status, contact, email, date_reg, user_id) 
						VALUES ('$barcode', '$fname', '$mname', '$lname','$address', '$bdate', '$gender', '$civil_status', '$contact', '$email', '$date_reg', '$user_id')";
				$customer_id = $tenant->insertLastId($sql);

				$sql = "INSERT INTO parents(mother, mother_occ, father, father_occ, parent_address, parent_contact, parent_email, cust_id) 
						VALUES ('$mother', '$mother_occ', '$father', '$father_occ' ,'$parent_address', '$parent_contact', '$parent_email', '$customer_id')";
				$response = $tenant->addRecord($sql);

				$date =  date("Y-m-d h:i:s");
				$message = "Add tenant ".$fname." ".$lname;
				$action = "Add";
				userLogs($message, $action, $date, $user_id);
				
				echo json_encode($response);
			}
			else {
				echo json_encode(true);
			}

		}

		//SEARCH TENANT
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
				$search = "%{$_POST['input']}%";
				$sql = "SELECT * FROM customer  
						WHERE fname LIKE '$search' 
						OR mname LIKE '$search' 
						OR lname LIKE '$search'
						OR gender LIKE '$search' 
						OR contact LIKE '$search' 
						OR email LIKE '$search' ";
				$data = $tenant->searchRecord($sql); 
				$response = array("data" =>$data, 'php_error' =>false);
				echo json_encode($response);
			}
			else {
				$response = array("data" =>$data, 'php_error' =>true);
				echo json_encode($data);
			}
			
		}

		//UPDATE TENANT DETAILS
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
				$cust_id = $_POST['cust_id'];
				$barcode = $_POST['barcode'];
				$fname = $_POST['first_name'];
				$mname = $_POST['middle_name'];
				$lname = $_POST['last_name'];
				$address = $_POST['address'];
				$bdate = $_POST['birth_date'];
				$gender = $_POST['gender'];
				$civil_status = $_POST['civil_status'];
				$contact = $_POST['contact_no'];
				$email = $_POST['email'];

				$mother = $_POST['mother'];
				$mother_occ = $_POST['mother_occ'];
				$father = $_POST['father'];
				$father_occ = $_POST['father_occ'];
				$parent_address = $_POST['parent_address'];
				$parent_email = $_POST['parent_email'];
				$parent_contact = $_POST['parent_contact'];
				$user_id = $_SESSION['DMMS_userid'];

				$sql = "UPDATE customer SET barcode='$barcode', fname='$fname', mname='$mname', lname='$lname',
						address='$address', bdate='$bdate', gender='$gender', civil_status='$civil_status',
						contact='$contact', email='$email' WHERE cust_id='$cust_id'";
				$response = $tenant->updateRecord($sql);

				$sql = "UPDATE parents SET mother='$mother', mother_occ='$mother_occ', father='$father', father_occ='$father_occ',
						parent_address='$parent_address', parent_contact='$parent_contact', parent_email='$parent_email' 
						WHERE cust_id='$cust_id'";
				$response = $tenant->updateRecord($sql);

				date_default_timezone_set('Asia/Manila');
				$date =  date("Y-m-d h:i:s");
				$message = "Update tenant ".$fname." ".$lname;
				$action = "Update";

				userLogs($message, $action, $date, $user_id);

				echo json_encode($response); 
			}
			else {
				echo json_encode(true);
			}
		}

		//UPLOAD TENANT PROFILE
		if($_POST['action'] == "upload") {
			if(!empty($_FILES['image-source']['name'])) {

	        	$tenant_id = $_POST['tenant_id'];
				$image_name = $_FILES['image-source']['name'];
				$image_tmp = $_FILES['image-source']['tmp_name'];

				$sql = "UPDATE customer SET image='$image_name' WHERE cust_id='$tenant_id'";
		        $error = $tenant->updateRecord($sql);
		        
		            
		        if($error == false) {
		        	$result = $controller->uploadImage($image_name, $image_tmp);

		        	$sql = "SELECT * FROM customer WHERE cust_id='$tenant_id'";
					$data = $tenant->searchRecord($sql);

					$name = $data[0]['fname']." ".$data[0]['lname'];
		        	$date =  date("Y-m-d h:i:s");
					$message = "Change tenant profile picture of  ".$name;
					$action = "Update";
					$id = $_SESSION['DMMS_userid'];
					userLogs($message, $action, $date, $id);

		        	echo json_encode($result);
		        }
		        else {
		            echo json_encode(false);
		        }
			}
		}

		if($_POST['action'] == "capture") {
			$img = $_POST['image'];
			$tenant_id = $_POST['tenant_id'];
			$img = str_replace('data:image/jpeg;base64,', '', $img);
			$img = str_replace(' ', '+', $img);
			$data = base64_decode($img);
			$image_name = uniqid() . '.png';
			$file = "../images/UPLOADED/".$image_name;

			$sql = "UPDATE customer SET image='$image_name' WHERE cust_id='$tenant_id'";
		    $error = $tenant->updateRecord($sql);
		    if($error == false) {
	        	if(file_put_contents($file, $data)) {
	        		$sql = "SELECT * FROM customer WHERE cust_id='$tenant_id'";
					$data = $tenant->searchRecord($sql);

					$name = $data[0]['fname']." ".$data[0]['lname'];
		        	$date =  date("Y-m-d h:i:s");
					$message = "Change tenant profile picture of  ".$name;
					$action = "Update";
					$id = $_SESSION['DMMS_userid'];
					userLogs($message, $action, $date, $id);
					
	        		echo json_encode(true);
	        	}
	        	else {
	        		echo json_encode(false);
	        	}
	        }
	        else {
	            echo json_encode(false);
	        }
		}

	}

	//SELECT ALL TENANTS LOGS
	function tenantLogs($id) {
		require_once "../../models/model.php";
		$tenant = new CRUD;
		$controller = new Database;
		$html = "";
		$sql = "SELECT * FROM time_in_out WHERE cust_id='$id' ORDER BY time_id DESC";
		$data = $tenant->displayRecord($sql);
		$count = 0;
		$logs = "";

		
		foreach ($data as $value) {
			$count++;
			if($value['logs'] == "in") {
				$logs = '<span class="label label-success">TIMEIN</span>';
			}
			else {
				$logs = '<span class="label label-warning">TIMEOUT</span>';
			}

			$html = $html.'
				<tr>
					<td>'.$count.'</td>
					<td>'.date('h:i:s A', strtotime($value['datetime'])).'</td>
					<td>'.date('M d, Y', strtotime($value['datetime'])).'</td>
					<td>'.$logs.'</td>
				</tr>';
		} 

		if(count($data) > 0) {
			return $html;
		}
		else {
			return "
				<tr>
					<td class='text-center' colspan='4'><h4>-------------------- No records available. -------------------</h4></td>
				</tr>
			";
		}

	}

	//SELECT ALL TENANTS PAYMENT
	function paymentLogs($id) {
		require_once "../../models/model.php";
		$payment = new CRUD;
		$controller = new Database;
		$sql = "SELECT * FROM payment 
				INNER JOIN rent_in ON rent_in.rentin_id=payment.rentin_id 
				INNER JOIN customer ON rent_in.cust_id=customer.cust_id 
				INNER JOIN bed ON rent_in.bed_id=bed.bed_id 
				INNER JOIN room ON bed.room_id=room.room_id 
				WHERE rent_in.cust_id='$id'
				ORDER BY payment.pay_id DESC";
		$data = $payment->displayRecord($sql);
		$count = 0;
		$html = "";

		foreach ($data as $value) {
			
			$amount = $value['amount'];
			$change = $value['changed'];
			$remarks = "";
			$date_paid = date('M d, Y h:i A', strtotime($value['date']));
			$balance = $value['balance'];
			$count++;

			if($value['balance'] > 0) {
				$remarks = '<span class="label label-warning" style="font-size: 12px">Unpaid</span>';
			}
			else {
				$remarks = '<span class="label label-info" style="font-size: 12px">Paid</span>';
			}

			$html = $html.'
				<tr>
					<td>'.$count.'</td>
					<td>'.number_format($amount, 2).'</td>
					<td>'.number_format($change, 2).'</td>
					<td>'.number_format($balance, 2).'</td>
					<td>'.$date_paid.'</td>
					<td>'.$remarks.'</td>
				</tr>';
		}

		if(count($data) > 0) {
			return $html;
		}
		else {
			return "
				<tr>
					<td class='text-center' colspan='5'><h4>-------------------- No records available. -------------------</h4></td>
				</tr>
			";
		}

	}


	function myDate($date1) {
		$left = "";
		date_default_timezone_set('Asia/Manila');
		$date2 = date('Y-m-d H:i:s');
		$datetime1 = new DateTime($date1);
		$datetime2 = new DateTime($date2);
		$interval = $datetime1->diff($datetime2);
		$elapsed = $interval->format('%m months %a days %h hours %i minutes');

		$month = $interval->format('%m');
		$day = $interval->format('%a');
		$hour = $interval->format('%h');
		$minutes = $interval->format('%i');
		

		if($day > 0) {
			if($month > 0) {
				$left = $month." MONTH(S) and ".$day." DAY(S)";
			}
			else {
				$left = $day." DAY(S)";
			}
		}
		else {
			$left = $hour." HR(S) and ".$minutes." MIN(S)";
		}

		return $left;
	}


	function unreturnedTenant() {
		require_once "../../models/model.php";
		$tenant = new CRUD;
		$controller = new Database;
		$html = "";
		$sql = "SELECT * FROM time_in_out 
		INNER JOIN customer ON time_in_out.cust_id=customer.cust_id 
		WHERE time_in_out.logs = 'out' GROUP BY time_in_out.cust_id ORDER BY customer.lname ASC";
		$data = $tenant->displayRecord($sql);

		//$sql = "SELECT * FROM time_in_out 
		// INNER JOIN customer ON time_in_out.cust_id=customer.cust_id 
		// WHERE time_in_out.logs = 'out' GROUP BY time_in_out.logs ORDER BY customer.lname ASC";
		// $data = $tenant->displayRecord($sql);
		$logs = "";
		
		for ($i = 0; $i < count($data); $i ++) {
			$cust_id = $data[$i]['cust_id'];

			$sql2 = "SELECT * FROM time_in_out 
			INNER JOIN customer ON time_in_out.cust_id=customer.cust_id 
			WHERE time_in_out.logs = 'out' AND  time_in_out.cust_id='$cust_id'
			GROUP BY time_in_out.logs ORDER BY time_in_out.time_id";
			$data2 = $tenant->displayRecord($sql2);


			$left = myDate($data[$i]['datetime']);

			$html = $html.'
				<tr>
					<td>'.($i +1).'</td>
					<td>'.$data2[0]['fname']." ".$data2[0]['lname'].'</td>
					<td>'.date('M d, Y h:i:s A', strtotime($data2[0]['datetime'])).'</td>
					<td><span class="label label-warning">'.$left.'</span></td>
				</tr>';
		}

		if(count($data) > 0) {
			return $html;
		}
		else {
			return "
				<tr>
					<td class='text-center' colspan='4'><h4>-------------------- No records available. -------------------</h4></td>
				</tr>
			";
		}
	}

	//SELECT TODAY TENANTS LOGS
	function todayTenantLogs() {
		require_once "../../models/model.php";
		$tenant = new CRUD;
		$controller = new Database;
		$html = "";
		$sql = "SELECT * FROM time_in_out 
		INNER JOIN customer ON time_in_out.cust_id=customer.cust_id 
		WHERE DATE(time_in_out.datetime) = CURDATE()";
		$data = $tenant->displayRecord($sql);
		$logs = "";
		
		for ($i = 0; $i < count($data); $i ++) {
			$left = "";

			if($data[$i]['logs'] == "in") {
				$logs = '<span class="label label-success">TIMEIN</span>';
				
			}
			else {
				$logs = '<span class="label label-warning">TIMEOUT</span>';
			}

			$html = $html.'
				<tr>
					<td>'.($i +1).'</td>
					<td>'.$data[$i]['fname']." ".$data[$i]['lname'].'</td>
					<td>'.date('h:i:s A', strtotime($data[$i]['datetime'])).'</td>
					<td>'.date('M d, Y', strtotime($data[$i]['datetime'])).'</td>
					<td>'.$logs.'</td>
				</tr>';
		}

		if(count($data) > 0) {
			return $html;
		}
		else {
			return "
				<tr>
					<td class='text-center' colspan='5'><h4>-------------------- No records available. -------------------</h4></td>
				</tr>
			";
		}
	}


	//SELECT ALL TENANTS LOGS
	function allTenantLogs() {
		require_once "../../models/model.php";
		$tenant = new CRUD;
		$controller = new Database;
		$html = "";
		$sql = "SELECT * FROM time_in_out 
		INNER JOIN customer ON time_in_out.cust_id=customer.cust_id 
		ORDER BY time_in_out.time_id ASC";
		$data = $tenant->displayRecord($sql);
		$logs = "";
		
		for ($i = 0; $i < count($data); $i ++) {

			if($data[$i]['logs'] == "in") {
				$logs = '<span class="label label-success">TIMEIN</span>';
				
			}
			else {
				$logs = '<span class="label label-warning">TIMEOUT</span>';
			}

			$html = $html.'
				<tr>
					<td>'.($i +1).'</td>
					<td>'.$data[$i]['fname']." ".$data[$i]['lname'].'</td>
					<td>'.date('h:i:s A', strtotime($data[$i]['datetime'])).'</td>
					<td>'.date('M d, Y', strtotime($data[$i]['datetime'])).'</td>
					<td>'.$logs.'</td>
				</tr>';
		}

		if(count($data) > 0) {
			return $html;
		}
		else {
			return "
				<tr>
					<td class='text-center' colspan='9'><h4>-------------------- No records available. -------------------</h4></td>
				</tr>
			";
		}
	}

	//SELECT ALL TENANTS
	function selectAllTenant() {
		require_once "../../models/model.php";
		$tenant = new CRUD;
		$controller = new Database;
		$html = "";
		$sql = "SELECT rent_in.rentin_id, rent_out.rentout_id, customer.cust_id, customer.image, customer.fname, 
				customer.lname, customer.mname, customer.address as c_address, customer.bdate, 
				customer.gender, customer.contact as c_contact, customer.tenant_type 
				FROM customer 
				INNER JOIN parents ON customer.cust_ID=parents.cust_id
				LEFT JOIN rent_in ON customer.cust_id=rent_in.cust_id
				LEFT JOIN rent_out ON customer.cust_id=rent_out.cust_id";
		$data = $tenant->displayRecord($sql);

		$count = 0;
		foreach ($data as $value) {
			$count++;
			$status = "";
			$cust_id = $value['cust_id'];
			$profile_dir = '';
			$tenant_type = $value['tenant_type'];

			if($value['image'] == "") {
				$profile_dir = ($value['gender'] == "Male") ? "../../images/UPLOADED/male.png" : "../../images/UPLOADED/female.png";
			}
			else {
				$profile_dir = "../../images/UPLOADED/".$value['image'];
			}

			if($value['tenant_type'] == "") {
				$tenant_type = "Unassigned";
			}

			

			if($value['rentin_id'] == NULL || $value['rentout_id'] != NULL ) {
				$status = '<span class="label label-success">INACTIVE</span>';
			}
			else {
				
				$status = '<span class="label label-info">ACTIVE</span>';
			}

			$fullname = ucwords(strtolower($value['fname']. ' '.$value['mname'].' '.$value['lname']));
			$address = ucwords(strtolower($value['c_address']));

			$html = $html.'
				<tr>
					<td align="center">'.$count.'</td>
					<td>
						<div class="update_profile">
							<button type="button" class="btn btn-xs btn-primary btn-show" onclick=showModal("'.$cust_id.'") id="btn-show'.$count.'">
								<span class="fa fa-camera"></span> Upload
							</button>
							<img src="'.$profile_dir.'" class="display_img" id="'.$cust_id.'">
						</div>
					</td>
                    <td>'.$fullname.'</td>
                    <td>'.$value['gender'].'</td>
                   	<td>'.date('M d, Y',strtotime($value['bdate'])).'</td>
                    <td>'.$value['c_contact'].'</td>
                    <td>'.$address.'</td>
                    <td>'.$tenant_type.'</td>
                    <td>'.$status.'</td>
                    <td>
                        <a  href="../update tenant/?id='.$cust_id.'" class="btn btn-warning btn-xs"><i class="fa fa-edit"></i> Edit</a>
                        <a href="../profile tenant/?id='.$cust_id.'" class="btn btn-primary btn-xs"><i class="fa fa-folder"></i> Profile</a>
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
					<td class='text-center' colspan='10'><h4>-------------------- No records available. -------------------</h4></td>
				</tr>
			";
		}
	}


	function selectAllTenantHidden() {

		require_once "../../models/model.php";
		$tenant = new CRUD;
		$controller = new Database;
		$html = "";
		$sql = "SELECT rent_in.rentin_id, customer.cust_id, customer.image, customer.fname, customer.lname, customer.mname, customer.address as c_address, customer.bdate, customer.gender, customer.contact as c_contact, customer.tenant_type 
		FROM customer INNER JOIN parents ON customer.cust_ID=parents.cust_id LEFT JOIN rent_in ON customer.cust_id=rent_in.cust_id";
		$data = $tenant->displayRecord($sql);

		$count = 0;
		foreach ($data as $value) {
			$count++;
			$status = "";
			$cust_id = $value['cust_id'];
			$profile_dir = '';
			$tenant_type = $value['tenant_type'];

			

			if($value['tenant_type'] == "") {
				$tenant_type = "Unassigned";
			}

			

			if($value['rentin_id'] == NULL ) {
				$status = 'INACTIVE';
			}
			else {
				
				$status = 'ACTIVE';
			}

			$fullname = ucwords(strtolower($value['fname']. ' '.$value['mname'].' '.$value['lname']));
			$address = ucwords(strtolower($value['c_address']));

			$html = $html.'
				<tr>
					<td align="center">'.$count.'</td>
                    <td>'.$fullname.'</td>
                    <td>'.$value['gender'].'</td>
                   	<td>'.date('M d, Y',strtotime($value['bdate'])).'</td>
                    <td>'.$value['c_contact'].'</td>
                    <td>'.$address.'</td>
                    <td>'.$tenant_type.'</td>
                    <td>'.$status.'</td>
				</tr>
			';
		}

		if(count($data) > 0) {
			return $html;
		}
		else {
			return "
				<tr>
					<td class='text-center' colspan='8'><h4>-------------------- No records available. -------------------</h4></td>
				</tr>
			";
		}
	}


	//GET TENANT DETAILS 
	function getTenantDetais($id) {
		require_once "../../models/model.php";
		$tenant = new CRUD;
		$controller = new Database;
		$response;

		$sql2 = "SELECT * FROM customer INNER JOIN rent_in ON customer.cust_id=rent_in.cust_id WHERE customer.cust_id='$id'";
		$rent_in = $tenant->totalRow($sql2);

		if($rent_in > 0) {
			$sql = "SELECT * FROM customer 
					INNER JOIN parents ON customer.cust_id=parents.cust_id 
					INNER JOIN users ON customer.user_id=users.user_id 
					INNER JOIN rent_in ON customer.cust_id=rent_in.cust_id 
					INNER JOIN bed ON rent_in.bed_id=bed.bed_id 
					INNER JOIN room ON bed.room_id=room.room_id WHERE customer.cust_id='$id'";
			$response = $tenant->searchRecord($sql);
			array_push($response[0], array("rent_in" => true));


		}
		else {
			$sql = "SELECT * FROM customer 
				INNER JOIN parents ON customer.cust_id=parents.cust_id 
				INNER JOIN users ON customer.user_id=users.user_id  WHERE customer.cust_id='$id'";
			$response = $tenant->searchRecord($sql);
			array_push($response[0], array("rent_in" => false));

		}
		


		return $response[0];
	}


	//RENDER TENANT GENDER
	function renderGender($gender) {
		$html = "";
		if($gender == "Male") {
			$html = $html."
			<option selected>Male</option>
			<option >Female</option>
			";
		}
		else {
			$html = $html."
			<option >Male</option>
			<option selected>Female</option>
			";
		}
		return $html;
	}

	//RENDER TENANT CIVIL STATUS
	function renderCivilStatus($status) {
		$html = "";
		if($gender == "Single") {
			$html = $html."
			<option selected>Single</option>
			<option >Merried</option>
			";
		}
		else {
			$html = $html."
			<option >Single</option>
			<option selected>Merried</option>
			";
		}
		return $html;
	}

	function userLogs($message, $action, $date, $user_id) {
		$database = new Database;
		$crud = new CRUD;
		$sql = "INSERT INTO user_logs (message, action, date, user_id) VALUES ('$message', '$action', '$date', '$user_id')";
		$crud->addRecord($sql);
	}

?>