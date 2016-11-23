<html>
<body>

<h1> LAB 8 </h1>

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

// Insert Data to table
$nn = "iPhone7";
$pp = rand(20000,30000);

$q = "INSERT INTO product(p_name,p_price)
VALUES ('$nn','$pp');";

echo "<br>" . $q;

//Insert Query Exec
$result = $mysqli -> query($q); 
if (!$result)
	echo "<br> Insert error - " . $mysqli -> error;
else
	echo "<br> Insert success!";

// Select data from table
$q = "SELECT p_id, p_name, p_price 
FROM product
ORDER BY p_id DESC";

$result = $mysqli -> query($q);

echo '<table border = 1>';
echo '<tr>';
echo '<th>Product ID</th>';
echo '<th>Product NAME</th>';
echo '<th>Product PRICE</th>';
echo '</tr>';

while ($row = $result -> fetch_array())
{
//	echo "<hr>";
//	echo "ID: " . $row['p_id'];
//	echo "<br>NAME: " . $row['p_name'];
//	echo "<br>PRICE: " . $row['p_price'];
echo '<tr>';
echo '<td>'.$row['p_id'].'</td>';
echo '<td>'.$row['p_name'].'</td>';
echo '<td>'.$row['p_price'].'</td>';
echo '</tr>';
}
echo '</table>';

// Close Connection
$mysqli -> close();

?>


</body>
</html>