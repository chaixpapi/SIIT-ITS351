<?php

	$userid = $_GET['userid']; // user id
	require_once('connect.php');
	if(isset($userid)) {
		$q="DELETE FROM user where USER_ID=$userid";
		$q = strtolower($q);
			if(!$mysqli->query($q)){
				echo "DELETE failed. Error: ".$mysqli->error ;
		   }
		   $mysqli->close();
		   //redirect
		   header("Location: user.php");
	}
?>
