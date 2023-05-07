
<?php 
include '../connectMySql.php';
$query = "SELECT * FROM `user` 
where user_id = ".$_COOKIE['comaker2']." "; 
$result = $conn->query($query);
while($row = $result->fetch_assoc())
{  
	echo $row['address'];
}
?>