<?php 
    include_once("../../controllers/auth.php"); 
    include_once("../../controllers/user_data.php");
    include_once("../../controllers/dashboard.php");
    homeAuth(); 
    $widget = widget();
    $calendar = calendar();
    $graph = graph();
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

    <title>Dashboard || DMMS</title>

    <!-- Bootstrap -->
    <link href="../../templates/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../../plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../../plugins/nprogress/nprogress.css" rel="stylesheet">
    <!-- bootstrap-progressbar -->
    <link href="../../plugins/bootstrap-progressbar/css/bootstrap-progressbar-3.3.2.min.css" rel="stylesheet">
    <!-- Calendar  -->
    <link href="../../plugins/fullcalendar/dist/fullcalendar.css" rel="stylesheet" type="text/css">
    <!-- Custom Theme Style -->
    <link href="../../templates/gentelella-master/css/custom.min.css" rel="stylesheet">
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
				  	<img src="../../images/widget.png" width="40px" height="40px">
					<h3 style="margin-left:50px; margin-top:-30px; font-size: 20px">Widget</h3>
					<div class="clearfix"></div>
			  	</div>
			  	<div class="x_content">
					<div class="col-md-12 col-sm-12 col-xs-12 hidden-print">
						<div class="row tile_count">
                            
                            <div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-6">
                                <div class="tile-stats" style="border: 1px solid #73879c">
                                    <div class="icon" style="margin-right: 10px;"><img src="../../images/borders.png" >
                                    </div>
                                    <div class="count"><?php echo $widget['tenants']; ?></div>
                                    <h3>Tenants</h3>
                                    <p>Registered</p>
                                </div>
                            </div>
                            <div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-6">
                                <div class="tile-stats" style="border: 1px solid #73879c">
                                    <div class="icon" style="margin-right: 30px;"><img src="../../images/tenants_active.png" >
                                    </div>
                                    <div class="count"><?php echo $widget['tenant_active']; ?></div>
                                    <h3>Tenants</h3>
                                    <p>Active</p>
                                </div>
                            </div>
                            <div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-6">
                                <div class="tile-stats" style="border: 1px solid #73879c">
                                    <div class="icon" style="margin-right: 30px;"><img src="../../images/tenants_inactive.png" >
                                    </div>
                                    <div class="count"><?php echo $widget['tenant_inactive']; ?></div>
                                    <h3>Tenants</h3>
                                    <p>Inactive</p>
                                </div>
                            </div>

                            <div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-6" >
                                <div class="tile-stats" style="border: 1px solid #73879c">
                                    <div class="icon" style="margin-right: 10px;"><img src="../../images/users.png" >
                                    </div>
                                    <div class="count"><?php echo $widget['users']; ?></div>
                                    <h3>Users</h3>
                                    <p>Authorized</p>
                                </div>
                            </div>


                            <div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-6">
                                <div class="tile-stats" style="border: 1px solid #73879c">
                                    <div class="icon" style="margin-right: 10px;"><img src="../../images/room-home.png" >
                                    </div>
                                    <div class="count"><?php echo $widget['rooms']; ?></div>
                                    <h3>Rooms</h3>
                                    <p>Registered</p>
                                </div>
                            </div>

                        </div>
					</div>
				</div>
			</div>

			<div class="x_panel">
				<div class="x_title">
					<img src="../../images/charts.png" width="40px" height="40px">
                    <h3 style="margin-left:50px; margin-top:-30px; font-size: 20px">Graphical chart</h3>
                    <div class="clearfix"></div>
			  	</div>
			  	<div class="x_content">
					<div id="chartdiv1" style="width: 100%; height: 550px; background-color: rgba(222, 220, 234, 0.9);"></div>
				</div>
			</div>

            <div class="x_panel">
              <div class="x_title">
                <img src="../../images/calendar.png" width="40px" height="40px">
                <h3 style="margin-left:60px; margin-top:-38px; ">Payment calendar</h3>
                <div class="clearfix"></div>
              </div>
              <div class="x_content">
                <div id='calendar' style="background-color: rgba(222, 220, 234, 0.8);"></div>

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
	<script src="../../templates/myjs/clock.js"></script>
	<!-- Armcharts -->
	<script src="../../plugins/amcharts/amcharts.js"></script>
	<script src="../../plugins/amcharts/pie.js"></script>
	<script src="../../plugins/amcharts/plugins/export/export.js"></script>
	<script src="../../plugins/amcharts/serial.js"></script>
    <script src="../../plugins/moment/min/moment.min.js" type="text/javascript"></script>
    <script src="../../plugins/fullcalendar/dist/fullcalendar.min.js" type="text/javascript"></script>
    <script type="text/javascript">
      var chartData = [<?php echo $graph; ?>]
      var chart = AmCharts.makeChart("chartdiv1", {
          type: "serial",
          dataProvider: chartData,
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
      chart.addTitle("INCOME IN YEAR"+"<?php echo date("Y"); ?>", 16);
      chart.addListener("clickGraphItem", function(event) {

      });
        init_calendar();
            
            function  init_calendar() {
                    
                if( typeof ($.fn.fullCalendar) === 'undefined'){ return; }
                //console.log('init_calendar');
                    
                var date = new Date(),
                    d = date.getDate(),
                    m = date.getMonth(),
                    y = date.getFullYear(),
                    started,
                    categoryClass;

                var calendar = $('#calendar').fullCalendar({
                  header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: ''
                  },
                  selectable: true,
                  selectHelper: true,
                  select: function(start, end, allDay) {
                    $('#fc_create').click();

                    started = start;
                    ended = end;

                    $("#antoform").on("submit", function(e) {
                    
                        
                      if (end) {
                        ended = end;
                      }

                      categoryClass = $("#event_type").val();

                      if (title) {
                        calendar.fullCalendar('renderEvent', {
                            title: "Event: "+title,
                            start: started,
                            end: end,
                            allDay: allDay
                          },
                          true // make the event "stick"
                        );
                      }

                      $('#title').val('');
                        $('#descr').val('');

                      calendar.fullCalendar('unselect');

                      $('.antoclose').click();

                      return false;
                    });
                  },
                  eventClick: function(calEvent, jsEvent, view) {
                     
                      
                  },
                  editable: false,
                  events: [<?php echo $calendar; ?>],
                   
                });
                
            };
    </script>
  </body>
</html>
