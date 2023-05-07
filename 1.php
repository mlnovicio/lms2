<?php
include 'connectMySql2.php';
// Load and initialize the mpdf library
require_once __DIR__ . '/vendor/autoload.php';

// Define a default page size/format by array - page will be 279.4 wide x 215.9 height
$mpdf = new \Mpdf\Mpdf(['format' => 'Legal']);
// Add a new page with portrait orientation

$mpdf->AddPage('L', // P for portrait, L for landscape
               'legal', // page size - default is A4
               0, // 
               0, // 
               0, //
               5, // right margin
               0, // 
               5, //top margin
               '10', // 
               '10', // 
               '10' // 
            );

            date_default_timezone_set('Asia/Manila');
            $date = date('Y-m-d');

// Buffer the following html with PHP so we can store it to a variable later
ob_start();
?>
<style>
    table {
   border-collapse: collapse;
  border-spacing: 0;

}

td, th {
  border: 1px solid black;
  padding: 1px;
 font-size:14px;
}

th {
  background-color: #ddd;
}

tr:nth-child(even) {
  background-color: #f2f2f2;
}

table.small-spacing td, table.small-spacing th {
  padding: 1px;
  margin: 1px;
  border-width: thin;
}

#top{
   
box-shadow: 0 2px 4px rgba(0,0,0,0.2);

display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  text-align: center;
}

#fontsize{
    font-size: 12px;
}
</style>

<div id="top" >  
               <div class="text-center">
                  <img src="./image/logo.jpg" alt="" style="height: 6rem;">
                  <p><b>LAGUNA UNIVERSITY EMPLOYEES CREDIT COOPERATIVE</b><br/>
                  <i>Laguna Sports Complex, Brgy. Bubukal, Sta. Cruz, Laguna<i/></p>
</div>
<?php


function format_number($number) {
    return number_format($number, 2, '.', ',');
  }

$id = $_GET['userid'];
$sql = "SELECT
`lastname`,
`firstname`,
`middlename`
FROM `db_lms`.`loans`  WHERE  `loans`.`user_id`='$id' LIMIT 1";
$result = $conn->query($sql);
while($row = $result->fetch_assoc())
{

    $name = $row['firstname']." ".$row['middlename']." ".$row['lastname'];
}
?>
<p id="fontsize">
<b ><?php echo $name; ?> LEDGER - <?php $fdate = date("F j, Y", strtotime($date)); echo 'DATE : '.$fdate; ?></b>
</p>



<table> <tr><td style= "display: inline-block; vertical-align: top;">

<table  class="small-spacing">
<tr>                                        
<th rowspan='2'>Date</th>
<th rowspan='2'>O/R.G/V<BR/>Number</th>
<th colspan='3'>SHARE CAPITAL</th>                                            
<th colspan='3'>SAVINGS DEPOSITS</th>                                            
<th rowspan='2'>Cashier's<BR/>Initial</th>                                                                                      
</tr>
<tr>
<th>Received</th>
<th>Withrawn</th>
<th>Balance</th>
<th>Received</th>
<th>Withrawn</th>
<th>Balance</th>
</tr> 
 <?php   
                $sql = "SELECT
                `payment_list`.`payment_id`
                , `payment_list`.`ref_no`
                , `payment_list`.`type_of_payment`
                , `payment_list`.`payee_id`
                , `payment_list`.`amount`
                , `payment_list`.`date`
                , `payment_list`.`status`
                , `loans`.`lastname`
                , `loans`.`firstname`
                , `loans`.`middlename`
                , `loans`.`type_of_loan`
                , `payment_list`.`date`
                , `loans`.`user_id`
            FROM
                `db_lms`.`payment_list`
                INNER JOIN `db_lms`.`loans` 
                    ON (`payment_list`.`payee_id` = `loans`.`user_id`) WHERE  `loans`.`user_id`='$id' AND `payment_list`.`type_of_payment`='CAPITAL SHARE' ORDER BY  `payment_list`.`date` DESC"; 

$result = $conn->query($sql);
$running_balance = 0;
while($row = $result->fetch_assoc())
{

  
    echo "<tr role='row'>";
    $formatted_date = date("m/d/Y", strtotime($row['date']));
    echo "<td>" . $formatted_date . "</td>";
    echo "<td></td>";
    echo "<td>".format_number($row['amount'])."</td>";
    echo "<td></td>";
    $running_balance += $row['amount'];
    echo "<td>".format_number($running_balance)."</td>";
    echo "<td></td>";
    echo "<td></td>";
    echo "<td></td>";
    echo "<td></td>";

}
?>
</table>  

</td>

<td style= "display: inline-block; vertical-align: top;">

<table  class="small-spacing">

<tr>                                        
<th rowspan='2'>Date</th>
<th rowspan='2'>O/R.G/V<BR/>Number</th>
<th colspan='3'>LOANS</th>                                            
<th rowspan='2'>Interest</th>
<th colspan='3'>CHARGES</th>                                            
<th rowspan='2'>Cashier's<BR/>Initial</th>                                                                                      
</tr>

<tr>
<th>Received</th>
<th>Withrawn</th>
<th>Balance</th>
<th>Received</th>
<th>Withrawn</th>
<th>Balance</th>
</tr> 
<?php   
 $sql = "SELECT
 `payment_list`.`payment_id`
 , `payment_list`.`ref_no`
 , `payment_list`.`type_of_payment`
 , `payment_list`.`payee_id`
 , `payment_list`.`amount`
 , `payment_list`.`date`
 , `payment_list`.`status`
 , `loans`.`lastname`
 , `loans`.`firstname`
 , `loans`.`middlename`
 , `loans`.`type_of_loan`
 , `payment_list`.`date`
 , `loans`.`user_id`
FROM
 `db_lms`.`payment_list`
 INNER JOIN `db_lms`.`loans` 
     ON (`payment_list`.`payee_id` = `loans`.`user_id`) WHERE  `loans`.`user_id`='$id' AND `payment_list`.`type_of_payment`='LOAN' ORDER BY  `payment_list`.`date` DESC"; 

$result = $conn->query($sql);
$running_balance = 0;
while($row = $result->fetch_assoc())
{

  
    echo "<tr role='row'>";
    $formatted_date = date("m/d/Y", strtotime($row['date']));
    echo "<td>" . $formatted_date . "</td>";
    echo "<td></td>";
    echo "<td></td>";
    echo "<td>".format_number($row['amount'])."</td>";
    $running_balance += $row['amount'];
    echo "<td>".format_number($running_balance)."</td>";
    echo "<td></td>";
    echo "<td></td>";
    echo "<td></td>";
    echo "<td></td>";
    echo "<td></td>";

}
?>
</table> 

</td>
<tr>
</table>

<?php
// Now collect the output buffer into a variable
$html = ob_get_contents();
ob_end_clean();

// send the captured HTML from the output buffer to the mPDF class for processing
$mpdf->WriteHTML($html);

// Output the PDF as a string
$mpdf->Output();
?>
