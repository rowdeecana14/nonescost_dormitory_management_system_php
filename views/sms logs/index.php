<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Logs || DMMS</title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<!-- Bootstrap -->
	    <link href="../../templates/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<!-- Font Awesome -->
	<link href="../../plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">
	<link rel="stylesheet" href="../../templates/admin-lte/css/custom.css">
	<!-- AdminLTE Skins. Choose a skin from the css/skins -->
	<link href="../../templates/admin-lte/skins/_all-skins.min.css" rel="stylesheet">
    <link rel="icon" href="../../images/dmms-sm.png" type="image/ico" />

	<style>
	.content-wrapper {
	    background: url(../../images/greyzz.png) repeat scroll 0 0 rgba(0, 0, 0, 0);
	}
	.panel-success {
		border-color: #b3f180;
	}
	hr {
		margin-top: 0px;
		margin-bottom: 15px;
		border-top: 1px solid #afaaaa;
	}
	.form-control {
		background-color: #e2e2e2;
	}
	.skin-blue .main-header .navbar {
		background-color: #2e8b57 !important;
		border-bottom: 2px solid #b3f180;
	}
	.top-title {
		width: 90%;
		min-height: 20px;
	    padding: 19px;
	    margin-bottom: 20px;
	    background-color: #f5f5f5;
	    border: 1px solid #e3e3e3;
	    -webkit-border-radius: 4px;
	    -moz-border-radius: 4px;
	    border-radius: 4px;
	    -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,0.05);
	    -moz-box-shadow: inset 0 1px 1px rgba(0,0,0,0.05);
	    box-shadow: inset 0 1px 1px rgba(0,0,0,0.05);
	}

	.top-title-h2  {
		margin: 10px 0;
	    font-family:Helvetica Neue, serif;
	    font-weight: bold;
	    line-height: 20px;
	    font-size: 40px;
	}

	.top-title-h4 {
		font-family:Helvetica Neue, serif;
	}

	.timein-image {
		width: 120px;
		height: 120px;
		border-radius: 50%;
		padding: 2px;
		border: 2px solid #d2d6de;
	}

	.form-timein {
		background: url(../../images/pixel-60fff.png) repeat scroll 0 0 rgba(0, 0, 0, 0) !important;
		background-color: #fff;
		border-radius: 5px;
		border: 1px solid #b3f180;
	}
</style>
<?php include_once("../../controllers/tenant.php"); ?>
</head>
<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
<body class="hold-transition skin-blue layout-top-nav" >
<div class="wrapper bg-image" >

  <header class="main-header">
      <nav class="navbar navbar-static-top" style="background-color:#2E8B57;">
        <div class="container">
          <div class="navbar-header">
              <a href="" class="navbar-brand"><b style="color:white">NONESCOST - DMMS </b></a>
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
              <i class="fa fa-bars"></i>
            </button>
          </div>

          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
            <ul class="nav navbar-nav">
                  <li><a href="../sms/"><i class="fa fa-user"></i> Attendance</a></li>
                  <li><a href=""><i class="fa fa-history"></i> Logs</a></li>
            </ul>
          </div>
        </div>
      </nav>
    </header>
  <!-- Full Width Column -->
  <div class="content-wrapper">
    <div class="container">
     
    	<div class="container-fluid top-title" >
  			<center>
  				<h2 class="top-title-h2">NONESCOST</h2>
  				<h3 class="top-title-h4">DORMITORY MANAGEMENT AND MONITORING SYSTEM</h3>
  			</center>
  		</div>

  		<div class="container-fluid"  style="width:70%; background-color: white" >
	  		<div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="table-responsive">
                        <?php
                            date_default_timezone_set('Asia/Manila');
                            $today_date = date("F j, Y");
                        ?>
                        <h4 style="font-weight: bold;"><i class="fa fa-calendar"></i> TODAY || <?php echo $today_date; ?></h4>
                        <table id="datatable-buttons" class="table table-hover table-striped">
                            <thead>
                                <tr class="headings">
                                    <th class="column-title">#</th>
                                    <th class="column-title">Tenant</th>
                                    <th class="column-title">Time</th>
                                    <th class="column-title">Date</th>
                                    <th class="column-title">Logs</th>
                                </tr>
                            </thead>
                            <tbody>
                               
                               <?php echo todayTenantLogs(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
		</div>

    </div>
    <!-- /.container -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer" style="border: 1px solid #b3f180; background-color: #d0f1e2;">
    <div class="container">
      <div class="pull-right hidden-xs">
        <b>Version</b> 1.0
      </div>
       Copyright ©<strong>2019. </strong>All rights reserved.
    </div>
    <!-- /.container -->
  </footer>
</div>
<!-- ./wrapper -->
<!-- jQuery 3 -->
<script src="../../plugins/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="../../templates/bootstrap/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="../../templates/admin-lte/js/custom.min.js"></script>

</body>
</html>
