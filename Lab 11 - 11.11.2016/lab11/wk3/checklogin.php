<?php
session_start();
$username = $_POST['username'];
$passwd = $_POST['passwd'];
require_once('connect.php');
//$passwd=md5($_POST['passwd']);

$q="select * from user where DISABLE = 0
and USER_NAME='".$username."'
and USER_PASSWD='".$passwd."'" ;

$result = $mysqli->query($q);
$rowcount = $result->num_rows;//Get number of rows
if (!$result) 
{
	die('Error: '.$q." ". $mysqli->error);
}
// If result matches, there must be one row returned
if($rowcount==1)
{
	//echo "Login Sucessfully";
	//echo '<br><a href="mainpage.php">Main Manu</a>';
	// Store User Information to Session
	$row = $result->fetch_array();
	$_SESSION['id'] = $row["USER_ID"];
	$_SESSION['name'] = $row["USER_FNAME"];
	$_SESSION['username'] = $row["USER_NAME"];
	$_SESSION['usergroup'] = $row["USER_GROUPID"];
	if($_SESSION['usergroup'] == 1)
	{
		header("Location: user.php");
	}
	if($_SESSION['usergroup'] == 3)
	{
		header("Location: user.php");
	}
	if($_SESSION['usergroup'] == 2)
	{
		header("Location: group.php");
	}
} 
else 
{
	echo "Wrong Username or Password";
}
?>

