<?php 
/*$servername = "localhost"; 
$username = "u582743816_root";
$password = "Password123";
$db = "u582743816_db_lmss";*/

$servername = "localhost"; 
$username = "root";
$password = "";
$db = "db_lms";
$conn = mysqli_connect($servername, $username, $password,$db);
// Check connection
if (!$conn) {
die("Connection failed: " . mysqli_connect_error());
}
function format_number($number) {
  return number_format($number, 2, '.', ',');
}
/*
$servername = "localhost"; 
$username = "root";
$password = "";
$db = "db_lms";
$conn = mysqli_connect($servername, $username, $password,$db);
// Check connection
if (!$conn) {
die("Connection failed: " . mysqli_connect_error());
}
function format_number($number) {
    return number_format($number, 2, '.', ',');
  }*/
?>