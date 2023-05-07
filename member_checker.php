<?php
include 'connectMySql.php';
$verify=0;
$query = "SELECT * FROM membership where name = '".$_POST['user_id']."'";
$result = $conn->query($query);
while($row = $result->fetch_assoc())
{
$verify=1;
}

if($verify!=1)
{
    echo ' <button onclick="generatePDF()" type="button" class="btn btn-success px-5"><i class="fas fa-download"></i></button>
                  <br><br>
                  <input type="submit" id="submit" class="btn btn-success px-5" value="Submit"></input>';
}
else
{
     echo 'Name exist';
}
?>