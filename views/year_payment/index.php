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

    <title>Payment || DMMS</title>

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
                    <h3 style="margin-left:50px; margin-top:-30px; font-size: 20px">Payment files (<?php echo $_GET['year']; ?>)</h3>
                    <div class="clearfix"></div>
                    <div class="btn-group pull-right" style="margin-top:-38px">
                       <a href="../archieved_list/" class="btn btn-primary" >
                         <i class="fa  fa-mail-reply-all"></i> Back</a>
                    </div>
			  	</div>
			  	<div class="x_content">
                    <div class="title_right">
                                        <div class="col-md-4 col-sm-5 col-xs-12 form-group pull-right top_search">
                                            <div class="input-group" >
                                                <input type="text" id="search-payment-logs" class="form-control" placeholder="Search for..." style="font-size: 16px; background-color:#eee;">
                                                <span class="input-group-btn">
                                                <button class="btn btn-primary" type="button" id="search-payment-logs-icon"><span class="fa fa-search" style="color:white"></span> </button>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="table-responsive">
                            <table id="datatable-buttons" class="table table-hover table-striped">
                                <thead>
                                    <tr class="headings">
                                        <th class="column-title">#</th>
                                        <th class="column-title">Tenant</th>
                                        <th class="column-title">Room and bed no</th>
                                        <th class="column-title">Amount paid</th>
                                        <th class="column-title">Amount change</th>
                                        <th class="column-title">Current balance</th>
                                        <th class="column-title">Date and time</th>
                                        <th class="column-title">Remarks</th>
                                    </tr>
                                </thead>
                                <tbody class="tbody-payment-logs">
                                    <?php echo allPayments($_GET['year']); ?>
                                </tbody>
                                <tfoot id="search-message-payment-logs" style="display: none">
                                    <td colspan="8"><h5 align="center">--------------------- NO RECORDS AVAILABLE ---------------------</h5></td>
                                </tfoot>
                            </table>
                        </div>
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
         $(document).ready(function() {

           $('#search-payment-logs').keyup(function() {
            $("#search-payment-logs-icon").html("<span class='fa fa-spinner fa-spin' style='color: white'></span>");
            var rex = new RegExp($(this).val(), 'i');

            $('.tbody-payment-logs tr').hide();
            $('.tbody-payment-logs tr').filter(function() {
                return rex.test($(this).text());
            }).show();

             var total_payment = $('.tbody-payment-logs tr').length;
             var rows = $('.tbody-payment-logs tr:hidden').length;

             if(rows == total_payment) {
                $("#search-message-payment-logs").show();
            }
            else {
                $("#search-message-payment-logs").hide();
            }
            setTimeout(function() {
                $("#search-payment-logs-icon").html("<span class='fa fa-search' style='color:white'></span>");
            }, 2000);
        });

        });

    </script>
  </body>
</html>
