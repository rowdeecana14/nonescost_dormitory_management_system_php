<?php 
    include_once("../../controllers/auth.php");
    include_once("../../controllers/user_data.php");
    include_once("../../controllers/archieved.php");
    homeAuth(); 
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


    <title>Archieved || DMMS</title>

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
    <!-- PHP SCRIPTS. -->
    
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
      		<div class="x_panel" >
				<div class="x_title">
				  	<img src="../../images/tenant-add.png" width="40px" height="40px">
                    <h3 style="margin-left:50px; margin-top:-30px; font-size: 20px">Archived files</h3>
                    <div class="clearfix"></div>
			  	</div>
			  	<div class="x_content">
                    <div class="row">
                        <div class="table-responsive">
                            <table id="datatable-buttons" class="table table-hover table-striped">
                                <thead>
                                    <tr class="headings">
                                        <th class="column-title">#</th>
                                        <th class="column-title">Year</th>
                                        <th class="column-title">Tenants</th>
                                        <th class="column-title">Payments</th>
                                    </tr>
                                </thead>
                                <tbody class="searchable">
                                    <?php echo years(); ?>
                                </tbody>
                                
                            </table>
                        </div>
                    </div>
				</div>
			</div>

        </div>
        <!-- /page content -->
        <?php require_once("../../controllers/include/modal_alert.php"); ?>
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
	<script src="../../templates/myjs/crud.js" ></script>
    <script type="text/javascript">
        $(document).ready(function(){
            //SAVE CHECKOUT TENANT
            $("#form-checkout").submit(function(e){
                e.preventDefault();
                
                var form = $("#form-checkout").serializeArray();
                form.push({name: 'action', value: 'checkout'});

                var query =  CRUD;
                query.path = '../../controllers/checkout.php';
                query.param = form;
                var response = query.run();
                console.log(response)
                var response = JSON.parse(response);
                var status = response['status'];
                var message = response['message'];

                if(status == false && message == "SUCCESS") {
                    $("#form-checkout")[0].reset();
                    $("#modal-success").modal("show");
                    $(".modal-alert-message").text("Record is successfully saved.");
                    //alert("Record is successfully saved.")
                }
                else if(message == "ERROR") {
                    $(".modal-alert-message").text("Cannot save, you have a remaining balance.");
                }
                else {
                    $("#modal-error").modal("show");
                    $(".modal-alert-message").text("Record is not save.");
                }

            });
        });

    </script>
  </body>
</html>
