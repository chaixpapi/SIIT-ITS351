<?php

// Connection
$mysqli = new mysqli ('localhost','root','','staff');
if ($mysqli -> connect_errno) {
	echo "BD Connection Failed!"; }
	
// Exec Query
$del_id = $_GET['del_id'];
$q = "DELETE FROM user WHERE USER_ID = '$del_id'";
$result = $mysqli -> query($q);
if (!$result) {
	echo "DELETE FAILED!"; }
else {
	// Go back to the select page (lab09.php)
	header ("Location: user.php");}

// Close Connection
$mysqli -> close();

?>