<?php
require_once('connect.php');


$pro_id = $_POST['product_id'];
$pro_name = $_POST['product_name'];
$pro_price = $_POST['product_price'];

$q = "UPDATE product SET p_name = '$pro_name', p_price = '$pro_price' WHERE p_id = '$pro_id' ";


if ($result = $mysqli->query($q)) // Exec select query
{
	header ("Location: lab9.php"); //Redirect to lab9.php
}
else 
{
	echo "Delete Failed!";
}
	
	
$mysqli->close(); //Close Connection
?>	