<?php 
    include_once("../../controllers/auth.php");
    include_once("../../controllers/user_data.php");
    include_once("../../controllers/report.php");
    homeAuth(); 
    $tenant_data = tenants(); 
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="../../images/dmms-sm.png" type="image/ico" />


    <title>Reports || DMMS</title>

    <!-- Bootstrap -->
    <link href="../../templates/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../../plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../../plugins/nprogress/nprogress.css" rel="stylesheet">
    <!-- bootstrap-daterangepicker -->
    <link href="../../plugins/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet" type="text/css">
    <!-- bootstrap-progressbar -->
    <link href="../../plugins/bootstrap-progressbar/css/bootstrap-progressbar-3.3.2.min.css" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="../../templates/gentelella-master/css/custom.min.css" rel="stylesheet">
    <!-- My Style -->
    <link href="../../templates/mycss/css.css" rel="stylesheet">
   <style type="text/css">
       .form-btn {
            display: inline block;
       }
   </style>
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view"> 
			  
            <!-- sidebar menu -->
           	<?php require_once('../../controllers/include/side_menubar.php'); ?>
            <!-- /sidebar menu -->

          </div>
        </div>

        <!-- top navigation -->
        <?php require_once('../../controllers/include/top_navbar.php'); ?>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">

             <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">

                    <div class="" role="tabpanel" data-example-id="togglable-tabs">
                        <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                          <li role="presentation" class="active" id="tab1"><a href="#tab_content1" id="upload-tab" role="tab" data-toggle="tab" aria-expanded="true">
                            <span class="badge bg-gray "><i class="fa fa-user"></i></span> Tenant</a>
                          </li>
                          <li role="presentation" id="tab5"><a href="#tab_content5" id="soa-tab" role="tab" data-toggle="tab" aria-expanded="true">
                            <span class="badge bg-gray "><i class="fa fa-file"></i></span> SOA</a>
                          </li>
                          <li role="presentation" class="" id="tab2"><a href="#tab_content2" role="tab" id="room-tab" data-toggle="tab" aria-expanded="false"><span class="badge bg-gray "><i class="fa  fa-edit"></i></span> Room</a>
                          </li>
                          <li role="presentation" class="" id="tab3"><a href="#tab_content3" role="tab" id="income-tab" data-toggle="tab" aria-expanded="false"><span class="badge bg-gray "><i class="fa  fa-money"></i></span> Income</a>
                          </li>
                          <li role="presentation" class="" id="tab4"><a href="#tab_content4" role="tab" id="graph-tab" data-toggle="tab" aria-expanded="false"><span class="badge bg-gray "><i class="fa  fa-bar-chart"></i></span> Graph</a>
                          </li>
                        </ul>
                        <div id="myTabContent" class="tab-content">
                            <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="upload-tab">
                                <div class="x_panel" >
                                    <div class="x_title">
                                        <img src="../../images/tenant-list.png" width="40px" height="40px">
                                        <h3 style="margin-left:50px; margin-top:-30px; font-size: 20px">Tenant list</h3>
                                        <div class="clearfix"></div>
                                        <div class="btn-group pull-right" style="margin-top:-38px;">
                                           
                                             <a class="btn btn-success" download="TenantList.xls" onclick="return ExcellentExport.excel(this, 'table-tenant', 'TenantList');" style="margin-right: 4px;">
                                             <i class="fa fa-file-excel-o"></i> Export</a>
                                            <button onclick="printTableTenant()" type="button" class="btn btn-primary" >
                                             <i class="fa fa-print"></i> Print</button>
                                        </div>
                                        
                                    </div>
                                    <div class="x_content">
                                        <div class="row">
                                        <div class="table-responsive">
                                            <div class="col-md-8">
                                                <h2 style="" id="tenant_list">LIST OF TENANTS 
                                                    <?php 
                                                        if(isset($result_data) && $_POST['action'] == "select-checkout") {
                                                            echo " (Check Out)";
                                                        }
                                                        elseif (isset($result_data) && $_POST['action'] == "select-checkin") {
                                                            echo " (Check In)";
                                                        }
                                                        elseif (isset($result_data) && $_POST['action'] == "select-all") {
                                                          echo " (All)";
                                                        }
                                                        else {
                                                            echo " (All)";
                                                        }
                                                    ?>
                                                        
                                                </h2>
                                            </div>
                                            <div class="col-md-1">
                                                <form  method="post" class="form-btn">
                                                    <input type="hidden" name="action" value="select-checkin">
                                                    <button type="submit" class="btn btn-default" >
                                                  Check In</button>
                                                </form>
                                            </div>
                                            <div class="col-md-1">
                                                <form action="" method="post" class="form-btn">
                                                    <input type="hidden" name="action" value="select-checkout">
                                                    <button type="submit" class="btn btn-default" >
                                                  Check out</button>
                                                </form>
                                            </div>
                                            <div class="col-md-1">
                                                <form action="" method="post" class="form-btn">
                                                    <input type="hidden" name="action" value="select-all">
                                                    <button type="submit" class="btn btn-default" >
                                                  All tenant</button>
                                                </form>
                                            </div>
                                                
                                            <table  class="table table-hover">
                                                <thead>
                                                    <tr class="headings">
                                                        <th class="column-title">#</th>
                                                        <th class="column-title">Tenant name</th>
                                                        <th class="column-title">Gender</th>
                                                        <th class="column-title">Birth date</th>
                                                        <th class="column-title">Contact</th>
                                                        <th class="column-title">Address</th>
                                                        <th class="column-title">Type</th>
                                                        <th class="column-title">Status </th>
                                                    </tr>
                                                </thead>
                                                <tbody class="tbody-tenant">
                                                    <?php 
                                                        if(isset($result_data)) {
                                                            $tenant_data = $result_data;
                                                        }
                                                        $html = "";
                                                        $tenant_type = "";
                                                        $tenant_status = '';
                                                        $count = 0;

                                                        foreach($tenant_data as $value) {
                                                            if($value['tenant_type'] == "") {
                                                                $tenant_type = "Unassign";
                                                            }
                                                            else {
                                                                $tenant_type = $value['tenant_type'];
                                                            }


                                                            if($value['rentout_id'] == NULL) {
                                                                $tenant_status = '<span class="label label-success">CHECK IN</span>';
                                                            }
                                                            else {
                                                                $tenant_status = '<span class="label label-warning">CHECK OUT</span>';
                                                            }

                                                           
                                                            if(isset($result_data) && $_POST['action'] == "select-checkin") {
                                                                if($value['rentout_id'] == NULL) {
                                                                     $count++;
                                                                    $html = $html.'
                                                                    <tr>
                                                                        <td>'.$count.'</td>
                                                                        <td>'.ucwords(strtolower($value['fname']." ".$value['lname'])).'</td>
                                                                        <td>'.$value['gender'].'</td>
                                                                        <td>'.date('M d, Y', strtotime($value['bdate'])).'</td>
                                                                        <td>'.$value['contact'].'</td>
                                                                        <td>'.ucwords(strtolower($value['address'])).'</td>
                                                                        <td>'.$tenant_type.'</td>
                                                                        <td>'.$tenant_status.'</td>
                                                                    </tr>
                                                                ';
                                                                }

                                                            }

                                                            else if(isset($result_data) && $_POST['action'] == "select-checkout") {
                                                                if($value['rentout_id'] != NULL) {
                                                                     $count++;
                                                                    $html = $html.'
                                                                    <tr>
                                                                        <td>'.$count.'</td>
                                                                        <td>'.ucwords(strtolower($value['fname']." ".$value['lname'])).'</td>
                                                                        <td>'.$value['gender'].'</td>
                                                                        <td>'.date('M d, Y', strtotime($value['bdate'])).'</td>
                                                                        <td>'.$value['contact'].'</td>
                                                                        <td>'.ucwords(strtolower($value['address'])).'</td>
                                                                        <td>'.$tenant_type.'</td>
                                                                        <td>'.$tenant_status.'</td>
                                                                    </tr>
                                                                ';
                                                                }

                                                            }
                                                            else if(isset($result_data) && $_POST['action'] == "select-all") {
                                                                if($value['rentout_id'] != NULL) {
                                                                     $count++;
                                                                    $html = $html.'
                                                                    <tr>
                                                                        <td>'.$count.'</td>
                                                                        <td>'.ucwords(strtolower($value['fname']." ".$value['lname'])).'</td>
                                                                        <td>'.$value['gender'].'</td>
                                                                        <td>'.date('M d, Y', strtotime($value['bdate'])).'</td>
                                                                        <td>'.$value['contact'].'</td>
                                                                        <td>'.ucwords(strtolower($value['address'])).'</td>
                                                                        <td>'.$tenant_type.'</td>
                                                                        <td>'.$tenant_status.'</td>
                                                                    </tr>
                                                                ';
                                                                }

                                                            }
                                                            else {
                                                                 $count++;
                                                                 $html = $html.'
                                                                    <tr>
                                                                        <td>'.$count.'</td>
                                                                        <td>'.ucwords(strtolower($value['fname']." ".$value['lname'])).'</td>
                                                                        <td>'.$value['gender'].'</td>
                                                                        <td>'.date('M d, Y', strtotime($value['bdate'])).'</td>
                                                                        <td>'.$value['contact'].'</td>
                                                                        <td>'.ucwords(strtolower($value['address'])).'</td>
                                                                        <td>'.$tenant_type.'</td>
                                                                        <td>'.$tenant_status.'</td>
                                                                    </tr>
                                                                ';
                                                            }
                                                            
                                                        }

                                                        if($count > 0) {
                                                            echo $html;
                                                        }
                                                        else {
                                                            echo "
                                                                <tr>
                                                                    <td class='text-center' colspan='8'><h4>-------------------- No records available. -------------------</h4></td>
                                                                </tr>
                                                            ";
                                                        }
                                                    ?>
                                                </tbody>
                                            </table>
                                            <table id="table-tenant" class="table table-hover hidden">
                                                <thead>
                                                    <tr>
                                                        <td colspan="8"><h4 class="text-center">LIST OF TANANTS</h4></td>
                                                    </tr>
                                                    <tr class="headings">
                                                        <th class="column-title">#</th>
                                                        <th class="column-title">Tenant name</th>
                                                        <th class="column-title">Gender</th>
                                                        <th class="column-title">Birth date</th>
                                                        <th class="column-title">Contact</th>
                                                        <th class="column-title">Address</th>
                                                        <th class="column-title">Type</th>
                                                        <th class="column-title">Status </th>
                                                    </tr>
                                                </thead>
                                                <tbody class="tbody-tenant" id="tbody-tenant">
                                                    <?php 
                                                        foreach($tenant_data as $value) {
                                                            if($value['tenant_type'] == "") {
                                                                $tenant_type = "Unassign";
                                                            }
                                                            else {
                                                                $tenant_type = $value['tenant_type'];
                                                            }


                                                            if($value['rentout_id'] == NULL) {
                                                                $tenant_status = 'CHECK IN';
                                                            }
                                                            else {
                                                                $tenant_status = 'CHECK OUT';
                                                            }

                                                            $count++;
                                                            $html = $html.'
                                                                <tr>
                                                                    <td>'.$count.'</td>
                                                                    <td>'.ucwords(strtolower($value['fname']." ".$value['lname'])).'</td>
                                                                    <td>'.$value['gender'].'</td>
                                                                    <td>'.date('M d, Y', strtotime($value['bdate'])).'</td>
                                                                    <td>'.$value['contact'].'</td>
                                                                    <td>'.ucwords(strtolower($value['address'])).'</td>
                                                                    <td>'.$tenant_type.'</td>
                                                                    <td>'.$tenant_status.'</td>
                                                                </tr>
                                                            ';
                                                        }

                                                        if(count($tenant_data) > 0) {
                                                            echo $html;
                                                        }
                                                        else {
                                                            echo "
                                                                <tr>
                                                                    <td class='text-center' colspan='8'><h4>-------------------- No records available. -------------------</h4></td>
                                                                </tr>
                                                            ";
                                                        }
                                                     ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </div>

                            <div role="tabpanel" class="tab-pane fade" id="tab_content5" aria-labelledby="soa-tab">
                                <div class="x_panel" >
                                    <div class="x_title">
                                        <img src="../../images/records.png" width="40px" height="40px">
                                        <h3 style="margin-left:50px; margin-top:-30px; font-size: 20px">Statement of Account</h3>
                                        <div class="clearfix"></div>
                                        <div class="btn-group pull-right" style="margin-top:-38px;">
                                            <a class="btn btn-success" download="StatementOfAccount.xls" onclick="return ExcellentExport.excel(this, 'table-soa', 'StatementOfAccount');" style="margin-right: 4px;">
                                         <i class="fa fa-file-excel-o"></i> Export</a>
                                            <button onclick="printTableSOA()" type="button" class="btn btn-primary" >
                                             <i class="fa fa-print"></i> Print</button>
                                        </div>
                                       
                                    </div>
                                    <div class="x_content">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <form method="post">
                                                    <div class="col-md-4">
                                                        <input type="hidden" name="action" value="select-soa">
                                                         <select name="cust_id" class="form-control " style="background-color:#eee; " required>
                                                            <?php 
                                                                $tenant_data = tenantsCategory();
                                                                $tenant_html_select = "<option value='' readonly>Select tenant</option>";

                                                                foreach ($tenant_data as $value) {
                                                                    if($value['rentout_id'] == NULL) {
                                                                        $cust_id = $value['cust_id'];
                                                                        $name = $value['fname']." ".$value['lname'];
                                                                        $tenant_html_select = $tenant_html_select."<option value='$cust_id'>".$name."</option>";
                                                                    }
                                                                }

                                                                echo $tenant_html_select;
                                                            ?>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <button type="submit" class="btn btn-primary"><span class="fa fa-search"></span> Search</button>
                                                    </div>
                                                </form>
                                                
                                            </div>
                                            <div class="col-md-12">
                                                <br>
                                                <h4 id="soa-name">
                                                    <?php 
                                                        if(isset($t_name) && $_POST['action'] == "select-soa") {
                                                            echo "Name: ".$t_name;
                                                        }
                                                    ?>
                                                </h4>
                                                <table class="table table-hover ">
                                                    <thead>
                                                        <tr class="headings">
                                                            <th class="column-title">#</th>
                                                            <th class="column-title">Date</th>
                                                            <th class="column-title">Amount</th>
                                                            <th class="column-title">Balance</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="tbody-soa" >
                                                         <?php 
                                                            if(isset($html_soa) && $_POST['action'] == "select-soa") {
                                                                if($html_soa != "") {
                                                                    echo $html_soa;
                                                                }
                                                                else {
                                                                    echo " <tr>
                                                                        <td class='text-center' colspan='4'><h4>-------------------- No records available. -------------------</h4></td>
                                                                    </tr>";
                                                                }
                                                            }
                                                            else {
                                                                echo " <tr>
                                                                    <td class='text-center' colspan='4'><h4>-------------------- No records available. -------------------</h4></td>
                                                                </tr>";
                                                            }
                                                         ?>
                                                    </tbody>
                                                </table>
                                                <table id="table-soa" class="table table-hover hidden">
                                                    <thead>
                                                        <tr>
                                                            <td colspan="4"><h4 class="text-center">STATEMENT OF ACCOUNT</h4></td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="4">
                                                                 <?php 
                                                                    if(isset($t_name) && $_POST['action'] == "select-soa") {
                                                                        echo "Name: ".$t_name;
                                                                    }
                                                                ?>
                                                            </td>
                                                        </tr>
                                                        <tr class="headings">
                                                            <th class="column-title">#</th>
                                                            <th class="column-title">Date</th>
                                                            <th class="column-title">Amount</th>
                                                            <th class="column-title">Balance</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="tbody-soa" id="tbody-soa">
                                                         <?php 
                                                            if(isset($html_soa) && $_POST['action'] == "select-soa") {
                                                                    echo $html_soa;
                                                                }
                                                                else {
                                                                    echo " <tr>
                                                                        <td class='text-center' colspan='4'><h4>-------------------- No records available. -------------------</h4></td>
                                                                    </tr>";
                                                                }
                                                         ?>
                                                    </tbody>
                                                </table>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="room-tab">
                                <div class="x_panel" >
                                    <div class="x_title">
                                        <img src="../../images/bed.png" width="40px" height="40px">
                                        <h3 style="margin-left:50px; margin-top:-30px; font-size: 20px">Room</h3>
                                        <div class="clearfix"></div>
                                        <div class="btn-group pull-right" style="margin-top:-38px;">
                                            <a class="btn btn-success" download="RoomAvailability.xls" onclick="return ExcellentExport.excel(this, 'table-rooms', 'RoomAvailability');" style="margin-right: 4px;">
                                         <i class="fa fa-file-excel-o"></i> Export</a>
                                            <button onclick="printTableRoom()" type="button" class="btn btn-primary" >
                                             <i class="fa fa-print"></i> Print</button>
                                        </div>
                                       
                                    </div>
                                    <div class="x_content">
                                        <div class="row">
                                            <div class="table-responsive">
                                            <h2 style="">ROOM AVAILABILITY</h2>
                                            <table id="datatable-buttons" class="table table-hover">
                                                <thead>
                                                    <tr class="headings">
                                                        <th class="column-title">#</th>
                                                        <th class="column-title">Room no</th>
                                                        <th class="column-title">Description</th>
                                                        <th class="column-title">Total bed</th>
                                                        <th class="column-title">Occupied bed</th>
                                                        <th class="column-title">Available bed</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="tbody-rooms">
                                                    <?php echo rooms(); ?>
                                                </tbody>
                                            
                                            </table>

                                            <table class="table table-hover hidden" id="table-rooms">
                                                <thead>
                                                    <tr>
                                                        <td colspan="6"><h4 class="text-center">ROOM AVAILABILITY</h4></td>
                                                    </tr>
                                                    <tr class="headings">
                                                        <th class="column-title">#</th>
                                                        <th class="column-title">Room no</th>
                                                        <th class="column-title">Description</th>
                                                        <th class="column-title">Total bed</th>
                                                        <th class="column-title">Occupied bed</th>
                                                        <th class="column-title">Available bed</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="tbody-rooms" id="tbody-rooms">
                                                    <?php echo roomsHidden(); ?>
                                                </tbody>
                                            </table>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="income-tab">
                                <div class="x_panel" >
                                    <div class="x_title">
                                        <img src="../../images/payment.png" width="40px" height="40px">
                                        <h3 style="margin-left:50px; margin-top:-30px; font-size: 20px">Income</h3>
                                        <div class="clearfix"></div>
                                        <div class="btn-group pull-right" style="margin-top:-38px; ">
                                            <a class="btn btn-success" download="IncomeStatement.xls" onclick="return ExcellentExport.excel(this, 'table-income', 'IncomeStatement');" style="margin-right: 4px;">
                                         <i class="fa fa-file-excel-o"></i> Export</a>
                                            <button onclick="printTable()" type="button" class="btn btn-primary" >
                                             <i class="fa fa-print"></i> Print</button>
                                        </div>
                                        
                                    </div>
                                    <div class="x_content">
                                        <form  method="POST">
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <input type="hidden" name="action" value="report">
                                                <div class="col-md-4 col-sm-4 col-xs-4">
                                                   <label class="col-md-12 col-sm-12 col-xs-12 form-group">From: </label>
                                                    <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                                        <input type="text" class="form-control  has-feedback-left" name="date_start" value="" placeholder="Date start" id="single_cal4" aria-describedby="inputSuccess2Status4" required="">
                                                        <span class="fa fa-calendar blue form-control-feedback left" aria-hidden="true" style="color:black"></span>
                                                    </div>

                                                </div>
                                                <div class="col-md-4 col-sm-4 col-xs-4">
                                                   <label class="col-md-12 col-sm-12 col-xs-12 form-group">To: </label>
                                                    <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                                        <input type="text" class="form-control  has-feedback-left single_cal3" name="date_end" value="" placeholder="Date end" id="single_cal3" aria-describedby="inputSuccess2Status4" required="">
                                                        <span class="fa fa-calendar blue form-control-feedback left" aria-hidden="true" style="color:black"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-sm-4 col-xs-4">
                                                    <button type="submit" name="search" class="btn btn-primary" style="margin-top:27px"><i class="fa fa-search"></i> Search</button>
                                                </div>
                                            </div>
                                        </form>
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <h4 style="margin-top: 30px;">
                                                <b>From:</b> 
                                                <b style="font-size: 14px" id="start">
                                                    <?php 
                                                        if(isset($dis_start)) { echo $dis_start; } 
                                                        else { echo "-----"; }
                                                    ?>  
                                                </b>
                                                <b style="margin-left: 10px;"> To:</b> 
                                                <b style="font-size: 14px" id="end">
                                                    <?php 
                                                        if(isset($dis_end)) { echo $dis_end; }  
                                                         else { echo "-----"; }
                                                    ?>
                                                        
                                                </b>
                                            </h4>
                                            <div class="table-responsive">
                                                <table class="table table-hover">
                                                    <thead>
                                                        <tr class="headings">
                                                            <th class="column-title">#</th>
                                                            <th class="column-title">Tenant name</th>
                                                            <th class="column-title">Amount paid</th>
                                                            <th class="column-title">Date</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="tbody-user">
                                                        <?php 
                                                            if(isset($html_income)) { echo  $html_income; }
                                                            else {
                                                                echo "<tr>
                                                                    <td class='text-center' colspan='9'><h4>-------------------- No records available. -------------------</h4></td>
                                                                </tr>";
                                                            }
                                                        ?>
                                                    </tbody>
                                                    <tfoot >
                                                        <th colspan="8">Total: 
                                                            <?php 
                                                                if(isset($total)) { echo '<span class="fa fa-rub"></span> '.number_format($total, 2); } 
                                                                else { echo '<span class="fa fa-rub"></span> 0.00'; }
                                                            ?>
                                                                
                                                        </th>
                                                    </tfoot>
                                                </table>

                                                <table id="table-income" class="table table-hover hidden">
                                                    <tr>
                                                        <td align="center" colspan="4"><h4>INCOME STATEMENT</h4></td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="2">From: 
                                                            <?php  
                                                                if(isset($dis_end)) { echo $dis_end; } 
                                                                else { echo "-----"; }
                                                                ?> 
                                                        </td>
                                                        <td colspan="2">To: 
                                                            <?php  
                                                                if(isset($dis_end)) { echo $dis_end; } 
                                                                else { echo "-----"; }
                                                            ?> 
                                                        </td>
                                                    </tr>
                                                    <thead>
                                                        <tr class="headings">
                                                            <th class="column-title">#</th>
                                                            <th class="column-title">Tenant name</th>
                                                            <th class="column-title">Amount paid</th>
                                                            <th class="column-title">Date</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="print-data-tbody">
                                                        <?php 
                                                            if(isset($html_income)) { echo  $html_income; }
                                                            else {
                                                                echo "<tr>
                                                                    <td class='text-center' colspan='9'><h4>-------------------- No records available. -------------------</h4></td>
                                                                </tr>";
                                                            }
                                                        ?>
                                                    </tbody>
                                                    <tfoot >
                                                        <th colspan="2">Total: 
                                                            <?php 
                                                                if(isset($total)) { echo '<span class="fa fa-rub"></span> '.number_format($total, 2); } 
                                                                else { echo '<span class="fa fa-rub"></span> 0.00'; }
                                                            ?>
                                                                
                                                        </th>
                                                        <th colspan="2"></th>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div role="tabpanel" class="tab-pane fade" id="tab_content4" aria-labelledby="graph-tab">
                                <div class="x_panel" >
                                    <div class="x_title">
                                        <img src="../../images/charts.png" width="40px" height="40px">
                                        <h3 style="margin-left:50px; margin-top:-30px; font-size: 20px" id="title-graph">Monthly Income in Year 
                                            <?php echo date('Y'); ?></h3>
                                        <div class="clearfix"></div>
                                        <div class="btn-group pull-right" style="margin-top:-38px; margin-right: 91px">
                                            <button onclick="printTable2()" type="button" class="btn btn-primary" >
                                             <i class="fa fa-print"></i> Print</button>
                                        </div>
                                        <div class="dropdown pull-right" style="margin-top:-38px">
                                              <button class="btn btn-success dropdown-toggle " type="button" data-toggle="dropdown">
                                                <span class="fa fa-calendar-o" style="color: white"></span>
                                                Year
                                              <span class="caret" style="color: white"></span></button>
                                              <ul class="dropdown-menu">
                                                <?php echo listYear(); ?>
                                              </ul>
                                            </div>
                                    </div>
                                    <div class="x_content">
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <div class="col-md-3 col-sm-12 col-xs-12">
                                                     <div class="container"  id="list-data">
                                                      <div class="list-group">
                                                        <a  class="list-group-item active" style="font-weight: bold;" id="list-title">LIST OF MONTH</a>
                                                        <a href="#" class="list-group-item" style="font-weight: bold;">January:
                                                            <b style="margin-left: 23px;" id="jan">0.00</b>
                                                        </a>
                                                        <a href="#" class="list-group-item" style="font-weight: bold;">February:
                                                            <b style="margin-left: 19px;" id="feb">0.00</b>
                                                        </a>
                                                        <a href="#" class="list-group-item" style="font-weight: bold;">March:
                                                            <b style="margin-left: 36px;" id="mar">0.00</b>
                                                        </a>
                                                        <a href="#" class="list-group-item" style="font-weight: bold;">April:
                                                            <b style="margin-left: 44px;" id="apr">0.00</b>
                                                        </a>
                                                        <a href="#" class="list-group-item" style="font-weight: bold;">May:
                                                            <b style="margin-left: 50px;" id="may">0.00</b>
                                                        </a>
                                                        <a href="#" class="list-group-item" style="font-weight: bold;">June:
                                                            <b style="margin-left: 46px;" id='jun'>0.00</b>
                                                        </a>
                                                        <a href="#" class="list-group-item" style="font-weight: bold;">July:
                                                            <b style="margin-left: 50px;" id="jul">0.00</b>
                                                        </a>
                                                        <a href="#" class="list-group-item" style="font-weight: bold;">August:
                                                            <b style="margin-left: 32px;" id="aug">0.00</b>
                                                        </a>
                                                        <a href="#" class="list-group-item" style="font-weight: bold;">September:
                                                            <b style="margin-left: 10px;" id="sep">0.00</b>
                                                        </a>
                                                        <a href="#" class="list-group-item" style="font-weight: bold;">October:
                                                            <b style="margin-left: 28px;" id="oct">0.00</b>
                                                        </a>
                                                        <a href="#" class="list-group-item" style="font-weight: bold;">November:
                                                            <b style="margin-left: 15px;" id="nov">0.00</b>
                                                        </a>
                                                        <a href="#" class="list-group-item" style="font-weight: bold;">December:
                                                            <b style="margin-left: 16px;" id="dec">0.00</b>
                                                        </a>
                                                         <a href="#" class="list-group-item" style="font-weight: bold;">TOTAL:
                                                            <b style="margin-left: 36px;" id="total">0.00</b>
                                                        </a>
                                                      </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-9 col-sm-12 col-xs-12">
                                                    <div class="container"  id="graph-data">
                                                      <div class="list-group">
                                                        <a  class="list-group-item active" style="font-weight: bold;" id="graph-title">TOTAL INCOME IN YEAR <?php echo date('Y'); ?></a>
                                                        <div id="chartdiv1" style="width: 100%; height: 522px; background-color: rgba(222, 220, 234, 0.9);"></div>
                                                      </div>
                                                  </div>
                                              </div>

                                            </div>
                                        </div>
                  
                                    </div>
                                </div>
                          </div>
               
                        </div>
                      </div>


                  </div>
              </div>

        </div>
        <!-- /page content -->
        

        <!-- footer content -->
        <?php require_once('../../controllers/include/bottom_footer.php'); ?>
        <!-- /footer content -->

      </div>
    </div>

    <!-- jQuery -->
	<script src="../../plugins/jquery/dist/jquery.min.js"></script>
	<!-- Bootstrap -->
	<script src="../../templates/bootstrap/js/bootstrap.min.js"></script>
	<!-- FastClick -->
	<script src="../../plugins/fastclick/lib/fastclick.js"></script>
	<!-- NProgress -->
	<script src="../../plugins/nprogress/nprogress.js"></script>
    <!-- Moment -->
    <script src="../../plugins/moment/min/moment.min.js" type="text/javascript"></script>
    <!-- /bootstrap-daterangepicker -->
    <script src="../../plugins/bootstrap-daterangepicker/daterangepicker.js" type="text/javascript"></script>
	<!-- Custom Theme Scripts -->  
    <script src="../../templates/gentelella-master/js/custom.min.js"></script>
	 <!-- My clock -->  
	<script src="../../templates/myjs/clock.js" ></script>
    <!-- Export to excel  -->  
    <script src="../../plugins/excellentexport/excellentexport.js"></script>
    <!-- Armcharts -->
    <script src="../../plugins/amcharts/amcharts.js"></script>
    <script src="../../plugins/amcharts/pie.js"></script>
    <script src="../../plugins/amcharts/plugins/export/export.js"></script>
    <script src="../../plugins/amcharts/serial.js"></script>
    <!-- My crud  -->  
	<script src="../../templates/myjs/crud.js" ></script>
    <script type="text/javascript">

        var tab = "<?php if(isset($_POST['action']) && $_POST['action']=="report") { echo "tab"; } else { echo ""; }  ?>";
        if(tab != "") {
            $("#tab_content1").removeClass("active in");
            $("#tab_content2").removeClass("active in");
            $("#tab_content4").removeClass("active in");
            $("#tab_content5").removeClass("active in");

            $("#tab1").removeClass("active");
            $("#tab2").removeClass("active");
            $("#tab4").removeClass("active");
            $("#tab5").removeClass("active");

            $("#tab3").addClass("active");
            $("#tab_content3").addClass("active in");
        }

        var tab2 = "<?php if(isset($_POST['action']) && $_POST['action']=="select-soa") { echo "tab"; } else { echo ""; }  ?>";
        if(tab2 != "") {
            $("#tab_content1").removeClass("active in");
            $("#tab_content2").removeClass("active in");
            $("#tab_content4").removeClass("active in");
            $("#tab_content3").removeClass("active in");

            $("#tab1").removeClass("active");
            $("#tab2").removeClass("active");
            $("#tab4").removeClass("active");
            $("#tab3").removeClass("active");

            $("#tab5").addClass("active");
            $("#tab_content5").addClass("active in");
        }

        var my_data = graph(2019);

        function graph(year) {
            $("#list-title").text("LIST OF MONTH ");
            $("#graph-title").text("MONTHLY INCOME");

            try {
                var query =  CRUD;
                query.path = '../../controllers/report.php';
                query.param = {
                    action: "graph",
                    year: year
                }
                var response = query.run();
                response = JSON.parse(response);
                var data1 = response['data1'];
                var data2 = response['data2'];

                $("#jan").text(data2[0]['Total']);
                $("#feb").text(data2[1]['Total']);
                $("#mar").text(data2[2]['Total']);
                $("#apr").text(data2[3]['Total']);
                $("#may").text(data2[4]['Total']);
                $("#jun").text(data2[5]['Total']);
                $("#jul").text(data2[6]['Total']);
                $("#aug").text(data2[7]['Total']);
                $("#sep").text(data2[8]['Total']);
                $("#oct").text(data2[9]['Total']);
                $("#nov").text(data2[10]['Total']);
                $("#dec").text(data2[11]['Total']);
                $("#total").text(response['total']);
                

                 var chart = AmCharts.makeChart("chartdiv1", {
                    type: "serial",
                    dataProvider: data1,
                    categoryField: "Month",
                    depth3D: 10,
                    angle: 30,

                    categoryAxis: {
                        labelRotation: 30,
                        gridPosition: "start"
                    },

                    valueAxes: [{
                        title: "Total"
                    }],

                    graphs: [{

                        valueField: "Total",
                        colorField: "Color",
                        type: "column",
                        lineAlpha: 0,
                        fillAlphas: 1,
                        balloonText: "<span style='font-size:18px'>Month: <b>[[Month]]</b><br>Total: <b>[[value]]</b></span>"
                    }],

                    chartCursor: {
                        cursorAlpha: 0,
                        zoomable: false,
                        categoryBalloonEnabled: false
                    }
                });


              var legend2 = new AmCharts.AmLegend();
              chart.addListener("clickGraphItem", function(event) {
               
              });

            }
            catch(err) {
                console.log(err);
            }
        }
        

        function printTable() {
            var html = document.getElementById("print-data-tbody");
            console.log(html)
            var start = $("#start").text();
            var end = $("#end").text();
            var newWin = window.open('', 'Print-Window', 'width=1000,height=600, left=170');
           
            var content = '<!DOCTYPE html>\
                <html >\
                <head>\
                    <meta charset="utf-8">\
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">\
                    <meta name="description" content="">\
                    <meta name="author" content="">\
                    <title>Print Records</title>\
                    <!-- Bootstrap -->\
                    <link href="../../templates/bootstrap/css/bootstrap.min.css" rel="stylesheet">\
                    <style>\
                        table, th, td {\
                            font-size:10px; \
                            border: 1px solid black;\
                        }\
                        h4 { \
                            font-size:12px; \
                        } \
                        h3 { \
                            font-size:14px; \
                            font-weight:bold; \
                        } \
                        hr {\
                            border: 0;\
                            border-top: 1px solid black;\
                        }\
                    </style>\
                </head>\
                <body onload="window.print()">\
                <div class="container">\
                    <div class="row">\
                        <div class="col-xs-12">\
                            <br>\
                             <center><h3 id="title_name">INCOME STATEMENT</h3></center>\
                             <b>From:</b> <b style="font-size: 14px">' + start +'</b>\
                             <b>To:</b> <b style="font-size: 14px">' + end +'</b>\
                            <br>\
                            <table class="table">\
                                <thead>\
                                <th style="border: 1px solid black">#</th>\
                                  <th width="" style="border: 1px solid black">Tenant name</th>\
                                  <th width="" style="border: 1px solid black"> Amount paid</th>\
                                  <th width="" style="border: 1px solid black">Date</th>\
                                <thead>\
                            <tbody style="border: 1px solid black">' + html.innerHTML + '</tbody>\
                            </table>\
                        </div>\
                    </div>\
                </div>\
                </body>\
                </html>';

            newWin.document.open();
            newWin.document.write(content);
            newWin.document.close();

             setTimeout(function() {
                 newWin.close();
             }, 2000);
        }

        function printTable2() {
            var listdata = document.getElementById("list-data");
            var graphdata = document.getElementById("graph-data");
            var title = $("#title-graph").text();
            var start = $("#start").text();
            var end = $("#end").text();
            var newWin = window.open('', 'Print-Window', 'width=1000,height=600, left=170');
           
            var content = '<!DOCTYPE html>\
                <html >\
                <head>\
                    <meta charset="utf-8">\
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">\
                    <meta name="description" content="">\
                    <meta name="author" content="">\
                    <title>Print Records</title>\
                    <!-- Bootstrap -->\
                    <link href="../../templates/bootstrap/css/bootstrap.min.css" rel="stylesheet">\
                    <style>\
                        table, th, td {\
                            font-size:10px; \
                            border: 1px solid black;\
                        }\
                        h4 { \
                            font-size:12px; \
                        } \
                        h3 { \
                            font-size:14px; \
                            font-weight:bold; \
                        } \
                        hr {\
                            border: 0;\
                            border-top: 1px solid black;\
                        }\
                    </style>\
                </head>\
                <body onload="window.print()">\
                    <div class="container">\
                        <div class="row">\
                            <div class="col-xs-12">\
                                <br>\
                                <center><h2 id="title_name">' +title+'</h2></center>\
                            </div>\
                            <div class="col-xs-12">\
                                <div class="col-xs-3">'
                                 + listdata.innerHTML + 
                                '</div>' +
                                '<div class="col-xs-9">'
                                 + graphdata.innerHTML + 
                                '</div>' +
                            '<div>\
                        </div>\
                    </div>\
                </body>\
                </html>';

            newWin.document.open();
            newWin.document.write(content);
            newWin.document.close();

             setTimeout(function() {
                 newWin.close();
             }, 2000);
        }


        function printTableTenant() {
            var html = document.getElementById('tbody-tenant');
            var title = $("#tenant_list").text();
            var newWin = window.open('', 'Print-Window', 'width=1000,height=600, left=170');
            var content = '<!DOCTYPE html>\
                <html >\
                <head>\
                    <meta charset="utf-8">\
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">\
                    <meta name="description" content="">\
                    <meta name="author" content="">\
                    <title>Print Records</title>\
                    <!-- Bootstrap -->\
                    <link href="../../templates/bootstrap/css/bootstrap.min.css" rel="stylesheet">\
                    <style>\
                        table, th, td {\
                            font-size:10px; \
                            border: 1px solid black;\
                        }\
                        h4 { \
                            font-size:12px; \
                        } \
                        h3 { \
                            font-size:14px; \
                            font-weight:bold; \
                        } \
                        hr {\
                            border: 0;\
                            border-top: 1px solid black;\
                        }\
                    </style>\
                </head>\
                <body onload="window.print()">\
                <div class="container">\
                    <div class="row">\
                        <div class="col-xs-12">\
                            <br>\
                             <center><h3 id="title_name">'+title+'</h3></center>\
                            <br>\
                            <table class="table">\
                                <thead>\
                                <th style="border: 1px solid black">#</th>\
                                  <th width="" style="border: 1px solid black">Tenant name</th>\
                                  <th width="" style="border: 1px solid black"> Gender</th>\
                                  <th width="" style="border: 1px solid black">Birth date</th>\
                                  <th width="" style="border: 1px solid black">Contact</th>\
                                  <th width="" style="border: 1px solid black">Address</th>\
                                  <th width="" style="border: 1px solid black">Type</th>\
                                  <th width="" style="border: 1px solid black">Status</th>\
                                <thead>\
                            <tbody style="border: 1px solid black">' + html.innerHTML + '</tbody>\
                            </table>\
                        </div>\
                    </div>\
                </div>\
                </body>\
                </html>';

            newWin.document.open();
            newWin.document.write(content);
            newWin.document.close();

             setTimeout(function() {
                 newWin.close();
             }, 2000);
        }

        function printTableRoom() {
            var html = document.getElementById('tbody-rooms');
            var newWin = window.open('', 'Print-Window', 'width=1000,height=600, left=170');
            var content = '<!DOCTYPE html>\
                <html >\
                <head>\
                    <meta charset="utf-8">\
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">\
                    <meta name="description" content="">\
                    <meta name="author" content="">\
                    <title>Print Records</title>\
                    <!-- Bootstrap -->\
                    <link href="../../templates/bootstrap/css/bootstrap.min.css" rel="stylesheet">\
                    <style>\
                        table, th, td {\
                            font-size:10px; \
                            border: 1px solid black;\
                        }\
                        h4 { \
                            font-size:12px; \
                        } \
                        h3 { \
                            font-size:14px; \
                            font-weight:bold; \
                        } \
                        hr {\
                            border: 0;\
                            border-top: 1px solid black;\
                        }\
                    </style>\
                </head>\
                <body onload="window.print()">\
                <div class="container">\
                    <div class="row">\
                        <div class="col-xs-12">\
                            <br>\
                             <center><h3 id="title_name">ROOM AVAILABILITY</h3></center>\
                            <br>\
                            <table class="table">\
                                <thead>\
                                <th style="border: 1px solid black">#</th>\
                                  <th width="" style="border: 1px solid black">Room no</th>\
                                  <th width="" style="border: 1px solid black">Description</th>\
                                  <th width="" style="border: 1px solid black">Total bed</th>\
                                  <th width="" style="border: 1px solid black">Occupied bed</th>\
                                  <th width="" style="border: 1px solid black">Available bed</th>\
                                <thead>\
                            <tbody style="border: 1px solid black">' + html.innerHTML + '</tbody>\
                            </table>\
                        </div>\
                    </div>\
                </div>\
                </body>\
                </html>';

            newWin.document.open();
            newWin.document.write(content);
            newWin.document.close();

             setTimeout(function() {
                 newWin.close();
             }, 2000);
        }

        function printTableSOA() {
            var html = document.getElementById('tbody-soa');
            var name = $("#soa-name").text();
            var newWin = window.open('', 'Print-Window', 'width=1000,height=600, left=170');
            var content = '<!DOCTYPE html>\
                <html >\
                <head>\
                    <meta charset="utf-8">\
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">\
                    <meta name="description" content="">\
                    <meta name="author" content="">\
                    <title>Print Records</title>\
                    <!-- Bootstrap -->\
                    <link href="../../templates/bootstrap/css/bootstrap.min.css" rel="stylesheet">\
                    <style>\
                        table, th, td {\
                            font-size:10px; \
                            border: 1px solid black;\
                        }\
                        h4 { \
                            font-size:12px; \
                        } \
                        h3 { \
                            font-size:14px; \
                            font-weight:bold; \
                        } \
                        hr {\
                            border: 0;\
                            border-top: 1px solid black;\
                        }\
                    </style>\
                </head>\
                <body onload="window.print()">\
                <div class="container">\
                    <div class="row">\
                        <div class="col-xs-12">\
                            <br>\
                             <center><h3 id="title_name">STATEMENT OF ACCOUNT</h3></center>\
                            <br>\
                            <h4>' + name +'</h4>\
                            <table class="table">\
                                <thead>\
                                <th style="border: 1px solid black">#</th>\
                                  <th width="" style="border: 1px solid black">Date</th>\
                                  <th width="" style="border: 1px solid black">Amount</th>\
                                  <th width="" style="border: 1px solid black">Balance</th>\
                                <thead>\
                            <tbody style="border: 1px solid black">' + html.innerHTML + '</tbody>\
                            </table>\
                        </div>\
                    </div>\
                </div>\
                </body>\
                </html>';

            newWin.document.open();
            newWin.document.write(content);
            newWin.document.close();

             setTimeout(function() {
                 newWin.close();
             }, 2000);
        }

       
    </script>
  </body>
</html>
