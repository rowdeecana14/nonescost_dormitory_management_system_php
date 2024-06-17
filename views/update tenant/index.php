<?php include_once("../../controllers/auth.php"); 
    include_once("../../controllers/user_data.php"); 
    include_once("../../controllers/tenant.php"); 
    homeAuth(); 
    if(isset($_GET['id'])) {
        $data = getTenantDetais($_GET['id']); 
    }
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


    <title>New tenant || DMMS</title>

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
				  	<img src="../../images/tenant-update.png" width="40px" height="40px">
                    <h3 style="margin-left:50px; margin-top:-30px; font-size: 20px">Update tenant</h3>
                    <div class="clearfix"></div>
                    <div class="btn-group pull-right" style="margin-top:-38px">
                      
                        <a href="../tenant/" class="btn btn-primary">
                         <i class="fa fa-table"></i> Records</a>
                    </div>
			  	</div>
			  	<div class="x_content">
                    <form id="update_tenant_form">
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <h1 class="form-title">Personal Data</h1>
                                    <hr  class="border-bottom">
                                </div>
                                <div class="col-md-6 col-sm-12 col-xs-12">
                                    <label class="col-md-12 col-sm-12 col-xs-12 form-group" for="barcode">Barcode: </label>
                                    <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                        <input type="text" name="barcode" id="barcode" class="form-control has-feedback-left"  placeholder="Barcode" style="background-color:#eee;"  value="<?php echo $data['barcode']; ?>">
                                        <span class="fa fa-barcode form-control-feedback left" aria-hidden="true" style="color:black"></span>
                                    </div>

                                    <label class="col-md-12 col-sm-12 col-xs-12 form-group" for="first_name">First Name: </label>
                                    <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                        <input type="text" name="first_name" id="first_name" class="form-control has-feedback-left"  placeholder="First Name" style="text-transform:capitalize; background-color:#eee;" value="<?php echo $data['fname']; ?>" required>
                                        <span class="fa fa-user form-control-feedback left" aria-hidden="true" style="color:black"></span>
                                    </div>

                                    <label class="col-md-12 col-sm-12 col-xs-12 form-group" for="middle_name">Middle Name: </label>
                                    <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                        <input type="text" name="middle_name" id="middle_name" class="form-control has-feedback-left"  placeholder="Middle Name" style="text-transform:capitalize; background-color:#eee;" value="<?php echo $data['mname']; ?>" >
                                        <span class="fa fa-user form-control-feedback left" aria-hidden="true" style="color:black"></span>
                                    </div>

                                    <label class="col-md-12 col-sm-12 col-xs-12 form-group" for="last_name">Last Name: </label>
                                    <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                        <input type="text" name="last_name" id="last_name" class="form-control has-feedback-left"  placeholder="Last Name" style="text-transform:capitalize; background-color:#eee;" value="<?php echo $data['lname']; ?>" required>
                                        <span class="fa fa-user form-control-feedback left" aria-hidden="true" style="color:black"></span>
                                    </div>

                                    <label class="col-md-12 col-sm-12 col-xs-12 form-group" for="gender">Gender: </label>
                                    <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                        <select name="gender" id="gender" class="form-control has-feedback-left" style="background-color:#eee; ">
                                           <?php  echo renderGender($data['gender']); ?>
                                        </select>
                                        <span class="fa fa-venus-double form-control-feedback left" aria-hidden="true" style="color:black"></span>
                                    </div>


                                </div>
                                <div class="col-md-6 col-sm-12 col-xs-12">
                                    <label class="col-md-12 col-sm-12 col-xs-12 form-group" for="birth_date">Birth Date: </label>
                                    <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                        <input type="date" name="birth_date" id="birth_date" class="form-control has-feedback-left"   style="background-color:#eee;" value="<?php echo $data['bdate']; ?>" required>
                                        <span class="fa fa-calendar form-control-feedback left" aria-hidden="true" style="color:black"></span>
                                    </div>


                                    <label class="col-md-12 col-sm-12 col-xs-12 form-group" for="civil_status">Civil Status: </label>
                                    <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                        <select name="civil_status" id="civil_status" class="form-control has-feedback-left" style="background-color:#eee; ">
                                            <?php  echo renderCivilStatus($data['civil_status']); ?>
                                        </select>
                                        <span class="fa fa-users form-control-feedback left" aria-hidden="true" style="color:black"></span>
                                    </div>


                                    <label class="col-md-12 col-sm-12 col-xs-12 form-group" for="address">Address: </label>
                                    <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                        <input type="text" name="address" id="address" class="form-control has-feedback-left"  placeholder="Address" style="text-transform:capitalize; background-color:#eee;" value="<?php echo $data['address']; ?>" required>
                                        <span class="fa fa-map-marker form-control-feedback left" aria-hidden="true" style="color:black"></span>
                                    </div>

                                    <label class="col-md-12 col-sm-12 col-xs-12 form-group" for="email">Email: </label>
                                    <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                        <input type="text" name="email" id="email" class="form-control has-feedback-left"  placeholder="Email" style="background-color:#eee;" value="<?php echo $data['email']; ?>" required>
                                        <span class="fa fa-envelope form-control-feedback left" aria-hidden="true" style="color:black"></span>
                                    </div>

                                    <label class="col-md-12 col-sm-12 col-xs-12 form-group" for="contact_no">Contact no: </label>
                                    <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                        <input type="number" name="contact_no" id="contact_no" maxlength="11" class="form-control has-feedback-left"  placeholder="Contact number" style="background-color:#eee;" value="<?php echo $data['contact']; ?>" required>
                                        <span class="fa fa-phone form-control-feedback left" aria-hidden="true" style="color:black"></span>
                                    </div>

                                </div>
                            </div>

                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <br>
                                     <h1 class="form-title">Parent Data</h1>
                                    <hr  class="border-bottom">

                                    <div class="col-md-6 col-sm-12 col-xs-12">
                                        <label class="col-md-12 col-sm-12 col-xs-12 form-group" for="mother">Mother Name: </label>
                                        <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                            <input type="text" name="mother" id="mother" class="form-control has-feedback-left"  placeholder="Mother Name" style="text-transform:capitalize; background-color:#eee;" value="<?php echo $data['mother']; ?>" required>
                                            <span class="fa fa-user form-control-feedback left" aria-hidden="true" style="color:black"></span>
                                        </div>


                                        <label class="col-md-12 col-sm-12 col-xs-12 form-group" for="mother_occ">Work: </label>
                                        <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                            <input type="text" name="mother_occ" id="mother_occ" class="form-control has-feedback-left"  placeholder="Work" style="text-transform:capitalize; background-color:#eee;" value="<?php echo $data['mother_occ']; ?>" required>
                                            <span class="fa fa-briefcase form-control-feedback left" aria-hidden="true" style="color:black"></span>
                                        </div>

                                        <label class="col-md-12 col-sm-12 col-xs-12 form-group" for="father">Father Name: </label>
                                        <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                            <input type="text" name="father" id="father" class="form-control has-feedback-left"  placeholder="Father Name" style="text-transform:capitalize; background-color:#eee;" value="<?php echo $data['father']; ?>" required>
                                            <span class="fa fa-user form-control-feedback left" aria-hidden="true" style="color:black"></span>
                                        </div>

                                        <label class="col-md-12 col-sm-12 col-xs-12 form-group" for="father_occ">Work: </label>
                                        <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                            <input type="text" name="father_occ" id="father_occ" class="form-control has-feedback-left"  placeholder="Work" style="text-transform:capitalize; background-color:#eee;" value="<?php echo $data['father_occ']; ?>" required>
                                            <span class="fa fa-briefcase form-control-feedback left" aria-hidden="true" style="color:black"></span>
                                        </div>

                                    </div>


                                    <div class="col-md-6 col-sm-12 col-xs-12">
                                        <label class="col-md-12 col-sm-12 col-xs-12 form-group" for="parent_address">Address: </label>
                                        <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                            <input type="text" name="parent_address" id="parent_address" class="form-control has-feedback-left"  placeholder="Address" style="text-transform:capitalize; background-color:#eee;" value="<?php echo $data['parent_address']; ?>" required>
                                            <span class="fa fa-user form-control-feedback left" aria-hidden="true" style="color:black"></span>
                                        </div>

                                        <label class="col-md-12 col-sm-12 col-xs-12 form-group" for="parent_email">Email:</label>
                                        <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                            <input type="email" name="parent_email" id="parent_email" class="form-control has-feedback-left"  placeholder="Email" style="background-color:#eee;" value="<?php echo $data['parent_email']; ?>">
                                            <span class="fa fa-envelope form-control-feedback left" aria-hidden="true" style="color:black"></span>
                                        </div>

                                        <label class="col-md-12 col-sm-12 col-xs-12 form-group" for="parent_contact">Contact no: </label>
                                        <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                            <input type="number" name="parent_contact" id="parent_contact" class="form-control has-feedback-left" maxlength="11"  placeholder="Contact no" style="background-color:#eee;" value="<?php echo $data['contact']; ?>" required>
                                            <span class="fa fa-phone form-control-feedback left" aria-hidden="true" style="color:black"></span>
                                        </div>

                                    </div>

                                </div>
                            </div>
                               

                            <div class="col-md-12 col-sm-12 col-xs-12 form-group" style="margin-left: 10px;">
                                <div class="col-md-6 col-sm-12 col-xs-12">
                                </div>
                                <div class="col-md-6 col-sm-12 col-xs-12">
                                    <br><br>
                                    <button type="reset" class="btn btn-danger"><i class="fa fa-eraser" aria-hidden="true"></i> Reset</button>
                                    <button type="submit" name="submit" class="btn btn-primary"><i class="fa fa-save" aria-hidden="true"></i> Submit</button>
                                </div>
                                
                            </div>
                        </div>
                    </form>

                    <div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="modal-search-tenant">
                        <div class="modal-dialog modal-md">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                              </button>
                              <h4 class="modal-title" id="myModalLabel" style="font-weight:bold;"><i class="fa fa-search"></i> SEARCH TENANT</h4>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <center>
                                                <img src="../../images/search-tenant.png" width="100px" height="100px">
                                            </center>
                                            <br>
                                            <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                                <input type="text" name="search-tenant" id="tenant" class="form-control" style="height: 40px;  background-color:#eee;"  placeholder="Search here.." >
                                                <br>
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
                                                   
                                                  </tbody>
                                                </table>
                                            </div>
                                        </div>

                                    </div>
                                <br>
                                </div>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="glyphicon glyphicon-remove-sign"></i> Close</button>
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
    <script src="../../templates/myjs/crud.js" ></script>
	<script type="text/javascript">
        $(document).ready(function(){
            //SAVE NEW TENANT
            $("#update_tenant_form").submit(function(e){
                e.preventDefault();
                
                var form = $("#update_tenant_form").serializeArray();
                form.push({name: 'action', value: 'update'});
                form.push({name: 'cust_id', value: "<?php echo $_GET['id']; ?>"});

                 try {
                    var query =  CRUD;
                    query.path = '../../controllers/tenant.php';
                    query.param = form;
                    var response = query.run();
                    response = JSON.parse(response);

                    if(response == false) {
                        $("#modal-information").modal("show");
                        $(".modal-alert-message").text("Record is successfully updated.");
                        setTimeout(function() {
                             $("#modal-information").modal("hide");
                        }, 2500);
                        //alert("Record is successfully updated.")
                    }
                    else {
                        $("#modal-error").modal("show");
                        $(".modal-alert-message").text("Record is not updated.");
                         setTimeout(function() {
                             $("#modal-error").modal("hide");
                        }, 2500);
                        //alert("Record is not updated.")
                    }
                }
                catch(error) {
                    $("#modal-error").modal("show");
                    $(".modal-alert-message").text(error);
                    setTimeout(function() {
                             $("#modal-error").modal("hide");
                    }, 2500);
                     //alert(error);
                }
            });
        });

        function is_valid_fields(form_id) {
            var count = 0;
            $(':input', '#new_tenant_form').each(function() {
                var input = $(this);

                for(var i = 0; i < not_required.length; i++) {
                   
                    if(input.attr('type') !== "submit" && input.attr('type') !== "reset" && not_required[0] !== this.name) {
                        if(this.value == "" || this.value== "select") {
                            count++;
                        }
                    }
                }
            });

            if(count == 0) {
                return true;
            }
            else {
                return false;
            }
        }

      
    </script>
  </body>
</html>
