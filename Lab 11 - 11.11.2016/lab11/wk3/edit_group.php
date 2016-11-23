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
				$groupid = $_GET['id'];
				$q = "select * from usergroup where USERGROUP_ID=$groupid";
				$result = $mysqli->query($q);
				if(!$result){
					echo "Select failed; ".$mysqli->error;
				}
				$row = $result->fetch_array();
				
			?>
			<h2>Edit User Group</h2>
			<form action="update_group.php" method="post">
				<label>Group ID </label>
				<input type="text" name="groupid" value="<?=$groupid?>" readonly>
				
				<label>Group Code</label>
				<input type="text" name="groupcode" value="<?=$row['USERGROUP_CODE']?>">
				
				<label>Group Name</label>
				<input type="text" name="groupname" value="<?=$row['USERGROUP_NAME']?>">
				
				<label>Remark</label>
				<textarea name="remark"><?=$row['USERGROUP_REMARK']?></textarea><br>
					
				<label>URL</label>
				<input type="text" name="url" value="<?=$row['USERGROUP_URL']?>">
					
				<div class="center">
					<input type="submit" name="submit" value="Submit">
					<input type="reset" value="Cancel">											
				</div>
				<input type="hidden" name="page" value="addgroup">
			</form>	
		</div> <!-- end div_content -->
	</div> <!-- end div_main -->
	
	<div id="div_footer">  
		
	</div>
	
</div>
</body>
</html>


