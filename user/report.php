<?php
date_default_timezone_set("Etc/GMT+8");
require_once '../session.php';
user();
require_once '../class.php';
require '../vendor/autoload.php';
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

    <link href="../fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">


    <link href="../css/sb-admin-2.css" rel="stylesheet">
    <link href="../css/bootstrap-datepicker3.standalone.min.css" rel="stylesheet" type="text/css">
    <link href="../css/select2.css" rel="stylesheet">
    <style>
        @media only screen and (max-width: 600px) {
            .hey {
                padding-left: 0px !important;
            }
        }
        td {
            padding: 5px !important;
        }
    </style>
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-success sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="home.php">
                <div class="sidebar-brand-text mx-3">LUECCO MEMBER</div>
            </a>


            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="home.php">
                    <i class="fas fa-fw fa-home"></i>
                    <span>Home</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="loan.php">
                    <i class="fas fa-fw fas fa-comment-dollar"></i>
                    <span>Loan Application <br> <span class="pl-4 hey"> And Evaluation</span></span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="saving.php">
                    <i class="fas fa-fw fa-donate"></i>
                    <span>Savings</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="capital_share.php">
                    <i class="fas fa-fw fa-chart-pie"></i>
                    <span>Capital Shares</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="message.php">
                    <i class="fas fa-fw fas fa-envelope"></i>
                    <span>Message</span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="report.php">
                    <i class="fas fa-fw fas fa-table"></i>
                    <span>Reports</span></a>
            </li>
            <li class="nav-item">
                    <a class="nav-link" href="password.php">
                        <i class="fas fa-tools "></i>
                        <span>Change Password</span></a>
                </li>
        </ul>
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

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline small" style="color:black;">
                                    <?php echo $db->user_acc($_SESSION['user_id']) ?>
                                </span>
                                <img class="img-profile rounded-circle" src="../image/admin_profile.svg">
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
                    <div class="col-xl-9 col-md-9 mb-4">
                            <div class="card" id="preview-card" style="height: 100%; overflow-x: auto;">
                                <div class="card-body mx-auto align-middle" id="preview-area">
                                <br><br><br><br>Preview
                                </div>
                                <div class="row">
                                    <div class="mx-auto col-md-1 mb-3">
                                        <a class="btn btn-success" hidden id="dl-lpr">Download</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-3 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <!-- <h5 class="card-title">Loan Payments Report</h5> -->
                                    <form method="POST" action="../generate_report.php">
                                        <div class="form-group">
                                            <label for="exampleFormControlSelect1">Report Type</label>
                                            <select name="report-type" class="form-control" id="report-type">
                                                <option value="1" selected>Loan & Payments</option>
                                                <option value="6">Savings Transactions</option>
                                                <option value="7">Capital Shares Transactions</option>
                                            </select>
                                        </div>
                                        <div class="form-row" id="lrn-container">
                                            <div class="form-group col-xl-12 col-md-12">
                                                <label>Reference no</label>
                                                <br />
                                                <select name="loan_id" class="ref_no form-control" id="ref_no"
                                                    required="required" style="width:100%;">
                                                    <option value=""></option>
                                                    <?php
                                                    $tbl_loan = $db->display_loanUser($_SESSION['user_id']);
                                                    while ($fetch = $tbl_loan->fetch_array()) {
                                                        if ($fetch['status'] == 2) {
                                                            ?>
                                                            <option value="<?php echo $fetch['loan_id'] ?>"><?php echo $fetch['ref_no'] . " (" . $fetch['ltype_name'] . ")" ?></option>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group" id="dr-container">
                                            <label for="exampleInputEmail1">Date range</label>
                                            <div class="input-daterange input-group" id="datepicker">
                                                <input type="text" class="input-sm form-control" name="lpr-start"
                                                    id="lpr-start" />
                                                <span class="input-group-addon"
                                                    style="margin-left: 0 !important; margin-right: 0 !important;">to</span>
                                                <input type="text" class="input-sm form-control" name="lpr-end"
                                                    id="lpr-end" />
                                            </div>
                                            <small id="help" class="form-text text-muted">
                                                Select the coverage of report that you want to generate.
                                            </small>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-block">Generate</button>
                                    </form>
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
            <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header bg-success">
                            <h5 class="modal-title text-white">System Information</h5>
                            <a class="" href="loan_type.php">x</a>
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
            <div class="modal fade" id="failedModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header bg-success">
                            <h5 class="modal-title text-white">System Information</h5>
                            <a class="" href="loan_type.php">x</a>
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
                            <a class="btn btn-danger" href="../logout.php">Logout</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bootstrap core JavaScript-->
            <script src="../js/jquery.js"></script>
            <script src="../js/bootstrap.bundle.js"></script>

            <!-- Core plugin JavaScript-->
            <script src="../js/jquery.easing.js"></script>

            <!-- Custom scripts for all pages-->
            <script src="../js/sb-admin-2.js"></script>
            <script src="../js/bootstrap-datepicker.min.js"></script>
            <script src="../js/select2.js"></script>
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
<?php
$protocol = strpos(strtolower($_SERVER['SERVER_PROTOCOL']), 'https') === FALSE ? 'http' : 'https';
$domainLink = $protocol . '://' . $_SERVER['HTTP_HOST'];
if (isset($_GET['report_generated']) && $_GET['report_generated'] == 1):
    $reader = IOFactory::createReader('Xlsx');
    $spreadsheet = $reader->load('../' . $_GET['filename']);
    $writer = IOFactory::createWriter($spreadsheet, 'Html');
?>
    <script>
        $("#preview-card").removeAttr('hidden');
        $("#dl-lpr").removeAttr('hidden');
        $("#dl-lpr").attr("href", "<?php echo $domainLink . "\/lms\/" . $_GET['filename']; ?>");
        $("#preview-area").html(`<?php echo $writer->save('php://output'); ?>`)
        const successModal = new bootstrap.Modal(document.getElementById('successModal'), {})
        // successModal.show()
    </script>
<?php endif;

if (isset($_GET['report_generated']) && $_GET['report_generated'] == 0): ?>
    <script>
        const failedModal = new bootstrap.Modal(document.getElementById('failedModal'), {})
        failedModal.show()
    </script>
<?php endif; ?>

</html>