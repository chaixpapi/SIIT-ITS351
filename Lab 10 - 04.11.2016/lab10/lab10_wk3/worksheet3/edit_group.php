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

		<div id="div_content" class="form">
			<!--%%%%% Main block %%%%-->
			<!--Form -->
<?php
// Connection
require_once('connect.php');

// Select
$edit_rec = $_GET['id'];

$q = "SELECT * FROM usergroup WHERE USERGROUP_ID = '$edit_rec'";
$result = $mysqli->query($q); // Exec select query
$row = $result -> fetch_array(); // Get record row by row

// Close
$mysqli->close(); //Close Connection


?>			
			<h2>Edit User Group</h2>
			<form action="updategroup.php" method="post">
				<label>Group Code</label>
				<input type="text" name="groupcode" value = "<?php echo $row['USERGROUP_CODE']; ?>"> 
				
				<label>Group Name</label>
				<input type="text" name="groupname" value = "<?php echo $row['USERGROUP_NAME']; ?>">
				
				<label>Remark</label>
				<textarea name="remark"><?php echo $row['USERGROUP_REMARK']; ?> </textarea><br>
					
				<label>URL</label>
				<input type="text" name="url" value = "<?php echo $row['USERGROUP_URL']; ?>">
				
				<input type = "hidden" name = "groupid" value = "<?php echo $row['USERGROUP_ID']; ?>">
					
				<div class="center">
					<input type="submit" name="submit" value="Submit">
					<input type="reset" value="Cancel">											
				</div>
			</form>	
		</div> <!-- end div_content -->
	</div> <!-- end div_main -->
	
	<div id="div_footer">  
		
	</div>
	
</div>
</body>
</html>


