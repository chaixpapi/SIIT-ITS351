<?php

// Connection
$mysqli = new mysqli ('localhost','root','','staff');
if ($mysqli -> connect_errno) {
	echo "BD Connection Failed!"; }
	
// Exec Query
$del_id = $_GET['del_id'];
$q = "DELETE FROM product WHERE p_id = '$del_id'";
$result = $mysqli -> query($q);
if (!$result) {
	echo "DELETE FAILED!"; }
else {
	// Go back to the select page (lab09.php)
	header ("Location: lab09.php");}

// Close Connection
$mysqli -> close();

?>