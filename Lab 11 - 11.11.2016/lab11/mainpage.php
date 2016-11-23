<?php
session_start();
?>

<html>
<body>

<?php
if (isset ($_SESSION['user_id']))
{
?>

<h1> Welcome <?php echo $_SESSION['user_fullname']; ?> </h1>
<hr>
ID: <?php echo $_SESSION['user_id']; ?>
<br> FULL NAME: <?php echo $_SESSION['user_fullname']; ?>
<br> USERNAME : <?php echo $_SESSION['user_username']; ?>
<hr>
<a href = "login.html"> Go to Login </a> | <a href = "logout.php"> Go to Logout </a>

<?php
}
else 
{
	echo "Please Login :" . '<a href = login.html"> Go to Login </a>';  
}	
?>

</body>
</html>