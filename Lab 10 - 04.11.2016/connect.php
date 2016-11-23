<?php
$mysqli = new mysqli('localhost','root','','staff'); //Connection
if ($mysqli->connect_errno)
{ 
	echo "Connection Failed!"; 
}
?>