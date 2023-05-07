<?php

include 'connectMySql.php';

$sql = "UPDATE `membership` SET `status`='2' WHERE `membership_id`='".$_COOKIE['membership_id']."'";
$result = mysqli_query($conn,$sql);
header('location:membership.php');
?>
