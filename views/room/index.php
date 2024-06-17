<?php include_once("../../controllers/auth.php"); 
    include_once("../../controllers/user_data.php");
    include_once("../../controllers/room.php"); 
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
    <title>Room || DMMS</title>

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
				  	<img src="../../images/room-home.png" width="40px" height="40px">
                    <h3 style="margin-left:50px; margin-top:-30px; font-size: 20px">List of room</h3>
                    <div class="clearfix"></div>
                    <div class="btn-group pull-right" style="margin-top:-38px">
                       
                       
                         <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-add-room" style="margin-right: 4px;">
                         <i class="fa fa-plus"></i> Add room</button>
                         <a class="btn btn-success" download="ListOfRoom.xls" onclick="return ExcellentExport.excel(this, 'table-export', 'ListOfRoom');" style="margin-right: 4px;">
                            <i class="fa fa-file-excel-o"></i> Export</a>
                        <button onclick="printTable()" type="button" class="btn btn-primary" >
                         <i class="fa fa-print"></i> Print</button>
                    </div>
			  	</div>
			  	<div class="x_content">
                    <div class="title_right">
                        <div class="col-md-4 col-sm-5 col-xs-12 form-group pull-right top_search">
                            <div class="input-group" >
                                <input type="text" id="search-room" class="form-control" placeholder="Search for..." style="font-size: 16px; background-color:#eee;">
                                <span class="input-group-btn">
                                <button class="btn btn-primary" type="button" id="search-room-icon"><span class="fa fa-search" style="color:white"></span> </button>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="table-responsive">
                                <table id="datatable-buttons" class="table table-hover table-bordered">
                                    <thead>
                                    	<tr>
                                    		<th colspan="3"></th>
                                    		<th colspan="3" class="text-center">Bed rent amount</th>
                                    		<th colspan="3" class="text-center">Beds</th>
                                    		<th colspan="2"></th>
                                    	</tr>
                                        <tr class="headings">
                                            <th class="column-title">#</th>
                                            <th class="column-title">Room no</th>
                                            <th class="column-title">Description</th>
                                            <th class="column-title">Student</th>
                                            <th class="column-title">Faculty</th>
                                            <th class="column-title">Others</th>
                                            <th class="column-title" class="text-center">Total</th>
                                            <th class="column-title" class="text-center">Occupied</th>
                                            <th class="column-title" class="text-center">Available</th>
                                            <th class="column-title" class="text-center">Availability </th>
                                            <th class="column-title no-link last hidden-print"><span class="nobr">Action</span></th>
                                        </tr>
                                    </thead>
                                    <tbody class="tbody-room">
                                       <?php echo selectAllRoom(); ?>
                                    </tbody>
                                    <tfoot id="message-room" style="display: none">
                                        <td colspan="11"><h5 align="center">--------------------- NO RECORDS AVAILABLE ---------------------</h5></td>
                                    </tfoot>
                                </table>

                                <table id="table-export" class="table table-hover table-bordered hidden">
                                    <thead>
                                        <tr>
                                              <th colspan="10"><p style="font-size:16px">LIST OF ROOM</p></th>
                                          </tr>
                                        <tr>
                                            <th colspan="3"></th>
                                            <th colspan="3" class="text-center">Bed rent amount</th>
                                            <th colspan="3" class="text-center">Beds</th>
                                            <th colspan="2"></th>
                                        </tr>
                                        <tr class="headings">
                                            <th class="column-title">#</th>
                                            <th class="column-title">Room no</th>
                                            <th class="column-title">Description</th>
                                            <th class="column-title">Student</th>
                                            <th class="column-title">Faculty</th>
                                            <th class="column-title">Others</th>
                                            <th class="column-title" class="text-center">Total</th>
                                            <th class="column-title" class="text-center">Occupied</th>
                                            <th class="column-title" class="text-center">Available</th>
                                            <th class="column-title" class="text-center">Availability </th>
                                        </tr>
                                    </thead>
                                    </thead>
                                    <tbody class="tbody-room" id="print-data-tbody">
                                        
                                        <?php echo selectAllRoomHidden(); ?>
                                    </tbody>
                                   
                                </table>
                            </div>
                        </div>
                    </div>

                    <form id="add_room_form">
                    <div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="modal-add-room">
                        <div class="modal-dialog modal-md">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                              </button>
                              <h4 class="modal-title" id="myModalLabel" style="font-weight:bold;"><i class="fa fa-plus"></i> ADD ROOM</h4>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                            	<div id="alert-message">
                                                </div>
                                                <label class="col-md-12 col-sm-12 col-xs-12 form-group" for="room_no">Room no: </label>
                                                <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                                    <input type="number" name="room_no" id="room_no" max="100" min="1" class="form-control has-feedback-left"   style="background-color:#eee;" placeholder="Room no" required>
                                                    <span class="fa fa-sort-numeric-asc form-control-feedback left" aria-hidden="true" style="color:black"></span>
                                                </div>

                                                <label class="col-md-12 col-sm-12 col-xs-12 form-group" for="room_description">Description: </label>
                                                <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                                    <input type="text" name="room_description" id="room_description" max="100" min="1" class="form-control has-feedback-left"   style="background-color:#eee;" placeholder="Description" required>
                                                    <span class="fa fa-edit form-control-feedback left" aria-hidden="true" style="color:black"></span>
                                                </div>

                                                <label class="col-md-12 col-sm-12 col-xs-12 form-group" for="no_of_bed">No. of beds: </label>
                                                <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                                    <input type="number" name="no_of_bed" id="no_of_bed" max="100" min="1" class="form-control has-feedback-left"   style="background-color:#eee;" placeholder="No. of beds" required>
                                                    <span class="fa fa-edit form-control-feedback left" aria-hidden="true" style="color:black"></span>
                                                </div>

                                                <label class="col-md-12 col-sm-12 col-xs-12 form-group" for="student_rate">Student rate: </label>
                                                <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                                    <input type="number" name="student_rate" id="student_rate" max="1000000" min="1" class="form-control has-feedback-left"   style="background-color:#eee;" placeholder="Rate of bed" required>
                                                    <span class="fa fa-rub form-control-feedback left" aria-hidden="true" style="color:black"></span>
                                                </div>

                                                 <label class="col-md-12 col-sm-12 col-xs-12 form-group" for="faculty_rate">Faculty rate: </label>
                                                <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                                    <input type="number" name="faculty_rate" id="faculty_rate" max="1000000" min="1" class="form-control has-feedback-left"   style="background-color:#eee;" placeholder="Rate of bed" required>
                                                    <span class="fa fa-rub form-control-feedback left" aria-hidden="true" style="color:black"></span>
                                                </div>

                                                 <label class="col-md-12 col-sm-12 col-xs-12 form-group" for="other_rate">Other rate: </label>
                                                <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                                    <input type="number" name="other_rate" id="other_rate" max="1000000" min="1" class="form-control has-feedback-left"   style="background-color:#eee;" placeholder="Rate of bed" required>
                                                    <span class="fa fa-rub form-control-feedback left" aria-hidden="true" style="color:black"></span>
                                                </div>

                                            </div>
                                        </div>
                                <br>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="glyphicon glyphicon-remove-sign"></i> Cancel</button>
                                    <button type="submit" name="submit" class="btn btn-primary"><i class="fa fa-save" aria-hidden="true"></i> Submit</button>
                                </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </form>

                    <form id="update_room_form">
                      <div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="modal-update-room">
                        <div class="modal-dialog modal-md">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                              </button>
                              <h4 class="modal-title" id="myModalLabel" style="font-weight:bold;"><i class="fa fa-edit"></i> UPDATE ROOM</h4>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <div id="alert-message-update">
                                            </div>
                                            <label class="col-md-12 col-sm-12 col-xs-12 form-group" for="edit_room_no">Room no: </label>
                                            <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                                <input type="hidden" name='orig_room_no' id="orig_room_no">
                                                <input type="number" name="edit_room_no" id="edit_room_no" max="100" min="1" class="form-control has-feedback-left"   style="background-color:#eee;" placeholder="Room no" required>
                                                <span class="fa fa-sort-numeric-asc form-control-feedback left" aria-hidden="true" style="color:black"></span>
                                            </div>

                                            <label class="col-md-12 col-sm-12 col-xs-12 form-group" for="edit_room_description">Description: </label>
                                            <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                                <input type="text" name="edit_room_description" id="edit_room_description" max="100" min="1" class="form-control has-feedback-left"   style="background-color:#eee;" placeholder="Description" required>
                                                <span class="fa fa-edit form-control-feedback left" aria-hidden="true" style="color:black"></span>
                                            </div>

                                            <label class="col-md-12 col-sm-12 col-xs-12 form-group" for="edit_no_of_bed">No. of beds: </label>
                                            <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                                <input type="number" name="edit_no_of_bed" id="edit_no_of_bed" max="100" min="1" class="form-control has-feedback-left" style="background-color:#eee;" placeholder="No. of beds" required>
                                                <span class="fa fa-edit form-control-feedback left" aria-hidden="true" style="color:black"></span>
                                            </div>

                                           <label class="col-md-12 col-sm-12 col-xs-12 form-group" for="edit_student_rate">Student rate: </label>
                                                <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                                    <input type="number" name="edit_student_rate" id="edit_student_rate" max="1000000" min="1" class="form-control has-feedback-left"   style="background-color:#eee;" placeholder="Rate of bed" required>
                                                    <span class="fa fa-rub form-control-feedback left" aria-hidden="true" style="color:black"></span>
                                                </div>

                                                 <label class="col-md-12 col-sm-12 col-xs-12 form-group" for="edit_faculty_rate">Faculty rate: </label>
                                                <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                                    <input type="number" name="edit_faculty_rate" id="edit_faculty_rate" max="1000000" min="1" class="form-control has-feedback-left"   style="background-color:#eee;" placeholder="Rate of bed" required>
                                                    <span class="fa fa-rub form-control-feedback left" aria-hidden="true" style="color:black"></span>
                                                </div>

                                                 <label class="col-md-12 col-sm-12 col-xs-12 form-group" for="edit_other_rate">Other rate: </label>
                                                <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                                    <input type="number" name="edit_other_rate" id="edit_other_rate" max="1000000" min="1" class="form-control has-feedback-left"   style="background-color:#eee;" placeholder="Rate of bed" required>
                                                    <span class="fa fa-rub form-control-feedback left" aria-hidden="true" style="color:black"></span>
                                                </div>

                                        </div>
                                    </div>
                                <br>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="glyphicon glyphicon-remove-sign"></i> Cancel</button>
                                    <button type="submit" name="submit" class="btn btn-primary"><i class="fa fa-save" aria-hidden="true"></i> Submit</button>
                                </div>
                            </div>
                          </div>
                        </div>
                      </div>


                      <div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="modal-view-room">
                        <div class="modal-dialog modal-md">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                              </button>
                              <h4 class="modal-title" id="myModalLabel" style="font-weight:bold;"><i class="fa  fa-users"></i> ALL TENANT</h4>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <h4 style="font-weight: bold" id="room-selection">Room no: </h4>
                                        <hr  class="border-bottom">
                                        <div class="table-responsive">
                                            <table class="table table-striped">
                                              <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Tenant Name</th>
                                                    <th>Bed no</th>
                                                    <th>Gender</th>
                                                    <th>Address</th>
                                                </tr>
                                              </thead>
                                              <tbody id="room-view">
                                                
                                              </tbody>
                                            </table>
                                        </div>
                                    </div>
                                <br>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="glyphicon glyphicon-remove-sign"></i> Close</button>
                                </div>
                            </div>
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
    <!-- Export to excel  -->  
    <script src="../../plugins/excellentexport/excellentexport.js"></script>
    <script src="../../templates/myjs/crud.js" ></script>
	<script type="text/javascript">

    var room_id = "";
    var is_valid_total_bed = true;
    var total_bed_occupied = 0;

    $(document).ready(function(){ 

        $('#search-room').keyup(function() {
            $("#search-room-icon").html("<span class='fa fa-spinner fa-spin' style='color: white'></span>");
            var rex = new RegExp($(this).val(), 'i');

            $('.tbody-room tr').hide();
            $('.tbody-room tr').filter(function() {
                return rex.test($(this).text());
            }).show();

             var total_room = $('.tbody-room tr').length;
             var rows = $('.tbody-room tr:hidden').length;

             if(rows == total_room) {
                $("#message-room").show();
            }
            else {
                $("#message-room").hide();
            }
            setTimeout(function() {
                $("#search-room-icon").html("<span class='fa fa-search' style='color:white'></span>");
            }, 2000);
        });


        //SAVE NEW TENANT
        $("#add_room_form").submit(function(e){
            e.preventDefault();
            $("#modal-add-room").modal("hide");
            var form = $("#add_room_form").serializeArray();
            form.push({name: 'action', value: 'insert'});

           try {

            var query =  CRUD;
            query.path = '../../controllers/room.php';
            query.param = form;
            var response = query.run();
           	response = JSON.parse(response);

           	if(response.php_error == false) {
                $("#add_room_form")[0].reset();
                $("#modal-information").modal("show");
                $(".modal-alert-message").text(response.message);
                setTimeout(function() {
                     window.location.reload();
                }, 2500);
                // alert(response.message);
                // window.location.reload();
            }
            else {
                $("#modal-error").modal("show");
                $(".modal-alert-message").text(response.message);
                setTimeout(function() {
                     window.location.reload();
                }, 2500);
            	 // alert(response.message);
              //    window.location.reload();
            }

           }
           catch(error) {
           	alert(error);
           }
        });

        //UPDATE ROOM DETAILS
        $("#update_room_form").submit(function(e){
            e.preventDefault();
            $("#modal-update-room").modal("hide");
            var form = $("#update_room_form").serializeArray();
            form.push({name: 'action', value: 'update'});
            form.push({name: 'edit_room_id', value: room_id});
          
            try {
                if(is_valid_total_bed == true) {
                    var query =  CRUD;
                    query.path = '../../controllers/room.php';
                    query.param = form;
                    var response = query.run();
                    console.log(response);
                    response = JSON.parse(response);

                    if(response.php_error == false) {
                        $("#modal-information").modal("show");
                        $(".modal-alert-message").text(response.message);
                        setTimeout(function() {
                             window.location.reload();
                        }, 2500);
                        // alert(response.message);
                        // window.location.reload();
                    }
                    else {
                        $("#modal-error").modal("show");
                        $(".modal-alert-message").text(response.message);
                        setTimeout(function() {
                             $("#modal-error").modal("hide");
                        }, 2500);
                        //alert(response.message);
                    }
                }
                else {
                    $("#modal-error").modal("show");
                    $(".modal-alert-message").text('Assign total of bed more than ' + total_bed_occupied +'.');
                    setTimeout(function() {
                         $("#modal-error").modal("hide");
                    }, 2500);
                    //alert('Assign total of bed more than ' + total_bed_occupied +'.')
                }
            }
            catch(error) {
                alert(error);
            }
        });

        //SEARCH TENANT
        $("#room_no").keydown(function() {
           searchRoom("add");
        });
        $("#room_no").keyup(function() {
           searchRoom("add");
        });

        $("#edit_room_no").keydown(function() {
           searchRoom("edit");
        });
        $("#edit_room_no").keyup(function() {
           searchRoom("edit");
        });

        $("#edit_no_of_bed").keydown(function() {
           searchTotalBed();
        });
        $("#edit_no_of_bed").keyup(function() {
           searchTotalBed();
        });

    });


    function searchTotalBed() {
        try {
            var total_bed = $("#edit_no_of_bed").val();
            var query =  CRUD;
            query.path = '../../controllers/room.php';
            query.param = {
                action: "search_total_bed",
                room_id: room_id
            };
            var response = query.run();
            response = JSON.parse(response);

            if(response.length > 0) {
                if(response[0].bed_no > total_bed) {

                    total_bed_occupied = response[0].bed_no;
                    is_valid_total_bed = false;
                    $("#alert-message-update").html(
                        '<div class="alert alert-danger" role="alert">' +
                          '<strong><span class="fa fa-times-circle"></span> Assign total of bed more than ' + response[0].bed_no +'.</strong>' +
                        '</div>'
                    );
                }
                else {
                    is_valid_total_bed = true;
                    $("#alert-message-update").html("");
                }
            }
            
        }
        catch(error) {
            alert(error);
        }
    }


    function searchRoom(type) {
	    try {
            var room_no = (type == "add") ? $("#room_no").val() : $("#edit_room_no").val();
            var query =  CRUD;
            query.path = '../../controllers/room.php';
            query.param = {
                action: "search",
                input: room_no
            };
            var response = query.run();

	    	response = JSON.parse(response);
	    	if(response.length >= 1) {
                alertMessage(type, room_no, response);
	    	}
	    	else {
                if(type == "add") {
                    $("#alert-message").html("");
                }
                else {
                    $("#alert-message-update").html("");
                }
	    	}
	    }
	    catch(error) {
	    	alert(error);
	    }
	}


    function alertMessage(type, room_no, response) {
         if(type == "add") {
            $("#alert-message").html(
                '<div class="alert alert-danger" role="alert">' +
                  '<strong><span class="fa fa-times-circle"></span> Room '  + room_no + ' is already exist</strong>' +
                '</div>'
            );
        }
        else {
            if(response[0].room_id != room_id) {
                 $("#alert-message-update").html(
                    '<div class="alert alert-danger" role="alert">' +
                      '<strong><span class="fa fa-times-circle"></span> Room '  + room_no + ' is already exist</strong>' +
                    '</div>'
                );
            }
        }
    }

    function editRoom(id) {
        room_id = id;
        try {
            var query =  CRUD;
            query.path = '../../controllers/room.php';
            query.param = {
                action: "edit",
                input: id
            };

            var response = query.run();
            response = JSON.parse(response);
            renderEditForm(response[0]);
        }
        catch(error) {
            alert(error);
        }
    }

    function renderEditForm(response) {
        $("#edit_room_no").val(response.room_no);
        $("#orig_room_no").val(response.room_no);
        $("#edit_room_description").val(response.details);
        $("#edit_no_of_bed").val(response.total_bed);
        $("#edit_student_rate").val(response.student_rate);
        $("#edit_faculty_rate").val(response.faculty_rate);
        $("#edit_other_rate").val(response.other_rate);
        $("#alert-message-update").html("");
        $("#modal-update-room").modal('show');
    }

    function viewRoom(id) {
        $("#modal-view-room").modal('show');
        try {
            var total_bed = $("#edit_no_of_bed").val();
            var query =  CRUD;
            query.path = '../../controllers/room.php';
            query.param = {
                action: "view-room",
                room_id: id
            };
            var response = query.run();
            console.log(response);
            response = JSON.parse(response);
            renderViewRoom(response);
        }
        catch(error) {
            alert(error);
        }
    }

    function renderViewRoom(response) {
        var html = "";
        var room_no = "";

        if(response.length > 0) {
            for(var i = 0; i < response.length; i++) {
                var name = response[i].fname + " " + response[i].mname + " " + response[i].lname;
                room_no = response[i].room_no;
                html = html +
                    '<tr>' +
                        '<td>' + (i + 1) + '</td>'+
                        '<td>' + name + '</td>'+
                        '<td>' + response[i].bed_no + '</td>'+
                        '<td>' + response[i].gender + '</td>'+
                        '<td>' + response[i].address + '</td>'+
                    '</tr>';
            }
        }
        else {
            html = html +
                '<tr>' +
                    '<td class="text-center" colspan="5"><h4>-------------------- No records available. -------------------</h4></td>'+
                '</tr>';
        }
        $("#room-selection").text("Room no: " + room_no);
        $("#room-view").html(html);
    }

    function printTable() {
        var html = document.getElementById("print-data-tbody");
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
                         <center><h3 id="title_name">LIST OF ROOMS</h3></center>\
                        <br>\
                         <thead>\
                        <table class="table">\
                            <thead>\
                                <tr>\
                                <th style="border: 1px solid black" colspan="3"></th>\
                                <th style="border: 1px solid black" colspan="3" class="text-center">Bed rent amount</th>\
                                <th style="border: 1px solid black" colspan="3" class="text-center">Beds</th>\
                                <th style="border: 1px solid black" colspan="2"></th>\
                            </tr>\
                            <tr>\
                                <th style="border: 1px solid black">#</th>\
                                <th width="" style="border: 1px solid black">Room no</th>\
                              <th width="" style="border: 1px solid black">Description</th>\
                              <th width="" style="border: 1px solid black">Student</th>\
                              <th width="" style="border: 1px solid black">Faculty Name</th>\
                              <th width="" style="border: 1px solid black">Others</th>\
                              <th width="" style="border: 1px solid black">Total</th>\
                              <th width="" style="border: 1px solid black">Occupied</th>\
                              <th width="" style="border: 1px solid black">Available</th>\
                              <th width="" style="border: 1px solid black">Availability</th>\
                              </tr>\
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
