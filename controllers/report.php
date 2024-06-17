<?php

    if(isset($_POST['action'])) {

        if($_POST['action'] == "report") {
            require_once "../../models/model.php"; 
            $report = new CRUD;
            $controller = new Database;

            $start = $_POST['date_start'];
            $end = $_POST['date_end'];
            $start = date('Y-m-d', strtotime($start));
            $end = date('Y-m-d', strtotime($end));
            $dis_start = date('M d, Y', strtotime($start));
            $dis_end = date('M d, Y', strtotime($end));

            $sql = "SELECT * FROM payment
                    INNER JOIN rent_in ON payment.rentin_id=rent_in.rentin_id
                    INNER JOIN customer ON rent_in.cust_id=customer.cust_id
                    WHERE date BETWEEN '$start' AND '$end'";
            $data = $report->displayRecord($sql);
            $html_income = "";
            $count = 0;
            $total = 0;
            
            foreach ($data as $value) {
                $count++;
                $total += $value['amount'];
                $html_income = $html_income.'
                    <tr>
                        <td >'.$count.'</td>
                        <td>'.ucwords(strtolower($value['fname']." ".$value['lname'])).'</td>
                        <td>'.number_format($value['amount'], 2).'</td>
                        <td>'.date('M d, Y h:i:s A', strtotime($value['date'])).'</td>
                    </tr>
                ';

            }

            if(count($data) == 0) {
             
                $html_income = "
                    <tr>
                        <td class='text-center' colspan='4'><h4>-------------------- No records available. -------------------</h4></td>
                    </tr>
                ";
            }
        }

        if($_POST['action'] == "select-checkin") {
            require_once "../../models/model.php";
            $report = new CRUD;
            $controller = new Database;
            $sql = " SELECT * FROM `customer`
                    LEFT JOIN rent_in ON customer.cust_id=rent_in.cust_id
                    LEFT JOIN rent_out ON customer.cust_id=rent_out.cust_id
                    WHERE customer.tenant_type != ''";
            $data = $report->displayRecord($sql);
            $result_data = array();

            foreach($data as $value) {
                array_push($result_data, array(
                    "fname" =>$value['fname'], 
                    "lname" =>$value['lname'], 
                    "gender" =>$value['gender'], 
                    "bdate" =>$value['bdate'], 
                    "contact" =>$value['contact'], 
                    "address" =>$value['address'], 
                    "tenant_type" =>$value['tenant_type'], 
                    "rentin_id" =>$value['rentin_id'], 
                    "rentout_id" =>$value['rentout_id']
                ));
            }

        }

        if($_POST['action'] == "select-checkout") {
            require_once "../../models/model.php";
            $report = new CRUD;
            $controller = new Database;
            $sql = " SELECT * FROM `customer`
                    LEFT JOIN rent_in ON customer.cust_id=rent_in.cust_id
                    LEFT JOIN rent_out ON customer.cust_id=rent_out.cust_id
                    WHERE customer.tenant_type != ''";
            $data = $report->displayRecord($sql);
            $result_data = array();

            foreach($data as $value) {
                array_push($result_data, array(
                    "fname" =>$value['fname'], 
                    "lname" =>$value['lname'], 
                    "gender" =>$value['gender'], 
                    "bdate" =>$value['bdate'], 
                    "contact" =>$value['contact'], 
                    "address" =>$value['address'], 
                    "tenant_type" =>$value['tenant_type'], 
                    "rentin_id" =>$value['rentin_id'], 
                    "rentout_id" =>$value['rentout_id']
                ));
            }

        }

        if($_POST['action'] == "select-checkout") {
            require_once "../../models/model.php";
            $report = new CRUD;
            $controller = new Database;
            $sql = " SELECT * FROM `customer`
                    LEFT JOIN rent_in ON customer.cust_id=rent_in.cust_id
                    LEFT JOIN rent_out ON customer.cust_id=rent_out.cust_id
                    WHERE customer.tenant_type != ''";
            $data = $report->displayRecord($sql);
            $result_data = array();

            foreach($data as $value) {
                array_push($result_data, array(
                    "fname" =>$value['fname'], 
                    "lname" =>$value['lname'], 
                    "gender" =>$value['gender'], 
                    "bdate" =>$value['bdate'], 
                    "contact" =>$value['contact'], 
                    "address" =>$value['address'], 
                    "tenant_type" =>$value['tenant_type'], 
                    "rentin_id" =>$value['rentin_id'], 
                    "rentout_id" =>$value['rentout_id']
                ));
            }

        }


        if($_POST['action'] == "select-soa") {

             //SELECT ALL TENANTS PAYMENT
            require_once "../../models/model.php";
            $payment = new CRUD;
            $controller = new Database;
            $id = $_POST['cust_id'];


            $sql = "SELECT * FROM customer WHERE cust_id='$id'";
            $t_data = $payment->searchRecord($sql);
            $t_name = $t_data[0]['fname']." ".$t_data[0]['lname'];
           
            $sql = "SELECT * FROM payment 
                    INNER JOIN rent_in ON rent_in.rentin_id=payment.rentin_id 
                    INNER JOIN customer ON rent_in.cust_id=customer.cust_id 
                    INNER JOIN bed ON rent_in.bed_id=bed.bed_id 
                    INNER JOIN room ON bed.room_id=room.room_id 
                    WHERE rent_in.cust_id='$id'
                    ORDER BY payment.pay_id DESC";
            $data = $payment->displayRecord($sql);
            $count = 0;
            $html_soa = "";
            $soa_name = "Name: ";

            foreach ($data as $value) {
                
                $amount = $value['amount'];
                $change = $value['changed'];
                $remarks = "";
                $date_paid = date('M d, Y', strtotime($value['date']));
                $balance = $value['balance'];
                $count++;

                if($value['balance'] > 0) {
                    $remarks = '<span class="label label-warning" style="font-size: 12px">Unpaid</span>';
                }
                else {
                    $remarks = '<span class="label label-info" style="font-size: 12px">Paid</span>';
                }

                $html_soa = $html_soa.'
                    <tr>
                        <td>'.$count.'</td>
                        <td>'.$date_paid.'</td>
                        <td>'.number_format($amount, 2).'</td>
                        <td>'.number_format($balance, 2).'</td>
                    </tr>';
            }

        }

        if($_POST['action'] == "graph") {
            require_once "../models/model.php";
            $report = new CRUD;
            $controller = new Database;

            $year = $_POST['year'];
            $month_list = ['01', '02', '03', '04', '05', '06', '07','08', '09', '10', '11', '12'];
            $string_month = array('01' =>"January", '02' =>"February", '03' =>"March", '04' =>"April", '05' =>"May", '06' =>"June", '07' =>"July",'08' =>"August",'09' =>"Septempber", '10' =>"October", '11' =>"November", '12' =>"December");
            $data_graph = "";
            $counted = 0;
            $len = count($month_list);
            $my_data = [];
            $my_data2 = [];
            $total = 0;


            foreach($month_list as $month) {
            
                $sql = "SELECT SUM(payment.amount) as amount FROM payment
                        WHERE YEAR(payment.date)='$year' AND MONTH(payment.date)='$month'";
                $data = $report->displayRecord($sql);
                $amount = 0;
                $counted++;

                if(count($data) > 0) {
                    if($data[0]['amount'] != NULL) {
                        $amount = $data[0]['amount'];
                        $total += $amount;
                    }
                    
                }

                if($counted == $len) {
                    if($counted %2== 1) {
                        array_push($my_data, array('Month' => $string_month[$month], 'Total' => $amount, 'Color' =>'#FCD202'));
                        array_push($my_data2, array('Month' => $string_month[$month], 'Total' => number_format($amount, 2), 'Color' =>'#FCD202'));
                    }
                    else {
                        array_push($my_data, array('Month' => $string_month[$month], 'Total' => $amount, 'Color' =>'#FF6600'));
                        array_push($my_data2, array('Month' => $string_month[$month], 'Total' => number_format($amount, 2), 'Color' =>'#FF6600'));
                    }
                }
                else {
                    if($counted %2== 1) {
                       array_push($my_data, array('Month' => $string_month[$month], 'Total' => $amount, 'Color' =>'#FCD202'));
                        array_push($my_data2, array('Month' => $string_month[$month], 'Total' => number_format($amount, 2), 'Color' =>'#FCD202'));
                    }
                    else {
                        array_push($my_data, array('Month' => $string_month[$month], 'Total' => $amount, 'Color' =>'#FF6600'));
                        array_push($my_data2, array('Month' => $string_month[$month], 'Total' => number_format($amount, 2), 'Color' =>'#FF6600'));
                    }
                }
            }

            echo json_encode(array('data1' => $my_data, 'data2' => $my_data2, 'total'=> number_format($total, 2)));
        }
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


    function listYear() {
        require_once "../../models/model.php";
        $dashboard = new CRUD;
        $controller = new Database;
        $sql = "SELECT YEAR(date) as year FROM payment GROUP BY YEAR(date)";
        $data = $dashboard->displayRecord($sql);
        $html = "<li style='font-size: 14px'><a >Select year<a></li>";

        foreach($data as $value) {

            $html = $html.'<li style="font-size: 14px"><a href="#" onclick="graph('.$value['year'].')" >'.$value['year'].'</a></li>';
        }

        if(count($data) > 0) {
            return $html;
        }
        else {
            return '
               <li><a type="button" >------</a></li>
            ';
        }
    }

    function tenantsCategory() {
        require_once "../../models/model.php";
        $dashboard = new CRUD;
        $controller = new Database;
        $sql = " SELECT customer.fname, customer.lname, customer.cust_id, rent_out.rentout_id FROM `customer`
                LEFT JOIN rent_in ON customer.cust_id=rent_in.cust_id
                LEFT JOIN rent_out ON customer.cust_id=rent_out.cust_id
                WHERE customer.tenant_type != ''";
        $data = $dashboard->displayRecord($sql);
        return $data;
    }

    function tenants() {
        require_once "../../models/model.php";
        $dashboard = new CRUD;
        $controller = new Database;
        $sql = " SELECT * FROM `customer`
                LEFT JOIN rent_in ON customer.cust_id=rent_in.cust_id
                LEFT JOIN rent_out ON customer.cust_id=rent_out.cust_id
                WHERE customer.tenant_type != ''";
        $data = $dashboard->displayRecord($sql);
        return $data;
    }


    function rooms() {
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
                    <td ><span class="badge bg-green">'.$value['total_bed'].' BED(S)</span></td>
                   <td ><span class="badge bg-orange">'.$total_occupied.' BED(S)</span></td>
                    <td ><span class="badge bg-blue">'.$total_available.' BED(S)</span></td>
                </tr>
            ';
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

    function roomsHidden() {
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
                    <td >'.$value['total_bed'].' BED(S)</td>
                   <td >'.$total_occupied.' BED(S)</td>
                    <td >'.$total_available.' BED(S)</td>
                </tr>
            ';
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