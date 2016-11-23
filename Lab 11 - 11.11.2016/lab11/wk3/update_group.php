<?php
	$groupid = $_POST['groupid'];
	$groupcode = $_POST['groupcode'];
	$groupname = $_POST['groupname'];
	$remark = $_POST['remark'];
	$url = $_POST['url'];
	
	require_once('connect.php'); 
	$q = "update usergroup set usergroup_code='$groupcode', usergroup_name='$groupname', usergroup_remark='$remark', usergroup_url='$url' where usergroup_id=$groupid";
	if(!$mysqli->query($q)){
		echo "Update failed: ". $mysqli->error;
	}else{
		header("Location: group.php");
	}
?>