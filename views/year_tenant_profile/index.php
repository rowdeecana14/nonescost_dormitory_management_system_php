<?php 
  include_once("../../controllers/auth.php"); 
  include_once("../../controllers/user_data.php"); 
  include_once("../../controllers/tenant.php"); 
  homeAuth(); 
  if(isset($_GET['id'])) {
    $data = getTenantDetais($_GET['id']);
    $logs =  tenantLogs($_GET['id']);
    $payments = paymentLogs($_GET['id']);
    $image_dir = "";

    if($data['image'] == "") {
      if($data['gender'] == "Male") {
        $image_dir = "Male.png";
      }  
      else {
        $image_dir = "Female.png";
      }
    }
    else {
      $image_dir = $data['image'];
    }
  }
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


    <title>New tenant || DMMS</title>   

    <!-- Bootstrap -->
    <link href="../../templates/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../../plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../../plugins/nprogress/nprogress.css" rel="stylesheet">
    <!-- bootstrap-progressbar -->
    <link href="../../plugins/bootstrap-progressbar/css/bootstrap-progressbar-3.3.2.min.css" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="../../templates/gentelella-master/css/custom.min.css" rel="stylesheet">
    <!-- My Style -->
    <link href="../../templates/mycss/css.css" rel="stylesheet">

  </head>

  <body class="nav-md">
    <script type="text/javascript">
    </script>
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
      		<div class="x_panel" >
    				<div class="x_title">
    				  	<img src="../../images/profile.png" width="40px" height="40px">
                  <h3 style="margin-left:50px; margin-top:-30px; font-size: 20px">Tenant profile</h3>
                  <div class="clearfix"></div>
                  <div class="btn-group pull-right" style="margin-top:-38px">
                    
                      <a href="../year_tenant/?year=<?php echo $_GET['year']; ?>" class="btn btn-primary">
                       <i class="fa fa-mail-reply-all"></i> Records</a>
                  </div>
    			  	</div>
    			  	<div class="x_content">
                  <div class="row">
                      <div class="col-md-3 col-sm-3 col-xs-12 profile_left">
                      <div class="profile_img">
                        <div id="crop-avatar">
                          <img class="img-responsive avatar-view" style="border: 2px solid #73879c; height: 180px; width: 180px;" src="<?php echo "../../images/UPLOADED/".$image_dir; ?>" alt="Avatar" title="Change the avatar">
                        </div>
                      </div>
                      <div style="background-color: #73879c; width: 180px; margin-top: -10px;">
                          <h2 style="text-align: center;  padding: 5px 0px; color: white;"><?php echo "-- ".$data['fname']." ".$data['lname']." --"; ?></h2>
                      </div>
                      
                    </div>

                    <div class="col-md-9 col-sm-9 col-xs-12">

                      <div class="" role="tabpanel" data-example-id="togglable-tabs">
                        <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                          <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true"><span class="badge bg-gray "><i class="fa fa-info-circle"></i></span> My Info</a>
                          </li>
                          <li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false"><span class="badge bg-gray "><i class="fa fa-money"></i></span> My Payment</a>
                          </li>
                          <li role="presentation" class=""><a href="#tab_content3" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false"> <span class="badge bg-gray "><i class="fa fa-history"></i></span> My Logs</a>
                          </li>
                        </ul>
                        <div id="myTabContent" class="tab-content">
                          <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
                            <div class="col-md-6 col-sm-6 col-xs-6">
                               <h1 class="form-title" style="color: black;"><span class="fa fa-info-circle"></span> Personal Data</h1>
                              <table class="table table-striped" style="font-size:14px">
                               <tbody>
                                <tr>
                                  <th width="30%">Barcode:</th>
                                  <td><?php echo $data['barcode']; ?></td>
                                </tr>
                                <tr>
                                  <th width="30%">Tenant name:</th>
                                  <td ><?php echo ucwords($data['fname']." ".$data['mname']." ".$data['lname']); ?></td>
                                </tr>

                                <tr>
                                  <th width="30%">Gender:</th>
                                  <td ><?php echo $data['gender'] ;?></td>
                                </tr>

                                <tr>
                                  <th width="30%">Birth date:</th>
                                  <td ><?php echo date('M d, Y',strtotime($data['bdate'])); ?></td>
                                </tr>
                                
                                <tr>
                                  <th width="30%">Civil status:</th>
                                  <td ><?php echo $data['civil_status']; ?></td>
                                </tr>

                                <tr>
                                  <th width="30%">Address:</th>
                                  <td ><?php echo $data['address']; ?></td>
                                </tr>

                                <tr>
                                  <th width="30%">Email:</th>
                                  <td ><?php echo $data['email']; ?></td>
                                </tr>

                                <tr>
                                  <th width="30%">Contact no:</th>
                                  <td ><?php echo $data['contact']; ?></td>
                                </tr>
                               
                              </tbody>
                            </table>


                            <h1 class="form-title" style="color: black; margin-top: 32px;"><span class="fa fa-info-circle"></span> Tenant info</h1>
                              <table class="table table-striped" style="font-size:14px">
                               <tbody>
                                <?php
                                  if($data[0]['rent_in']) {
                                    $room_no = "Room ".$data['room_no'];
                                    $bed_no = "Bed ".$data['bed_no'];
                                    $bed_rate = "<i class='fa fa-rub'></i>";
                                    
                                    if($data['tenant_type'] == "Student") {
                                      $bed_rate = $bed_rate." ".$data['student_rate'];
                                    }
                                    else if($data['tenant_type'] == "Faculty") {
                                      $bed_rate = $bed_rate." ".$data['faculty_rate'];
                                    }
                                    else {
                                      $bed_rate = $bed_rate." ".$data['other_rate'];
                                    }
                                  }
                                  else {
                                    $room_no = "--------?----------";
                                    $bed_no = "--------?----------";
                                    $bed_rate = "--------?----------";
                                  }
                                ?>
                                <tr>
                                  <th width="30%">Room no:</th>
                                  <td ><?php echo $room_no; ?></td>
                                </tr>

                                <tr>
                                  <th width="30%">Bed no:</th>
                                  <td ><?php echo $bed_no; ?></td>
                                </tr>

                                <tr>
                                  <th width="30%">Bed rate:</th>
                                  <td ><?php echo $bed_rate; ?></td>
                                </tr>
                              </tbody>
                            </table>
                            </div>

                            <div class="col-md-6 col-sm-6 col-xs-6">
                               <h1 class="form-title" style="color: black;"><span class="fa fa-info-circle"></span>  Parent Data</h1>
                              <table class="table table-striped" style="font-size:14px">
                               <tbody>
                                <tr>
                                  <th width="30%">Mother name:</th>
                                 <td ><?php echo $data['mother']; ?></td>
                                </tr>

                                <tr>
                                  <th width="30%">Work:</th>
                                  <td ><?php echo $data['mother_occ']; ?></td>
                                </tr>

                                <tr>
                                  <th width="30%">Father name:</th>
                                 <td ><?php echo $data['father']; ?></td>
                                </tr>

                                <tr>
                                  <th width="30%">Work:</th>
                                  <td ><?php echo $data['father_occ']; ?></td>
                                </tr>


                                <tr>
                                  <th width="30%">Address:</th>
                                  <td ><?php echo $data['parent_address']; ?></td>
                                </tr>

                                <tr>
                                  <th width="30%">Email:</th>
                                  <td ><?php echo $data['parent_email']; ?></td>
                                </tr>

                                <tr>
                                  <th width="30%">Contact no:</th>
                                 <td ><?php echo $data['parent_contact']; ?></td>
                                </tr>
                                
                               
                              </tbody>
                            </table>
                            <br><br>
                            <h1 class="form-title" style="color: black;"><span class="fa fa-info-circle"></span>  Other info</h1>
                              <table class="table table-striped" style="font-size:14px">
                               <tbody>
                                <tr>
                                  <th width="30%">Created by:</th>
                                  <td ><?php echo ucwords($data['user_fname']." ".$data['user_lname']); ?></td>
                                </tr>

                                <tr>
                                  <th width="30%">Date created:</th>
                                  <td ><?php echo date('M d, Y',strtotime($data['date_reg'])); ?></td>
                                </tr>
                              </tbody>
                            </table>
                            </div>


                          </div>
                          <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">
                              <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="table-responsive">

                                        <table id="datatable-buttons" class="table table-hover">
                                            <thead>
                                                <tr class="headings">
                                                    <th class="column-title">#</th>
                                                    <th class="column-title">Amount paid</th>
                                                    <th class="column-title">Amount change</th>
                                                    <th class="column-title">Balance</th>
                                                    <th class="column-title">Date and time</th>
                                                    <th class="column-title">Remarks</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                               <?php echo $payments; ?>
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                          </div>

                          <div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="profile-tab">
                             <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="table-responsive">
                                      <h1 class="form-title" style="color: black;"><span class="fa fa-info-circle"></span> Tenant logs</h1>
                                        <table id="datatable-buttons" class="table table-hover table-striped">
                                            <thead>
                                             
                                                <tr class="headings">
                                                    <th class="column-title text-align">#</th>
                                                    <th class="column-title">Time</th>
                                                    <th class="column-title">Date</th>
                                                    <th class="column-title">Logs</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                
                                               <?php echo $logs; ?>
                                            </tbody>
                                        </table>
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
	<!-- Custom Theme Scripts -->  
    <script src="../../templates/gentelella-master/js/custom.min.js"></script>
	 <!-- My clock -->  
	<script src="../../templates/myjs/clock.js" ></script>
	<!-- Armcharts -->
  </body>
</html>
