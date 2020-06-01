<?php	
	function itexmo($number, $msg, $api){
        $url = 'https://www.itexmo.com/php_api/api.php';
        $itexmo = array('1' => $number, '2' => $msg, '3' => $api);
        $param = array(
            'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => http_build_query($itexmo),
            ),
        );
        $context  = stream_context_create($param);
        return file_get_contents($url, false, $context);
    }

    function send($number, $name, $datetime, $logs) {
        $datetime = date('M d, Y h:i:s A',strtotime($datetime));
        $msg = $name.", paid Php.".$logs." at ".$datetime;
        $api = "TR-EUGEN211358_5RD42";
        $alert_message = "";
        $result = itexmo($number,$msg,$api);

        if ($result == ""){
            $alert_message = 'iTexMo: No response from server!!!
                    Please check the METHOD used (CURL or CURL-LESS). If you are using CURL then try CURL-LESS and vice versa.  
                    Please CONTACT US for help.';
        } 
        else if ($result == 0){
            $alert_message = 'Message Succesfully Sent!';
        } 
        else {   
            $alert_message = "Error Num ". $result . " was encountered!";
        }

        return $alert_message;
    }


	if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action'])) {
		require_once "../models/model.php";
		$payment = new CRUD;
		$controller = new Database;
		session_start();
		date_default_timezone_set('Asia/Manila'); 
 
		if($_POST['action'] == "select_tenant") {
			$cust_id = $_POST['cust_id'];
			$sql = "SELECT * FROM rent_in
					LEFT JOIN payment ON rent_in.rentin_id=payment.rentin_id
					LEFT JOIN customer ON customer.cust_id=rent_in.cust_id 
					INNER JOIN bed ON rent_in.bed_id=bed.bed_id 
					INNER JOIN room ON bed.room_id=room.room_id
					WHERE rent_in.cust_id='$cust_id'";
			$response = $payment->searchRecord($sql);

			$my_data = $response;
			$my_data[0]['student_rate'] = number_format($my_data[0]['student_rate'], 2);
			$my_data[0]['faculty_rate'] = number_format($my_data[0]['faculty_rate'], 2);
			$my_data[0]['other_rate'] = number_format($my_data[0]['other_rate'], 2);

			$month = date("m");
			$year = date('Y');
			$balance = 0;
			$rent_amount = 0;
			$remarks = "Not paid";

			if($response[0]['tenant_type'] == "Student") {
				$balance = $response[0]['student_rate'];
				$rent_amount= $response[0]['student_rate'];
			}
			else if($response[0]['tenant_type'] == "Faculty") {
				$balance = $response[0]['faculty_rate'];
				$rent_amount= $response[0]['faculty_rate'];
			}
			else {
				$balance = $response[0]['other_rate'];
				$rent_amount= $response[0]['other_rate'];
			}
				

			if($response[0]['balance'] == NULL) {

				$current_date = date('Y-m-d');
				$date_in = $response[0]['datein'];
				$day = date('d', strtotime($date_in));
				$current_month = date('m');
				$current_year = date('Y');
				$due_date = $current_year."-".$current_month."-".$day;
				$due_date = date('Y-m-d', strtotime($due_date));

				$datetime1 = new DateTime($date_in);
	            $datetime2 = new DateTime($current_date);
	            $interval = $datetime1->diff($datetime2);
	            $total_month = $interval->format('%m');

	            if($total_month == 0) {
	            	$balance = $rent_amount * 1;
	            }
	            else {
	            	$balance = $rent_amount * ($total_month + 1);
	            }

			}
			else {
				
				$current_date = date('Y-m-d');
				$date_in = $response[0]['datein']; 
				$day = date('d', strtotime($date_in));
				$current_month = date('m');
				$current_year = date('Y');
				$due_date = $current_year."-".$current_month."-".$day;
				$due_date = date('Y-m-d', strtotime($due_date));

				$datetime1 = new DateTime($date_in);
	            $datetime2 = new DateTime($current_date);
	            $interval = $datetime1->diff($datetime2);
	            $total_month = $interval->format('%m');
	            $total_day = $interval->format('%a');

	            $sql3 = "SELECT DATEDIFF('$current_date','$date_in') AS total_day";
                $data_day = $payment->searchRecord($sql3);
                $data_payment = [];

                if($data_day[0]['total_day'] < 0) {
                	$sql2 = "SELECT SUM(payment.total_bills) as total_bills, SUM(payment.amount) as amount_paid
						FROM rent_in
						LEFT JOIN payment ON rent_in.rentin_id=payment.rentin_id
                        WHERE rent_in.cust_id='$cust_id'
						AND (payment.date_payment BETWEEN '$current_date' AND '$date_in')";
					$data_payment = $payment->searchRecord($sql2);
                }
                else {
                	$sql2 = "SELECT SUM(payment.total_bills) as total_bills, SUM(payment.amount) as amount_paid
						FROM rent_in
						LEFT JOIN payment ON rent_in.rentin_id=payment.rentin_id
                        WHERE rent_in.cust_id='$cust_id'
						AND (payment.date_payment BETWEEN '$date_in' AND '$current_date')";
					$data_payment = $payment->searchRecord($sql2);
                }

				
				if($total_month == 0) {
	            	$total_bill = $rent_amount * 1;
	            	if($data_payment[0]['amount_paid'] >= $total_bill) {
	            		$balance = 0;
	            		
	            	}
	            	else {
	            		$balance = $total_bill - $data_payment[0]['amount_paid'];
	            	}
	            }
	            else {
	            	
	            	$total_bill = $rent_amount * ($total_month + 1);
	            	if($data_payment[0]['amount_paid'] >= $total_bill) {
	            		$balance = 0;
	            	}
	            	else {
	            		$balance = $total_bill - $data_payment[0]['amount_paid'];
	            	}
	            }

				if($balance == 0) {
					$remarks = "Paid";
				}
				else {
					$remarks = "Unpaid";
				}
			}


			echo json_encode(array("data" =>$response[0], "balance" => number_format($balance, 2), "bal" =>$balance, "remarks" => $remarks, "month" =>$month, "date" =>date('M d, Y')));
		}

		//INSERT PAYMENT
		if($_POST['action'] == "insert") {
			$cust_id = $_POST['tenant'];
			$amount_paid = 0;
			$sql = "SELECT * FROM rent_in
					INNER JOIN customer ON rent_in.cust_id=customer.cust_id
					INNER JOIN parents ON customer.cust_id=parents.cust_id
					WHERE rent_in.cust_id='$cust_id'";
			$data = $payment->searchRecord($sql);
			$rentin_id = $data[0]['rentin_id'];
			$date = date("Y-m-d H:i:s");
			$day = date("d");
			$response = false;

			$month = $_POST['month_num'];
			$year = date("Y");
			$amount = $_POST['paid_amount'];
			$balance = $_POST['balance'];
			$remaining_balance = 0;
			$change = 0;
			$date_payment = $year."-".$month."-".$day;
			$remarks = "";

			if($amount >= $balance) {
				$remaining_balance = 0;
				$change = $amount - $balance; 
				$amount_paid = $balance;
			}
			else {
				$remaining_balance = $balance - $amount;
				$amount_paid = $amount;
			}
			$sql = "INSERT INTO payment(total_bills, amount, balance, changed, date_payment, date, rentin_id) VALUES('$balance', '$amount', '$remaining_balance', '$change', '$date_payment', '$date', '$rentin_id')";
			$response = $payment->addRecord($sql);


			//SEND TO SMS //
			if($data[0]['parent_contact'] != "") {
				date_default_timezone_set('Asia/Manila');
				$name = ucwords(strtolower($data[0]['fname']." ".$data[0]['lname'] ));
				$number = $data[0]['parent_contact'];
	            $datetime = date("Y-m-d H:i:s");
				$alert_message = send($number, $name, $datetime, $amount_paid);
	            $sql = "INSERT INTO time_in_out (datetime, logs, message, cust_id) VALUES ('$datetime', 'Payment', '$alert_message', '$cust_id')";
	            $payment->addRecord($sql);
			}

		
			echo json_encode($response);
		} 
		else if ($_POST['action'] == 'getremainbal') {
			$cust_id = $_POST['cust_id'];
			$sql = "SELECT * FROM rent_in WHERE cust_id='$cust_id'";
			$response = $payment->searchRecord($sql);
			$datein = $response[0]['datein'];

			$sql = "SELECT * FROM rent_in
					LEFT JOIN payment ON rent_in.rentin_id=payment.rentin_id
					LEFT JOIN balance ON rent_in.rentin_id=balance.rentin_id
					INNER JOIN bed ON rent_in.bed_id=bed.bed_id 
					INNER JOIN room ON bed.room_id=room.room_id
					WHERE rent_in.cust_id='$cust_id'";
			$data = $payment->searchRecord($sql);

			foreach ($data as $value) {
				
			}


			$sql = "SELECT * FROM rent_in
					INNER JOIN bed ON rent_in.bed_id=bed.bed_id 
					INNER JOIN room ON bed.room_id=room.room_id
					WHERE rent_in.cust_id='$cust_id'";
			$data2 = $payment->searchRecord($sql);


			echo json_encode($data);
			echo json_encode($data2);

			//$datenow = date('Y-m-d');

			//echo json_encode($response[0]['datein']);
		}
	}

	function renderTenant() {
		require_once "../../models/model.php";
		$tenant = new CRUD;
		$controller = new Database;
		$sql = "SELECT customer.fname, customer.lname, customer.cust_id, rent_out.rentout_id FROM rent_in 
				INNER JOIN customer ON rent_in.cust_id=customer.cust_id
				LEFT JOIN rent_out ON rent_out.cust_id=customer.cust_id";
		$data = $tenant->displayRecord($sql);
		$count = 0;
		$html = "<option style='background-color: gray; color:white' value='' disabled selected>Select tenant</option>";

		foreach ($data as $value) {
			if($value['rentout_id'] == NULL) {
				$cust_id = $value['cust_id'];
				$name = ucwords(strtolower($value['fname']." ".$value['lname']));
				$html = $html."<option value='$cust_id'>".$name."</option>";
			}
			
		}
 
		return $html;
	}

	function allPayments() {
		$year = date("Y");
		require_once "../../models/model.php";
		$payment = new CRUD;
		$controller = new Database;
		$sql = "SELECT * FROM payment 
				INNER JOIN rent_in ON rent_in.rentin_id=payment.rentin_id 
				INNER JOIN customer ON rent_in.cust_id=customer.cust_id 
				INNER JOIN bed ON rent_in.bed_id=bed.bed_id 
				INNER JOIN room ON bed.room_id=room.room_id 
                WHERE YEAR(payment.date)='$year'
				ORDER BY payment.pay_id ASC";
		$data = $payment->displayRecord($sql);
		$count = 0;
		$html = "";

		foreach ($data as $value) {
			
			$name = ucwords(strtolower($value['fname']." ".$value['lname']));
			$room_bed = "Room ".$value['room_no'].", bed ".$value['bed_no'];
			$amount = $value['amount'];
			$change = $value['changed'];
			$remarks = "";
			$date_paid = date('M d, Y h:i A', strtotime($value['date']));
			$balance = $value['balance'];
			$count++;

			if($value['balance'] > 0) {
				$remarks = '<span class="label label-warning" style="font-size: 12px">UNPAID</span>';
			}
			else {
				$remarks = '<span class="label label-primary" style="font-size: 12px">PAID</span>';
			}

			$html = $html.'
				<tr>
					<td>'.$count.'</td>
					<td>'.$name.'</td>
					<td>'.$room_bed.'</td>
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
					<td class='text-center' colspan='8'><h4>-------------------- No records available. -------------------</h4></td>
				</tr>
			";
		}
	}


	function paymentSummary() {

		require_once "../../models/model.php";
		$payment = new CRUD;
		$controller = new Database;
		$sql = "SELECT customer.cust_id, customer.fname, customer.lname, room.room_no, bed.bed_no, room.student_rate, room.faculty_rate,
				room.other_rate, customer.tenant_type, rent_in.rentin_id, day(rent_in.datein) as day, rent_in.datein
				FROM rent_in 
				LEFT JOIN payment ON rent_in.rentin_id=payment.rentin_id 
				INNER JOIN customer ON rent_in.cust_id=customer.cust_id
				INNER JOIN bed ON rent_in.bed_id=bed.bed_id
				INNER JOIN room ON bed.room_id=room.room_id
				GROUP BY rent_in.cust_id";
		$data = $payment->displayRecord($sql);
		$count = 0;
		$html = "";
		$cur_date = date("Y-m-d");

		foreach ($data as $value) {
			$cust_id = $value['cust_id'];
			$rentin_id = $value['rentin_id'];
			$name = ucwords(strtolower($value['fname']." ".$value['lname']));
			$room_bed = "Room ".$value['room_no'].", bed ".$value['bed_no'];
			$rent_amount = 0;
			$day = $value['day'];
			$current_day = date("d");
			$month = date("m");
			$year = date("Y");

			$date_orig = $year."-".$month."-".$day;
			$date = date('M d, Y', strtotime($date_orig));
			$current_date = date('Y-m-d');
			$due_date_span = '<span class="label label-success" style="font-size: 12px">'.$date.'</span>';
			$remarks = "";
			$status = "";
			$balance = 0;

			
			if($value['tenant_type'] == "Student") {
				$rent_amount = $value['student_rate'];
			}
			else if($value['tenant_type'] == "Faculty") {
				$rent_amount = $value['faculty_rate'];
			}
			else {
				$rent_amount = $value['other_rate'];
			}

			$datetime1 = new DateTime($value['datein']);
            $datetime2 = new DateTime($cur_date);
            $interval = $datetime1->diff($datetime2);
            $total_month = $interval->format('%m');

			$sql2 = "SELECT SUM(payment.total_bills) as total_bills, SUM(payment.amount) as amount_paid FROM payment WHERE payment.rentin_id='$rentin_id'";
			$data_balance = $payment->searchRecord($sql2);


			if(count($data_balance) > 0) {
				$current_date = date('Y-m-d');
				$date_in = $value['datein'];
				$day = date('d', strtotime($date_in));
				$current_month = date('m');
				$current_year = date('Y');
				$due_date = $current_year."-".$current_month."-".$day;
				$due_date = date('Y-m-d', strtotime($due_date));

				$datetime1 = new DateTime($date_in);
	            $datetime2 = new DateTime($current_date);
	            $interval = $datetime1->diff($datetime2);
	            $total_month = $interval->format('%m');

				if($data_balance[0]['total_bills'] == NULL) {
					
		            if($total_month == 0) {
		            	$balance = $rent_amount * 1;
		            }
		            else {
		            	$balance = $rent_amount * ($total_month + 1);
		            }

				}
				else {
					$sql3 = "SELECT DATEDIFF('$current_date','$date_in') AS total_day";
	                $data_day = $payment->searchRecord($sql3);
	                $data_payment = [];

	                if($data_day[0]['total_day'] < 0) {
	                	$sql2 = "SELECT SUM(payment.total_bills) as total_bills, SUM(payment.amount) as amount_paid
							FROM rent_in
							LEFT JOIN payment ON rent_in.rentin_id=payment.rentin_id
	                        WHERE rent_in.cust_id='$cust_id'
							AND (payment.date_payment BETWEEN '$current_date' AND '$date_in')";
						$data_payment = $payment->searchRecord($sql2);
	                }
	                else {
	                	$sql2 = "SELECT SUM(payment.total_bills) as total_bills, SUM(payment.amount) as amount_paid
							FROM rent_in
							LEFT JOIN payment ON rent_in.rentin_id=payment.rentin_id
	                        WHERE rent_in.cust_id='$cust_id'
							AND (payment.date_payment BETWEEN '$date_in' AND '$current_date')";
						$data_payment = $payment->searchRecord($sql2);
	                }


					
					if($total_month == 0) {
		            	$total_bill = $rent_amount * 1;
		            	if($data_payment[0]['amount_paid'] >= $total_bill) {
		            		$balance = 0;
		            	}
		            	else {
		            		$balance = $total_bill - $data_payment[0]['amount_paid'];
		            	}
		            }
		            else {
		            	$total_bill = $rent_amount * ($total_month + 1);
		            	if($data_payment[0]['amount_paid'] >= $total_bill) {
		            		$balance = 0;
		            	}
		            	else {
		            		$balance = $total_bill - $data_payment[0]['amount_paid'];
		            	}
		            }
				}
				

				if($balance == 0) {
					$remarks = '<span class="label label-primary" style="font-size: 12px">PAID</span>';
				}
				else {
					$remarks = '<span class="label label-warning" style="font-size: 12px">UNPAID</span>';
				}
			}
			else {
				$remarks = '<span class="label label-warning" style="font-size: 12px">UNPAID</span>';
			}

			$count++;


			$html = $html.'
				<tr>
					<td>'.$count.'</td>
					<td>'.$name.'</td>
					<td>'.$room_bed.'</td>
					<td>'.number_format($rent_amount, 2).'</td>
					<td>'.number_format($balance, 2).'</td>
					<td>'.$due_date_span.'</td>
					<td>'.$remarks.'</td>
				</tr>';
		}

		if(count($data) > 0) {
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
?>