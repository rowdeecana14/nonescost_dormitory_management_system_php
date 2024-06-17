<?php include_once("../../controllers/auth.php"); ?>
<?php include_once("../../controllers/user_data.php"); ?>
<?php include_once("../../controllers/user.php"); ?>
<?php homeAuth(); ?>
<?php
  if(isset($_GET['id'])) {
     $data  = getUserDetais($_GET['id']);
     $profile_id = "profile_".$_GET['id'];
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
    <style>
        .card-primary.card-outline {
          border-top: 3px solid #007bff; 
        }
        .card {
            box-shadow: 0 0 1px rgba(0,0,0,.125), 0 1px 3px rgba(0,0,0,.2);
        }
        .callout, .card, .info-box, .mb-3, .my-3, .small-box {
            margin-bottom: 1rem!important;
        }
        .card {
            position: relative;
            display: -ms-flexbox;
            display: flex;
            -ms-flex-direction: column;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            background-color: #fff;
            background-clip: border-box;
            border: 0 solid rgba(0,0,0,.125);
            border-radius: .25rem;
        }
        .card-body {
            -ms-flex: 1 1 auto;
            flex: 1 1 auto;
            padding: 1.25rem;
        }
       
        .profile-username {
            font-size: 21px;
            margin-top: 5px;
        }
        .callout, .card, .info-box, .mb-3, .my-3, .small-box {
            margin-bottom: 1rem!important;
        }
        .list-group {
            display: -ms-flexbox;
            display: flex;
            -ms-flex-direction: column;
            flex-direction: column;
            padding-left: 0;
            margin-bottom: 0;
        }
        ol, ul {
            margin-top: 0;
            margin-bottom: 1rem;
        }
       
        ul {
            display: block;
            list-style-type: disc;
            margin-block-start: 1em;
            margin-block-end: 1em;
            margin-inline-start: 0px;
            margin-inline-end: 0px;
            padding-inline-start: 40px;
        }
        .card-primary:not(.card-outline)>.card-header, .card-primary:not(.card-outline)>.card-header a {
            color: #fff;
        }
        .card-primary:not(.card-outline)>.card-header {
            background-color: #007bff;
            border-bottom: 0;
        }
        .card-header:first-child {
            border-radius: calc(.25rem - 0) calc(.25rem - 0) 0 0;
        }
        .card-header {
            background-color: transparent;
            border-bottom: 1px solid rgba(0,0,0,.125);
            padding: .75rem 1.25rem;
            position: relative;
            border-top-left-radius: .25rem;
            border-top-right-radius: .25rem;
        }
        .card-title {
            float: left;
            font-size: 1.1rem;
            font-weight: bold;
            margin: 0;
        }
        .card-header {
            padding: .75rem 1.25rem;
            margin-bottom: 0;
            background-color: rgba(0,0,0,.03);
            border-bottom: 0 solid rgba(0,0,0,.125);
        }
        .text-muted {
            color: #6c757d!important;
        }
        .img-circle {
            border-radius: 50%;
        }
        .profile-user-img {
            border: 3px solid #adb5bd;
            margin: 0 auto;
            padding: 3px;
            width: 100px;
        }
        .img-fluid {
            max-width: 100%;
            height: auto;
        }
        img {
            vertical-align: middle;
            border-style: none;
        }

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
    <script type="text/javascript">
    </script>
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
    				  	<img src="../../images/profile.png" width="40px" height="40px">
                  <h3 style="margin-left:50px; margin-top:-30px; font-size: 20px"> User profile</h3>
                  <div class="clearfix"></div>
                  <div class="btn-group pull-right" style="margin-top:-38px">
                    
                     
                  </div>
    			  	</div>
    			  	<div class="x_content">
                  <div class="row">
                      <div class="col-md-3 col-sm-3 col-xs-12 profile_left">
                        <!-- Profile Image -->
                        <div class="card card-primary card-outline">
                          <div class="card-body box-profile">
                            <div class="text-center">
                              <img style="border-radius: 50%; padding: 3px; border: 3px solid #b1b5b9;" width="130px" height="130px" src="<?php echo "../../images/UPLOADED/".$data['user_image']; ?>" alt="User profile picture" id="<?php echo $profile_id; ?>">
                            </div>

                            <h3 class="profile-username text-center"><?php echo $data['user_fname']." ".$data['user_lname']; ?></h3>
                            <center>
                              <button type="button" class="btn btn-success" id="update_photo"><b><i class="fa fa-camera"></i> Update photo</b></button>
                            </center>
                          </div>
                          <!-- /.card-body -->
                        </div>
                        <!-- /.card -->

                        <!-- About Me Box -->
                        <div class="card card-primary">
                          <div class="card-header">
                            <h3 class="card-title" style="font-size: 14px;">ABOUT ME</h3>
                          </div>
                          <!-- /.card-header -->
                          <div class="card-body">
                            <strong><i class="fa fa-user" style="padding-right: 5px;"></i> FULLNAME</strong>
                            <p class="text-muted" style="padding-left: 18px;">
                             <?php echo ucwords($data['user_fname']." ".$data['user_lname']); ?>
                            </p>
                            <hr style="margin-top: -5px; margin-bottom: 5px">

                            <strong><i class="fa fa-venus-double"  style="padding-right: 5px;"></i> GENDER</strong>
                            <p class="text-muted" style="padding-left: 18px;">
                             <?php echo $data['user_gender']; ?>
                            </p>
                            <hr style="margin-top: -5px; margin-bottom: 5px">

                            <strong><i class="fa fa-calendar"  style="padding-right: 5px;"></i> BIRTH DATE</strong>
                            <p class="text-muted" style="padding-left: 18px;">
                             <?php echo date('M. d, Y',strtotime($data['user_bdate'])); ?>
                            </p>
                            <hr style="margin-top: -5px; margin-bottom: 5px">

                            <strong><i class="fa fa-briefcase"  style="padding-right: 5px;"></i> POSITION</strong>
                            <p class="text-muted" style="padding-left: 18px;">
                             <?php echo ucwords($data['user_position']); ?>
                            </p>
                            <hr style="margin-top: -5px; margin-bottom: 5px">

                            <strong><i class="fa fa-map-marker"  style="padding-right: 5px;"></i> ADDRESS</strong>
                            <p class="text-muted" style="padding-left: 18px;">
                             <?php echo ucwords($data['user_address']); ?>
                            </p>
                            <hr style="margin-top: -5px; margin-bottom: 5px">

                            <strong><i class="fa fa-phone"  style="padding-right: 5px;"></i> CONTACT NO</strong>
                            <p class="text-muted" style="padding-left: 18px;">
                             <?php echo $data['user_contact']; ?>
                            </p>
                            <hr style="margin-top: -5px; margin-bottom: 5px">

                            <strong><i class="fa fa-info"  style="padding-right: 5px;"></i> STATUS</strong>
                            <p class="text-muted" style="padding-left: 18px;">
                             <?php echo $data['user_status']; ?>
                            </p>
                          </div>
                          <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                      </div>

                    <div class="col-md-9 col-sm-9 col-xs-12">

                      <div class="" role="tabpanel" data-example-id="togglable-tabs">
                        <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                          <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true"><span class="badge bg-gray "><i class="fa fa-user"></i></span> Update details</a>
                          </li>
                        
                        </ul>
                        <div id="myTabContent" class="tab-content">
                          <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
                            <form id="update_user_form">
                                  <div class="row"> 
                                      <div class="col-md-12 col-sm-12 col-xs-12">
                                        <br>
                                          <div class="col-md-6 col-sm-12 col-xs-12">
                                              <label class="col-md-12 col-sm-12 col-xs-12 form-group" for="user_fname">First Name: </label>
                                              <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                                  <input type="text" name="user_fname" id="user_fname" value="<?php echo $data['user_fname']; ?>" class="form-control has-feedback-left"  placeholder="First Name" style="text-transform:capitalize; background-color:#eee;" required>
                                                  <span class="fa fa-user form-control-feedback left" aria-hidden="true" style="color:black"></span>
                                              </div>

                                              <label class="col-md-12 col-sm-12 col-xs-12 form-group" for="user_lname">Last Name: </label>
                                              <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                                  <input type="text" name="user_lname" id="user_lname" value="<?php echo $data['user_lname']; ?>" class="form-control has-feedback-left"  placeholder="Last Name" style="text-transform:capitalize; background-color:#eee;" required>
                                                  <span class="fa fa-user form-control-feedback left" aria-hidden="true" style="color:black"></span>
                                              </div>

                                              <label class="col-md-12 col-sm-12 col-xs-12 form-group" for="user_gender">Gender: </label>
                                              <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                                  <select name="user_gender" id="user_gender" class="form-control has-feedback-left" style="background-color:#eee; " required>
                                                      <option selected disabled value="">Select gender</option>
                                                      <?php 
                                                        $gender = "";
                                                        if($data['user_gender'] == "Male") {
                                                          $gender = "
                                                              <option selected>Male</option>
                                                              <option>Female</option>";
                                                        }
                                                        else {
                                                          $gender = "
                                                              <option>Male</option>
                                                              <option selected>Female</option>";
                                                        }
                                                        echo $gender;
                                                      ?>
                                                      
                                                  </select>
                                                  <span class="fa fa-venus-double form-control-feedback left" aria-hidden="true" style="color:black"></span>
                                              </div>
                                               <label class="col-md-12 col-sm-12 col-xs-12 form-group" for="user_bdate">Birth Date: </label>
                                              <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                                  <input type="date" name="user_bdate" id="user_bdate" value="<?php echo $data['user_bdate']; ?>" class="form-control has-feedback-left"   style="background-color:#eee;" required>
                                                  <span class="fa fa-calendar form-control-feedback left" aria-hidden="true" style="color:black"></span>
                                              </div>

                                          </div>
                                          <div class="col-md-6 col-sm-12 col-xs-12">
                                             


                                              <label class="col-md-12 col-sm-12 col-xs-12 form-group" for="user_position">Position: </label>
                                              <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                                  <select name="user_position" id="user_position" class="form-control has-feedback-left" style="background-color:#eee; " required>
                                                      <option selected disabled value="">Select position</option>
                                                      <?php 
                                                        $position = "";
                                                        if($data['user_position'] == "Admin") {
                                                          $position = "
                                                              <option selected>Admin</option>
                                                              <option>Staff</option>";
                                                        }
                                                        else {
                                                          $position = "
                                                              <option>Admin</option>
                                                              <option selected>Staff</option>";
                                                        }
                                                        echo $position;
                                                      ?>
                                                  </select>
                                                  <span class="fa fa-users form-control-feedback left" aria-hidden="true" style="color:black"></span>
                                              </div>

                                             

                                              <label class="col-md-12 col-sm-12 col-xs-12 form-group" for="user_address">Address: </label>
                                              <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                                  <input type="text" name="user_address" id="user_address" class="form-control has-feedback-left"  placeholder="Address" style="text-transform:capitalize; background-color:#eee;" value="<?php echo $data['user_address']; ?>" required>
                                                  <span class="fa fa-map-marker form-control-feedback left" aria-hidden="true" style="color:black"></span>
                                              </div>

                                              <label class="col-md-12 col-sm-12 col-xs-12 form-group" for="user_contact">Contact no: </label>
                                              <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                                  <input type="number" name="user_contact" id="user_contact" value="<?php echo $data['user_contact']; ?>" maxlength="11" class="form-control has-feedback-left"  placeholder="Contact number" style="background-color:#eee;" required>
                                                  <span class="fa fa-phone form-control-feedback left" aria-hidden="true" style="color:black"></span>
                                              </div>

                                              <label class="col-md-12 col-sm-12 col-xs-12 form-group" for="user_status">Status: </label>
                                              <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                                  <select name="user_status" id="user_status" class="form-control has-feedback-left" style="background-color:#eee; " required>
                                                      <option selected disabled value="">Select status</option>
                                                      <?php 
                                                        $status = "";
                                                        if($data['user_status'] == "Active") {
                                                          $status = "
                                                              <option selected>Active</option>
                                                              <option>Inactive</option>";
                                                        }
                                                        else {
                                                          $status = "
                                                              <option>Active</option>
                                                              <option selected>Inactive</option>";
                                                        }
                                                        echo $status;
                                                      ?>
                                                      
                                                  </select>
                                                  <span class="fa fa-info form-control-feedback left" aria-hidden="true" style="color:black"></span>
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
                        <h4 class="modal-title" id="myModalLabel" style="font-weight:bold;"><i class="fa  fa-camera"></i>  UPDATE USER PROFILE</h4>
                      </div>
                      <div class="modal-body">
                          <div class="row">
                              <div class="col-md-12 col-sm-12 col-xs-12">
                                 <div class="" role="tabpanel" data-example-id="togglable-tabs">
                                      <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                                        <li role="presentation" class="active" onclick="select('upload')"><a href="#tab_upload" id="upload_li" role="tab" data-toggle="tab" aria-expanded="true">Upload photo</a>
                                        </li>
                                        <li role="presentation" class="" onclick="select('camera')"><a href="#tab_camera" role="tab" id="camera_link" data-toggle="tab" aria-expanded="false">Take camera</a>
                                        </li>
                                       
                                      </ul>
                                      <div id="myTabContent" class="tab-content">
                                        <div role="tabpanel" class="tab-pane fade active in" id="tab_upload" aria-labelledby="upload-tab">
                                          <input type="hidden" name="action" value="upload">
                                          <input type="hidden" name="user_id"  id="user_id">
                                          <center>
                                              <img  id="image-preview" src="../../images/UPLOADED/unknown.png" class="image-preview" style="border: 2px solid gray;"/>
                                               <input type="file" class="form-control" style="width: 60%" id="image-source" onchange="previewImage();" name="image-source"  accept="image/png, image/jpeg, image/gif" required>
                                          </center>

                                        </div>
                                        <div role="tabpanel" class="tab-pane fade" id="tab_camera" aria-labelledby="camera-tab">
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
  <!-- WEB CAMERA -->
  <script src="../../plugins/camera/webcam.js"></script>
	<script src="../../templates/myjs/crud.js" ></script>
  <script type="text/javascript">
  var selected = "upload";
  $(document).ready(function(){
     $("#update_user_form").submit(function(e){

        try {
            e.preventDefault();
            var user_id = "<?php echo $_GET['id']; ?>"
            var form = $("#update_user_form").serializeArray();
            form.push({name: 'action', value: 'update'});
            form.push({name: 'user_id', value: user_id});

            var query =  CRUD;
            query.path = '../../controllers/user.php';
            query.param = form;
            var response = query.run();
            response = JSON.parse(response);

            if(response == false) {
                $("#modal-information").modal("show");
                $(".modal-alert-message").text("Record was successfully updated.");
                setTimeout(function() {
                     window.location.reload();
                }, 2500);
                // alert("Record was successfully updated.")
                // window.location.reload();
            }
            else {
                $("#modal-error").modal("show");
                $(".modal-alert-message").text("User details not updated.");
                setTimeout(function() {
                     window.location.reload();
                }, 2500);
                //alert("User details not updated.")
            }

        }
        catch(error) {
            alert(error);
        }
        
    });

     $("#reset_camera").click(function() {
          $("#image_capture").hide();
          $("#my_camera").show();
      });

     $("#update_photo").click(function() {
        var user_id = "<?php echo $_GET['id']; ?>";
        showModal(user_id);
     });

     $("#capture_photo").click(function() {
          // take snapshot and get image data
          var shutter = new Audio();
          shutter.autoplay = true;
          shutter.src = navigator.userAgent.match(/Firefox/) ? 'shutter.ogg' : '../../plugins/camera/shutter.mp3';
          shutter.play();
          Webcam.snap( function(data_uri) {
              $("#camera").val(data_uri);
              $("#my_camera").hide();
              $("#image_capture").show();
              document.getElementById("image_capture").src = data_uri;
          });
      });

      $("#close_btn").click(function() {
          closeModal();
      });
       $("#top-close-btn").click(function() {
          closeModal();
      });

       //Submit the form modal
      $("#submit-btn").click(function(){

          $("#modal-user-profile").modal("hide");
          let upload_image = $("#image-source").val();
          let capture_image = $("#camera").val();
          if(upload_image != "" || capture_image != "") {
              if(selected == "upload") {
                  uploadImage();
              }
              else {
                  captureImage();
              }
              Webcam.reset();
          }
          else {
              showError("Upload or take photo first.");
          }
          
      });
  });

  function showModal(id) {
        //Show the modal
        document.getElementById("image-preview").src = document.getElementById("<?php echo $profile_id; ?>").src;
        $("#user_id").val(id);
        Webcam.reset();
       
        $('#modal-user-profile').modal({
            backdrop: 'static',
            keyboard: false  // to prevent closing with Esc button (if you want this too)
        });

        if(selected == "camera") {
          loadWebcam();
        }
    }

    function closeModal() {
        $("#modal-user-profile").modal("hide");
        Webcam.reset();
    }

    //load the web cam js 
    function loadWebcam() {
        //Set the web camera
        Webcam.set({
            width: 320,
            height: 240,
            dest_width: 640,
            dest_height: 480,
            image_format: 'jpeg',
            jpeg_quality: 90,
            force_flash: false
        });
        Webcam.attach('#my_camera');
    }

    //preview the user image selected
    function previewImage() {
        document.getElementById("image-preview").style.display = "block";
        var oFReader = new FileReader();
         oFReader.readAsDataURL(document.getElementById("image-source").files[0]);

        oFReader.onload = function(oFREvent) {
          document.getElementById("image-preview").src = oFREvent.target.result;
        };
    };

    function select(selection) {
        selected = selection;

        if(selected == "camera") {
            loadWebcam();
        }
        else {
             Webcam.reset();
        }
    }

    function showError(message) {
       $("#modal-error").modal("show");
        $(".modal-alert-message").text(message);
        setTimeout(function() {
             window.location.reload();
        }, 2500);
        //alert(message);
    }

    //save the user upload image
    function uploadImage() {
        let form = document.getElementById("form-user-profile");
        let user_id = document.getElementById("user_id").value;

        $.ajax({
            url: "../../controllers/user.php",
            type: "POST",
            dataType: 'json',
            data: new FormData(form),
            contentType: false,
            cache: false,
            processData:false,
            success: function(data){

                if(data == true) {
                    document.getElementById("<?php echo $profile_id; ?>").src = document.getElementById("image-preview").src;
                    $("#modal-information").modal("show");
                    $(".modal-alert-message").text("Profile was successfuly updated.");
                    setTimeout(function() {
                         window.location.reload();
                    }, 2500);

                    //alert("Profile was successfuly updated.")
                   
                }
                else {
                    showError("User profile not updated.");
                }
                closeModal();
            },
            error: function(error){
                showError(error);
                Webcam.reset();
            }
        });
    }

    //save the user capture image
    function captureImage() {
        let image =  $("#camera").val();
        let user_id =  $("#user_id").val();
        let formdata = new FormData();
        formdata.append("image", image);
        formdata.append("user_id", user_id);
        formdata.append("action", "capture");

        $.ajax({
            url: "../../controllers/user.php",
            dataType: 'json',
            type: "POST",
            data: formdata,
            contentType: false,
            cache: false,
            processData:false,
            success: function(data){
              console.log(data);
                if(data == true) {
                    document.getElementById("<?php echo $profile_id; ?>").src = image;
                    $("#modal-information").modal("show");
                    $(".modal-alert-message").text("Profile was successfuly updated.");
                    setTimeout(function() {
                         window.location.reload();
                    }, 2500);

                   //alert("Profile was successfuly updated.");
                }
                else {
                    showError("User profile not updated.");
                }
                closeModal();
            },
            error: function(){
                showError("System error.");
            }
        });
    }
  </script>
  </body>
</html>
