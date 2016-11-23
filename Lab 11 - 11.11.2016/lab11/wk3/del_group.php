<?php
	$id = $_GET['id']; // group id
	require_once('connect.php');
	if (isset($id)) {
		$q="DELETE FROM usergroup where USERGROUP_ID=$id";
		$q = strtolower($q);
		if(!$mysqli->query($q)){
			echo "DELETE failed. Error: ".$mysqli->error ;
	   }
	   $mysqli->close();
	   //redirect
	   header("Location: group.php");
	} 
?>
