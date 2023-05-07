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
                  <b class="text-black p-0 m-0">MEMBERSHIP SUBSCRIPTION AGREEMENT</b>
               </div>
               <br>
               <div >
                  <p class="text-black p-0 m-0 ">I HEREBY APPLY FOR THE MEMBERSHIP IN THE LAGUNA UNIVERSITY EMPLOYEES’ CREDIT
                  COOPERATIVE (LUECCO), AND AGREE TO FAITHFULLY OBEY IT’S RULES AND
                  REGULATIONS AS SET DOWN IN ITS BY-LAWS AND AMENDMENTS THEREOF, OR
                  ELSEWHERE, AND THE DECISION OF THE GENERAL ASSEMBLY AS WELL AS THOSE OF THE
                  BOARD OF DIRECTORS.
                  </p>

               </div>   
               <br>
               <div> 
                  <div class="text-black" style="display:inline-block">I HEREBY agree/pledge to Subscribe at least 200 shares valued at P100.00/share, amounting to
                  TWENTY THOUSAND PESOS (P20,000.00) as my Capital Stock/Deposit payable in lump sum or
                  monthly installment of
                  <div style="text-align:center; display: inline-block; min-width: 500px;">
                     <input type="text"  name="amount1"  class="w-100 line-input" style="text-align: center; border: none; border-bottom: 1px solid black; padding: 0" oninput="this.value=this.value.replace(/[^a-z]/gi,'');" >
                  </div>(P
                  <div style="text-align:center; display: inline-block; min-width: calc(100% - 1100px);">
                     <input type="text" name="amount2" class=" line-input" style="text-align: center; border: none; border-bottom: 1px solid black; padding: 0" oninput="this.value=this.value.replace(/[^0-9]/g,'');">
                  </div>)which I understand that it will not be withdrawn during my tenure of membership. I also
                  understand that I will become a member of LUECCO if I had paid P500.00 Membership Fee and
                  P5,000.00 minimum paid up capital.
                  <br>
                  <br>
                  The Treasurer of the LUECCO is also hereby authorized to collect from the Paymaster/Cashier out of
                  my salary the sum indicated above (R.A. 9520, an Act amending Cooperative Code to be known as
                  the Philippine Cooperative Code of 2008).
                  <br>
                  &nbsp &nbsp &nbsp In WITNESS THEREOF, I have hereunto affixed my signature this
                  <div style="display: inline-block;max-width: 50px">
                     <input type="text"  name="date1"  class="w-100 line-input " style="text-align: center; border: none; border-bottom: 1px solid black; padding: 0;" value="<?php date_default_timezone_set('Asia/Manila');echo date('d'); ?>" readonly>
                  </div>day of
                  <div style="display: inline-block;max-width: 200px">
                     <input type="text"  name="date2" class="w-100 line-input " style="text-align: center;border: none; border-bottom: 1px solid black; padding: 0;" value="<?php date_default_timezone_set('Asia/Manila');echo date('M'); ?>" readonly>
                  </div>,   <div style="display: inline-block;max-width: 50px">
                     <input type="text"  name="date3" class="w-100 line-input " style="text-align: center; border: none; border-bottom: 1px solid black; padding: 0;"value="<?php date_default_timezone_set('Asia/Manila');echo date('Y'); ?>" readonly>
                  </div>.
                  <br>
                  <br>
                  <br>
                  <br>
                  <br>
                  
                  <center>
 
                  <div style="text-align:center; display: inline-block;min-width: 500px" >
                     <input type="text" name="printed_name" class="w-100 line-input " style="text-align:center; border: none; border-bottom: 1px solid black; padding: 0;" required>
                  </div><br>
                  <b>PRINTED NAME & SIGNATURE</b>
                  </center>
                  </div>
               <div style="color:black">
                  <br>
                  <b>PERSONAL DATA:</b>
                  <br>
                  Name:<div style="display: inline-block;min-width: 1035px">
                     <input type="text"  name="name"  id="name" class="w-100 line-input " style="border: none; border-bottom: 1px solid black; padding: 0;" oninput="member_checker()" required>
                  </div>
                  Email:<div style="display: inline-block;min-width: 1040px">
                     <input type="email"  name="email"  class="w-100 line-input " style="border: none; border-bottom: 1px solid black; padding: 0;" required>
                  </div>
                  Address:<div style="display: inline-block;min-width: 1020px">
                     <input type="text"  name="address"  class="w-100 line-input " style="border: none; border-bottom: 1px solid black; padding: 0;">
                  </div>
                  Date of birth:<div style="display: inline-block;min-width: 500px">
                     <input type="text" name="bday"  class="w-100 line-input " style="border: none; border-bottom: 1px solid black; padding: 0;">
                  </div>Place of Birth:<div style="display: inline-block;min-width: 250px">
                     <input type="text"  name="bplace"  class="w-100 line-input " style="border: none; border-bottom: 1px solid black; padding: 0;">
                  </div>Age:<div style="display: inline-block;min-width: 20px;max-width: 105px">
                     <input type="text"  name="age" oninput="this.value=this.value.replace(/[^0-9]/g,'');"  class="w-100 line-input " maxlength="2" style="border: none; border-bottom: 1px solid black; padding: 0;">
                  </div>
                  Gender:<div style=" display: inline-block;min-width: 100px;max-width: 100px">
                     <select name="gender" class="w-100 line-input " style="text-align: center;border: none; border-bottom: 1px solid black; padding: 0;">
                        <option value="MALE">MALE</option>
                        <option value="FEMALE">FEMALE</option>
                     </select>
                  </div>Civil Status:<div style="display: inline-block;min-width: 200px">
                     <select name="civil_status"  class="w-100 line-input " style="border: none; border-bottom: 1px solid black; padding: 0;">
                        <option value="SINGLE">SINGLE</option>
                        <option value="MARRIED">MARRIED</option>
                        <option value="MARRIED">DIVORCED</option>
                        <option value="MARRIED">WIDOWED</option>
                     </select>
                  </div>if married; husband/wife Name/B-day:<div style="display: inline-block;min-width: 365px;max-width: 365px">
                     <input type="text" name="married_info"  class="w-100 line-input " style="border: none; border-bottom: 1px solid black; padding: 0;">
                  </div>
                  Highest Educational Attainment:<div style="display: inline-block;min-width: 850px">
                     <input type="text" name="education"  class="w-100 line-input " style="border: none; border-bottom: 1px solid black; padding: 0;">
                  </div>
                  Department:<div style="display: inline-block;min-width: 500px">
                     <input type="text" name="department"  class="w-100 line-input " style="border: none; border-bottom: 1px solid black; padding: 0;">
                  </div>Position:<div style="display: inline-block;min-width: 250px">
                     <input type="text" name="position"  class="w-100 line-input " style="border: none; border-bottom: 1px solid black; padding: 0;">
                  </div>Salary:<div style="display: inline-block;min-width: 130px;max-width: 130px">
                     <input type="text"  oninput="this.value=this.value.replace(/[^0-9,]/g,'');" name="salary" maxlength="9" class="w-100 line-input " style="border: none; border-bottom: 1px solid black; padding: 0;">
                  </div>
                  Other Source of Income (specify):<div style="display: inline-block;min-width: 500px">
                     <input type="text" name="other_source"  class="w-100 line-input " style="border: none; border-bottom: 1px solid black; padding: 0;">
                  </div>Monthly Income:<div style="display: inline-block;min-width: 215px;max-width: 215px">
                     <input type="text"  oninput="this.value=this.value.replace(/[^0-9NnAa/]/g,'');"  maxlength="9" name="monthly_income"  class="w-100 line-input " style="border: none; border-bottom: 1px solid black; padding: 0;">
                  </div>
                  Nearest Relative:<div style="display: inline-block;min-width: 500px">
                     <input type="text"  name="nearest_relative"  class="w-100 line-input " style="border: none; border-bottom: 1px solid black; padding: 0;">
                  </div>Relationship:<div style="display: inline-block;min-width: 365px;max-width: 365px">
                     <input type="text" name="relation"  class="w-100 line-input " style="border: none; border-bottom: 1px solid black; padding: 0;">
                  </div>
                  No. of Dependents:<div style="display: inline-block;min-width: 100px;max-width:100px">
                     <input type="text"  oninput="this.value=this.value.replace(/[^0-9,]/g,'');" maxlength="2" name="dependents"  class="w-100 line-input " style="border: none; border-bottom: 1px solid black; padding: 0;">
                  </div>Religion/Social Affiliation:<div style="display: inline-block;min-width: 657px;max-width: 657px">
                     <input type="text" name="religion" class="w-100 line-input " style="border: none; border-bottom: 1px solid black; padding: 0;">
                  </div>
                  Name of Dependents and Date of Birth:<div style="display: inline-block;min-width: 795px">
                     <input type="text"  name="name_dependents"  class="w-100 line-input " style="border: none; border-bottom: 1px solid black; padding: 0;">
                  </div>
                  Tin:<div style="display: inline-block;min-width: 255px">
                     <input type="text" name="tin" oninput="this.value=this.value.replace(/[^0-9]/g,'');"  class="w-100 line-input " style="border: none; border-bottom: 1px solid black; padding: 0;">
                  </div>
                  <br>
                  ******************************************************************************************************************************************************
                  This Application for membership was approved/disapproved by the Board of Directors in its meeting held
                  on<div style="display: inline-block;min-width: 255px">
                     <input type="text"  name="input1" class="w-100 line-input " style="border: none; border-bottom: 1px solid black; padding: 0;"readonly>
                  </div>under BOD Resolution No.<div style="display: inline-block;min-width: 50px;max-width: 50px">
                     <input type="text" name="input2"  class="w-100 line-input " style="border: none; border-bottom: 1px solid black; padding: 0;" readonly>
                  </div>s,<div style="display: inline-block;min-width: 105px;max-width: 105px">
                     <input type="text" name="input3" class="w-100 line-input " style="border: none; border-bottom: 1px solid black; padding: 0;"readonly>
                  </div><br>
                  Membership No.<div style="display: inline-block;min-width: 150px;max-width: 150px">
                     <input type="text" name="input4" class="w-100 line-input " style="border: none; border-bottom: 1px solid black; padding: 0;"readonly>
                  </div>
                  <br>
                 <center>
                  <div style="display: inline-block;min-width: 350px;max-width: 350px">
                     <input type="text" name="secretary" class="w-100 line-input " style="border: none; border-bottom: 1px solid black; padding: 0;"readonly>
                  </div><br>
                    Secretary
                  </center>
                  <br>
                  <br>
                  <div style="border: 1px solid black;">
                  Disclaimer: All the personal information collected from this form will be used in the processing of
                  membership in LUECCO only and with regard to the Data Privacy Policy of Laguna University.
                  </div>
               </div>
               </div>
              <br>
              <br>
              <br>
              <br>
              <br>
              <br>
              <br>
              <br>
              <br>
 

               <div class="text-center w-100 mb-5 pb-5" id="formField">
                 

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
<script type="text/javascript">
    function  member_checker(){
        var user_id = document.getElementById('name').value;
         $.ajax({
         url:"member_checker.php",
         method:"POST",
         data:{user_id:user_id},
         success:function(data){
          $('#formField').html(data);
         }
        })
     }
</script>

</html>