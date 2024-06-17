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
    <link rel="icon" href="../../images/dmms-sm.png" type="image/ico" />


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
				  	<img src="../../images/tenant-list.png" width="40px" height="40px">
                    <h3 style="margin-left:50px; margin-top:-30px; font-size: 20px">List of tenant</h3>
                    <div class="clearfix"></div>
                    <div class="btn-group pull-right" style="margin-top:-38px">
                       
                       
                         <a href="../new tenant/" type="button" class="btn btn-info"  style="margin-right: 4px;">
                         <i class="fa fa-user-plus"></i> Add tanant</a>
                         <a class="btn btn-success" download="ListOfTenants.xls" onclick="return ExcellentExport.excel(this, 'table-export', 'ListOfTenants');" style="margin-right: 4px;">
                            <i class="fa fa-file-excel-o"></i> Export</a>
                        <button onclick="printTable()" type="button" class="btn btn-primary" >
                         <i class="fa fa-print"></i> Print</button>
                    </div>
			  	</div>
			  	<div class="x_content">
                    <div class="title_right">
                        <div class="col-md-4 col-sm-5 col-xs-12 form-group pull-right top_search">
                            <div class="input-group" >
                                <input type="text" id="search-tenant" class="form-control" placeholder="Search for..." style="font-size: 16px; background-color:#eee;">
                                <span class="input-group-btn">
                                <button  class="btn btn-primary" type="button" id="search-tenant-icon"><span class="fa fa-search" style="color:white"></span> </button>
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
                                            <th class="column-title">Gender</th>
                                            <th class="column-title">Birth date</th>
                                            <th class="column-title">Contact</th>
                                            <th class="column-title">Address</th>
                                            <th class="column-title">Type</th>
                                            <th class="column-title">Status </th>
                                            <th class="column-title no-link last hidden-print"><span class="nobr">Action</span></th>
                                        </tr>
                                    </thead>
                                    <tbody class="tbody-tenant">
                                        <?php echo selectAllTenant(); ?>
                                       
                                    </tbody>
                                    <tfoot id="search-message-tenant" style="display: none">
                                        <td colspan="10"><h5 align="center">--------------------- NO RECORDS AVAILABLE ---------------------</h5></td>
                                    </tfoot>
                                </table>
                                <table id="table-export" class="table table-hover hidden">
                                    <thead>
                                         <tr>
                                              <th colspan="9"><p style="font-size:16px">LIST OF TENANTS</p></th>
                                          </tr>
                                        <tr class="headings">
                                            <th class="column-title">#</th>
                                            <th class="column-title">Fullname</th>
                                            <th class="column-title">Gender</th>
                                            <th class="column-title">Birth date</th>
                                            <th class="column-title">Contact</th>
                                            <th class="column-title">Address</th>
                                            <th class="column-title">Type</th>
                                            <th class="column-title">Status </th>
                                        </tr>
                                    </thead>
                                    <tbody class="tbody-tenant" id="print-data-tbody">
                                        
                                        <?php echo selectAllTenantHidden(); ?>
                                    </tbody>
                                   
                                </table>
                            </div>
                        </div>
                    </div>

                   <form id="form-tenant-profile">
                    <div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="modal-tenant-profile">
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
    <!-- WEB CAMERA -->
    <script src="../../plugins/camera/webcam.js"></script>
	<!-- Custom Theme Scripts -->  
    <script src="../../templates/gentelella-master/js/custom.min.js"></script>
	<!-- My clock -->  
    <script src="../../templates/myjs/clock.js" ></script>
    <!-- Export to excel  -->  
    <script src="../../plugins/excellentexport/excellentexport.js"></script>
	<script type="text/javascript">

    var selected = "upload";
    $(document).ready(function() {

        $('#search-tenant').keyup(function() {
            $("#search-tenant-icon").html("<span class='fa fa-spinner fa-spin' style='color: white'></span>");
            var rex = new RegExp($(this).val(), 'i');

            $('.tbody-tenant tr').hide();
            $('.tbody-tenant tr').filter(function() {
                return rex.test($(this).text());
            }).show();

             var total_tenant = $('.tbody-tenant tr').length;
             var rows = $('.tbody-tenant tr:hidden').length;

             if(rows == total_tenant) {
                $("#search-message-tenant").show();
            }
            else {
                $("#search-message-tenant").hide();
            }
            setTimeout(function() {
                $("#search-tenant-icon").html("<span class='fa fa-search' style='color:white'></span>");
            }, 2000);
        });


        

        $('tr').mouseenter(function(){

            var valueOfTd = $(this).find('td:first-child').text();
            $("#btn-show"+valueOfTd).show();
        });
        $('tr').mouseleave(function(){
            var valueOfTd = $(this).find('td:first-child').text();
            $("#btn-show"+valueOfTd).hide();
        });

        $("#reset_camera").click(function() {
            $("#image_capture").hide();
            $("#my_camera").show();
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
            $("#modal-tenant-profile").modal("hide");
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
        $("#tenant_id").val(id);
        Webcam.reset();
        document.getElementById("image-preview").src = document.getElementById(id).src;
        $('#modal-tenant-profile').modal({
            backdrop: 'static',
            keyboard: false  // to prevent closing with Esc button (if you want this too)
        });
        if(selected == "camera") {
          loadWebcam();
        }
    }

    function closeModal() {
        $("#modal-tenant-profile").modal("hide");
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
        let form = document.getElementById("form-tenant-profile");
        let tenant_id = document.getElementById("tenant_id").value;

        $.ajax({
            url: "../../controllers/tenant.php",
            type: "POST",
            dataType: 'json',
            data: new FormData(form),
            contentType: false,
            cache: false,
            processData:false,
            success: function(data){
                console.log(data);
                if(data == true) {
                    document.getElementById(tenant_id).src = document.getElementById("image-preview").src;
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
            error: function(){
                showError("System error.");
                Webcam.reset();
            }
        });
    }

    //save the user capture image
    function captureImage() {
        let image =  $("#camera").val();
        let tenant_id =  $("#tenant_id").val();
        let formdata = new FormData();
        formdata.append("image", image);
        formdata.append("tenant_id", tenant_id);
        formdata.append("action", "capture");

        $.ajax({
            url: "../../controllers/tenant.php",
            dataType: 'json',
            type: "POST",
            data: formdata,
            contentType: false,
            cache: false,
            processData:false,
            success: function(data){
                if(data == true) {
                    document.getElementById(tenant_id).src = image;
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
                         <center><h3 id="title_name">LIST OF TENANTS</h3></center>\
                        <br>\
                        <table class="table">\
                            <thead>\
                            <th style="border: 1px solid black">#</th>\
                              <th width="" style="border: 1px solid black">Fullname</th>\
                              <th width="" style="border: 1px solid black">Gender</th>\
                              <th width="" style="border: 1px solid black">Birthdate</th>\
                              <th width="" style="border: 1px solid black">Contact</th>\
                              <th width="" style="border: 1px solid black">Address</th>\
                              <th width="" style="border: 1px solid black">Type</th>\
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
