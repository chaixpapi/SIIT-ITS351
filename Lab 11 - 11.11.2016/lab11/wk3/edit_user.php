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
			<?php print_menus(); ?>

		<div id="div_content" class="form">
			<!--%%%%% Main block %%%%-->
			<!--Form -->
			<?php
				require_once('connect.php');
				$userid = $_GET['userid'];
				$q = "select * from user where USER_ID=$userid";
				$result = $mysqli->query($q);
				if(!$result){
					echo "Select failed: ".$mysqli->error;
				}
				$urow = $result->fetch_array();
				
			?>
			<form action="update_user.php" method="post">
				<h2>Edit User Profile</h2>
				<label>User ID</label>
				<input type="text" name="userid" value="<?=$userid?>" readonly>
				
				<label>Title</label>
				<select name="title">
					<?php
						$q='select TITLE_ID, TITLE_NAME from title;';
						
						if($result=$mysqli->query($q)){
							while($row=$result->fetch_array()){
								
								if($urow['USER_TITLE']==$row['TITLE_ID']){
									$select = 'selected';
								}else{
									$select = '';
								}
								echo '<option value="'.$row[0].'" '. $select.'>'.$row[1].'</option>';
							}
						}else{
							echo 'Query error: '.$mysqli->error;
						}
					?>
				</select>
				
				<label>First name</label>
				<input type="text" name="firstname" value="<?=$urow['USER_FNAME']?>">
					
				<label>Last name</label>
				<input type="text" name="lastname" value="<?=$urow['USER_LNAME']?>">

				<label>Gender</label>
					<?php
						$q='select GENDER_ID, GENDER_NAME from gender;';
						
						if($result=$mysqli->query($q)){
							while($row=$result->fetch_array()){
								if($row['GENDER_ID']==$urow['USER_GENDER']){
									$check = 'checked';
								}else{
									$check = '';
								}
								echo '<input type="radio" name="gender" value="'.$row[0].'" '.$check.'>'.$row[1];
							}
						}else{
							echo 'Query error: '.$mysqli->error;
						}
					?>
				
				<div></div>
				<label>Email</label>
				<input type="text" name="email" value="<?=$urow['USER_EMAIL']?>">
				
				<h2>Edit Account Profile</h2>
				<label>Username</label>
				<input type="text" name="username" value="<?=$urow['USER_NAME']?>">
				
				<label>Password</label>
				<input type="password" name="passwd" value="<?=$urow['USER_PASSWD']?>">
				
				<label>User group</label>
				<select name="usergroup">
					<?php
						$q='select USERGROUP_ID, USERGROUP_NAME from usergroup;';
						
						if($result=$mysqli->query($q)){
						
							while($row=$result->fetch_array()){
								if($urow['USER_GROUPID']==$row['USERGROUP_ID']){
									$select = ' selected ';
								}else{
									$select = '';
								}
								echo '<option value="'.$row[0].'"'.$select.'>'.$row[1].'</option>';
							}
						}else{
							echo 'Query error: '.$mysqli->error;
						}
					?>
				</select>
				
				<label>Disabled</label>
				<?php
					if($urow['DISABLE']){
						$dis = ' checked ';
					}else{
						$dis = '';
					}
				?>
				<input type="checkbox" name="disabled" value="1" <?=$dis?>>

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


