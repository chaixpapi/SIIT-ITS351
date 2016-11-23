<?php
function print_menus(){
	?>
	<ul id="menu">
		<li><a href="login.php">Login </a></li>
		<li><a href="user.php">User Profile</a></li>
		<li><a href="add_user.php">Add User</a></li>
		<li><a href="group.php">User Group</a></li>
		<li><a href="add_group.php">Add User Group</a></li>
		<li><a href="logout.php">Logout</a></li>
	</ul>	
	<?php
}   

function welcome(){
	if(isset($_SESSION['user'])){
		$user = $_SESSION['user'];
		$fname = $user['USER_FNAME'];
		$lname = $user['USER_LNAME'];
		$groupname = $user['USERGROUP_NAME'];
		echo "Welcome $fname $lname ($groupname)";
	}else{
		echo "Welcome guest";
	}
}
function ispermitted(){
	if(!isset($_SESSION['user'])){
		return false;
	}
	$user = $_SESSION['user'];
	$group = strtolower($user['USERGROUP_NAME']);
	$filename = basename($_SERVER['PHP_SELF'], '.php');
	$noperms = array(
		'staff' => array(
			'add_user', 'user', 'edit_user', 'del_user'
		),
		'member' => array(
			'add_group', 'group', 'edit_group', 'del_group'
		)
	);
	return !array_key_exists($group, $noperms) 
		or !in_array($filename, $noperms[$group]);
}
?>