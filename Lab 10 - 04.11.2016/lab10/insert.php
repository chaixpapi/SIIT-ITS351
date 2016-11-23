<?php
require_once('connect.php');

// Insert Data to table
$nn = $_POST['product_name'];
$pp = $_POST['product_price'];

$q = "INSERT INTO product(p_name,p_price) 
VALUES('$nn','$pp');
";

//echo "<br>" . $q;

$result = $mysqli->query($q); //Insert Query Exec
if(!$result)
{
	echo "<br>Insert error - " . $mysqli->error;
}
else
{
	//echo "<br>Insert Success";
	header('Location: lab9.php');
}

$mysqli->close(); //Close Connection

?>