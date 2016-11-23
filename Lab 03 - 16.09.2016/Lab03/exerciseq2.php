<html>
<head>

<?php
	$stackdata = '';
	if (isset ($_POST['stackdata']))
		$stackdata = $_POST['stackdata'];
	
	var_dump($stackdata);
	
	
	$recdata = '';
	if (isset ($_POST['opt']))
		$recdata = $_POST['opt'] ;
	
	if($recdata == "Clear")
		$stackdata = '';
	else
		$stackdata = $stackdata . $recdata;
	
	//$arr = explode ("|", $stackdata);
	
	var_dump($recdata);
?>

    <title>Question 2</title>
</head>
<body>
<h1> Random Numbers </h1>
    
	<form action = "exerciseq2.php" method = "POST">
    <br>
    <input type="submit" name = "opt" value="1">
    <input type="submit" name = "opt" value="2">
    <input type="submit" name = "opt" value="3">
    <br>
	<br>
    <input type="submit" name = "opt" value="4">
    <input type="submit" name = "opt" value="5">
    <input type="submit" name = "opt" value="6">
    <br>
	<br>
    <input type="submit" name = "opt" value="7">
    <input type="submit" name = "opt" value="8">
    <input type="submit" name = "opt" value="9">
    <br>
	<br>
	
	<input type = "hidden" name = "stackdata" value = "<?php echo $stackdata; ?>" >
	<input type = "submit" name = "opt" value = "Clear">
	
	
	<br>
	<br>
	<br>
	Text : <?php echo $stackdata; ?>

    </form>
    </body>
</html>