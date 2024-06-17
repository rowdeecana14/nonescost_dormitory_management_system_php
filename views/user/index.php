<?php 
    include_once("../../controllers/auth.php");
    include_once("../../controllers/user_data.php");
    include_once("../../controllers/user.php");
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

             <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="" role="tabpanel" data-example-id="togglable-tabs">
                        <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                          <li role="presentation" class="active" ><a href="#tab_content1" id="upload-tab" role="tab" data-toggle="tab" aria-expanded="true">
                            <span class="badge bg-gray "><i class="fa fa-edit"></i></span> Register</a>
                          </li>
                          <li role="presentation" class=""><a href="#tab_content2" role="tab" id="camera-tab" data-toggle="tab" aria-expanded="false"><span class="badge bg-gray "><i class="fa fa-table"></i></span> Record</a>
                          </li>
                        </ul>
                        <div id="myTabContent" class="tab-content">
                          <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="upload-tab">
                            <div class="x_panel" >
                                <div class="x_title">
                                    <img src="../../images/tenant-add.png" width="40px" height="40px">
                                    <h3 style="margin-left:50px; margin-top:-30px; font-size: 20px">User register</h3>
                                    <div class="clearfix"></div>
                                    
                                </div>
                                <div class="x_content">
                                    <?php require_once("../../controllers/include/modal_alert.php"); ?>
                                    <form id="new_user_form">
                                        <div class="row"> 
                                            <div class="col-md-12 col-sm-12 col-xs-12">

                                               <div class="col-md-12 col-sm-12 col-xs-12">
                                                    <h1 class="form-title">Personal Data</h1>
                                                    <hr  class="border-bottom">
                                                </div>
                                               
                                                <div class="col-md-6 col-sm-12 col-xs-12">
                                                    <label class="col-md-12 col-sm-12 col-xs-12 form-group" for="user_fname">First Name: </label>
                                                    <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                                        <input type="text" name="user_fname" id="user_fname" class="form-control has-feedback-left"  placeholder="First Name" style="text-transform:capitalize; background-color:#eee;" required>
                                                        <span class="fa fa-user form-control-feedback left" aria-hidden="true" style="color:black"></span>
                                                    </div>

                                                   
                                                    <label class="col-md-12 col-sm-12 col-xs-12 form-group" for="user_lname">Last Name: </label>
                                                    <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                                        <input type="text" name="user_lname" id="user_lname" class="form-control has-feedback-left"  placeholder="Last Name" style="text-transform:capitalize; background-color:#eee;" required>
                                                        <span class="fa fa-user form-control-feedback left" aria-hidden="true" style="color:black"></span>
                                                    </div>

                                                    <label class="col-md-12 col-sm-12 col-xs-12 form-group" for="user_gender">Gender: </label>
                                                    <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                                        <select name="user_gender" id="user_gender" class="form-control has-feedback-left" style="background-color:#eee; " required>
                                                            <option selected disabled value="">Select gender</option>
                                                            <option>Male</option>
                                                            <option>Female</option>
                                                        </select>
                                                        <span class="fa fa-venus-double form-control-feedback left" aria-hidden="true" style="color:black"></span>
                                                    </div>

                                                     <label class="col-md-12 col-sm-12 col-xs-12 form-group" for="user_bdate">Birth Date: </label>
                                                    <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                                        <input type="date" name="user_bdate" id="user_bdate" class="form-control has-feedback-left"   style="background-color:#eee;" required>
                                                        <span class="fa fa-calendar form-control-feedback left" aria-hidden="true" style="color:black"></span>
                                                    </div>

                                                </div>
                                                <div class="col-md-6 col-sm-12 col-xs-12">
                                                   

                                                    <label class="col-md-12 col-sm-12 col-xs-12 form-group" for="user_position">Position: </label>
                                                    <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                                        <select name="user_position" id="user_position" class="form-control has-feedback-left" style="background-color:#eee; " required>
                                                            <option selected disabled value="">Select position</option>
                                                            <option>Admin</option>
                                                            <option>Staff</option>
                                                        </select>
                                                        <span class="fa fa-users form-control-feedback left" aria-hidden="true" style="color:black"></span>
                                                    </div>

                                                   

                                                    <label class="col-md-12 col-sm-12 col-xs-12 form-group" for="user_address">Address: </label>
                                                    <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                                        <input type="text" name="user_address" id="user_address" class="form-control has-feedback-left"  placeholder="Address" style="text-transform:capitalize; background-color:#eee;" required>
                                                        <span class="fa fa-map-marker form-control-feedback left" aria-hidden="true" style="color:black"></span>
                                                    </div>

                                                    <label class="col-md-12 col-sm-12 col-xs-12 form-group" for="user_contact">Contact no: </label>
                                                    <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                                        <input type="number" name="user_contact" id="user_contact" maxlength="11" class="form-control has-feedback-left"  placeholder="Contact number" style="background-color:#eee;" required>
                                                        <span class="fa fa-phone form-control-feedback left" aria-hidden="true" style="color:black"></span>
                                                    </div>

                                                </div>
                                            </div>


                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                    <br>
                                                     <h1 class="form-title">Account Data</h1>
                                                    <hr  class="border-bottom">

                                                    <div class="col-md-8 col-sm-12 col-xs-12">
                                                        <label class="col-md-12 col-sm-12 col-xs-12 form-group" for="username">Username: </label>
                                                        <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                                            <input type="text" name="username" id="username" class="form-control has-feedback-left"  placeholder="Username" style=" background-color:#eee;" required>
                                                            <span class="fa fa-user form-control-feedback left" aria-hidden="true" style="color:black"></span>
                                                        </div>

                                                        <label class="col-md-12 col-sm-12 col-xs-12 form-group" for="user_password">Password: </label>
                                                        <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                                            <input type="password" name="user_password" id="user_password" class="form-control has-feedback-left"  placeholder="Password" style=" background-color:#eee;" required>
                                                            <span class="fa fa-user form-control-feedback left" aria-hidden="true" style="color:black"></span>
                                                        </div>

                                                        <label class="col-md-12 col-sm-12 col-xs-12 form-group" for="confirm_password">Confirm Password: </label>
                                                        <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                                            <input type="password" name="confirm_password" id="confirm_password" class="form-control has-feedback-left"  placeholder="Confirm password" style=" background-color:#eee;" required>
                                                            <span class="fa fa-key form-control-feedback left" aria-hidden="true" style="color:black"></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                                        <div class="col-md-8 col-sm-12 col-xs-12" id="pass_match">
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-12 col-sm-12 col-xs-12 form-group" style="margin-left: 10px;">
                                                <div class="col-md-5 col-sm-12 col-xs-12">
                                                </div>
                                                <div class="col-md-6 col-sm-12 col-xs-12">
                                                    <br><br>
                                                    <button type="reset" class="btn btn-danger"><i class="fa fa-eraser" aria-hidden="true"></i> Reset</button>
                                                    <button type="submit" name="submit" class="btn btn-primary"><i class="fa fa-save" aria-hidden="true"></i> Submit</button>
                                                </div>
                                                
                                            </div>
                                        </div>

                                    </form>
                                </div>
                            </div>
                          </div>
                          <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="camera-tab">
                              
                                <div class="x_panel" >
                                <div class="x_title">
                                    <img src="../../images/tenant-list.png" width="40px" height="40px">
                                    <h3 style="margin-left:50px; margin-top:-30px; font-size: 20px">User record</h3>
                                    <div class="clearfix"></div>
                                    <div class="btn-group pull-right" style="margin-top:-38px">
                                       
                                         <a class="btn btn-success" download="ListOfUsers.xls" onclick="return ExcellentExport.excel(this, 'table-export', 'ListOfUsers');" style="margin-right: 4px;">
                                         <i class="fa fa-file-excel-o"></i> Export</a>
                                        <button onclick="printTable()" type="button" class="btn btn-primary" >
                                         <i class="fa fa-print"></i> Print</button>
                                    </div>
                                </div>
                                <div class="x_content">
                                    <div class="title_right">
                                        <div class="col-md-4 col-sm-5 col-xs-12 form-group pull-right top_search">
                                            <div class="input-group" >
                                                <input type="text" id="search-user" class="form-control" placeholder="Search for..." style="font-size: 16px; background-color:#eee;">
                                                <span class="input-group-btn">
                                                <button class="btn btn-primary" type="button" id="search-user-icon"><span class="fa fa-search" style="color:white"></span> </button>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <div class="table-responsive">
                                                <table id="datatable-buttons" class="table table-hover">
                                                    <thead>
                                                        <tr class="headings">
                                                            <th class="column-title">#</th>
                                                            <th class="column-title">Profile</th>
                                                            <th class="column-title">Fullname</th>
                                                            <th class="column-title">Position</th>
                                                            <th class="column-title">Address</th>
                                                            <th class="column-title">Contact</th>
                                                            <th class="column-title">Status</th>
                                                            <th class="column-title no-link last hidden-print"><span class="nobr">Action</span></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="tbody-user">
                                                        
                                                        <?php echo allUsers(); ?>
                                                    </tbody>
                                                    <tfoot id="search-message-user" style="display: none">
                                                        <td colspan="8"><h5 align="center">--------------------- NO RECORDS AVAILABLE ---------------------</h5></td>
                                                    </tfoot>
                                                </table>

                                                 <table id="table-export" class="table table-hover hidden">
                                                    <thead>
                                                         <tr>
                                                              <th colspan="9"><p style="font-size:16px">LIST OF USER</p></th>
                                                          </tr>
                                                        <tr class="headings">
                                                            <th class="column-title">#</th>
                                                            <th class="column-title">Fullname</th>
                                                            <th class="column-title">Gender</th>
                                                            <th class="column-title">Birthdate</th>
                                                            <th class="column-title">Position</th>
                                                            <th class="column-title">Address</th>
                                                            <th class="column-title">Contact</th>
                                                            <th class="column-title">Date registered</th>
                                                            <th class="column-title">Status</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="tbody-user" id="print-data-tbody">
                                                        
                                                        <?php echo allUsersHidden(); ?>
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


            
              <form id="form-user-profile">
                    <div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="modal-user-profile">
                        <div class="modal-dialog modal-md">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" id="top-close-btn"><span aria-hidden="true">×</span>
                              </button>
                              <h4 class="modal-title" id="myModalLabel" style="font-weight:bold;"><i class="fa  fa-camera"></i>  UPDATE TENANT PROFILE</h4>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                       <div class="" role="tabpanel" data-example-id="togglable-tabs">
                                            <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                                              <li role="presentation" class="active" onclick="select('upload')"><a href="#tab_content1" id="upload-tab" role="tab" data-toggle="tab" aria-expanded="true">Upload photo</a>
                                              </li>
                                              <li role="presentation" class="" onclick="select('camera')"><a href="#tab_content2" role="tab" id="camera-tab" data-toggle="tab" aria-expanded="false">Take camera</a>
                                              </li>
                                             
                                            </ul>
                                            <div id="myTabContent" class="tab-content">
                                              <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="upload-tab">
                                                <input type="hidden" name="action" value="upload">
                                                <input type="hidden" name="tenant_id"  id="tenant_id">
                                                <center>
                                                    <img  id="image-preview" src="../../images/UPLOADED/unknown.png" class="image-preview" style="border: 2px solid gray;"/>
                                                     <input type="file" class="form-control" style="width: 60%" id="image-source" onchange="previewImage();" name="image-source"  accept="image/png, image/jpeg, image/gif" required>
                                                </center>

                                              </div>
                                              <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="camera-tab">
                                                   <center>
                                                        <div id="my_camera" class="my_camera"></div>
                                                        <img src="../../images/UPLOADED/unknown.png" id="image_capture" class="image_capture" />
                                                        <input type="hidden" name="camera" id="camera" value="">

                                                        <div class="camera-btns">
                                                            <button type="button" class="btn btn-default" id="reset_camera">
                                                            <span class="adminpro-icon adminpro-danger-error"></span> Reset
                                                            </button>
                                                            <button type="button" class="btn btn-default" id="capture_photo">
                                                                <span class="adminpro-icon adminpro-checked-pro"></span> Capture 
                                                            </button>
                                                        </div>
                                                    </center>
                                                    
                                              </div>


                                            </div>
                                          </div>
                                    </div>
                                <br>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <button type="reset" class="btn btn-danger" id="close_btn"><i class="glyphicon glyphicon-remove-sign"></i> Close</button>
                                     <button type="button" class="btn btn-primary" id="submit-btn"><i class="fa fa-save"></i> Submit</button>
                                </div>
                            </div>
                          </div>
                        </div>
                      </div>
                  </form>
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
    <!-- Export to excel  -->  
    <script src="../../plugins/excellentexport/excellentexport.js"></script>
    <!-- My crud  -->  
	<script src="../../templates/myjs/crud.js" ></script>
    <script type="text/javascript">
    $(document).ready(function(){
        $('#search-user').keyup(function() {
            $("#search-user-icon").html("<span class='fa fa-spinner fa-spin' style='color: white'></span>");
            var rex = new RegExp($(this).val(), 'i');

            $('.tbody-user tr').hide();
            $('.tbody-user tr').filter(function() {
                return rex.test($(this).text());
            }).show();

             var total_user = $('.tbody-user tr').length;
             var rows = $('.tbody-user tr:hidden').length;

             if(rows == total_user) {
                $("#search-message-user").show();
            }
            else {
                $("#search-message-user").hide();
            }
            setTimeout(function() {
                $("#search-user-icon").html("<span class='fa fa-search' style='color:white'></span>");
            }, 2000);
        });
       
        $("#new_user_form").submit(function(e){
            try {
                e.preventDefault();
                var form = $("#new_user_form").serializeArray();
                form.push({name: 'action', value: 'insert'});
                console.log(form);

                var query =  CRUD;
                query.path = '../../controllers/user.php';
                query.param = form;
                var response = query.run();
                response = JSON.parse(response);

                if(response == false) {
                    $("#modal-success").modal("show");
                    $(".modal-alert-message").text("New user was successfully saved.");
                    setTimeout(function() {
                         window.location.reload();
                    }, 2500);
                    // alert("New user was successfully saved.")
                    // window.location.reload();
                }
                else {
                    $("#modal-error").modal("show");
                    $(".modal-alert-message").text("User record not save.");
                    setTimeout(function() {
                          window.location.reload();
                    }, 2500);
                    //alert("User register not save.")
                }

            }
            catch(error) {

                alert(error);
            }
            
        });

         //SEARCH TENANT
        $("#confirm_password").keydown(function() {
           passwordMatch();
        });
        $("#confirm_password").keyup(function() {
           passwordMatch();
        });

    });

    function passwordMatch() {
        var pass1 = $("#user_password").val();
        var pass2 = $("#confirm_password").val();

        if(pass1 == pass2) {
            $("#pass_match").html(
                '<div class="alert alert-success text-center" role="alert">' +
                  '<strong><span class="fa fa-check"></span> Password matched.</strong>' +
               '</div>'
            );
        }
        else {
            $("#pass_match").html(
                '<div class="alert alert-warning text-center" role="alert">' +
                  '<strong><span class="fa fa-times-circle"></span> Password not match.</strong>' +
               '</div>'
            );
        }
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
                         <center><h3 id="title_name">LIST OF USERS</h3></center>\
                        <br>\
                        <table class="table">\
                            <thead>\
                            <th style="border: 1px solid black">#</th>\
                              <th width="" style="border: 1px solid black">Fullname</th>\
                              <th width="" style="border: 1px solid black">Gender</th>\
                              <th width="" style="border: 1px solid black">Birthdate</th>\
                              <th width="" style="border: 1px solid black">Position</th>\
                              <th width="" style="border: 1px solid black">Address</th>\
                              <th width="" style="border: 1px solid black">Contact</th>\
                              <th width="" style="border: 1px solid black">Date registere</th>\
                              <th width="" style="border: 1px solid black">Status</th>\
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
