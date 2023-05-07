<?php
date_default_timezone_set("Etc/GMT+8");
require_once 'session.php';
admin();
require_once 'class.php';
$db = new db_class();
$_SESSION['user_id_admin'] = $_GET['user'];
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <title>LAGUNA UNIVERSITY CREDIT COOPERATIVE LOAN MANAGEMENT SYSTEM</title>

    <link href="fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">


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
                    style="background-color: lightblue !important;">

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
                                <span class="mr-2 d-none d-lg-inline text-white-600 small" style="color:black;">
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
                    <div class="d-sm-flex align-items-center justify-content-between mb-4 ">
                        <h1 class="h3 mb-0 text-gray-800">Message</h1>
                    </div>

                    <!-- Content Row -->
                    <div class="row mb-4">
                        <div class="container-fluid">
                            <?php
                            $tbl_loans = $db->displayMessage($_SESSION['user_id_admin']);
                            //   while ($fetch1=$tbl_loans->fetch_array()){
                            $fetch1 = $tbl_loans->fetch_array();
                            $fetch1['lastname'];
                            ?>



                            <div class="col-md text-center h3"><?php echo ucfirst($fetch1['lastname']) . ", " . ucfirst($fetch1['firstname']) . " " . substr(ucfirst($fetch1['middlename']), 0, 1) . "." ?></div>

                            <div class="col-md text-center"><a style="cursor: pointer;" id="seeall"
                                    class="text-warning">See all message</a></div>
                            <div id="chathis">
                                <?php include("chathistory.php");
                                ?>

                            </div>
                            <div id="chats">
                                <?php include("chat.php") ?>
                            </div>
                        </div>
                        <script>
                            $('#chathis').hide();
                            notClick(500)

                            function notClick(timer) {
                                $(function () {
                                    setTimeout(function () { $("#hideme").fadeOut(0); }, timer)
                                })
                                var timeout = setInterval(reloadChat, 500);
                                function reloadChat() {
                                    $('#chats').load('chat.php');
                                }

                            }
                            $('#seeall').click(function () {
                                $('#chats').hide();
                                $('#seeall').hide();
                                $('#chathis').show();

                            });


                        </script>
                        <div class="col-md">
                            <div class="row pt-4">
                                <div class="col-sm-11">
                                    <form action="" method="POST">
                                        <input type="text" name="send" placeholder="Input Message to user.."
                                            class="form-control">
                                </div>
                                <div class="col-sm-1">
                                    <button type="submit" id="subm" name="sendMessage"
                                        class="form-control">Send</button>
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
        <?php
        if (isset($_POST['sendMessage'])) {
            $db->sendMessageAdmin($_GET['user'], $_POST['send']);
        }
        ?>
        <!-- Bootstrap core JavaScript-->
        <script src="js/jquery.js"></script>
        <script src="js/bootstrap.bundle.js"></script>

        <!-- Core plugin JavaScript-->
        <script src="js/jquery.easing.js"></script>

        <!-- Custom scripts for all pages-->
        <script src="js/sb-admin-2.js"></script>


</body>

</html>