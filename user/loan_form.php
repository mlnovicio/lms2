<?php
include '../connectMySql.php';
date_default_timezone_set("Etc/GMT+8");
require_once '../session.php';
user();
require_once '../class.php';
$db = new db_class();
$id = $_SESSION['user_id'];


$firstname = "";
$lastname = "";
$address = "";


$query = "SELECT * FROM `user`
where user_id = ".$id." "; 
$result = $conn->query($query);
while($row = $result->fetch_assoc())
{  
   $firstname = $row['firstname'];
   $lastname = $row['lastname'];
   $address = $row['address'];
}

?>
<!DOCTYPE html>
<html lang="en">

<head>

   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

   <title>LUECCO - Memeber Registration</title>

   <link href="../fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
   <link href="../css/sb-admin-2.css" rel="stylesheet">

   <style>
      .bg-yellow-green {
         background: #98d454;
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
<form method="POST" action="addloan.php">
   <!-- Page Wrapper -->
   <div id="wrapper">

      <!-- Content Wrapper -->
      <div id="content-wrapper" class="d-flex flex-column">

         <!-- Main Content -->
         <div id="content">

            <!-- Begin Page Content -->
            
            <div class="container border shadow my-5 p-4 bg-white">
               <div class="text-center">
                  <img src="../image/logo.jpg" alt="" style="height: 6rem;">
                  <h5 class="mt-3 text-black">LAGUNA UNIVERSITY EMPLOYEES CREDIT COOPERATIVE</h3>
                  <p class="text-black">Laguna Sports Complex, Brgy. Bubukal, Sta. Cruz, Laguna</p>
               </div>

               <div class="text-center mt-4 bg-yellow-green">
                  <h5 class="text-black p-0 m-0">LOAN APPLICATION AND AGREEMENT</h4>
               </div>

               <p class="text-center p-0 m-0 text-black">
                  <small><i>
                     *Please READ the instructions, policies, terms & conditions printed at the back, before accomplishing this form.
                  </i></small>
               </p>

               <div class="row mt-4">
                  <div class="col-md-6 mb-4">
                     <strong class="text-black">APPLICATION NO: <?php 
                                                            $count=0;
                                                       
                                                               $query = "SELECT COUNT(loan_id) as count FROM loans ";
                                                               $result = $conn->query($query);
                                                               while($row = $result->fetch_assoc())
                                                               {
                                                                    $count= $row['count'] + 1;
                                                               }
                  $sk2 = str_pad($count, 6, '0', STR_PAD_LEFT);
                                                              echo $sk2;

                  ?></strong>
                  </div>
                  <div class="col-md-6" style="text-align: end">
                     <div style="display: inline-block !important;">
                        <div class="form-check mr-3" style="display: inline-block !important">
                           <input name="loanInstance" class="form-check-input" type="radio" value="New Loan">
                           <label class="form-check-label text-black" for="New">
                              New Loan
                           </label>
                        </div>
                        <div class="form-check" style="display: inline-block !important">
                           <input name="loanInstance" class="form-check-input" type="radio" value="Renewal">
                           <label class="form-check-label text-black" for="Renewal">
                              Renewal
                           </label>
                        </div>
                     </div>
                  </div>
               </div>

               <div>
                  <div class="text-black" style="width: 100px; display:inline-block">Last Name:</div>
                  <div style="display: inline-block; min-width: calc(100% - 110px);">
                     <input type="text" name="lastname" id="lastname" class="w-100 line-input" oninput="namecopy()" style="border: none; border-bottom: 1px solid black; padding: 0"  value="<?php $pieces = explode(" ", $firstname);
                              echo  $pieces[1]; ?>" > 
                  </div>
               </div>
               <div>
                  <div class="row">
                     <div class="col-9">
                        <div class="text-black" style="width: 100px; display:inline-block">First Name:</div>
                        <div style="display: inline-block; min-width: calc(100% - 110px);">
                           <input type="text" name="firstname" id="firstname" oninput="namecopy()" class="w-100 line-input" style="border: none; border-bottom: 1px solid black; padding: 0" value="<?php $pieces = explode(" ", $firstname);
                              echo  $pieces[0]; ?>">
                        </div>
                     </div>
                     <div class="col-3">
                        <div  class="text-black"style="width: 30px; display:inline-block">M.I.</div>
                        <div style="display: inline-block; width: calc(100% - 40px) !important;">
                           <input maxlength="1" name="middlename"  type="text" class="w-100 line-input" style="border: none; border-bottom: 1px solid black; padding: 0" >
                        </div>
                     </div>
                  </div>

                  <div>
                     <div class="text-black" style="width: 100px; display:inline-block">Address:</div>
                     <div style="display: inline-block; min-width: calc(100% - 110px);">
                        <input type="text" name="address" class="w-100 line-input" style="border: none; border-bottom: 1px solid black; padding: 0"  value="<?php 
                              echo  $address; ?>">
                     </div>
                  </div>

                  <div>
                     <div class="text-black" style="width: 136px; display:inline-block">Contact Number:</div>
                     <div style="display: inline-block; min-width: calc(100% - 146px);">
                        <input type="number" name="contact_no" class="w-100 line-input" style="border: none; border-bottom: 1px solid black; padding: 0">
                     </div>
                  </div>
               </div>

               <div class="row mt-4">
                  <div class="col-md-6 mb-4">
                     <strong class="text-black">TYPE OF LOAN:</strong>
                     <div class="mt-4">
                        <div class="form-check mr-3 mb-1">
                           <input name="loanType" id="loanType1" class="form-check-input loanzxc" type="radio" value="6000">
                           <label class="form-check-label text-black" for="New">
                              Emergency Loan (Php 6,000)
                           </label>
                        </div>
                        <div class="form-check">
                           <input name="loanType" id="loanType2" class="form-check-input loanzxc" type="radio" value="12000">
                           <label class="form-check-label text-black" for="Renewal">
                              Short Term Loan (Php 12,000) 
                           </label>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <strong class="text-black">TERM OF PAYMENT</strong>
                     <div class="mt-4">
                        <div class="form-check mr-3 mb-1">
                           <input name="paymentTerms" id="paymentTerms1" class="form-check-input terms" type="radio"  value="3">
                           <label class="form-check-label text-black" for="New">
                           Three (3) months
                           </label>
                        </div>
                        <div class="form-check">
                           <input name="paymentTerms" id="paymentTerms2"  class="form-check-input terms" type="radio" value="6">
                           <label class="form-check-label text-black" for="Renewal">
                           Six (6) months
                           </label>
                        </div>
                     </div>
                  </div>
               </div>

               <div class="mt-4">
                  <p style="text-indent: 3rem;" class="text-black">
                     I hereby apply for a loan in the amount of <span id="amountInWords">_______________________________________</span> 
                     (P <span id="amountInNumber">________________</span> ) in consideration thereof, I hereby promise to pay the full amount of the loan in 
                     accordance with the policies, terms and conditions printed at the back which I have READ and 
                     UNDERSTOOD clearly. I have attached to this loan application supporting documents which I am certifying 
                     to be correct and truthful
                  </p>
               </div>

               <div class="mt-5 py-5" style="text-align: end">
                  <div style="text-align:center; max-width: 300px;width: 100%; display:inline-block">
                     <input type="text" name="input1" id="input1s" class="w-100 line-input" style="text-align:center; border: none; border-bottom:"  value="<?php 
                              echo  $firstname; ?>">
                     <p class="text-black text-center" style="border-top: 1px solid black; padding-top:5px;" >Signature over printed name of Applicant</p>
                  </div>
               
                  
               </div>


               <!-- CO-MAKER -->
               <div class="pl-2 mt-4 bg-yellow-green">
                  <h6 class="text-black p-0 m-0"><strong>CO-MAKERS’ OBLIGATION AND AUTHORIZATION</strong></h4>
               </div>

               <div class="mt-4">
                  <p class="text-black">We, the undersigned co-makers, hereby agree with all the terms and conditions of this loan agreement 
                     and voluntarily bind ourselves to be jointly and severally liable to the borrower should he/she fails to pay 
                     the loan subject to this agreement. In order to fulfill this obligation, we hereby authorize the LUECCO 
                     Cashier to collect and deduct from his/her salary, bonuses, allowances, and other benefits and/or LUECCO 
                     Treasurer to collect and deduct from our dividend payments of the unpaid obligation including interest, 
                     penalties, and surcharges. 
                  </p>
               </div>

               <div class="mt-4">
                  <p class="text-black">Conforme:</p>
               </div>

               <div class="row mt-5 pt-5">
                  <div class="col-md-5 mb-5">
                     <div>
                               <select name="comaker1" id="type1" class="w-100 line-input custom-select" style="text-align:center; border: none; border-bottom:" onchange="ver()" required>
                                 <option value=""></option>
                                    <?php
                                     
                                       $query = "SELECT concat(a.firstname , ' ' , a.middlename ,' ', a.lastname) as name , a.user_id FROM user a
                                          WHERE a.user_type = 3 and user_id  not in (SELECT comaker_id FROM (
                                          SELECT if(COUNT(lc_id)>= 2 ,'USED','AVAILABLE')as used ,comaker_id FROM loan_comaker
                                          GROUP by comaker_id
                                          )a 
                                          WHERE used = 'USED')";
                                       $result = $conn->query($query);
                                       while($row = $result->fetch_assoc())
                                       {
                                       echo '<option value="'.$row['user_id'].'" >'.$row['name'].'</option>';
                                       }
                                    ?>
                                </select>
                        <div class="" style="text-align: end">
                           <p class="text-black text-center" style="border-top: 1px solid black; padding-top:5px;">
                           Name and Signature of Co-Maker
                           </p>
                        </div>
                     </div>
                     <div class="mt-5">
                     <input type="text" name="home1" id="home1" class="w-100 line-input" style=" text-align:center; border: none; border-bottom:" >
                        <div class="" style="text-align: end">
                           <p class="text-black text-center" style="text-align:center; border-top: 1px solid black; padding-top:5px;">
                           Home Address and Tel. No. 
                           </p>
                        </div>
                     </div>
                  </div>
                  <div class="col-0 col-md-2"></div>
                  <div class="col-md-5 mb-5">
                  <div>
                     <div>
                        <select name="comaker2" id="type2" class="w-100 line-input custom-select" style="text-align:center; border: none; border-bottom:" onchange="address1()"  required>
                                 <option value=""></option>
                                    <?php
                                      
                                       $query = "SELECT concat(a.firstname , ' ' , a.middlename ,' ', a.lastname) as name , a.user_id FROM user a
                                          WHERE a.user_type = 3 and user_id  not in (SELECT comaker_id FROM (
                                          SELECT if(COUNT(lc_id)>= 2 ,'USED','AVAILABLE')as used ,comaker_id FROM loan_comaker
                                          GROUP by comaker_id
                                          )a 
                                          WHERE used = 'USED')";
                                       $result = $conn->query($query);
                                       while($row = $result->fetch_assoc())
                                       {
                                       echo '<option value="'.$row['user_id'].'" >'.$row['name'].'</option>';
                                       }
                                    ?>
                                </select>
                                <script type="text/javascript">
                                 function ver(){
                               var select1 = document.getElementById("type1").value;
                               var select = document.getElementById("type2");

                              var valueToRemove = ""+select1;

                              for (var i = 0; i < select.options.length; i++) {
                                if (select.options[i].value === valueToRemove) {
                                  select.options[i].remove();
                                  i--;
                                }

                                if(select1.value != ''|| select1.value != null)
                                {
                                        document.cookie = "comaker1='"+select1+"'";
                                       $.ajax({
                                       url:"address1.php",
                                       method:"POST",
                                       success:function(data){
                                        document.getElementById('home1').value = data;
                                       }
                                      })
                                }
                                
                                 }
                              }

                               function address1(){
                               var select1 = document.getElementById("type2").value;


                                if(select1.value != ''|| select1.value != null)
                                {
                                        document.cookie = "comaker2='"+select1+"'";
                                       $.ajax({
                                       url:"address2.php",
                                       method:"POST",
                                       success:function(data){
                                        document.getElementById('home2').value = data;
                                       }
                                      })
                                }
                              }
                                </script>
                        <div class="" style="text-align: end">
                           <p class="text-black text-center" style=" border-top: 1px solid black; padding-top:5px;">
                           Name and Signature of Co-Maker
                           </p>
                        </div>
                     </div>
                     <div  class="mt-5">
                        <input type="text" name="home2"  id="home2"  class="w-100 line-input" style="text-align:center; border: none; border-bottom:">
                        <div class="" style="text-align: end">
                           <p class="text-black text-center" style="text-align:center; border-top: 1px solid black; padding-top:5px;">
                           Home Address and Tel. No. 
                           </p>
                        </div>
                     </div>
                  </div>
               </div>
               






<div class="table-responsive">
   <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
      <thead>
         <tr>
         <th colspan = "2" style="background-color:yellowgreen;color: black;text-align: center;">COMPUTATION OF LOAN (TO BE FILLED BY COOPERATIVE)</th>
         </tr>
      </thead>
      <tbody>

         <tr>
         <td style="color: black;width: 50%;"><b>AMOUNT LOAN</b></th>
         <td style="color: black;width: 50%"><span id="amountInNumber2"></span></th>
         </tr>

         <tr>
         <td style="color: black;">TERMS OF PAYMENT</th>
         <td style="color: black;"><span id="terms" name="terms"></span></th>
         </tr>

         <tr>
         <td style="color: black;">INTEREST (1% per month)</th>
         <td style="color: black;"><span id="input1" ></span></th>
         </tr>

         <tr>
         <td style="color: black;">TOTAL INTEREST</th>
         <td style="color: black;"><span id="input2" ></span></th>
         </tr>

         <tr>
         <td style="color: black;">AMORTIZATION PERIOD</th>
         <td style="color: black;"><span id="input3" ></span></th>
         </tr>

         <tr>
         <td style="color: black;"><b>MONTHLY AMORTIZATION</b></th>
         <td style="color: black;"><span id="input4" ></span></th>
         </tr>

         <tr>
         <td style="color: black;"><b>DEDUCTION PER PAYDAY</b></th>
         <td style="color: black;"><span id="input5" ></span></th>
         </tr>

      </tbody>
   </table>
</div>

</div>
<div class="row">
      <div class="col-md-5 mb-5">
         <div class="mt-5">
         <input type="text" name = "processor1" class="w-100 line-input" style="border: none; border-bottom:" readonly>
            <div class="" style="text-align: end">
               <p class="text-black text-center" style="border-top: 1px solid black; padding-top:5px;" >
               <i>Processor</i>
               </p>
            </div>
         </div>
      </div>
      <div class="col-0 col-md-2"></div>
      <div class="col-md-5 mb-5">
      <div>
         <div  class="mt-5">
            <input type="text" name = "admin1" class="w-100 line-input" style="border: none; border-bottom:" readonly>
            <div class="" style="text-align: end">
               <p class="text-black text-center" style="border-top: 1px solid black; padding-top:5px;">
               <i>General Manager</i>
               </p>
            </div>
         </div>
      </div>
</div>
</div>

<div class="col-md-12 mb-12">
<p class="text-black text-left" style="border-top: 1px solid black; padding-top:5px;">
   TO BE FILLED BY THE CREDIT COMMITTEE:
</div>
       <div class="col-md-12" style="text-align: center;">
                     <div style="display: inline-block !important;">
                        <div class="form-check mr-3" style="display: inline-block !important">
                           <input name="status" class="form-check-input" type="radio" value="Approved" disabled>
                           <label class="form-check-label text-black" for="New">
                              Approved
                           </label>
                        </div>
                        <div class="form-check" style="display: inline-block !important">
                           <input name="status" class="form-check-input" type="radio" value="Disapproved" disabled>
                           <label class="form-check-label text-black" for="Renewal">
                              Disapproved
                           </label>
                        </div>
                     </div>
                  </div>
                  <div class="row">
<div class="col-md-5 mb-5">
         <div class="mt-5">
         <input type="text" name = "processor2"  class="w-100 line-input" style="border: none; border-bottom:" readonly>
            <div class="" style="text-align: end">
               <p class="text-black text-center" style="border-top: 1px solid black; padding-top:5px;">
               <i>Printed Name/ Signature / Date</i>
               </p>
            </div>
         </div>
      </div>
      <div class="col-0 col-md-2"></div>
      <div class="col-md-5 mb-5">
      <div>
         <div  class="mt-5">
            <input type="text" name = "admin2"  class="w-100  line-input" style="border: none; border-bottom:" readonly>
            <div class="" style="text-align: end">
               <p class="text-black text-center" style="border-top: 1px solid black; padding-top:5px;">
               <i>Printed Name/ Signature / Date</i>
               </p>
            </div>
         </div>
      </div>
      </div>
      </div>
<div class="col-md-12 mb-12">
<p class="text-black text-left" style="border-top: 1px solid black; padding-top:5px;">
</div>

      <input type="hidden" name="compute1" id="compute1" class="btn btn-success px-5" value=""/>
      <input type="hidden" name="compute2" id="compute2" class="btn btn-success px-5" value=""/>
      <input type="hidden" name="compute3" id="compute3" class="btn btn-success px-5" value=""/>
      <input type="hidden" name="compute4" id="compute4" class="btn btn-success px-5" value=""/>
      <input type="hidden" name="compute5" id="compute5" class="btn btn-success px-5" value=""/>

      <div class="text-center w-100 mb-5 pb-5">
      <input type="submit" class="btn btn-success px-5" value="Submit"/>
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
      <script src="../js/jquery.js"></script>
      <script src="../js/bootstrap.bundle.js"></script>

      <!-- Core plugin JavaScript-->
      <script src="../js/jquery.easing.js"></script>

      <!-- Custom scripts for all pages-->
      <script src="../js/sb-admin-2.js"></script>
      <script>
var amount = 0;
var terms = 0;
        $(document).ready(function(){ 
      $(document).on('click', '.loanzxc', function(){
      var valuez = $(this).attr("id");

            $('input[name=loanType]').on('change', function () {
               var value = $( 'input[name=loanType]:checked' ).val(),
                   amountInWords = $('#amountInWords'),
                   amountInNumber = $('#amountInNumber');
                   amountInNumber2 = $('#amountInNumber2');


               if (valuez == "loanType1") {
                  amountInWords.html("<b>Six thousand pesos</b>");
                  amountInNumber.html("<b>6,000.00</b>")
                  amountInNumber2.html("<b>6,000.00</b>")
                  amount = 6000;

               } else {
                  amountInWords.html("<b>Twelve thousand pesos</b>");
                  amountInNumber.html("<b>12,000.00</b>")
                  amountInNumber2.html("<b>12,000.00</b>")
                  amount = 12000;
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

            $('#terms').on('change', function () {
               console.log($('#terms').is(":checked"))
               if($('#terms').is(":checked")){
                  $('#reg-submit').removeAttr('disabled')
               } else {
                  $('#reg-submit').attr('disabled', 'disabled')
               }
            });
         })
   });




      $(document).ready(function(){ 
      $(document).on('click', '.terms', function(){
      var valuez = $(this).attr("id");
      if(valuez  == 'paymentTerms1')
      {
         document.getElementById('terms').innerHTML = "Three (3) Months";
         terms = 3; compute();
      }
      else
      {
         document.getElementById('terms').innerHTML = "Six (6) Months";
         terms = 6; compute()

      }

var monthly_interest  = (amount*0.01);
         var total_interest  = (amount*0.01)*terms;
         const period =""; 
         var  monthly_amortize = (amount/terms)+monthly_interest;
         var per_cutoff = monthly_amortize/2;


         const monthNames = ["January", "February", "March", "April", "May", "June",
           "July", "August", "September", "October", "November", "December"
         ];

         const d = new Date();
         var dd = monthNames[d.getMonth()+1];

         const e = new Date();
          var ee = monthNames[e.getMonth()+terms];

         period = dd+"-"+ee+" 2023";

         document.getElementById('input1').innerHTML = monthly_interest;
         document.getElementById('input2').innerHTML = total_interest;
         document.getElementById('input3').innerHTML = period;
         document.getElementById('input4').innerHTML = monthly_amortize;
         document.getElementById('input5').innerHTML = per_cutoff;


         document.getElementById('compute1').value = monthly_interest;
         document.getElementById('compute2').value = total_interest;
         document.getElementById('compute3').value = period;
         document.getElementById('compute4').value = monthly_amortize;
         document.getElementById('compute5').value = per_cutoff;


         alert(monthly_interest);
         alert(total_interest);
         alert(period);
         alert(monthly_amortize);
         alert(per_cutoff);






      })
      });


      function compute(){
         var monthly_interest  = (amount*0.01);
         var total_interest  = (amount*0.01)*terms;
         var period =""; 
         var  monthly_amortize = (amount/terms)+monthly_interest;
         var per_cutoff = monthly_amortize/2;


         const monthNames = ["January", "February", "March", "April", "May", "June",
           "July", "August", "September", "October", "November", "December"
         ];

         const d = new Date();
         var dd = monthNames[d.getMonth()+1];

         const e = new Date();
          var ee = monthNames[e.getMonth()+terms];

         period = dd+"-"+ee+" 2023";

         document.getElementById('input1').innerHTML = monthly_interest;
         document.getElementById('input2').innerHTML = total_interest;
         document.getElementById('input3').innerHTML = period;
         document.getElementById('input4').innerHTML = monthly_amortize;
         document.getElementById('input5').innerHTML = per_cutoff;


         document.getElementById('compute1').value = monthly_interest;
         document.getElementById('compute2').value = total_interest;
         document.getElementById('compute3').value = period;
         document.getElementById('compute4').value = monthly_amortize;
         document.getElementById('compute5').value = per_cutoff;
        

      }

      function namecopy(){
         document.getElementById('input1s').value = document.getElementById('firstname').value+" "+document.getElementById('lastname').value+"";
      }
      </script>
    
</body>

</html>