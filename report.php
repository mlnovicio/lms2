<?php
date_default_timezone_set("Etc/GMT+8");
require_once 'session.php';
require 'vendor/autoload.php';
admin();
require_once 'class.php';
$db = new db_class();
use PhpOffice\PhpSpreadsheet\IOFactory;

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>LAGUNA UNIVERSITY CREDIT COOPERATIVE LOAN MANAGEMENT SYSTEM</title>

    <link href="fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="css/sb-admin-2.css" rel="stylesheet">
    <link href="css/bootstrap-datepicker3.standalone.min.css" rel="stylesheet" type="text/css">
    <link href="css/select2.css" rel="stylesheet">
    
    <style>
        td {
            padding: 5px !important;
        }
    </style>

</head>

<body onload="box()" id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php require_once 'sidebar.php'; ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow"
                    style="background-color: lightblue!important;">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>


                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
<!-- copy -->
<li class="nav-item dropdown no-arrow">
                    <a class="nav-link dropdown-toggle" href="#" data-toggle="modal" data-backdrop="false" data-target="#notifymembership"  style="position: relative;">

                                <span class="badge bg-info " style="color:white;">
                                    <i class="fas fa-bell" style="color: black;">Notifications
                                    (<span class='numcntloan'></span>)</i>
                                </span>
                            </a>
                        </li>
                    <!-- copy -->
                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline small" style="color:black;">
                                    <?php echo $db->user_acc($_SESSION['user_id']) ?>
                                </span>
                                <img class="img-profile rounded-circle" src="image/admin_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Generate Report</h1>
                    </div>

                    <!-- Content Row -->
                    <div class="row">
                  
                        <div class="col-lg-12 col-md-3 mb-5">
                            <div class="card">

                                <div class="card-body">
                                    <!-- <h5 class="card-title">Loan Payments Report</h5> -->
                                    <form method="POST" action="generate_report.php">
                                        <div class="form-group">
                                            <label for="exampleFormControlSelect1">Report Type</label>
                                            <select name="report_type" class="form-control" id="report_type" onchange=" box()" required>
                                                <option value="2">List of member</option>
                                                <option value="1">All members loan</option>
                                                <option value="3">Membership fee</option>
                                                <option value="4">Capital share</option>
                                            </select>
                                        </div>
                                        <div class="form-row" id="containerzxc">
                                            
                                        </div>
                                        <div class="form-group" id="dr-container">
                                            <label for="exampleInputEmail1">Date range</label>
                                            <div class="input-daterange input-group" id="datepicker">
                                                <input type="text" class="input-sm form-control" name="date1"
                                                    id="date1"  value="<?php date_default_timezone_set('Asia/Manila');
                                                    $date = date('Y-m-d'); echo $date;?>" />
                                                <span class="input-group-addon"
                                                    style="margin-left: 0 !important; margin-right: 0 !important;">to</span>
                                                <input type="text" class="input-sm form-control" name="date2"
                                                    id="date2" value="<?php date_default_timezone_set('Asia/Manila');
                                                    $date = date('Y-m-d'); echo $date;?>" />
                                            </div>
                                            <small id="help" class="form-text text-muted">
                                                Select the coverage of report that you want to generate
                                            </small>
                                        </div>
                                        <div id="generate_button">
                                        
                                        </div>
                                    </form>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
                <!-- End of Main Content -->

                <!-- Footer -->
                <footer class="stocky-footer">
                    <div class="container my-auto">
                        <div class="copyright text-center my-auto">
                            <span>Copyright &copy; LAGUNA UNIVERSITY CREDIT COOPERATIVE LOAN MANAGEMENT SYSTEM
                                <?php echo date("Y") ?>
                            </span>
                        </div>
                    </div>
                </footer>
                <!-- End of Footer -->

            </div>
            <!-- End of Content Wrapper -->

        </div>
        <!-- End of Page Wrapper -->

        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>

        <!-- success modal -->
        <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-success">
                        <h5 class="modal-title text-white">System Information</h5>
                        <a class="" href="report.php">x</a>
                    </div>
                    <div class="modal-body">
                        Report successfully generated.
                    </div>
                    <div class="modal-footer">
                        <a class="btn btn-success" id="dl-lpr">Download</a>
                        <a class="btn btn-secondary" href="report.php">Close</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Failed Modal-->
        <div class="modal fade" id="failedModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-success">
                        <h5 class="modal-title text-white">System Information</h5>
                        <a class="" href="report.php">x</a>
                    </div>
                    <div class="modal-body">
                        Report generation failed.
                    </div>
                    <div class="modal-footer">
                        <a class="btn btn-secondary" href="report.php">Close</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Logout Modal-->
        <div class="modal fade" id="logoutModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-danger">
                        <h5 class="modal-title text-white">System Information</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">Are you sure you want to logout?</div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <a class="btn btn-danger" href="logout.php">Logout</a>
                    </div>
                </div>
            </div>
        </div>
