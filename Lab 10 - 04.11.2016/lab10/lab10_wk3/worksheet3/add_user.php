<?php require_once('connect.php'); ?>
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
				<li><a href="add_user.html">Add User</a></li>
				<li><a href="group.php">User Group</a></li>
				<li><a href="add_group.html">Add User Group</a></li>
			</ul>		
		</div>

		<div id="div_content" class="form">
			<!--%%%%% Main block %%%%-->
			<!--Form -->
			
			<form action="user.php" method="post">
				<h2>User Profile</h2>
				<label>Title</label>
				<select name="title">
					<?php
						$q='select TITLE_ID, TITLE_NAME from TITLE;';
						if($result=$mysqli->query($q)){
							while($row=$result->fetch_array()){
								echo '<option value="'.$row[0].'">'.$row[1].'</option>';
							}
						}else{
							echo 'Query error: '.$mysqli->error;
						}
					?>
				</select>
				
				<label>First name</label>
				<input type="text" name="firstname">
					
				<label>Last name</label>
				<input type="text" name="lastname">

				<label>Gender</label>
					<?php
						$q='select GENDER_ID, GENDER_NAME from GENDER;';
						if($result=$mysqli->query($q)){
							while($row=$result->fetch_array()){
								echo '<input type="radio" name="gender" value="'.$row[0].'">'.$row[1];
							}
						}else{
							echo 'Query error: '.$mysqli->error;
						}
					?>
				
				<div></div>
				<label>Email</label>
				<input type="text" name="email">
				
				<h2> Account Profile</h2>
				<label>Username</label>
				<input type="text" name="username">
				
				<label>Password</label>
				<input type="password" name="passwd">
				
				<label>Confirmed password</label>
				<input type="password" name="cpasswd">
				
				<label>User group</label>
				<select name="usergroup">
					<?php
						$q='select USERGROUP_ID, USERGROUP_NAME from USERGROUP;';
						if($result=$mysqli->query($q)){
							while($row=$result->fetch_array()){
								echo '<option value="'.$row[0].'">'.$row[1].'</option>';
							}
						}else{
							echo 'Query error: '.$mysqli->error;
						}
					?>
				</select>
				
				<label>Disabled</label>
				<input type="checkbox" name="disabled" value="1">
				<input type="hidden" name="page" value="adduser" >
				<div class="center">
					<input type="submit" value="Submit">			
				</div>
			</form>

		</div> <!-- end div_content -->
	</div> <!-- end div_main -->
	
	<div id="div_footer">  
		
	</div>
	
</div>
</body>
</html>


