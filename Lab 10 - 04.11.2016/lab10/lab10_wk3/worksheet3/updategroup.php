<?php
require_once('connect.php');

$group_groupcode = $_POST['groupcode'];
$group_name = $_POST['groupname'];
$group_groupremark = $_POST['remark'];
$group_groupurl = $_POST['url'];
$group_groupid = $_POST['groupid'];

$q = "UPDATE usergroup SET " .
" USERGROUP_CODE = '$group_groupcode', ".
" USERGROUP_NAME = '$group_name', ".
" USERGROUP_REMARK = '$group_groupremark', ".
" USERGROUP_URL = '$group_groupurl' ".

"WHERE USERGROUP_ID = '$group_groupid'";

//echo $q;

if ($result = $mysqli->query($q)) // Exec select query
{
	header ("Location: group.php"); //Redirect to group.php
}
else 
{
	echo "Delete Failed!";
}
	
	
$mysqli->close(); //Close Connection
?>	