<?php
session_start(); // TO USE session (top of the php code, always)
require_once('connect.php');

$re_user = $_POST['username'];
$re_pass = $_POST['passwd'];

$q = "SELECT * FROM user WHERE ".
" username = '$re_user' AND " .
" passwd = '$re_pass' AND " .
" disable = 0 " ;

$result = $mysqli -> query($q);

if ($result)
{
	$count_no_row = $result -> num_rows;
	if ($count_no_row == 1)
	{
		echo "Login Successful!" . '<a href = "mainpage.php"> GO TO Main Page </a>' ;
		$row = $result -> fetch_array();
		$_SESSION['user_id'] = $row['id']; //keep data to session
		$_SESSION['user_fullname'] = $row['name']; //keep data to session
		$_SESSION['user_username'] = $row['username']; //keep data to session
	}
	else
	{
		echo "Wrong username or password";
	}
}
else 
{
	echo "Wrong username or password";
}


?>