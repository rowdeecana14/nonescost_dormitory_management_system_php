<?php

    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action'])) {

        require_once "../models/model.php";
        $tenant = new CRUD;
        $controller = new Database;

        if($_POST['action'] == "search") {
            $barcode = $_POST['input'];
            $sql = "SELECT * FROM customer INNER JOIN parents ON customer.cust_id=parents.cust_id WHERE barcode='$barcode'";
            $data = $tenant->searchRecord($sql);

            if(count($data) == 1) {
                echo json_encode(array('data' => $data[0], 'is_exist' => true));
            }
            else {
                echo json_encode(array('data' => [], 'is_exist' => false));
            }
        }
        
        if($_POST['action'] == "send") {
            $number =  $_POST['input'];
            $cust_id = $_POST['cust_id'];
            $name = strtoupper($_POST['name']);
            date_default_timezone_set('Asia/Manila');
            $datetime = date("Y-m-d H:i:s");
            $logs = "in";

            $sql = "SELECT * FROM time_in_out WHERE cust_id='$cust_id' ORDER BY datetime DESC";
            $data = $tenant->searchRecord($sql);

            if($data[0]['logs'] == "in") {
                $logs = "out";
            }
            else if($data[0]['logs'] == "out") {
                $logs = "in";
            }

            $alert_message = send($number, $name, $datetime, $logs);
            $sql = "INSERT INTO time_in_out (datetime, logs, message, cust_id) VALUES ('$datetime', '$logs', '$alert_message', '$cust_id')";
            $tenant->addRecord($sql);
            echo json_encode(array('message' => $alert_message));
        }
    }


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
        $msg = $name.", log".$logs." at ".$datetime;
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

?>