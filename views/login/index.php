<?php 
  include_once("../../controllers/auth.php");
  loginAuth();
  $token = token('DMMS_login_token'); 
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Login || DMMS</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="icon" href="../../images/dmms-sm.png">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="../../templates/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plugins/font-awesome/css/font-awesome.min.css">
	<!-- NProgress -->
  <link rel="stylesheet" href="../../plugins/nprogress/nprogress.css" >
  <!-- bootstrap-progressbar -->
  <link rel="stylesheet" href="../../plugins/bootstrap-progressbar/css/bootstrap-progressbar-3.3.2.min.css" rel="stylesheet">
  <!-- Custom Theme Style -->
  <link rel="stylesheet" href="../../templates/admin-lte/css/custom.min.css">
  <!-- AdminLTE Skins. -->
  <link rel="stylesheet" href="../../templates/admin-lte/skins/_all-skins.min.css">
 <style type="text/css">
   .modal {
      text-align: center;
      padding: 0!important; 
    }

    .modal:before {
      content: '';
      display: inline-block;
      height: 100%;
      vertical-align: middle;
      margin-right: -4px; /* Adjusts for spacing */
    }

    .modal-dialog {
      display: inline-block;
      text-align: left;
      vertical-align: middle;
    }
 </style>
  

</head>
<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
<body class="hold-transition skin-red-light layout-top-nav">
<div class="wrapper">

    <header class="main-header">
      <nav class="navbar navbar-static-top" style="background-color:#2E8B57;">
        <div class="container">
          <div class="navbar-header">
              <a href="index.php" class="navbar-brand" style="margin-top: -1rem;"><img src="../../images/dmms-sm.png" height="40px" > </a>
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
              <i class="fa fa-bars"></i>
            </button>
          </div>

          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
            <ul class="nav navbar-nav">
                  <li><a href="index.php"><i class="fa fa-sign-in"></i> Login</a></li>
                  <li><a href="../sms/"><i class="fa fa-history"></i> Attendance</a></li>
            </ul>
          </div>
        </div>
      </nav>
    </header>

    <div class="content-wrapper" style="background-image: url(../../images/front.jpg); background-size: cover; ">
    <div class="container">
          <section class="content" >
             <center>
                <div class="form-group">
                  <br><br>
                  <h3 style="font-style: Sans; font-size: 30px"><b>DORMITORY MANAGEMENT AND MONITORING SYSTEM</b></h3>
                </div>
              </center>
              <!--Client Form-->
                <div class="col-lg-6">
                    <div class="horizontal-form pull-right">
                        <div class="form-group"><br><br>
                            <center>
                              <h4>
                                <b id="date"></b>
                                <b id="timer"></b>
                              </h4>
                            <img id="default_logo" src="../../images/nonescost.png" width="200px" height="20%">
                          </center>
                        </div>
                    </div>
                  </div>
                  <div class="col-lg-6" >
                    <form  id="loginForm">
                        <div id="#addModal" class="modal-dialog modal-success modal-fade modal-sm pull-left" style="width:330px !important;">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <center><h3 class="modal-title"><img src="../../images/dmms-sm.png" height="70px" /> Login </h3></center>
                                    </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                        <div class="form-group">
                                            <label style="font-size: 18px;">Username:</label>
                                            <div class="input-group">
                                              <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                              <input type="text" class="form-control input-md" name="username" id="username" placeholder="Username" autofocus required>
                                            </div>

                                        </div>
                                            <div class="form-group">
                                                <label style="font-size: 18px;">Password:</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                                    <input type="password" class="form-control input-md" name="password" id="password" placeholder="Password" autofocus required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                  <button type="reset" class="btn btn-default btn-md btn-active" style="font-weight: bold"><i class="fa fa-times-circle"> </i> Cancel</button>
                                    <button type="submit" class="btn btn-default btn-md btn-active" style="font-weight: bold"><i class="fa fa-sign-in"> </i> Login</button>
                                </div>
                                
                            </div>
                        </div>
                    </form>
                  </div>
          </section>
        </div>
    </div>
        
        <div class="modal fade" id="modal-default">
          <div class="modal-dialog modal-sm">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><span class="fa fa-times-circle"></span> ERROR MESSAGE</h4>
              </div>
              <div class="modal-body">
                <center>
                  <img src="../../images/Cancel.png">
                  <h4 id="alert-message"></h4>
                </center>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal"><span class="fa fa-thumbs-o-up"></span> Okay</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->

    <!-- jQuery -->
  <script src="../../plugins/jquery/dist/jquery.min.js"></script>
  <!-- Bootstrap -->
  <script src="../../templates/bootstrap/js/bootstrap.min.js"></script>
  <!-- FastClick -->
  <script src="../../plugins/fastclick/lib/fastclick.js"></script>
  <!-- NProgress -->
  <script src="../../plugins/nprogress/nprogress.js"></script>
  <!-- ADMIN LTE JS -->
  <script src="../../templates/admin-lte/js/custom.min.js"></script>
  
  <script type="text/javascript">

    var d = new Date();
    $("#date").text(d.toDateString());
    var myVar = setInterval(myTimer, 1000);

    function myTimer() {
      var d = new Date();
      $("#timer").text(d.toLocaleTimeString());
    }

    $("#loginForm").on('submit',(function(e) {

      e.preventDefault();
      $.ajax({
        url: "../../controllers/login.php",
        dataType: 'json',
        type: "POST",
        data:{
          action: 'login',
          username: $("#username").val(),
          password: $("#password").val(),
          DMMS_login_token: "<?php echo $token; ?>"
        },
        success: function(response) {
          if(response.php_error == false) {
            window.location.href = response.link;
          }
          else if(response.php_error == true) {
            showError(response.php_message);
          }
          else {
            showError("Error");
          }
        },
        error: function(){
          showError("error");
        }
      });
    }));

    

    function showError(message) {
      //alert(message)
      $("#modal-default").modal("show");
      $("#alert-message").text(message);

    }
    
  </script>
</body>
</html>