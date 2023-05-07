<?php
date_default_timezone_set("Etc/GMT+8");
require_once 'session.php';
admin();
require_once 'class.php';
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
                                    <i class="fas fa-tools fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Change Password
                                </a>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->
                <?php 
                include 'connectMySql.php';
                $password_old="";
                $query = "SELECT * FROM user 
                WHERE user_id = ".$_SESSION['user_id']." ";
                $result = $conn->query($query);
                while($row = $result->fetch_assoc())
                {
                $password_old = $row['password'];
                }
                ?>
                <form method="POST" action="change_password.php">
                    <!-- Begin Page Content -->
                    <div class="container-fluid">
                            <input type="hidden" name="password_old" id="password_old"  class="form-control"  value="<?php echo $password_old ;?>" >

                        <!-- Page Heading -->
                        <div class="d-sm-flex align-items-center justify-content-between mb-4">
                            <h1 class="h3 mb-0 text-gray-800">Change Password</h1>
                        </div>
                        <!-- DataTales Example -->
                        <div class="card shadow mb-4">
                            <div class="card-body">
                              <div class="card shadow mb-4">
                            <div class="card-body">
                            <div class="row">
                            <div class="form-group col-lg-12">
                            <label>Current Password</label>
                            <input type="password" name="password1"  id="password1" oninput="verify1()" class="form-control"  value="" >
                            <script type="text/javascript">
                                function verify1() {
                                    if(document.getElementById('password_old').value == document.getElementById('password1').value)
                                    {
                                        document.getElementById('password1').style.borderColor = "green";
                                    }
                                    else
                                    {
                                        document.getElementById('password1').style.borderColor = "red";
                                    }
                                }
                            </script>
                            </div>
                              <div class="form-group col-lg-12">
                            <label>New Password</label>
                            <input type="password" name="password2" id="password2"  class="form-control"  value="" >

                            </div>
                              <div class="form-group col-lg-12">
                            <label>Confirmed Password</label>
                            <input type="password" name="password" id="password" class="form-control"  value=""  oninput="verify2()">
                              <script type="text/javascript">
                                function verify2() {
                                    if(document.getElementById('password2').value == document.getElementById('password').value)
                                    {
                                        document.getElementById('password').style.borderColor = "green";
                                         document.getElementById('button').disabled= false;
                                    }
                                    else
                                    {
                                        document.getElementById('password').style.borderColor = "red";
                                         document.getElementById('button').disabled = true;

                                    }
                                }
                            </script>
                            <input type="hidden" name="user_id" class="form-control"  value="<?php echo $_SESSION['user_id']?>" >

                            </div>
                            <div class="form-group col-lg-12">
                            <label>Save</label>
                            <input type="submit" id="button" class="btn btn-info form-control" value="Save" disabled  />
                            </div>
                            </div>
                            </div>
                            </div>
                            </div>

                        </div>
                    </div>
                </form>
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
                                <label>Middlename</label>
                                <input type="text" name="middlename" class="form-control" required="required" />
                            </div>
                            <div class="form-group">
                                <label>Lastname</label>
                                <input type="text" name="lastname" class="form-control" required="required" />
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control" required="required" />
                            </div>
                            <div class="form-group">
                                <label for="type">User Type</label>
                                <select name="type" id="type" class="custom-select">
                                    <?php echo $_SESSION['user_type'] == 1 ? '<option value="2" >Cashier</option>
                                    <option value="4" >Treasurer</option>' : '' ?>
                                    <option value="3">Borrower</option>
                                </select>
                            </div>
                            <div class="form-check">
                                
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
                    "order": [[3, "asc"]]
                });

                table.search('<?php echo isset($_GET['search']) ? $_GET['search'] : ""; ?>').draw();

                $('#mem-fee-chk-box').on('change', function () {
                    console.log(this.value)
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