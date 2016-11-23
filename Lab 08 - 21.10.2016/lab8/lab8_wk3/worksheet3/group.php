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
$code = $_POST['groupcode'];
$name = $_POST['groupname'];
$remark = $_POST['remark'];
$url = $_POST['url'];

$q = "INSERT INTO usergroup(
usergroup_code,
usergroup_name,
usergroup_remark,
usergroup_url
) VALUES (
'$code',
'$name',
'$remark',
'$url'
); ";
echo $q;

$result = $mysqli -> query($q); 
if (!$result)
	echo "<br> Insert error - " . $mysqli -> error;
else
	echo "<br> Insert success!";

// Display

// Select data from table
$q = "SELECT * FROM usergroup";

$result = $mysqli -> query($q);

echo '<table border = 1>';
echo '<tr>';
echo '<th>Usergroup ID</th>';
echo '<th>Usergroup Code</th>';
echo '<th>Usergroup Name</th>';
echo '<th>Usergroup Remark</th>';
echo '<th>Usergroup URL</th>';
echo '</tr>';

while ($row = $result -> fetch_array())
{

echo '<tr>';
echo '<td>'.$row['usergroup_id'].'</td>';
echo '<td>'.$row['usergroup_code'].'</td>';
echo '<td>'.$row['usergroup_name'].'</td>';
echo '<td>'.$row['usergroup_remark'].'</td>';
echo '<td>'.$row['usergroup_url'].'</td>';
echo '</tr>';
}

echo '</table>';



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
			<h2>User Group</h2>			
			<table>
                <col width="10%">
                <col width="20%">
                <col width="30%">
                <col width="30%">
                <col width="5%">
                <col width="5%">

                <tr>
                    <th>Group Code</th> 
                    <th>Group Name</th>
                    <th>Remark</th>
                    <th>URL</th>
                    <th>Edit</th>
                    <th>Del</th>
                </tr>
                 <tr>
                    <td>Data 1</td> 
                    <td>Data 2</td>
                    <td>Data 3</td>
                    <td>Data 4</td>
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


