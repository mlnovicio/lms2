<?php
	require_once'class.php';
	session_start();
	
	if(isset($_REQUEST['id'])){
		$db = new db_class();
		$db->deleteAnnouncement($_REQUEST['id']);
		header('location:announce.php');
	}
?>	