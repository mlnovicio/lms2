<?php
include '../connectMySql.php';
	date_default_timezone_set("Etc/GMT+8");
	require_once'../session.php'; 
    user();
	require_once'../class.php';
	$db=new db_class(); 
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
            <li class="nav-item active">
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
                    <h1 class="h3 mb-0 text-gray-800">Capital Shares</h1>
                    </div>
                    <div class="card shadow mb-4">
<div class="card-body">
<div class="row">
<div class="form-group col-lg-6">
<?php
$count = "";
$sum = "";

$query = "SELECT count(payment_id) as count, sum(amount) as amount FROM `payment_list`
WHERE type_of_payment = 'CAPITAL SHARE' and payee_id = '".$_SESSION['user_id']."'";
$result = $conn->query($query);
while($row = $result->fetch_assoc())
{
$count = $row['count'];
$sum = $row['amount'];
}
?>
<label>Total count of payment</label>
<input type="text" class="form-control"  value="<?php echo $count;?>" readonly >
</div>
<div class="form-group col-lg-6">
<label>Total Amount </label>
<input type="text" class="form-control"  value="<?php echo $sum;?>" readonly />
</div>
</div>
</div>
</div>
 					<!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    
	                                    <thead>
	                                        <tr>
	                                            <th>Reference No.</th>
	                                            <th>Date</th>
	                                            <th>Amount</th>
	                                        </tr>
	                                    </thead>
	                                    <tbody>
	                                    <?php
	                                 
	                                       $query = "SELECT * FROM `payment_list`
											WHERE type_of_payment = 'CAPITAL SHARE' and payee_id = '".$_SESSION['user_id']."'";
	                                       $result = $conn->query($query);
	                                       while($row = $result->fetch_assoc())
	                                       {
	                                       echo "<tr role='row'>";
	                                       echo "<td>" . $row['ref_no'] . "</td>";
	                                       echo "<td>" . $row['date'] . "</td>";
	                                       echo "<td>" . format_number($row['amount']) . "</td>";
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

    

		<!-- Add Loan Modal-->
		<div class="modal fade" id="addModal" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<form method="POST">
					<div class="modal-content">
						<div class="modal-header bg-primary">
							<h5 class="modal-title text-white">Loan Application</h5>
							<button class="close" type="button" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">×</span>
							</button>
						</div>
						<div class="modal-body">
							<div class="form-row">
								<div class="form-group col-xl-6 col-md-6">
									<label>Borrower</label>
									<br />
									<?php $tbl_borrower = $db->display_borrower_user($id);
									while ($fetch = $tbl_borrower->fetch_array()) {
										?>

										<input readonly type="text" placeholder="Borrower's Name" class="form-control"
											value="<?php echo ucfirst($fetch['lastname']) . ", " . ucfirst($fetch['firstname']) . " " . substr(ucfirst($fetch['middlename']), 0, 1) ?>.">
										<?php
									}
									?>
								</div>
								<div class="form-group col-xl-6 col-md-6">
									<label>Salary</label>
									<br />
									<input type="number" min="10000" max="200000" id="slary" required
										placeholder="Current Salary" class="form-control">
								</div>
							</div>


							<!-- loans -->
							<div class="form-row">
								<div class="form-group col-xl-6 col-md-6">
									<label>Loan Type</label>

									<br />
									<select name="type" id="ltype" class="form-control" required>
										<option value="">Select Type</option>

										<?php
										$tbl_loan = $db->display_type();
										$i = 1;

										while ($fetch = $tbl_loan->fetch_array()) {
											echo '<option value="' . $fetch['ltype_id'] . '"  data-max="' . $fetch['maxloan'] . '" data-min="' . $fetch['minloan'] . '" >' . ucwords($fetch['ltype_name']) . '</option>';
										}
										?>

									</select>
								</div>
								<div class="form-group col-xl-6 col-md-6">
									<label>Loan plan</label>
									<br />
									<select name="plan" class="form-control" required id="lplan">
										<option value="">Select Plan</option>
										<?php
										$tbl_loan = $db->display_lplan();
										$i = 1;
										while ($fetch = $tbl_loan->fetch_array()) {
											echo '<option value="' . $fetch['lplan_id'] . '" 
										data-month="' . $fetch['lplan_month'] . '"
										data-interest="' . $fetch['lplan_interest'] . '"
										data-penalty="' . $fetch['lplan_penalty'] . '"
										>' .
												$fetch['lplan_month'] . ' Month/s ' . '[' .
												$fetch['lplan_interest'] . '% Interest ' .
												$fetch['lplan_penalty'] . '% Monthly overdue ]' .
												'</option>';
										}
										?>
									</select>
								</div>
								<input type="text" name="interest" hidden id="interest">
							</div>

							<div class="form-row">
								<div class="form-group col-xl-12 col-md-12">
									<label>Co-Maker</label>

									<br />
									<select name="comaker" id="cm" class="form-control js-states" required
										style="width: 100%; padding: 0.375rem 0.75rem;" multiple="multiple">

										<?php
										$tbl_users = $db->display_user();
										$i = 1;

										while ($fetch = $tbl_users->fetch_array()) {
											if ($fetch['user_id'] != $_SESSION['user_id']) {
												echo '<option value="' . $fetch['user_id'] . '">' . ucfirst($fetch['lastname']) . ", " . ucfirst($fetch['firstname']) . " " . substr(ucfirst($fetch['middlename']), 0, 1) . (strlen($fetch['middlename']) == 0 ? '' : '.') . '</option>';
											}
										}
										?>

									</select>
									<input type="text" name="comakers" hidden id="comakers" required>
								</div>
							</div>
							<div class="form-row">
								<div class="form-group col-xl-12 col-md-12">
									<label>Loan Amount</label>
									<br />
									<input type="number" name="loanable" id="loanAmount" required class="form-control">
								</div>
							</div>
							<hr id="calcTableHr">
							<div class="row" id="calcTable">
								<div class="col-xl-4 col-md-4">
									<center><span>Total Payable Amount</span></center>
									<center><span id="tpa"></span></center>
								</div>
								<div class="col-xl-4 col-md-4">
									<center><span>Monthly Payable Amount</span></center>
									<center><span id="mpa"></span></center>
								</div>
								<div class="col-xl-4 col-md-4">
									<center><span>Penalty Amount</span></center>
									<center><span id="pa"></span></center>
								</div>
							</div>
						</div><!-- end modal body -->
						<div class="modal-footer">
							<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
							<button type="submit" name="apply" class="btn btn-primary">Apply</a>
						</div>
					</div>
				</form>
			</div>
		</div>

		<?php
		if (isset($_POST['apply'])) {
			$digits = 6;
			$randy = rand(pow(10, $digits - 1), pow(10, $digits) - 1);
			$randy2 = rand(pow(10, $digits - 1), pow(10, $digits) - 1);

			$var = explode("/", $_POST['interest']); //split by array 0 = interest 1=months
			$loanRate = ($var[0] / 100) * $_POST['loanable']; //get rate then multiply by loan
		
			if ($db->userLoan($randy, $_POST['type'], $_POST['plan'], $_SESSION['user_id'], $_POST['loanable'], $loanRate, $_POST['comakers'])) {

				echo ("<script LANGUAGE='JavaScript'>
					window.location.href='loan.php';
					</script>");
			}
		}

		?>
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
    <!-- Bootstrap core JavaScript-->
		<script src="../js/jquery.js"></script>
		<script src="../js/bootstrap.bundle.js"></script>

		<!-- Core plugin JavaScript-->
		<script src="../js/jquery.easing.js"></script>


		<!-- Page level plugins -->
		<script src="../js/jquery.dataTables.js"></script>
		<script src="../js/dataTables.bootstrap4.js"></script>


		<!-- Custom scripts for all pages-->
		<script src="../js/sb-admin-2.js"></script>
				<script>
			$(document).ready(function () {
				$('#sharesTxDataTable').DataTable();
			});
	
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
</html>