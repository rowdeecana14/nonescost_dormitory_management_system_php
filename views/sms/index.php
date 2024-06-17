<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>SMS || DMMS</title>
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
                  <li><a href=""><i class="fa fa-user"></i> Attendance</a></li>
                  <li><a href="../sms logs/"><i class="fa fa-history"></i> Logs</a></li>
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

  		<div class="container-fluid"  style="width:45%;" >
	  		<form class="form-timein">
	  			<center>
	  				<img src="../../images/UPLOADED/unknown.png" class="timein-image" style="margin-top: 20px;" id="profile">
	  			</center>
	  			<div style="margin: 5px 40px;">
	  				<center><label style="font-size: 25px;" id="name">------ ? ------</label></center>
	  				<div style="padding-bottom: 10px"></div>
	  				<div class="input-group">
	                  <input type="text" id="barcode" name="barcode"  oninput="getCode(this.value)" autofocus class="form-control input-lg" style="border-top-left-radius: 6px; border-bottom-left-radius: 6px;" placeholder="Scan barcode here...">
	                  <div class="input-group-addon" style="border-top-right-radius: 6px; border-bottom-right-radius: 6px;">
	                    <i class="fa fa-barcode"></i>
	                  </div>
	                </div>
	                <div style="padding-bottom: 25px;"></div>
	                <div id="message" style="margin-bottom: 70px;">
                    </div>
	  			</div>
	  			
	  		</form>
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
<script src="../../templates/myjs/crud.js" ></script>
<script type="text/javascript">
	function getCode(str){
        
        if(str.length == 0){
            document.getElementById("message").innerHTML = "";
            return;
        } 
        else{
        	document.getElementById("message").innerHTML = "";
            var query =  CRUD;
            query.path = '../../controllers/sms.php';
            query.param = {
                action: 'search',
                input: str
            };
            
            try {
              var response = query.run();
              response = JSON.parse(response);

              if(response.is_exist == true) {
              	var name = response.data.fname + " " + response.data.lname;
              	var image_dir = "";

              	if(response.data.image == "") {
              		if(response.data.gender == "Male") {
              			image_dir = "../../images/UPLOADED/male.png";
              		}
              		else {
              			image_dir = "../../images/UPLOADED/female.png";
              		}
              	}
              	else {
              		image_dir = "../../images/UPLOADED/"+response.data.image;
              	}

              	$("#profile").attr("src", image_dir);
              	$("#name").text(name);
              	$("#barcode").attr('disabled','disabled');

              	setTimeout(function() {
              		query.path = '../../controllers/sms.php';
	                query.param = {
	                    action: 'send',
	                    input: response.data.parent_contact,
	                    cust_id: response.data.cust_id,
	                    name: name
	                };

	                var response2 = query.run();
	                try {
	                	response2 = JSON.parse(response2);
	                }
	                catch(err) {
	                	alert(err);
              		}
	                

	                $("#barcode").removeAttr('disabled');
	                $("#barcode").val("");
	                $("#profile").attr("src", "../../images/UPLOADED/unknown.png");
	                $("#name").text('------ ? ------');
	                $("#message").html(
	            		'<div class="alert alert-success text-center" role="alert">' +
	                      '<strong><span class="fa fa-send"></span> ' + response2.message + '</strong>' +
	                    '</div>'
	            	);
	            	$( "#barcode" ).focus();
	                

	                setTimeout(function() {
	                	document.getElementById("message").innerHTML = "";
	                }, 2000);
              	}, 1000);

              }
              else{
                $("#message").html(
            		'<div class="alert alert-danger text-center" role="alert">' +
                      '<strong><span class="fa fa-times-circle"></span> No records fund.</strong>' +
                    '</div>'
            	);
              }
            }
            catch(err) {
            	$("#message").html(
            		'<div class="alert alert-danger text-center" role="alert">' +
                      '<strong><span class="fa fa-times-circle"></span> There was something wrong.</strong>' +
                    '</div>'
            	);
            }
        }
    }
</script>
</body>
</html>
