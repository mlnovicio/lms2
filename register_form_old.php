<?php
date_default_timezone_set("Etc/GMT+8");
require_once 'class.php';
$db = new db_class();
if (isset($_POST['submit'])) {
   if ($_POST['password'] == $_POST['cpassword']) {
      $db->add_user2($_POST['user'], $_POST['password'], $_POST['f'], $_POST['m'], $_POST['l'], $_POST['email'], $_POST['address'], $_POST['contact']);
      echo "<script>alert('Register successfully')</script>";
      echo "<script>window.location='index.php'</script>";
   } else {
      echo "Password is not the same";
   }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

   <title>LUECCO - Memeber Registration</title>

   <link href="fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
   <link href="css/sb-admin-2.css" rel="stylesheet">

</head>

<body id="page-top">

   <!-- Page Wrapper -->
   <div id="wrapper">

      <!-- Content Wrapper -->
      <div id="content-wrapper" class="d-flex flex-column">

         <!-- Main Content -->
         <div id="content">

            <!-- Begin Page Content -->
            <div class="container-fluid">

               <!-- Page Heading -->
               <div class="row">
                  <div class="d-sm-flex mb-4 mt-4 mx-auto">
                     <h1 class="h3 mb-0 text-gray-800">Member Registration Form</h1>
                  </div>
               </div>

               <!-- Content Row -->
               <div class="row">
                  <div class="mx-auto col-xl-3 col-md-6 mb-4">
                     <div class="card">
                        <div class="card-body">
                           <?php
                           if (isset($error)) {
                              foreach ($error as $error) {
                                 echo '<div class="alert alert-danger" role="alert"><i class="fas fa-info-circle"></i>&nbsp;' . $error . '</div>';
                              }
                           }
                           ?>
                           <form method="POST" action="">
                              <div class="form-group">
                                 <label for="exampleFormControlSelect1">First Name</label>
                                 <input type="text" class="form-control" name="f" required
                                    placeholder="enter your first name">
                              </div>
                              <div class="form-group">
                                 <label for="exampleFormControlSelect1">Middle Name</label>
                                 <input type="text" class="form-control" name="m" required
                                    placeholder="enter your middle name">
                              </div>
                              <div class="form-group">
                                 <label for="exampleFormControlSelect1">Last Name</label>
                                 <input type="text" class="form-control" name="l" required
                                    placeholder="enter your last name">
                              </div>
                              <div class="form-group">
                                 <label for="exampleFormControlSelect1">Email</label>
                                 <input type="email" class="form-control" name="email" required
                                    placeholder="enter your email">
                              </div>
                              <div class="form-group">
                                 <label for="exampleFormControlSelect1">Username</label>
                                 <input type="text" class="form-control" name="user" required
                                    placeholder="enter your username">
                              </div>
                              <div class="form-group">
                                 <label for="exampleFormControlSelect1">Contact Number</label>
                                 <input type="text" class="form-control" name="contact" required
                                    placeholder="enter your contact number">
                              </div>
                              <div class="form-group">
                                 <label for="exampleFormControlSelect1">Address</label>
                                 <input type="text" class="form-control" name="address" required
                                    placeholder="enter your address">
                              </div>
                              <div class="form-group">
                                 <label for="exampleFormControlSelect1">Password</label>
                                 <input type="password" class="form-control" name="password" required
                                    placeholder="enter your password">
                              </div>
                              <div class="form-group">
                                 <label for="exampleFormControlSelect1">Confirm Password</label>
                                 <input type="password" class="form-control" name="cpassword" required
                                    placeholder="confirm your password">
                              </div>
                              <div class="form-check">
                                 <input class="form-check-input" type="checkbox" value="1" name="terms" id="terms">
                                 <label class="form-check-label" for="terms">
                                    I Accept the <a href="#" data-toggle="modal" data-target="#termsModal">Terms and
                                       Conditions</a>
                                 </label>

                              </div><br>
                              <button type="submit" name="submit" value="register now" id="reg-submit"
                                 class="btn btn-primary btn-block" disabled>Submit</button>
                           </form>
                        </div>
                        <div class="card-footer" style="text-align: center">
                           <p>
                              aleady have an account?&nbsp;
                              <a href="index.php">login now</a>
                        </p>
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

      <div class="modal fade" id="termsModal" tabindex="-1" aria-hidden="true">
         <div class="modal-dialog">
            <div class="modal-content">
               <div class="modal-header bg-success">
                  <h5 class="modal-title text-white">Please read carefully</h5>
                  <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">×</span>
                  </button>
               </div>
               <div class="modal-body ml-4 mr-4">

                  <h3 style="text-align: center;">Vision</h3>
                  <p>
                     To be the choice of credit cooperative in financial services and to boost members' standard of
                     living.
                     Mission
                  </p><br><br>
                  <h3 style="text-align: center;">Mission</h3>
                  <p>
                     LUECCO the first choice of Credit cooperative that cares and protects the total assets of our
                     members
                     through our professionalism, integrity, corporate governance, and quality customer service.
                  </p>
                  <p>
                     We provide members with responsive and innovative financial products and services leading to
                     sustainable growth of our Credit cooperative.
                  </p><br><br>
                  <h3 style="text-align: center;">Terms and Conditions</h3>
                  <p>
                     A member accepted into membership shall have a Share Capital / Fixed Deposit which may be paid in
                     cash
                     or in monthly installments and the same shall not be withdrawn during the depositor's membership.
                  </p>
                  <p>
                     A duly approved member may open a Savings Deposits account in such amounts and at such regular
                     intervals as the member may elect and the board of directors may determine. However, no member may
                     open a Saving Deposit account unless the Share Capital/Fixed Deposit is first fully paid. Savings
                     Deposits may be withdrawn during the depositor's membership at any time at the office of the
                     Cooperative is open for business in accordance with the provisions of the Bylaws. Time Deposits may
                     also be opened subject to the policies of the Board of Directors.
                  </p>
                  <p>
                     Loans may be made to any member in good standing subject to rules and regulations contained in the
                     Bylaws and those that may be promulgated by the Board of Directors. The amount and terms of the
                     loan
                     shall be in accordance with the Bylaws. Fines for non-payment of loans as agreed will be levied
                     unless
                     excused by the Board of Directors for cause.
                  </p>
               </div>
               <div class="modal-footer">
                  <button class="btn btn-secondary" type="button" data-dismiss="modal" aria-label="Close">
                     Close
                  </button>
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
      <script>
         $(document).ready(function () {

            

            $('#terms').on('change', function () {
               console.log($('#terms').is(":checked"))
               if($('#terms').is(":checked")){
                  $('#reg-submit').removeAttr('disabled')
               } else {
                  $('#reg-submit').attr('disabled', 'disabled')
               }
            });
         });
      </script>

</body>

</html>