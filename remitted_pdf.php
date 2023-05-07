
<?php
include 'connectMySql.php';
$date = "";
$query = "SELECT *  FROM `remitted_header` WHERE remitted_id = '".$_COOKIE['remitted_id']."'";
$result = $conn->query($query);
while($row = $result->fetch_assoc())
{
   $date = $row['date'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

   <title>LUECCO - Memeber Registration</title>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
  
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script> 
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script> 
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.min.js"></script>
   <link href="fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
   <link href="css/sb-admin-2.css" rel="stylesheet">

   <style>
      .bg-yellow-green {
         background: #fff;
      }

      .text-black {
         color: black;
      }

      .line-input {
         position: relative;
         bottom: 3px;
      }

      .line-input:focus-visible {
         outline: unset;
      }
   </style>
</head>

<body id="page-top">
<form method="post" action="addMember.php">
   <!-- Page Wrapper -->
   <div id="wrapper">

      <!-- Content Wrapper -->
      <div id="content-wrapper" class="d-flex flex-column">

         <!-- Main Content -->
         <div id="content">

            <!-- Begin Page Content -->
            
            <div class="container border shadow my-5 p-4 bg-white">
               <div class="text-center">
                  <img src="./image/logo.jpg" alt="" style="height: 6rem;">
                  <h5 class="mt-3 text-black">LAGUNA UNIVERSITY EMPLOYEES CREDIT COOPERATIVE</h3>
                  <p class="text-black">Laguna Sports Complex, Brgy. Bubukal, Sta. Cruz, Laguna</p>
               </div>

               <div class="text-center mt-4 bg-yellow-green">
                  <b class="text-black p-0 m-0">REMITTED MONEY</b>
               </div>

               <div class="text-center mt-4 bg-yellow-green">
                  <p class="text-black p-0 m-0">Date remitted : <?php  echo $date;?></p>
               </div>
               <br>
               <br>
               <div>
                <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Type of Payment</th>
                                            <th>Payee</th> 
                                            <th>Amount</th>
                                            <th>Date</th>
                                            <!-- <th>Action</th> -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    include 'connectMySql.php';
                                       $query = "SELECT a.*,Concat(b.firstname,' ',b.middlename,' ',b.lastname) as name FROM remitted_det a 
                                                   LEFT JOIN user b ON b.user_id = a.payee_id 
                                                   UNION
                                                   SELECT '','','','',Concat('TOTAL : ',SUM(a.amount)),'','' FROM remitted_det a 
                                                   LEFT JOIN user b ON b.user_id = a.payee_id  
                                                WHERE remitted_id = '".$_COOKIE['remitted_id']."'";
                                       $result = $conn->query($query);
                                       while($row = $result->fetch_assoc())
                                       {
                                       echo "<tr role='row'>";
                                       echo "<td>" . $row['type_of_payment'] . "</td>";
                                       echo "<td>" . $row['name'] . "</td>";
                                       echo "<td>" . $row['amount'] . "</td>";
                                       echo "<td>" . $row['date'] . "</td>";
                                       }
                                       ?>
                                    </tbody>
                                </table>
               </div>
               </div>
              <br>
              <br>
              <br>
               <div class="text-center w-100 mb-5 pb-5">
                  <button onclick="generatePDF()" type="button" class="btn btn-success px-5"><i class="fas fa-download"></i> Download</button>
               </div>
            </div>
            </form>

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

            $('input[name=loanType]').on('change', function () {
               var value = $( 'input[name=loanType]:checked' ).val(),
                   amountInWords = $('#amountInWords'),
                   amountInNumber = $('#amountInNumber');

               if (value == "Emergency Loan") {
                  amountInWords.html("<b>Six thousand pesos</b>");
                  amountInNumber.html("<b>6,000.00</b>")
               } else {
                  amountInWords.html("<b>Twelve thousand pesos</b>");
                  amountInNumber.html("<b>12,000.00</b>")
               }

               amountInWords.css("border-bottom", "1px solid black");
               amountInNumber.css("border-bottom", "1px solid black");
            });

            $('.line-input').on('keyup', function () {
               var value = $(this).val().toUpperCase();
               $(this).val(value);
            })
            
            .val (function () {
               return this.value.toUpperCase();
            });

         });
      </script>
<script type="text/javascript">
  function generatePDF() {
        
        // Choose the element id which you want to export.
        var element = document.getElementById('wrapper');
        element.style.width = '100%';
        element.style.height = '100%';
        var filepath = "";
        var opt = {
            margin:       0.5,
            filename:     'myfile.pdf',
            image:        { type: 'jpeg', quality: 1 },
            html2canvas:  { scale: 10 },
            jsPDF:        { unit: 'in', format: 'letter', orientation: 'portrait',precision: '12' }
          };

        
        // choose the element and pass it to html2pdf() function and call the save() on it to save as pdf.
        html2pdf().set(opt).from(element).save();
      }
</script>
<style>
*{
	font-family:"Segoe UI",Arial,sans-serif
}
.header
{
  background: rgb(172,67,179);
  background: linear-gradient(90deg, rgba(172,67,179,1) 0%, rgba(70,70,195,1) 54%, rgba(0,212,255,1) 100%);
  color: #ffffff !important;
}
.icon-size
{
  font-size: 36px;
  color: rgb(172,67,179);
}
.nav-link
{
  color: #fff !important;
}
.paragraph
{
  padding-top: 10px;
  text-align: justify;
  display: block;
}
</style>
</body>

</html>