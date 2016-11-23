<?php
require_once('connect.php');

$p_id = $_GET['id'];
$q = "DELETE FROM product WHERE p_id = '$p_id'";
if ($result = $mysqli->query($q)) // Exec delete query
{
	//Success
	header("Location: lab9.php"); // Redirect to lab9.php
}
else
{
	//Failed
	echo "Delete Failed!";
}

$mysqli->close(); //Close Connection

?>