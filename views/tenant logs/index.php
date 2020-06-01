<?php
    include_once("../../controllers/auth.php");
    include_once("../../controllers/user_data.php");
    include_once("../../controllers/tenant.php");
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
	<link rel="icon" href="../../images/nonescost.png" type="image/ico" />

    <title>List of tenant || DMMS</title>

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
             <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="" role="tabpanel" data-example-id="togglable-tabs">
                        <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                          <li role="presentation" class="active" ><a href="#tab_content1" id="upload-tab" role="tab" data-toggle="tab" aria-expanded="true">
                            <span class="badge bg-gray "><i class="fa fa-history"></i></span> Daily logs</a>
                          </li>
                          <li role="presentation" class=""><a href="#tab_content2" role="tab" id="camera-tab" data-toggle="tab" aria-expanded="false"><span class="badge bg-gray "><i class="fa fa-history"></i></span> All logs</a>
                          </li>
                         <li role="presentation" class=""><a href="#tab_content3" role="tab" id="camera-tab" data-toggle="tab" aria-expanded="false"><span class="badge bg-gray "><i class="fa fa-users"></i></span> Unreturned</a>
                          </li>
                        </ul>
                        <div id="myTabContent" class="tab-content">
                          <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="upload-tab">
                            <div class="x_panel" >
                                <div class="x_title">
                                    <img src="../../images/tenant_logs.png" width="40px" height="40px">
                                    <h3 style="margin-left:50px; margin-top:-30px; font-size: 20px">Daily logs</h3>
                                    <div class="clearfix"></div>
                                    
                                </div>
                                <div class="x_content">
                                    <div class="title_right">
                                        <div class="col-md-4 col-sm-5 col-xs-12 form-group pull-right top_search">
                                            <div class="input-group" >
                                                <input type="text" id="search-daily-logs" class="form-control" placeholder="Search for..." style="font-size: 16px; background-color:#eee;">
                                                <span class="input-group-btn">
                                                <button class="btn btn-primary" type="button" id="search-daily-logs-icon"><span class="fa fa-search" style="color:white"></span> </button>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
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
                                                    <tbody class="tbody-daily-logs">
                                                       
                                                       <?php echo todayTenantLogs(); ?>
                                                    </tbody>
                                                    <tfoot id="search-message-daily-logs" style="display: none">
                                                        <td colspan="5"><h5 align="center">--------------------- NO RECORDS AVAILABLE ---------------------</h5></td>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                            </div>
                          </div>
                          <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="camera-tab">
                              
                                <div class="x_panel" >
                                <div class="x_title">
                                    <img src="../../images/tenant_logs.png" width="40px" height="40px">
                                    <h3 style="margin-left:50px; margin-top:-30px; font-size: 20px">All tenant logs</h3>
                                    <div class="clearfix"></div>
                                    
                                </div>
                                <div class="x_content">
                                    <div class="title_right">
                                        <div class="col-md-4 col-sm-5 col-xs-12 form-group pull-right top_search">
                                            <div class="input-group" >
                                                <input type="text" id="search-all-logs" class="form-control" placeholder="Search for..." style="font-size: 16px; background-color:#eee;">
                                                <span class="input-group-btn">
                                                <button class="btn btn-primary" type="button" id="search-all-logs-icon"><span class="fa fa-search" style="color:white"></span> </button>
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
                                                            <th class="column-title">Time</th>
                                                            <th class="column-title">Date</th>
                                                            <th class="column-title">Logs</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="tbody-all-logs">
                                                       
                                                       <?php echo allTenantLogs(); ?>
                                                    </tbody>
                                                    <tfoot id="search-message-all-logs" style="display: none">
                                                        <td colspan="5"><h5 align="center">--------------------- NO RECORDS AVAILABLE ---------------------</h5></td>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                            </div>
                          </div>

                          <div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="camera-tab">
                              
                                <div class="x_panel" >
                                <div class="x_title">
                                    <img src="../../images/tenant-list.png" width="40px" height="40px">
                                    <h3 style="margin-left:50px; margin-top:-30px; font-size: 20px">Unreturned tenant</h3>
                                    <div class="clearfix"></div>
                                    
                                </div>
                                <div class="x_content">
                                    <div class="title_right">
                                        <div class="col-md-4 col-sm-5 col-xs-12 form-group pull-right top_search">
                                            <div class="input-group" >
                                                <input type="text" id="search-unreturned-tanant" class="form-control" placeholder="Search for..." style="font-size: 16px; background-color:#eee;">
                                                <span class="input-group-btn">
                                                <button class="btn btn-primary" type="button" id="search-unreturned-tanant-icon"><span class="fa fa-search" style="color:white"></span> </button>
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
                                                            <th class="column-title">Date timeout</th>
                                                            <th class="column-title">Total time left</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="tbody-unreturned-tanant">
                                                        <?php echo unreturnedTenant(); ?>
                                                    </tbody>
                                                    <tfoot id="search-message-unreturned-tenant" style="display: none">
                                                        <td colspan="4"><h5 align="center">--------------------- NO RECORDS AVAILABLE ---------------------</h5></td>
                                                    </tfoot>
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
    <!-- WEB CAMERA -->
    <script src="../../plugins/camera/webcam.js"></script>
	<!-- Custom Theme Scripts -->  
    <script src="../../templates/gentelella-master/js/custom.min.js"></script>
	 <!-- My clock -->  
	<script src="../../templates/myjs/clock.js" ></script>
	<script type="text/javascript">

    $(document).ready(function() {
        $('#search-daily-logs').keyup(function() {
            $("#search-daily-logs-icon").html("<span class='fa fa-spinner fa-spin' style='color: white'></span>");
            var rex = new RegExp($(this).val(), 'i');

            $('.tbody-daily-logs tr').hide();
            $('.tbody-daily-logs tr').filter(function() {
                return rex.test($(this).text());
            }).show();

             var total_daily_logs = $('.tbody-daily-logs tr').length;
             var rows = $('.tbody-daily-logs tr:hidden').length;

             if(rows == total_daily_logs) {
                $("#search-message-daily-logs").show();
            }
            else {
                $("#search-message-daily-logs").hide();
            }
            setTimeout(function() {
                $("#search-daily-logs-icon").html("<span class='fa fa-search' style='color:white'></span>");
            }, 2000);
        });

        $('#search-all-logs').keyup(function() {
            $("#search-all-logs-icon").html("<span class='fa fa-spinner fa-spin' style='color: white'></span>");
            var rex = new RegExp($(this).val(), 'i');

            $('.tbody-all-logs tr').hide();
            $('.tbody-all-logs tr').filter(function() {
                return rex.test($(this).text());
            }).show();

             var rows = $('.tbody-all-logs tr:hidden').length;
             var total_all_logs = $('.tbody-all-logs tr').length;

             if(rows == total_all_logs) {
                $("#search-message-all-logs").show();
            }
            else {
                $("#search-message-all-logs").hide();
            }
            setTimeout(function() {
                $("#search-all-logs-icon").html("<span class='fa fa-search' style='color:white'></span>");
            }, 2000);
        });

        $('#search-unreturned-tanant').keyup(function() {
            $("#search-unreturned-tanant-icon").html("<span class='fa fa-spinner fa-spin' style='color: white'></span>");
            var rex = new RegExp($(this).val(), 'i');

            $('.tbody-unreturned-tanant tr').hide();
            $('.tbody-unreturned-tanant tr').filter(function() {
                return rex.test($(this).text());
            }).show();

             var rows = $('.tbody-unreturned-tanant tr:hidden').length;
             var total_unreturned_tanant = $('.tbody-unreturned-tanant tr').length;

             if(rows == total_unreturned_tanant) {
                $("#search-message-unreturned-tenant").show();
            }
            else {
                $("#search-message-unreturned-tenant").hide();
            }
            setTimeout(function() {
                $("#search-unreturned-tanant-icon").html("<span class='fa fa-search' style='color:white'></span>");
            }, 2000);
        });

    });

               
    </script>
  </body>
</html>