<!-- notifymembership Modal copy-->
<div class="modal fade" id="notifymembership" tabindex="-1" aria-hidden="true" >
        <div class="modal-dialog">
            <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal" style="position: absolute; top: 10px; right: 10px; z-index: 9999;">&times;</button>
            <div class="modal-body">

                <div class="modal-body">
                    <div class='notifcontent'></div>
                </div>

               
            </div>
        </div>
    </div>
 <!-- notifymembership Modal copy-->
        <!-- Bootstrap core JavaScript-->
        <script src="js/jquery.js"></script>
        <script src="js/bootstrap.bundle.js"></script>

        <!-- Core plugin JavaScript-->
        <script src="js/jquery.easing.js"></script>

        <!-- Custom scripts for all pages-->
        <script src="js/sb-admin-2.js"></script>
        <script src="js/bootstrap-datepicker.min.js"></script>
        <script src="js/select2.js"></script>
        <script>
            $('.ref_no').select2({
                placeholder: 'Select a loan'
            });
            $(document).ready(function () {

                $('#dr-container .input-daterange').datepicker({
                    autoclose: true,
                    format: "yyyy-mm-dd"
                });

                $('#lpr-start').on('change', function () {
                    console.log($('#lpr-start').val())
                });
                $('#lpr-end').on('change', function () {
                    console.log($('#lpr-end').val())
                });
                $('#report-type').on('change', function () {
                    var val = $('#report-type').val();
                    if (val == 1) {
                        $('#lrn-container').show();
                        $('#ref_no').attr('required', 'required');
                    } else {
                        $('#lrn-container').hide();
                        $('#ref_no').removeAttr('required');
                    }
                });
            });
        </script>

</body>



<script type="text/javascript">




  $(document).ready(function(){ 
  $(document).on('click', '.REPORT_FUNCTION', function(){
    var report = document.getElementById('report_type').value;
    if(report == '1')
    {
        var loan_type = document.getElementById('loan_type').value;
        document.cookie = "date1="+document.getElementById('date1').value;
        document.cookie = "date2="+document.getElementById('date2').value;
        document.cookie = "loan_type="+document.getElementById('loan_type').value;

    }
    else if(report == '2')
    {
        const link = document.querySelector('a');
        document.cookie = "date1="+document.getElementById('date1').value;
        document.cookie = "date2="+document.getElementById('date2').value;
    }
 })
});

  function box() {
     var report = document.getElementById('report_type').value;
      if(report == '1')
    {
      document.getElementById('containerzxc').innerHTML = '<div class="form-group col-xl-12 col-md-12"><label>Type of loan</label><br /><select name="loan_type" class="report_type form-control" id="loan_type"style="width:100%;"required><option value="6000">Emergency Loan (Php 6,000)</option><option value="12000">Short Term Loan (Php 12,000)</option></select></div>';
      document.getElementById('generate_button').innerHTML = '<a  href="report1.php"  target="_blank" class="btn btn-primary btn-block REPORT_FUNCTION">Generate</a>';
   }
   else  if(report == '2')
   {
      document.getElementById('containerzxc').innerHTML = '';
           document.getElementById('generate_button').innerHTML = '<a  href="report2.php"  target="_blank" class="btn btn-primary btn-block REPORT_FUNCTION">Generate</a>';
   }
     else  if(report == '3')
   {
      document.getElementById('containerzxc').innerHTML = '';
           document.getElementById('generate_button').innerHTML = '<a  href="report3.php"  target="_blank" class="btn btn-primary btn-block REPORT_FUNCTION">Generate</a>';
   }
     else  if(report == '4')
   {
      document.getElementById('containerzxc').innerHTML = '';
           document.getElementById('generate_button').innerHTML = '<a  href="report4.php"  target="_blank" class="btn btn-primary btn-block REPORT_FUNCTION">Generate</a>';
   }
  }
// copy
$(document).ready(function() {
    // Load the initial content of the modal via AJAX
    $('.notifcontent').load('load_notification.php');

    // Refresh the content of the modal every 10 seconds
    setInterval(function() {
        $('.notifcontent').load('load_notification.php');
    }, 10000);

    // counter Load the initial content of the modal via AJAX
    $('.numcntloan').load('counter.php');

    // counter Refresh the content of the modal every 10 seconds
    setInterval(function() {
        $('.numcntloan').load('counter.php');
    }, 10000);
});
// copy

</script>
<style>
/*copy*/
  /*Position the modal to the right */
  #notifymembership .modal-dialog {
      position: absolute;
      right: 200px;
      top:20px;
      width: 7  00px;
  }

  /* Adjust the positioning of the backdrop */
  #notifymembership .modal-backdrop {
      right: auto;
      left: 0;
  }
  .column {
        display: inline-block;
        vertical-align: top;
    }
  /*copy*/  
</style>
</html>