<?php
include 'connectMySql.php';
$query = "SELECT * FROM loans where ((type_of_loan + compute2) + compute3 - payments) > 0 and  user_id = '".$_POST['user_id']."' ORDER BY loan_id DESC LIMIT 1";
$result = $conn->query($query);
while($row = $result->fetch_assoc())
{
echo ' <label>Monthly Amortization</label>
                                <br /> <input type="number" name="loan_amount"  value="'.$row['compute4'].'" class="form-control" readonly> ';
}
?>