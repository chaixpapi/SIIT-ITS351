<?php
require_once('connect.php');

$user_title = $_POST['title'];
$user_fname = $_POST['firstname'];
$user_lname = $_POST['lastname'];
$user_gender = $_POST['gender'];
$user_email = $_POST['email'];
$user_name = $_POST['username'];
$user_passwd = $_POST['passwd'];
$user_groupid = $_POST['usergroup'];
$user_disable = $_POST['disabled'];


$q = "UPDATE user SET " .
" USER_TITLE = '$user_title', ".
" USER_FNAME = '$user_fname', ".
" USER_LNAME = '$user_lname', ".
" USER_GENDER = '$user_gender', ".
" USER_EMAIL = '$user_email', ".
" USER_NAME = '$user_name', ".
" USER_PASSWD = '$user_passwd', ".
" DISABLE ='$user_disable' ".

"WHERE USER_ID = '$user_groupid'";

//echo $q;

if ($result = $mysqli->query($q)) // Exec select query
{
	//echo "success!";
	header ("Location: user.php"); //Redirect to user.php
}
else 
{
	echo "Delete Failed!";
}
	
	
$mysqli->close(); //Close Connection
?>	