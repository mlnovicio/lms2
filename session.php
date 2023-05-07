<?php
	session_start();
	function admin(){
		if(!isset($_SESSION['user_id']) || ($_SESSION['user_type']!=1 && $_SESSION['user_type']!=2 && $_SESSION['user_type']!=4)){
			header('location:index.php');
		}
	}

	function user(){
		if(!($_SESSION['user_id'])|| $_SESSION['user_type']!=3 ){
			echo"<script>window.location='../index.php'</script>";
	    }
	}
	
?>