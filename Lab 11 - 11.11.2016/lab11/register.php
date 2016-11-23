<?php
$name = $_POST['name'];
$email = $_POST['email'];
$username = $_POST['username'];
$passwd = $_POST['passwd'];
require_once('connect.php');
$q="INSERT INTO user (name, email, username, passwd, disable) VALUES ('".$name."','".$email."','".$username."','".$passwd."',0)";
$result = $mysqli->query($q);
 if (!$result)	{
		die('Error: '.$q." ". $mysql->error);
	 }
//redirect
header("Location: login.html");
?>