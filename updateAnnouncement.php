<?php
	require_once'class.php';
	if(ISSET($_POST['up'])){
		$db=new db_class();
		$db->updateAnnouncement($_POST['up_details'],$_POST['up_id']);
		echo"<script>alert('Update Announcement successfully')</script>";
		echo"<script>window.location='announce.php'</script>";
	}
?>