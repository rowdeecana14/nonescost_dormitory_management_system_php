<?php
	function widget() {
		require_once "../../models/model.php";
		$dashboard = new CRUD;
		$controller = new Database;

		$sql = "SELECT * FROM users GROUP BY user_id";
		$users = $dashboard->totalRow($sql);

		$sql = "SELECT * FROM `customer` WHERE tenant_type != ''";
		$tenants = $dashboard->totalRow($sql);

		$sql = "SELECT * FROM room GROUP BY room_id";
		$rooms = $dashboard->totalRow($sql);

		$sql = "SELECT * FROM rent_in 
				LEFT JOIN rent_out ON rent_in.cust_id=rent_out.cust_id
				WHERE rent_out.cust_id IS NULL
				GROUP BY rent_in.cust_id";
		$tenant_active = $dashboard->totalRow($sql);

		$sql = "SELECT * FROM rent_out GROUP BY cust_id";
		$tenant_inactive = $dashboard->totalRow($sql);

		$data = array(
			"users" =>$users, 
			'tenants' => $tenants, 
			'rooms' => $rooms, 
			'tenant_active' => $tenant_active,
			'tenant_inactive' => $tenant_inactive
		);
		return $data;
	}

	function graph() { 
		require_once "../../models/model.php";
		$dashboard = new CRUD;
		$controller = new Database;
		$year =  date("Y");
		$month_list = ['01', '02', '03', '04', '05', '06', '07','08', '09', '10', '11', '12'];
		$string_month = array('01' =>"January", '02' =>"February", '03' =>"March", '04' =>"April", '05' =>"May", '06' =>"June", '07' =>"July",'08' =>"August",'09' =>"Septempber", '10' =>"October", '11' =>"November", '12' =>"December");
		$data_graph = "";
		$counted = 0;
		$len = count($month_list);


		foreach($month_list as $month) {
		
			$sql = "SELECT SUM(payment.amount) as amount FROM payment
					WHERE YEAR(payment.date)='$year' AND MONTH(payment.date)='$month'";
			$data = $dashboard->displayRecord($sql);
			$amount = 0;
			$counted++;

			if(count($data) > 0) {
				if($data[0]['amount'] != NULL) {
					$amount = $data[0]['amount'];
				}
				
			}

			if($counted == $len) {
				if($counted %2== 1) {
					$data_graph .= "{Month:'".$string_month[$month]."', Total:".$amount.", Color:'#FCD202'}";
				}
				else {
					$data_graph .= "{Month:'".$string_month[$month]."', Total:".$amount.", Color:'#FF6600'}";
				}
			}
			else {
				if($counted %2== 1) {
					$data_graph .= "{Month:'".$string_month[$month]."', Total:".$amount.", Color:'#FCD202'},";
				}
				else {
					$data_graph .= "{Month:'".$string_month[$month]."', Total:".$amount.", Color:'#FF6600'},";
				}
			}
		}
		

	    return $data_graph;
	}

	function calendar() {
		require_once "../../models/model.php";
		date_default_timezone_set('Asia/Manila');
		$year = date("Y");
		$month = date("m");
		$cur_day = date("d");;
		$rent_amount = 0;
		$balance = 0;

		$payment = new CRUD;
		$controller = new Database;
		$sql = "SELECT customer.fname, customer.lname, room.room_no, bed.bed_no, room.student_rate, 
				room.faculty_rate, room.other_rate, customer.tenant_type, rent_in.rentin_id, 
				day(rent_in.datein) as day, rent_in.datein, rent_in.cust_id, payment.pay_id
				FROM rent_in 
				LEFT JOIN payment ON rent_in.rentin_id=payment.rentin_id 
				INNER JOIN customer ON rent_in.cust_id=customer.cust_id 
				INNER JOIN bed ON rent_in.bed_id=bed.bed_id 
				INNER JOIN room ON bed.room_id=room.room_id 
				GROUP BY rent_in.cust_id";
		$data = $payment->displayRecord($sql);
		$calendar = "";
	 	$len = count($data);
	 	$count = 0;
	 	$day_count = 0;

		foreach ($data as $value) {
			$count++;
			$cust_id = $value['cust_id'];
			$rentin_id = $value['rentin_id'];
			$name = ucwords($value['fname']." ".$value['lname']);
			$room_bed = "Room ".$value['room_no'].", bed ".$value['bed_no'];
			$rent_amount = 0;
			$day = $value['day'];
			$current_day = date("d");
			$month = date("m");
			$year = date("Y");

			$date_orig = $year."-".$month."-".$day;
			$date = date('M d, Y', strtotime($date_orig));
			$current_date = date('Y-m-d');
			$due_date = '<span class="label label-success" style="font-size: 12px">'.$date.'</span>';
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
            $datetime2 = new DateTime($current_date);
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
	                $day_count = $data_day[0]['total_day'];

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
					$color = "#5cb85c";
			 		$remarks = "Paid";
				}
				else {
					if($day_count < 0) {
						$color = "#f0ad4e";
			 			$remarks = "Unpaid";
					}
					else {
						$color = "#CD0D74";
						$remarks = "Unpaid";
					}
					
				}
			}
			else {
				$color = "#f0ad4e";
			 	$remarks = "Unpaid";
			}



			if($count == $len) {
				$calendar .= "{id:'".$count."', title:'".strtoupper($value['fname']." ".$value['lname'])." (".$remarks.")"."', start:'".$due_date."', backgroundColor:'".$color."'}";
			}
			else {
				$calendar .= "{id:'".$count."', title:'".strtoupper($value['fname']." ".$value['lname'])." (".$remarks.")"."', start:'".$due_date."', backgroundColor:'".$color."'},";
			}

			
		}

		return $calendar;
	}
?>