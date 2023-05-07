<table><tr>
<td ><a href="loan.php"  style="text-decoration: none;">
<?php
include 'connectMySql.php';
$query = "SELECT
`lastname`,
`firstname`,
`date`
FROM `db_lms`.`loans`
WHERE `status`='PENDING' ORDER BY loan_id DESC LIMIT 10";
$result = $conn->query($query);
while($row = $result->fetch_assoc())
{
    $loan_date = strtotime($row['date']);
    $days_passed = floor((time() - $loan_date) / (60 * 60 * 24));
    $days_text = ($days_passed == 0) ? 'Today' : (($days_passed == 1) ? '1 day ago' : $days_passed.' days ago');

    ?>
    <div class="row">
    <div class="col-sm-2">
    <i class="fas fa-credit-card"></i>
    </div>
    <div class="col-sm-10">
      <b><?php echo $row['firstname']." ".$row['lastname']; ?></b>
       <p>Applied for loan <?php echo $days_text; ?></p>
    </div>
  </div>
<?php   
}
?>
</a>
</td>

<td class="column">
<a href="members.php"  style="text-decoration: none;">
<?php
$query = "SELECT `name`, `date`
FROM `db_lms`.`membership` where `status` = 1 order by membership_id desc";
$result = $conn->query($query);
while($row = $result->fetch_assoc())
{
    $loan_date = strtotime($row['date']);
    $days_passed = floor((time() - $loan_date) / (60 * 60 * 24));
    $days_text = ($days_passed == 0) ? 'Today' : (($days_passed == 1) ? '1 day ago' : $days_passed.' days ago');

    ?>
    <div class="row">
    <div class="col-sm-2">
   <i class="fas fa-user-plus"></i>
    </div>
    <div class="col-sm-10">
      <b><?php echo $row['name']; ?></b>
       <p>Registered <?php echo $days_text; ?></p>
    </div>
  </div>
<?php   
}
?>
</a>    
</td>  
</tr></table> 