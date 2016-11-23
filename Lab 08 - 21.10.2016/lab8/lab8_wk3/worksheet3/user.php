<?php
// BD Connection
$mysqli = new mysqli('localhost','root','','staff');

// check to see if connection is successful or not
if($mysqli -> connect_errno)
{
	echo "<br> Database Connection Error!";
}
else
{
	echo "<br> Database Connection Success!";
}

//Insert
$title = $_POST['title'];
$fname = $_POST['firstname'];
$lname = $_POST['lastname'];
$gender = $_POST['gender'];
$email = $_POST['email'];
$name = $_POST['username'];
$passwd = $_POST['passwd'];
$groupid = $_POST['usergroup'];
$disabled = $_POST['disabled'];

$q = "INSERT INTO user(
user_title,
user_fname,
user_lname,
user_gender,
user_email,
user_name,
user_passwd,
user_groupid,
disabled
) VALUES (
'$title',
'$fname',
'$lname',
'$gender',
'$email',
'$name',
'$passwd',
'$groupid',
'$disabled'
); ";
echo $q;

$result = $mysqli -> query($q); 
if (!$result)
	echo "<br> Insert error - " . $mysqli -> error;
else
	echo "<br> Insert success!";




?>


<!DOCTYPE html>
<html>
<head>
<title>ITS331 Sample</title>
<link rel="stylesheet" href="default.css">
</head>

<body>
<div id="wrapper"> 
	<div id="div_header">
		ITS331 System 
	</div>
	<div id="div_subhead">
	
	</div>
	
	<div id="div_main">
		<div id="div_menu">
			<ul id="menu">
				<li><a href="user.php">User Profile</a></li>
				<li><a href="add_user.php">Add User</a></li>
				<li><a href="group.php">User Group</a></li>
				<li><a href="add_group.html">Add User Group</a></li>
			</ul>		
		</div>

		<div id="div_content" class="usergroup">
			<!--%%%%% Main block %%%%-->
			
			<h2>User Profile</h2>
			<table>
                <col width="15%">
                <col width="30%">
                <col width="30%">
                <col width="20%">
                <col width="5%">

                <tr>
                    <th>Title</th> 
                    <th>Name</th>
                    <th>Email</th>
                    <th>User Group</th>
                    <th>Disabled</th>
                    <th>Edit</th>
                    <th>Del</th>
                </tr>
                 <tr>
                    <td>Data1</td> 
                    <td>Data2</td>
                    <td>Data3</td>
                    <td>Data4</td>
                    <td><input type='checkbox'></td>
                    <td><img src="images/Modify.png" width="24" height="24"></td>
                    <td><img src="images/Delete.png" width="24" height="24"></td>
                </tr>      
            </table>
				
		</div> <!-- end div_content -->
	</div> <!-- end div_main -->
	
	<div id="div_footer">  
		
	</div>
	
</div>
</body>
</html>


