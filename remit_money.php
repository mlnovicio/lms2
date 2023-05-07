<?php

include 'connectMySql.php';

date_default_timezone_set('Asia/Manila');
$date = date('Y/m/d H:i:s');
$remitted_id = "";
$query = "SELECT SUM(amount) as amount FROM payment_list 
WHERE status = 1";
$result = $conn->query($query);
while($row = $result->fetch_assoc())
{
            $sql = "INSERT INTO `remitted_header` 
            (
                amount,
                date
            ) 
            VALUES 
            (
                '".$row['amount']."',
                '".$date."'
                
            )";
            $result1 = mysqli_query($conn,$sql);
}


$query = "SELECT * FROM remitted_header order by remitted_id desc limit 1";
$result = $conn->query($query);
while($row = $result->fetch_assoc())
{
            $remitted_id = $row['remitted_id'];
}

$query = "SELECT * FROM payment_list 
WHERE status = 1";
$result = $conn->query($query);
while($row = $result->fetch_assoc())
{
            $sql = "INSERT INTO `remitted_det` (`remitted_id`, `type_of_payment`, `payee_id`,`amount`, `date`) 
            VALUES ('". $remitted_id ."','". $row['type_of_payment'] ."','". $row['payee_id']."','". $row['amount'] ."','". $row['date'] ."')";
            $result1 = mysqli_query($conn,$sql);
}



$sql = "UPDATE `payment_list` SET `status`='2'";
$result = mysqli_query($conn,$sql);
echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    <body onload='save()'></body>
    <script> 
    function save(){
    Swal.fire(
         'Money remitted!',
         '',
         'success'
       )
    }</script>";
    include 'home.php';
?>
