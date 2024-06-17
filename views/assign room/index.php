<?php 
    include_once("../../controllers/auth.php"); 
    include_once("../../controllers/user_data.php"); 
    include_once("../../controllers/bed.php"); 
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
     <!-- select -->
    <link rel="stylesheet" type="text/css" href="../../plugins/select2/dist/css/select2.css">
    <!-- My Style -->
    <link href="../../templates/mycss/css.css" rel="stylesheet">
    <!-- PHP SCRIPTS. -->
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
				  	<img src="../../images/bed.png" width="40px" height="40px">
                    <h3 style="margin-left:50px; margin-top:-30px; font-size: 20px">Assign bed</h3>
                    <div class="clearfix"></div>
                    <div class="btn-group pull-right" style="margin-top:-38px">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-add-room">
                         <i class="fa fa-plus"></i> Assign bed</button>
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
                                        <tr class="headings">
                                            <th class="column-title">#</th>
                                            <th class="column-title">Room no</th>
                                            <th class="column-title text-center">Bed no</th>
                                            <th class="column-title">Tenant name</th>
                                            <th class="column-title">Tenant type</th>
                                            <th class="column-title">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="tbody-room">
                                        <?php echo selectAllBeds(); ?>
                                    </tbody>
                                    <tfoot id="search-message-room" style="display: none">
                                        <td colspan="6"><h5 align="center">--------------------- NO RECORDS AVAILABLE ---------------------</h5></td>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>


                    <form id="assign_bed_form"">
                          <div class="modal fade" id="modal-add-room" role="dialog">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                  <h4 class="modal-title" id="myModalLabel" style="font-weight:bold;"><i class="fa fa-plus"></i> ASSIGN BED</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                
                                                <br>
                                                <label class="col-md-12 col-sm-12 col-xs-12 form-group">Borrower: </label>
                                                <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                                    <select class="form-control select2 has-feedback-left" required="" name="tenant_id" id="tenant_id" style="background-color:#e2e2e2; width:100%">
                                                        <?php echo renderTenantCat(); ?>
                                                    </select>
                                                </div>

                                                <label class="col-md-12 col-sm-12 col-xs-12 form-group" for="tenant_type">Tenant type: </label>
                                                <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                                    <select class="form-control" style="background-color:#eee;"  name="tenant_type" id="tenant_type" required>
                                                        <option style='background-color: gray; color:white' value='select' disabled selected>Select tenant type</option>
                                                        <option>Student</option>
                                                        <option>Faculty</option>
                                                        <option>Others</option>
                                                    </select>
                                                </div>

                                                <label class="col-md-12 col-sm-12 col-xs-12 form-group" for="room_id">Room no: </label>
                                                <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                                    <select class="form-control" style="background-color:#eee;"  name="room_id" id="room_id" required>
                                                        <?php echo renderRooms(); ?>
                                                    </select>
                                                </div>

                                                 <label class="col-md-12 col-sm-12 col-xs-12 form-group" for="bed_id">Bed no: </label>
                                                <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                                    <select class="form-control " style="background-color:#eee;"  name="bed_id" id="bed_id" required>
                                                        <option style='background-color: gray; color:white' value='select' disabled selected>Select bed no</option>
                                                    </select>
                                                </div>

                                                 <label class="col-md-12 col-sm-12 col-xs-12 form-group" for="date_started">Date started: </label>
                                                <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                                    <input type="date" name="date_started" id="date_started" class="form-control "  placeholder="Date stared" style="background-color:#eee;" required>
                                                </div>
                                   
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times-circle"></i> Close</button>
                                     <button type="submit" class="btn btn-primary"><i class="fa fa-save"> Save</i></button>
                                </div>

                                </div>
                              </div>
                            </div>
                      </form>


                   <form id="update_assign_bed_form">
                    <div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="modal-update-assign-bed">
                        <div class="modal-dialog modal-md">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                              </button>
                              <h4 class="modal-title" id="myModalLabel" style="font-weight:bold;"><i class="fa fa-edit"></i> UPDATE ASSIGN BED</h4>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <h2 id="alert-message"></h2>

                                                <label class="col-md-12 col-sm-12 col-xs-12 form-group" for="edit_tenant_name">Tenant name:</label>
                                                <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                                    <input type="text" name="edit_tenant_name" id="edit_tenant_name" class="form-control has-feedback-left"  placeholder="Tenant name" style="background-color:#eee;" required readonly>
                                                    <span class="fa fa-user form-control-feedback left" aria-hidden="true" style="color:black"></span>
                                                </div>

                                                <label class="col-md-12 col-sm-12 col-xs-12 form-group" for="edit_tenant_type">Tenant type: </label>
                                                <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                                     <select class="form-control has-feedback-left" name="edit_tenant_type" id="edit_tenant_type" style="background-color:#eee;"  required>
                                                    </select>
                                                    <span class="fa fa-sort-numeric-asc form-control-feedback left" aria-hidden="true" style="color:black"></span>
                                                </div>


                                                <label class="col-md-12 col-sm-12 col-xs-12 form-group" for="edit_room_id">Room no: </label>
                                                <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                                    <select class="form-control has-feedback-left" style="background-color:#eee;"  name="edit_room_id" id="edit_room_id" required>
                                                    </select>
                                                    <span class="fa fa-sort-numeric-asc form-control-feedback left" aria-hidden="true" style="color:black"></span>
                                                </div>

                                                <label class="col-md-12 col-sm-12 col-xs-12 form-group" for="edit_bed_id">Bed no: </label>
                                                <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                                    <select class="form-control has-feedback-left" style="background-color:#eee;"  name="edit_bed_id" id="edit_bed_id" required>
                                                        <option style='background-color: gray; color:white' value='select' disabled selected>Select bed no</option>
                                                    </select>
                                                    <span class="fa fa-sort-numeric-asc form-control-feedback left" aria-hidden="true" style="color:black"></span>
                                                </div>

                                                 <label class="col-md-12 col-sm-12 col-xs-12 form-group" for="edit_date_started">Date started: </label>
                                                <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                                    <input type="date" name="edit_date_started" id="edit_date_started" class="form-control has-feedback-left"  placeholder="Date stared" style="background-color:#eee;" required>
                                                    <span class="fa fa-calendar form-control-feedback left" aria-hidden="true" style="color:black"></span>
                                                </div>

                                            </div>
                                        </div>
                                    <br>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <button type="reset" class="btn btn-danger" data-dismiss="modal"><i class="glyphicon glyphicon-remove-sign"></i> Cancel</button>
                                    <button type="submit" name="submit" class="btn btn-primary"><i class="fa fa-save" aria-hidden="true"></i> Submit</button>
                                </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </form>
       


                      <div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="modal-view-tenants">
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
                                        <h4>Room no: Room 1</h4>
                                        <hr  class="border-bottom">
                                        <div class="table-responsive">
                                            <table class="table table-striped">
                                              <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Tenant Name</th>
                                                    <th>Gender</th>
                                                    <th>Address</th>
                                                </tr>
                                              </thead>
                                              <tbody>
                                                <tr>
                                                    <td>1</td>
                                                    <td>Mark Balinario</td>
                                                    <td>Male</td>
                                                    <td>Sagay city</td>
                                                     
                                                </tr>
                                                <tr>
                                                    <td>2</td>
                                                    <td>Eugene Padernal</td>
                                                    <td>Male</td>
                                                    <td>Sagay city</td>

                                                </tr>
                                               
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
    <!-- select --> 
    <script type="text/javascript" src="../../plugins/select2/dist/js/select2.js"></script>
	 <!-- My clock -->  
	<script src="../../templates/myjs/clock.js" ></script>
    <script src="../../templates/myjs/crud.js" ></script>
    
	<script type="text/javascript">

    var rentin_id = 0;
    var selected_tenant_id = 0;
    var selected_bed_id = 0;

    
    $(document).ready(function(){

        $('.select2').select2();
        $('#search-room').keyup(function() {
            $("#search-room-icon").html("<span class='fa fa-spinner fa-spin' style='color: white'></span>");
            var rex = new RegExp($(this).val(), 'i');

            $('.tbody-room tr').hide();
            $('.tbody-room tr').filter(function() {
                return rex.test($(this).text());
            }).show();

             var total_payment = $('.tbody-room tr').length;
             var rows = $('.tbody-room tr:hidden').length;

             if(rows == total_payment) {
                $("#search-message-room").show();
            }
            else {
                $("#search-message-room").hide();
            }
            setTimeout(function() {
                $("#search-room-icon").html("<span class='fa fa-search' style='color:white'></span>");
            }, 2000);
        });

        //ASSIGN TENANT BED
        $("#assign_bed_form").submit(function(e){
            e.preventDefault();
            $("#modal-add-room").modal("hide");
            var form = $("#assign_bed_form").serializeArray();
            form.push({name: 'action', value: 'insert'});

            if(form.length == 6) {
                try {
                    var query =  CRUD;
                    query.path = '../../controllers/bed.php';
                    query.param = form;
                    var response = query.run();
                    response = JSON.parse(response);

                    if(response == false) {
                        $("#assign_bed_form")[0].reset();
                        $("#modal-success").modal("show");
                        $(".modal-alert-message").text("Record is successfully saved.");
                        // alert("Record is successfully saved.");
                        setTimeout(function() {
                             window.location.reload();
                        }, 3000);
                       
                    }
                    else {
                        $("#modal-error").modal("show");
                        $(".modal-alert-message").text("Record is not save.");
                        //alert("Record is not save.")
                    }
               }
               catch(error) {
                $("#modal-error").modal("show");
                $(".modal-alert-message").text(error);
                 //alert(error);
               }
            }
            else {
                alert("Fill in all fields.");
            }
           
            
          
        });

        //UPDATE ASSIGN TENANT BED
        $("#update_assign_bed_form").submit(function(e){
            e.preventDefault();
            $("#modal-update-assign-bed").modal("hide");
            var form = $("#update_assign_bed_form").serializeArray();
            form.push({name: 'action', value: 'update'});
            form.push({name: 'rentin_id', value: rentin_id});
            form.push({name: 'edit_tenant_id', value: selected_tenant_id});
            console.log(form);

            if(form.length == 8) {
                try {
                    var query =  CRUD;
                    query.path = '../../controllers/bed.php';
                    query.param = form;
                    var response = query.run();
                    console.log(response);
                    response = JSON.parse(response);

                    if(response == false) {
                        $("#update_assign_bed_form")[0].reset();
                        $("#assign_bed_form")[0].reset();
                        $("#modal-information").modal("show");
                        $(".modal-alert-message").text("Record is successfully updated.");
                        setTimeout(function() {
                             window.location.reload();
                        }, 3000);
                        // alert("Record is successfully saved.");
                        // window.location.reload();
                    }
                    else {
                        $("#modal-error").modal("show");
                        $(".modal-alert-message").text("Record is not save.");
                        //alert("Record is not save.")
                    }
                }
                catch(error) {
                    $("#modal-error").modal("show");
                    $(".modal-alert-message").text(error);
                    //alert("Record is not save.")
                    //alert(error);
                }
            }
            else {
                alert("Fill in all fields.");
            }
          
        });

        //SELECT ROOM NO ADD FORM
        $("#room_id" ).change(function() {
            selectRoomNo($("#room_id" ).val(), "add");
        });

        //SELECT ROOM NO UPDATE FORM
        $("#edit_room_id").change(function() {
            selectRoomNo($("#edit_room_id" ).val(), "edit");
        });

    });


    function selectRoomNo(val, type) {
        try {
            var query =  CRUD;
            query.path = '../../controllers/bed.php';
            query.param = {
                action: "select",
                room_id: val
            };

            var response = query.run();
            response = JSON.parse(response);

            if(type == "add") {
                renderBeds(response);
            }
            else {
                console.log(response);
                renderBedsUpdate(response);
            }
        }
        catch(error){
            alert(error);
        }
    }

    function renderBeds(response) {
        var len = response.length;
        var html = "<option style='background-color: gray; color:white' value='select' disabled selected>Select bed no</option>";

        for(var i = 0; i < len; i++) {
            if(response[i].availability == "available") {
                 html = html + 
                "<option value='" + response[i].bed_id + "'>" + response[i].bed_no + "</option>";
            }
            else {
                 html = html + 
                "<option value='select' disabled value='" + response[i].bed_id + "'>" + response[i].bed_no + "</option>";
            }
        }
        $("#bed_id").html(html);
        
    }

    function renderBedsUpdate(response) {
        var len = response.length;
        var html = "";

        for(var i = 0; i < len; i++) {
            if(response[i].availability == "available") {
                 html = html + 
                "<option value='" + response[i].bed_id + "'>" + response[i].bed_no + "</option>";
            }
            else {
                if(selected_bed_id == response[i].bed_id) {
                    html = html + 
                    "<option value='" + response[i].bed_id + "' selected>" + response[i].bed_no + "</option>";
                }

                else {
                    html = html + 
                    "<option value='select' disabled value='" + response[i].bed_id + "'>" + response[i].bed_no + "</option>";
                }
            }
        }
        $("#edit_bed_id").html(html);
        
    }


    function editAssign(id) {
        rentin_id = id;
        $("#modal-update-assign-bed").modal("show");
        try {
            var query =  CRUD;
            query.path = '../../controllers/bed.php';
            query.param = {
                action: 'edit',
                rentin_id: id
            };
            var response = query.run();
            response = JSON.parse(response);
            renderEditAssign(response);
       }
       catch(error) {
         alert(error);
       }
    }

    function renderEditAssign(response) {
        var data = response.data;
        var tenant_list = response.tenant_list;
        var room_list = response.room_list;
        var bed_list = response.bed_list;

        var selected_name = data[0].fname + " " + data[0].mname + " " + data[0].lname;
        var selected_type = data[0].tenant_type;
        var selected_room = data[0].room_no;
        selected_tenant_id = data[0].cust_id;
        selected_bed_id = data[0].bed_id;

        $("#edit_tenant_name").val(selected_name);

        if(room_list.length > 0) {

            var html = "";
            for(var i = 0; i < room_list.length; i++) {
               
                var room_id = room_list[i].room_id;
                if(data[0].room_id == room_id) {
                     html = html + 
                        "<option selected value='" + room_id + "'>Room " + room_list[i].room_no + "</option>";
                }
                else {
                     html = html + 
                        "<option value='" + room_id + "'>Room " + room_list[i].room_no + "</option>";
                }
               
            }
            $("#edit_room_id").html(html);
        }

        if(bed_list.length > 0) {

            var html = "";
            for(var i = 0; i < bed_list.length; i++) {
               
                var bed_id = bed_list[i].bed_id;
                if(data[0].bed_id == bed_id) {
                     html = html + 
                        "<option selected value='" + bed_id + "'>" + bed_list[i].bed_no + "</option>";
                }
                else {
                    if(bed_list[i].availability == "available") {
                        html = html + 
                            "<option value='" + bed_id + "'>" + bed_list[i].bed_no + "</option>";
                    }
                    else {
                         html = html + 
                            "<option value='" + bed_id + "' disabled>" + bed_list[i].bed_no + "</option>";
                    }
                }
               
            }
            $("#edit_bed_id").html(html);
        }

        if(selected_type == "Student") {
            $("#edit_tenant_type").html(
                '<option selected>Student</option>' +
                '<option >Faculty</option>' +
                '<option>Others</option>'
            );
        }
        else if(selected_type == "Faculty") {
            $("#edit_tenant_type").html(
                '<option>Student</option>' +
                '<option selected>Faculty</option>' +
                '<option>Others</option>'
            );
        }
        else {
            $("#edit_tenant_type").html(
                '<option>Student</option>' +
                '<option>Faculty</option>' +
                '<option selected>Others</option>'
            );
        }

        $("#edit_date_started").val(data[0].datein);
    }

    function cancelAssign(id) {
        try {
            var query =  CRUD;
            query.path = '../../controllers/bed.php';
            query.param = {
                action: 'remove',
                rentin_id: id
            };
            var response = query.run();
            response = JSON.parse(response);

            if(response == false) {
                $("#modal-information").modal("show");
                $(".modal-alert-message").text("Tenant is successfully removed.");
                setTimeout(function() {
                     window.location.reload();
                }, 2500);
                // alert("Tenant is successfully removed.");
                // window.location.reload();
            }
            else {
                $("#modal-error").modal("show");
                $(".modal-alert-message").text("Tenant not removed.");
                setTimeout(function() {
                     window.location.reload();
                }, 2000);
                 // alert('Tenant not removed.');
                 // window.location.reload();
            }
       }
       catch(error) {
         alert(error);
       }
    }

   
    </script>
  </body>
</html>
