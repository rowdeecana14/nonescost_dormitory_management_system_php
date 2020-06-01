<?php

    function years() {
        require_once "../../models/model.php";
        $archieved = new CRUD;
        $controller = new Database;
        $sql = " SELECT YEAR(user_logs.date) as year FROM user_logs 
                GROUP BY YEAR(user_logs.date) 
                ORDER BY YEAR(user_logs.date) DESC";
        $data = $archieved->displayRecord($sql);
        $html = "";
        $count = 0;
        
        foreach ($data as $value) {
            $count++;


            $html = $html.'
                <tr>
                    <td>'.$count.'</td>
                    <td ><p style="font-size: 20px;">'.$value['year'].'</p></td>
                    <td width="20%"><a href="../year_tenant/?year='.$value['year'].'" class="btn btn-warning"><i class="fa fa-folder-o"></i> Open folder</a></td>
                    <td width="20%"><a href="../year_payment/?year='.$value['year'].'" class="btn btn-warning"><i class="fa fa-folder-o"></i> Open folder</a></td>
                </tr>
            ';
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

    //SELECT ALL TENANTS
    function allTenant($year) {
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
                LEFT JOIN rent_out ON customer.cust_id=rent_out.cust_id
                WHERE YEAR(customer.date_reg)='$year'";
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

            $name = ucwords(strtolower($value['fname']. ' '.$value['mname'].' '.$value['lname']));
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
                    <td>'.$name.'</td>
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


    function allPayments($year) {
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
            
            $name = ucwords($value['fname']." ".$value['lname']);
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


?>