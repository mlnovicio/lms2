<?php
date_default_timezone_set("Asia/Manila");
require_once 'session.php';
admin();
require_once 'class.php';
$db = new db_class();

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<style>
		input[type=number]::-webkit-inner-spin-button,
		input[type=number]::-webkit-outer-spin-button {
			-webkit-appearance: none;
		}
	</style>


	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<title>LAGUNA UNIVERSITY CREDIT COOPERATIVE LOAN MANAGEMENT SYSTEM</title>

	<link href="fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">


	<link href="css/sb-admin-2.css" rel="stylesheet">

	<!-- Custom styles for this page -->
	<link href="css/dataTables.bootstrap4.css" rel="stylesheet">
	<link href="css/select2.css" rel="stylesheet">

</head>

<body id="page-top">

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
						<h1 class="h3 mb-0 text-gray-800">Savings Accounts and Transactions</h1>
					</div>
					<ul class="nav nav-tabs">

						<li class="nav-item">
							<button class="btn btn-sm btn-primary nav-link" href="#" data-toggle="modal"
								data-target="#addModal"><span class="fa fa-plus"></span>
								New Account</button>
						</li>
						<li class="nav-item">
							<a class="nav-link active" data-toggle="tab" href="#savingsAccountsTab">Accounts</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" data-toggle="tab" href="#txsTab">Transactions</a>
						</li>
					</ul>
					<div class="tab-content">
						<div role="tabpanel" class="tab-pane active" id="savingsAccountsTab">
							<?php include('savingsAccount.php') ?>
						</div>
						<div role="tabpanel" class="tab-pane fade in" id="txsTab">
							<?php include('savingsTransactions.php') ?>
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


		<!-- Add Savings Account Modal-->
		<div class="modal fade" id="addModal" aria-hidden="true">
			<div class="modal-dialog modal-md">
				<form method="POST" action="save_savings_account.php">
					<div class="modal-content">
						<div class="modal-header bg-primary">
							<h5 class="modal-title text-white">Savings Account Application</h5>
							<button class="close" type="button" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">×</span>
							</button>
						</div>
						<div class="modal-body">
							<div class="form-row">
								<div class="form-group col-xl-12 col-md-12">
									<label>Account Owner</label>
									<br />
									<select name="account_owner" class="borrow" required="required" style="width:100%;">
										<option value=""></option>
										<?php
										$tbl_borrower = $db->display_borrower();
										while ($fetch = $tbl_borrower->fetch_array()) {
											?>
											<option value="<?php echo $fetch['user_id'] ?>"><?php echo ucfirst($fetch['lastname']) . ", " . ucfirst($fetch['firstname']) . " " . substr(ucfirst($fetch['middlename']), 0, 1) ?>.</option>
											<?php
										}
										?>
									</select>
								</div>
								<div class="form-group col-xl-12 col-md-12">
									<label>Account Name</label>
									<input type="text" name="account_name" class="form-control" id="account_name"
										required="required" />
								</div>
							</div>

						</div>
						<div class="modal-footer">
							<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
							<button type="submit" name="apply" class="btn btn-primary">Apply</a>
						</div>
					</div>
				</form>
			</div>
		</div>

		<!-- Savings Account creation success modal -->
		<div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header bg-success">
						<h5 class="modal-title text-white">System Information</h5>
						<a class="" href="saving.php">x</a>
					</div>
					<div class="modal-body">
						Savings Account successfully added.
					</div>
					<div class="modal-footer">
						<a class="btn btn-success" href="saving.php">Close</a>
					</div>
				</div>
			</div>
		</div>

		<!-- Add Savings success modal -->
		<div class="modal fade" id="savingSavedSuccessModal" tabindex="-1" aria-labelledby="exampleModalLabel"
			aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header bg-success">
						<h5 class="modal-title text-white">System Information</h5>
						<a class="" href="saving.php">x</a>
					</div>
					<div class="modal-body">
						Savings successfully updated.
					</div>
					<div class="modal-footer">
						<a class="btn btn-success" href="saving.php">Close</a>
					</div>
				</div>
			</div>
		</div>

		<!-- Account deactivated modal -->
		<div class="modal fade" id="accDeactivatedModal" tabindex="-1" aria-labelledby="exampleModalLabel"
			aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header bg-success">
						<h5 class="modal-title text-white">System Information</h5>
						<a class="" href="saving.php">x</a>
					</div>
					<div class="modal-body">
						Account is now deactivated.
					</div>
					<div class="modal-footer">
						<a class="btn btn-success" href="saving.php">Close</a>
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
		<script src="js/select2.js"></script>


		<!-- Page level plugins -->
		<script src="js/jquery.dataTables.js"></script>
		<script src="js/dataTables.bootstrap4.js"></script>


		<!-- Custom scripts for all pages-->
		<script src="js/sb-admin-2.js"></script>

		<script>
			$(".tugler").click(function () {
				$(".balancer").val($(this).attr("data-balance"))
			})
			$(document).ready(function () {

				$('.borrow').select2({
					placeholder: 'Select an owner'
				});

				$('#savingsAccntsDataTable').DataTable();
				$('#savingsTxDataTable').DataTable();

				$('input[type=radio][name=tx_type]').change(function () {
					if (this.value == '1') {
						$('#dep-wit-amount').attr('max', '')
						$('#dep-wit-amount').removeAttr('readonly')
					}
					else if (this.value == '0') {
						if ($('#total_balance').val() <= 0) {
							$('#dep-wit-amount').attr('readonly', 'readonly')
						} else {
							$('#dep-wit-amount').attr('max', $('#total_balance').val())
						}

					}
				});

				$('#dep-wit-amount-update').on("input", function () {
					if ($('input[type=radio][name=tx_type_update][checked]').val() == '1') {
						$('#dep-wit-amount-update').removeAttr('max')
						$('#dep-wit-amount-update').removeAttr('readonly')
					}
					if ($('input[type=radio][name=tx_type_update][checked]').val() == '0') {
						if ($('#total_balance_update').val() <= 0 && $('#dep-wit-amount-update').val() > $('#total_balance_update').val()) {
							$('#dep-wit-amount-update').attr('max', Math.abs($('#current_tx_amount').val()))
						}
					}
				});
			});

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
</body>
<?php if (isset($_GET['account_added']) && $_GET['account_added'] == 1): ?>
	<script>
		const myModal = new bootstrap.Modal(document.getElementById('successModal'), {})
		myModal.show()
	</script>
<?php endif; ?>
<?php if (isset($_GET['saving_updated']) && $_GET['saving_updated'] == 1): ?>
	<script>
		const myModal = new bootstrap.Modal(document.getElementById('savingSavedSuccessModal'), {})
		myModal.show()
	</script>
<?php endif; ?>
<?php if (isset($_GET['account_deactivated']) && $_GET['account_deactivated'] == 1): ?>
	<script>
		const myModal = new bootstrap.Modal(document.getElementById('accDeactivatedModal'), {})
		myModal.show()
	</script>
<?php endif; ?>

</html>