<?php 
    include_once("../../controllers/auth.php");
    include_once("../../controllers/user_data.php");
    include_once("../../controllers/payment.php");
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
     <!-- select -->
    <link rel="stylesheet" type="text/css" href="../../plugins/select2/dist/css/select2.css">
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
				  	<img src="../../images/payment.png" width="40px" height="40px">
                    <h3 style="margin-left:50px; margin-top:-30px; font-size: 20px">Payment</h3>
                    <div class="clearfix"></div>
                    <div class="btn-group pull-right" style="margin-top:-38px">
                       <a href="../payment record/" class="btn btn-primary">
                         <i class="fa fa-table"></i> Records</a>
                    </div>
			  	</div>
			  	<div class="x_content">
                    <div class="row">
                        <form id="form-payment">
                          <div class="col-md-12 col-sm-12 col-xs-12 form-group" style="margin-left: 10px;">
                               

                                <div class="col-md-8 col-sm-12 col-xs-12">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <input type="hidden" value="insert" name="action">
                                        <table class="table">
                                             <tr>
                                                <th>Tenant:</th>
                                                <th>Room and bed:</th>
                                                <th>Amount rent:</th>
                                            </tr>
                                            <tbody>
                                                <tr>
                                                    <td width="50%">
                                                         <select name="tenant" onchange="selectTenant()" id="tenant" class="form-control select2" style="background-color:#eee; " required>
                                                            <?php echo renderTenant(); ?>
                                                        </select>
                                                    </td>
                                                    <td width="25%">
                                                        <input type="text" name="room_bed" id="room_bed" class="form-control " readonly  style="background-color:#eee;" required placeholder="Room and bed">
                                                    </td>
                                                    <td width="25%">
                                                        <input type="text" value="0.00" name="rate_per_bed" id="rate_per_bed"  class="form-control " readonly  style="background-color:#eee;" required>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table> 
                                         
                                        <table class="table" id="table-form">
                                            <tr>
                                                <th>Month:</th>
                                                <th>Total Balance:</th>
                                            </tr>
                                            <tbody>
                                                <tr>
                                                    <td width="50%">
                                                        <input type="text" name="month" id="month"  class="form-control " readonly  style="background-color:#eee;" placeholder="Month" required>
                                                    </td>
                                                    
                                                    <td width="50%">
                                                         <input type="text" value="" name="balance" id="balance"  placeholder="Remaining balance" class="form-control"  style="background-color:#eee;" required readonly>
                                                    </td>
                                                   
                                                   
                                                </tr>
                                            </tbody>
                                        </table>
                                         <table class="table" id="table-form">
                                            <tr>
                                                <th>Amount paid:</th>
                                            </tr>
                                            <tbody>
                                                <td width="30%">
                                                    <input type="number" value="" name="paid_amount" id="paid_amount" max="1000000" min="1" onkeyup="getAmount('paid_amount')" placeholder="Amount paid" class="form-control input-lg"  style="background-color:#eee;" required disabled>
                                                </td>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                 <div class="col-md-4 col-sm-12 col-xs-12">
                                     <div class="container">
                                      <div class="list-group">
                                        <a href="#" class="list-group-item active" style="font-weight: bold;">PAYMENT DETAILS</a>
                                        <a href="#" class="list-group-item" style="font-weight: bold;">Total Balance:<b style="margin-left: 10px;" id="total_balance">0.00</b></a>
                                        <a href="#" class="list-group-item" style="font-weight: bold;">Total paid:<b style="margin-left: 33px;" id="total_paid">0.00</b></a>
                                        <a href="#" class="list-group-item" style="font-weight: bold;">Change:<b style="margin-left: 45px;" id="amount_change">0.00</b></a>
                                      </div>
                                    </div>
                                </div>
                          
                                <div class="col-md-7 col-sm-12 col-xs-12">
                                    <button type="submit" name="submit" class="btn btn-primary pull-right"><i class="fa fa-save" aria-hidden="true"></i> Submit</button>
                                    <button type="reset" class="btn btn-danger pull-right"><i class="fa fa-eraser" aria-hidden="true"></i> Reset</button>
                                  
                                </div>
                            </div>
                            </div>
                        </form>
                    </div>
				</div>
			</div>

                    <div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="modal-receipt">
                        <div class="modal-dialog modal-md">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" onclick="closeModal()"><span aria-hidden="true">×</span>
                              </button>
                              <h4 class="modal-title" id="myModalLabel" style="font-weight:bold;"><i class="fa fa-info-circle"></i> CONFIRMATION MESSAGE</h4>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h3 class="text-center">Payment was successfully saved.</h3>
                                        <h4 class="text-center">Are want to print this receipt?</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-danger" onclick="closeModal()"><i class="glyphicon glyphicon-remove-sign"></i> Close</button>
                              <button type="button" class="btn btn-primary" onclick="printReceipt()"><i class="fa fa-thumbs-up"></i> Okay</button>
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
    <!-- select --> 
    <script type="text/javascript" src="../../plugins/select2/dist/js/select2.js"></script>
	<!-- Custom Theme Scripts -->  
    <script src="../../templates/gentelella-master/js/custom.min.js"></script>
	 <!-- My clock -->  
	<script src="../../templates/myjs/clock.js" ></script>
	<script src="../../templates/myjs/crud.js" ></script>
    <script type="text/javascript">


    var month_list = [];
    var selected_list = [];
    var bal = 0;
    var month_num = 0;
    var global_data = [];
    var cur_month = "";

    $(document).ready(function(){
        $('.select2').select2();
         $("#form-payment").submit(function(e){
            e.preventDefault();
            try {
                var form = $("#form-payment").serializeArray();
                form.push({name: 'month_num', value: month_num});

                var query =  CRUD;
                query.path = '../../controllers/payment.php';
                query.param = form;
                var response = query.run();
                console.log(response);

                if(response) {
                    $('#modal-receipt').modal({
                        backdrop: 'static',
                        keyboard: false  // to prevent closing with Esc button (if you want this too)
                    });
                    $("#modal-receipt").modal("show");
                    // alert("Payment transaction was saved.");
                    // window.location.reload();
                }
                else {
                    alert("Payment not save.");
                }
            }
            catch(error) {
                alert(error);
            }

        });
    });

  
    function selectTenant() {
        var tenant_id = $("#tenant").val();
        $("#balance").val("");
        $("#month").removeAttr('disabled');
        $("#paid_amount").removeAttr('disabled');

        try {
            var form = $("#form-payment").serialize();
            var query =  CRUD;
            query.path = '../../controllers/payment.php';
            query.param = {
                action: "select_tenant",
                cust_id: tenant_id
            };
            var response = query.run();
            console.log(response);
            response = JSON.parse(response);
            var data = response['data'];
            global_data = response;
            
            var bed_rate = 0;

            if(data.tenant_type == "Student") {
                bed_rate = data.student_rate;

            }
            else if(data.tenant_type == "Faculty") {
                bed_rate = data.faculty_rate;
            }
            else {
                bed_rate = data.other_rate;
            }

            if(response.bal === 0) {
                $("#paid_amount").attr('disabled','disabled');

            }

            month_num = response.month;
            var month_list = {
                "01": "January",
                "02": "February",
                "03": "March",
                "04": "April", 
                "05": "May",
                "06": "June",
                "07": "July",
                "08": "August",
                "09": "September",
                "10": "October",
                "11": "November",
                "12": "December"
            };

            cur_month = month_list[month_num];
            $("#month").val(month_list[month_num]);
            $("#rate_per_bed").val(bed_rate);
            $("#room_bed").val("Room "+data['room_no']+", bed "+data['bed_no']);
            $("#balance").val(response.bal);
            $("#total_balance").text(response.balance);

        }
        catch(error) {
            alert(error);
        }
    }



    function renderSelected() {

    }

    function getAmount(id) {
        var total_paid = Number($("#"+id).val());
        var balance = Number($("#balance").val());

        if(total_paid > 0) {
            if(total_paid >= balance) {
                var change = total_paid - balance;
                $("#amount_change").text(change);
            }
            else {
                 var change = balance - total_paid;
                  $("#amount_change").text(0.00);
            }
            
        }
        $("#total_paid").text(total_paid);
    }

    function closeModal() {
        $("#modal-receipt").modal("hide");
        window.location.reload();
    }

    function printReceipt() {
        var newWin = window.open('', 'Print-Window', 'width=1000,height=600, left=170');
        var name = global_data['data']['fname']+" "+global_data['data']['lname'];
        var cur_date = global_data['date'];
        var balance = $("#balance").val();
        var amount = $("#paid_amount").val();
        var month = month_list[month_num];
        var paid = 0;

        if(amount > balance) {
            paid = balance;
        }
        else {
            paid = amount;
        }
       
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
                            <center><h3 id="title_name">RENTAL RECEIPT</h3></center>\
                        </div>\
                        <div class="col-xs-12" style="margin-top: 30px;">\
                            <p class="pull-right"><b>Date: </b>'+cur_date+'</p>\
                             <table class="table" >\
                                <tbody style="border: 1px solid black">\
                                     <tr>\
                                        <td width="20%" style="border: 1px solid white"><b>Received form:</b></td>\
                                        <td style="border: 1px solid white; border-bottom: 1px solid black" colspan="5">' +name +'</td>\
                                    </tr>\
                                    <tr>\
                                        <td style="border: 1px solid white"><b>the Sum of: </b></td>\
                                        <td width="30%" style="border: 1px solid white; border-bottom: 1px solid black;" colspan="3"></td>\
                                        <td style="border: 1px solid white; border-bottom: 1px solid black;" colspan="2">Php '+paid+'</td>\
                                    </tr>\
                                    <tr>\
                                        <td style="border: 1px solid white"><b>as rent for the month of: </b></td>\
                                        <td style="border: 1px solid white;border-bottom: 1px solid black" colspan="5">'+cur_month+'</td>\
                                    </tr>\
                                    <tr>\
                                        <td style="border: 1px solid white"><b>for the rental property at:</b></td>\
                                        <td style="border: 1px solid white; border-bottom: 1px solid black" colspan="5">Brgy. Old Sagay, Sagay City</td>\
                                    </tr>\
                                </tbody>\
                            </table>\
                            <table class="table" style="margin-top: 70px">\
                                <tbody style="border: 1px solid black">\
                                    <tr>\
                                        <td width="10%" style="border: 1px solid white"><b>Landlord:</b></td>\
                                        <td width="40%" style="border: 1px solid white; border-bottom: 1px solid black"></td>\
                                        <td width="50%" style="border: 1px solid white;"></td>\
                                    </tr>\
                                    <tr>\
                                        <td width="10%" style="border: 1px solid white"><b>Signature:</b></td>\
                                        <td width="40%" style="border: 1px solid white; border-bottom: 1px solid black"></td>\
                                        <td width="50%" style="border: 1px solid white;"></td>\
                                    </tr>\
                                </tbody>\
                            </table>\
                        <div>\
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
