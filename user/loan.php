<?php
include '../connectMySql.php';
date_default_timezone_set("Etc/GMT+8");
require_once '../session.php';
user();
require_once '../class.php';
$db = new db_class();
$id = $_SESSION['user_id'];
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
    
<style>
@media only screen and (max-width: 600px) {
  .hey {
    padding-left: 0px!important;
  }
}</style>
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
			<li class="nav-item active">
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
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow"  style="background-color: lightblue!important;">

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
                                <span class="mr-2 d-none d-lg-inline small"style="color:black;"><?php echo $db->user_acc($_SESSION['user_id'])?></span>
                                <img class="img-profile rounded-circle"
                                    src="../image/admin_profile.svg">
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
                        <h1 class="h3 mb-0 text-gray-800">Loan List</h1>
                    </div>

                    <!-- Content Row -->
                 
                    <?php
				
					$balance= "";
                   $query = "SELECT loan_id, (type_of_loan+compute2) AS amount,( (type_of_loan+compute2) + compute3 - payments ) AS balance,
							payments,
							compute3,
							STATUS 
							FROM
							`loans` a
							where a.user_id ='".$id."' ORDER BY
							loan_id LIMIT 1";
                   $result = $conn->query($query);
                   while($row = $result->fetch_assoc())
                   {
                   	$balance= $row['balance'];
                   }
					if($_COOKIE['total_share'] >= 20000 && 	$balance <= 0)
					{
					echo'<a class="mb-2 btn btn-lg btn-primary" href="loan_form.php" target="_blank"><span class="fa fa-plus"></span> Apply new Loan Application</a>';
					}
					?>

					<!-- DataTales Example -->
					<div class="card shadow mb-4">
						<div class="card-body">
							<div class="table-responsive">
								<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
									<thead>
										<tr>
											<th>Loan Amount</th>
											<th>Balance</th>
											<th>Payment</th>
											<th>Payable up to</th>
											<th>Status</th>
											<th>View payments</th>
										</tr>
									</thead>
									<tbody>
										<?php
                                    	
                                       $query = "SELECT concat(b.firstname,' ',b.lastname)as name,loan_id,(type_of_loan + compute2) as amount,((type_of_loan + compute2) + compute3 - payments) as balance,payments,compute3, status FROM `loans` a
										LEFT JOIN user b ON b.user_id = a.user_id where a.user_id ='".$id."'";
                                       $result = $conn->query($query);
                                       while($row = $result->fetch_assoc())
                                       {
                                       echo "<tr role='row'>";
                                       echo "<td>" . format_number($row['amount']) . "</td>";
                                       echo "<td>" . format_number($row['balance']) . "</td>";
                                       echo "<td>" . format_number($row['payments']) . "</td>";
                                   
                                       echo "<td>" . $row['compute3'] . "</td>";
                                       echo "<td>" . $row['status'] . "</td>";
                                       echo "<td><a class='btn btn-info view_loan' id= '".$row['loan_id']."' href='view_loan_form.php' target='_blank'><i class='fas fa-fw fas fa-download'></i></a>
                                      		 <a class='btn btn-info view_loan_payment' id= '".$id."' href='payments_pdf.php' target='_blank'><i class='fas fa-fw fas fa-eye'></i></a></td>";
                                       }
                                       ?>
									</tbody>
								</table>
							</div>
						</div>

					</div>
                    
                    
            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="stocky-footer">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; LAGUNA UNIVERSITY CREDIT COOPERATIVE LOAN MANAGEMENT SYSTEM <?php echo date("Y")?></span>
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
    <script src="../js/jquery.js"></script>
    <script src="../js/bootstrap.bundle.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../js/jquery.easing.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../js/sb-admin-2.js"></script>

	<script>
                            // copy
$(document).ready(function() {
    // Load the initial content of the modal via AJAX
    $('.notifcontent').load('../load_notification.php');

    // Refresh the content of the modal every 10 seconds
    setInterval(function() {
        $('.notifcontent').load('../load_notification.php');
    }, 10000);

    // counter Load the initial content of the modal via AJAX
    $('.numcntloan').load('../counter.php');

    // counter Refresh the content of the modal every 10 seconds
    setInterval(function() {
        $('.numcntloan').load('../counter.php');
    }, 10000);
});
// copy
</script>

</body>
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
</body>

</html>