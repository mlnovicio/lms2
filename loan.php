<?php
date_default_timezone_set("Etc/GMT+8");
require_once 'session.php';
admin();
require_once 'class.php';
require_once 'connectMySql.php';

$db = new db_class();
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>LAGUNA UNIVERSITY CREDIT COOPERATIVE LOAN MANAGEMENT SYSTEM</title>

    <link href="fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    <link href="css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="css/dataTables.bootstrap4.css" rel="stylesheet">

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
                        <h1 class="h3 mb-0 text-gray-800">Loans</h1>
                    </div>
                  
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="table-responsive">
                               <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
								<thead>
									<tr>
										<th>Cooperators</th>
										<th>Loan Amount</th>
										<th>Balance</th>
										<th>Payment</th>
										<th>Payable up to</th>
                                        <th>Status</th>
										<th>Date</th>
										<th>View payments</th>
									</tr>
								</thead>
								<tbody>
									<?php
							   
							       $query = "SELECT date,a.user_id,concat(b.firstname,' ',b.lastname)as name,loan_id,(type_of_loan + compute2) as amount,((type_of_loan + compute2) + compute3 - payments) as balance,payments,compute3, if(((type_of_loan + compute2) + compute3 - payments) =0,'COMPLETED', status) as status FROM `loans` a
                                       LEFT JOIN user b ON b.user_id = a.user_id";
							       $result = $conn->query($query);
							       while($row = $result->fetch_assoc())
							       {
							       echo "<tr role='row'>";
							       echo "<td>" . $row['name'] . "</td>";
                                   echo "<td>" . format_number($row['amount']) . "</td>";
							       echo "<td>" . format_number($row['balance']) . "</td>";
							       echo "<td>" . format_number($row['payments']) . "</td>";
							       echo "<td>" . $row['compute3'] . "</td>";
                                   echo "<td>" . $row['status'] . "</td>";
							       echo "<td>" . $row['date'] . "</td>";

							       if($_SESSION['user_type'] == 4 )
							       {	
							       echo "<td><a class='btn btn-info view_loan' id= '".$row['loan_id']."' href='loan_form1.php' target='_blank'><i class='fas fa-fw fas fa-edit' ></i></a>  <a class='btn btn-info view_loan_payment' id= '".$row['user_id']."' href='user/payments_pdf.php' target='_blank'><i class='fas fa-fw fas fa-eye'></i></a></td>";
							  	   }

							  	   if($_SESSION['user_type'] == 1)
							       {	
							       echo "<td><a class='btn btn-info view_loan' id= '".$row['loan_id']."' href='loan_form2.php' target='_blank'><i class='fas fa-fw fas fa-edit' ></i></a>  <a class='btn btn-info view_loan_payment' id= '".$row['user_id']."' href='user/payments_pdf.php' target='_blank'><i class='fas fa-fw fas fa-eye'></i></a></td>";
							  	   }

                                   if($_SESSION['user_type'] == 2)
                                   {    
                                   echo "<td> <a class='btn btn-info view_loan_payment' id= '".$row['user_id']."' href='user/payments_pdf.php' target='_blank'><i class='fas fa-fw fas fa-eye'></i></a></td>";
                                   }
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


        <!-- Add User Modal-->
        <div class="modal fade" id="addModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <form method="POST" action="addUser.php">
                    <div class="modal-content">
                        <div class="modal-header bg-primary">
                            <h5 class="modal-title text-white">Add User</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" name="username" class="form-control" required="required" />
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" name="password" class="form-control" required="required" />
                            </div>
                            <div class="form-group">
                                <label>Firstname</label>
                                <input type="text" name="firstname" class="form-control" required="required" />
                            </div>
                            <div class="form-group">
                                <label>Lastname</label>
                                <input type="text" name="lastname" class="form-control" required="required" />
                            </div>
                            <div class="form-group">
                                <label for="type">User Type</label>
                                <select name="type" id="type" class="custom-select">
                                    <?php echo $_SESSION['user_type'] == 1 ? '<option value="2" >Staff</option>' : '' ?>
                                    <option value="4">Borrower</option>
                                </select>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" name="mem-fee"
                                    id="mem-fee-chk-box">
                                <label class="form-check-label" for="mem-fee-chk-box">
                                    Paid Membership Fee?
                                </label>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                            <button type="submit" name="confirm" class="btn btn-primary">Confirm</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- insert success modal -->
        <div class="modal fade" id="successModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-success">
                        <h5 class="modal-title text-white">System Information</h5>
                        <a class="" href="user.php">x</a>
                    </div>
                    <div class="modal-body">
                        User successfully added.
                    </div>
                    <div class="modal-footer">
                        <a class="btn btn-success" href="user.php">Close</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- edit success modal -->
        <div class="modal fade" id="editSuccessModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-success">
                        <h5 class="modal-title text-white">System Information</h5>
                        <a class="" href="user.php">x</a>
                    </div>
                    <div class="modal-body">
                        User successfully updated.
                    </div>
                    <div class="modal-footer">
                        <a class="btn btn-success" href="user.php">Close</a>
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


        <!-- Page level plugins -->
        <script src="js/jquery.dataTables.js"></script>
        <script src="js/dataTables.bootstrap4.js"></script>


        <!-- Custom scripts for all pages-->
        <script src="js/sb-admin-2.js"></script>

        <script>
            $(document).ready(function () {
                var table = $('#dataTable').DataTable({
                    "order": [[6, "desc"]]
                });

                table.search('<?php echo isset($_GET['search']) ? $_GET['search'] : ""; ?>').draw();

                $('#mem-fee-chk-box').on('change', function () {
                    console.log(this.value)
                });
            });
        </script>

</body>


<?php if (isset($_GET['user_added']) && $_GET['user_added'] == 1): ?>
    <script>
        const myModal = new bootstrap.Modal(document.getElementById('successModal'), {})
        myModal.show()
    </script>
<?php endif; ?>
<?php if (isset($_GET['user_updated']) && $_GET['user_updated'] == 1): ?>
    <script>
        const editSuccessModal = new bootstrap.Modal(document.getElementById('editSuccessModal'), {})
        editSuccessModal.show()
    </script>
<?php endif; ?>

<script>
  $(document).ready(function(){ 
  $(document).on('click', '.view_loan', function(){
  var loan_id = $(this).attr("id");
  document.cookie = "loan_id="+loan_id+"" ;
 })
});

    $(document).ready(function(){ 
  $(document).on('click', '.update_status', function(){
  var membership_id = $(this).attr("id");
  document.cookie = "membership_id="+membership_id+"" ;
      Swal.fire({
      title: 'Do you want to save the changes?',
      showDenyButton: true,
      showCancelButton: true,
      confirmButtonText: 'Save',
      denyButtonText: `Don't save`,
    }).then((result) => {
      /* Read more about isConfirmed, isDenied below */
      if (result.isConfirmed) {
        Swal.fire('Saved!', '', 'success')
        window.location.href = "membership_update.php";
      } else if (result.isDenied) {
        Swal.fire('Changes are not saved', '', 'info')
      }
    })
 })
});

$(document).ready(function(){ 
  $(document).on('click', '.delete_status', function(){
  var membership_id = $(this).attr("id");
  document.cookie = "membership_id="+membership_id+"" ;
      Swal.fire({
      title: 'Do you want to save the changes?',
      showDenyButton: true,
      showCancelButton: true,
      confirmButtonText: 'Save',
      denyButtonText: `Don't save`,
    }).then((result) => {
      /* Read more about isConfirmed, isDenied below */
      if (result.isConfirmed) {
        Swal.fire('Saved!', '', 'success')
        window.location.href = "membership_declined.php";
      } else if (result.isDenied) {
        Swal.fire('Changes are not saved', '', 'info')
      }
    })
 })
});

                         $(document).ready(function(){ 
  $(document).on('click', '.view_loan_payment', function(){
  var user_id = $(this).attr("id");
  document.cookie = "user_id="+user_id+"" ;
 })
});

$(document).ready(function(){ 
  $(document).on('click', '.approved_status', function(){
  var membership_id = $(this).attr("id");
  document.cookie = "membership_id="+membership_id+"" ;
      Swal.fire({
      title: 'Do you want to save the changes?',
      showDenyButton: true,
      showCancelButton: true,
      confirmButtonText: 'Save',
      denyButtonText: `Don't save`,
    }).then((result) => {
      /* Read more about isConfirmed, isDenied below */
      if (result.isConfirmed) {
        Swal.fire('Saved!', '', 'success')
        window.location.href = "membership_approved.php";
      } else if (result.isDenied) {
        Swal.fire('Changes are not saved', '', 'info')
      }
    })
 })
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
</html>