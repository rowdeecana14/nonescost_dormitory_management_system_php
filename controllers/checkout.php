<?php

    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action'])) { 
        if($_POST['action'] == "checkout" ) {
            require_once "../models/model.php";
            $checkout = new CRUD;
            $controller = new Database;
            session_start();

            $cust_id = $_POST['tenant'];
            $reason = $_POST['reason'];
            $date = date("Y-m-d", strtotime($_POST['date']));
            $user_id = $_SESSION['DMMS_userid'];
            $rent_amount = 0;


             $sql = "SELECT * FROM rent_in
                    LEFT JOIN payment ON rent_in.rentin_id=payment.rentin_id
                    LEFT JOIN customer ON customer.cust_id=rent_in.cust_id 
                    INNER JOIN bed ON rent_in.bed_id=bed.bed_id 
                    INNER JOIN room ON bed.room_id=room.room_id
                    WHERE rent_in.cust_id='$cust_id'";
            $tenant_data =  $checkout->searchRecord($sql);

            $month = date("m");
            $year = date('Y');
            $balance = 0;
            $rent_amount = 0;
            $remarks = "Not paid";


            if($tenant_data[0]['tenant_type'] == "Student") {
                $rent_amount = $tenant_data[0]['student_rate'];
            }
            else if($tenant_data[0]['tenant_type'] == "Faculty") {
                $rent_amount = $tenant_data[0]['faculty_rate'];
            }
            else {
                $rent_amount = $tenant_data[0]['other_rate'];
            }

            if($tenant_data[0]['balance'] == NULL) {
                $current_date = date('Y-m-d');
                $date_in = $tenant_data[0]['datein'];
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
                $date_in = $tenant_data[0]['datein']; 
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
                $data_day = $checkout->searchRecord($sql3);
                $data_payment = [];

                if($data_day[0]['total_day'] < 0) {
                    $sql2 = "SELECT SUM(payment.total_bills) as total_bills, SUM(payment.amount) as amount_paid
                        FROM rent_in
                        LEFT JOIN payment ON rent_in.rentin_id=payment.rentin_id
                        WHERE rent_in.cust_id='$cust_id'
                        AND (payment.date_payment BETWEEN '$current_date' AND '$date_in')";
                    $data_payment = $checkout->searchRecord($sql2);
                }
                else {
                    $sql2 = "SELECT SUM(payment.total_bills) as total_bills, SUM(payment.amount) as amount_paid
                        FROM rent_in
                        LEFT JOIN payment ON rent_in.rentin_id=payment.rentin_id
                        WHERE rent_in.cust_id='$cust_id'
                        AND (payment.date_payment BETWEEN '$date_in' AND '$current_date')";
                    $data_payment = $checkout->searchRecord($sql2);
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
                    $remarks = "Paid";
            }
            else {
                $remarks = "Unpaid";
            }

            if($balance == 0) {
                $sql = "INSERT INTO rent_out(reason, dateout, cust_id, user_id) 
                    VALUES('$reason', '$date', '$cust_id', '$user_id')";
                $response = $checkout->addRecord($sql);
                $bed_id = $tenant_data[0]['bed_id'];
                $sql = "UPDATE bed SET availability='available' WHERE bed_id='$bed_id'";
                $response = $checkout->updateRecord($sql);

                echo json_encode(array("status" =>$response, "message" =>"SUCCESS"));
            }
            else  {
                echo json_encode(array("status" =>false, "message" =>"ERROR"));
            }




            
        }
    }

    function renderTenant() {
        require_once "../../models/model.php";
        $tenant = new CRUD;
        $controller = new Database;
        $sql = "SELECT customer.fname, customer.lname, customer.cust_id, rent_out.rentout_id FROM rent_in 
                INNER JOIN customer ON rent_in.cust_id=customer.cust_id 
                LEFT JOIN rent_out ON customer.cust_id=rent_out.cust_id";
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

?>