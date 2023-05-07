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



    <!-- Custom styles for this page -->
    <link href="css/dataTables.bootstrap4.css" rel="stylesheet">
    <link href="css/sb-admin-2.css" rel="stylesheet">


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
                        <h1 class="h3 mb-0 text-gray-800">Loan Type</h1>
                    </div>

                    <!-- Content Row -->
                    <div class="row">
                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <form method="POST" action="save_ltype.php">
                                        <div class="form-group">
                                            <label>Loan Name</label>
                                            <input type="text" class="form-control" name="ltype_name"
                                                required="required" />
                                        </div>
                                        <!-- <div class="form-group">
                                            <label>Loan Description</label>
                                            <textarea style="resize:none;" class="form-control" name="ltype_desc" required="required"></textarea>
                                        </div> -->
                                        <div class="form-group">
                                            <label>Loan Minimum</label>
                                            <input type="number" class="form-control" min="500" name="minloan"
                                                required="required" />
                                        </div>
                                        <div class="form-group">
                                            <label>Loan Maximum</label>
                                            <input type="number" class="form-control" min="1000" name="maxloan"
                                                required="required" />
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-block"
                                            name="save">Save</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-9  mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>Loan Name</th>
                                                    <th>Minimum Loanable Amount</th>
                                                    <th>Maximum Loanable Amount</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $tbl_ltype = $db->display_ltype();
                                                while ($fetch = $tbl_ltype->fetch_array()) {
                                                    ?>
                                                    <tr>
                                                        <td>
                                                            <?php echo $fetch['ltype_name'] ?>
                                                        </td>
                                                        <td>
                                                            <?php echo '₱ ' . number_format($fetch['minloan'], 2) ?>
                                                        </td>
                                                        <td>
                                                            <?php echo '₱ ' . number_format($fetch['maxloan'], 2) ?>
                                                        </td>
                                                        <td>
                                                            <div class="dropdown">
                                                                <button class="btn btn-secondary dropdown-toggle"
                                                                    type="button" id="dropdownMenuButton"
                                                                    data-toggle="dropdown" aria-haspopup="true"
                                                                    aria-expanded="false">
                                                                    Action
                                                                </button>
                                                                <div class="dropdown-menu"
                                                                    aria-labelledby="dropdownMenuButton">
                                                                    <a class="dropdown-item bg-warning text-white" href="#"
                                                                        data-toggle="modal"
                                                                        data-target="#updateltype<?php echo $fetch['ltype_id'] ?>">Edit</a>
                                                                    <a class="dropdown-item bg-danger text-white" href="#"
                                                                        data-toggle="modal"
                                                                        data-target="#deleteltype<?php echo $fetch['ltype_id'] ?>">Delete</a>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>


                                                    <!-- Delete Loan Type Modal -->

                                                    <div class="modal fade" id="deleteltype<?php echo $fetch['ltype_id'] ?>"
                                                        tabindex="-1" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header bg-danger">
                                                                    <h5 class="modal-title text-white">System Information
                                                                    </h5>
                                                                    <button class="close" type="button" data-dismiss="modal"
                                                                        aria-label="Close">
                                                                        <span aria-hidden="true">×</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">Are you sure you want to delete this
                                                                    record?</div>
                                                                <div class="modal-footer">
                                                                    <button class="btn btn-secondary" type="button"
                                                                        data-dismiss="modal">Cancel</button>
                                                                    <a class="btn btn-danger"
                                                                        href="delete_ltype.php?ltype_id=<?php echo $fetch['ltype_id'] ?>">Delete</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Update Loan Type Modal -->

                                                    <div class="modal fade" id="updateltype<?php echo $fetch['ltype_id'] ?>"
                                                        tabindex="-1" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <form method="POST" action="update_ltype.php">
                                                                <div class="modal-content">
                                                                    <div class="modal-header bg-warning">
                                                                        <h5 class="modal-title text-white">Edit Loan Type
                                                                        </h5>
                                                                        <button class="close" type="button"
                                                                            data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">×</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="form-group">
                                                                            <label>Loan Name</label>
                                                                            <input type="text" class="form-control"
                                                                                value="<?php echo $fetch['ltype_name'] ?>"
                                                                                name="ltype_name" required="required" />
                                                                            <input type="hidden" class="form-control"
                                                                                value="<?php echo $fetch['ltype_id'] ?>"
                                                                                name="ltype_id" />
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label>Loan Minimum</label>
                                                                            <input type="number" class="form-control"
                                                                            value="<?php echo $fetch['minloan'] ?>"    
                                                                            min="500" name="minloan"
                                                                                required="required" />
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label>Loan Maximum</label>
                                                                            <input type="number" class="form-control"
                                                                            value="<?php echo $fetch['maxloan'] ?>"     
                                                                            min="1000" name="maxloan"
                                                                                required="required" />
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button class="btn btn-secondary" type="button"
                                                                            data-dismiss="modal">Cancel</button>
                                                                        <button type="submit" name="update"
                                                                            class="btn btn-warning">Update</a>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>

                                                    <?php
                                                }
                                                ?>
                                            </tbody>
                                        </table>
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
            <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header bg-success">
                            <h5 class="modal-title text-white">System Information</h5>
                            <a class="" href="loan_type.php">x</a>
                        </div>
                        <div class="modal-body">
                            Loan type successfully added.
                        </div>
                        <div class="modal-footer">
                            <a class="btn btn-success" href="loan_type.php">Close</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- success modal -->
            <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header bg-success">
                            <h5 class="modal-title text-white">System Information</h5>
                            <a class="" href="loan_type.php">x</a>
                        </div>
                        <div class="modal-body">
                            Loan type successfully updated.
                        </div>
                        <div class="modal-footer">
                            <a class="btn btn-success" href="loan_type.php">Close</a>
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

            <!-- Bootstrap core JavaScript-->
            <script src="js/jquery.js"></script>
            <script src="js/bootstrap.bundle.js"></script>

            <!-- Core plugin JavaScript-->
            <script src="js/jquery.easing.js"></script>

            <!-- Custom scripts for all pages-->
            <script src="js/sb-admin-2.js"></script>

            <!-- Page level plugins -->
            <script src="js/jquery.dataTables.js"></script>
            <script src="js/dataTables.bootstrap4.js"></script>

            <script>
                $(document).ready(function () {
                    $('#dataTable').DataTable({
                        "order": [[1, "asc"]]
                    });

                });
            </script>

</body>
<?php if (isset($_GET['ltype_added']) && $_GET['ltype_added'] == 1): ?>
    <script>
        const myModal = new bootstrap.Modal(document.getElementById('successModal'), {})
        myModal.show()
    </script>
<?php endif; ?>
<?php if (isset($_GET['ltype_updated']) && $_GET['ltype_updated'] == 1): ?>
    <script>
        const myModal = new bootstrap.Modal(document.getElementById('updateModal'), {})
        myModal.show()
    </script>
<?php endif; ?>

</html>