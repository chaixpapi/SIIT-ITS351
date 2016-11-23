<html>
<body>

<?php
	echo "NAME : " . $_POST['text1'];
	echo "<br>". "USERNAME : ". $_POST['text2'];
?>
<hr>
Password : <?php echo $_POST['pass']; ?>

<br> hidden field : <?php echo $_POST['userid']; ?>
<hr>

<br> OS name : <?php echo $_POST['osname']; ?>
<br> Device : <?php echo $_POST['device']; ?>
<hr>

<br> Car 1 : <?php if (isset ($_POST['car1'])) echo $_POST['car1']; ?>
<br> Car 2 : <?php if (isset ($_POST['car2'])) echo $_POST['car2']; ?>
<br> Car 3 : <?php if (isset ($_POST['car3'])) echo $_POST['car3']; ?>
<br> Car 4 : <?php if (isset ($_POST['car4'])) echo $_POST['car4']; ?>
<hr>

<br> Gender : <?php echo $_POST['gender']; ?>
<hr>

<br> Gender 2 : <?php echo $_POST['gender2']; ?>
<hr>

<br> Memo: <?php echo $_POST['mymemo']; ?>

</body>
</html>
