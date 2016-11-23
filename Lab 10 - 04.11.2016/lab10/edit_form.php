<?php
require_once('connect.php');

$edit_rec = $_GET['id'];

$q = "SELECT * FROM product WHERE p_id = '$edit_rec'";
$result = $mysqli->query($q); // Exec select query
$row = $result -> fetch_array(); // Get record row by row

$mysqli->close(); //Close Connection
?>


<html>
<body>

<h1> Edit Product </h1>
<hr/>
<form action = "update.php" method = "POST">

Product Name:
<br><input type = "text" name = "product_name" value="<?php echo $row['p_name']; ?>">

<br> Product Price:
<br><input type = "text" name = "product_price" value="<?php echo $row['p_price']; ?>">

<br>
<br><input type = "submit" value="Update Product">

<br>
<br><input type = "hidden" name = "product_id" value = "<?php echo $row['p_id']; ?>">

</form>
<hr/>
<a href = "lab9.php"> Go Back to Product List </a>

</body>
</html>
