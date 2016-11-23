<?php
	$userid = $_POST['userid'];
	$title = $_POST["title"];
	$firstname = $_POST["firstname"];
	$lastname = $_POST["lastname"];
	$gender = $_POST["gender"];
	$email = $_POST["email"];
	$username = $_POST["username"];
	$passwd = $_POST["passwd"];
	
	$usergroup = $_POST["usergroup"];
	$disabled = isset($_POST["disabled"]) ? 1 : 0;

	require_once('connect.php');
	$q = "update user set USER_TITLE=$title, USER_FNAME='$firstname', USER_LNAME='$lastname', USER_GENDER=$gender, USER_EMAIL='$email', USER_NAME='$username', USER_PASSWD='$passwd', USER_GROUPID=$usergroup, DISABLE=$disabled where USER_ID=$userid";
	
	if(!$mysqli->query($q)){
		echo "Update failed: ". $mysqli->error;
	}else{
		header("Location: user.php");
	}
?>