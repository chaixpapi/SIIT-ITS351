<html>
<body>

<table border = "1">
<tr>
<th> ID </th>
<th> Product Name </th>
<th> Product Price </th>
<th> Delete </th>
</tr>

<?php
// Table Rows

// Connection
$mysqli = new mysqli ('localhost','root','','staff');
if ($mysqli -> connect_errno) {
	echo "BD Connection Failed!"; }
	
// Select Data
$q = "SELECT * FROM product ORDER BY p_id asc";
if ($result = $mysqli -> query($q)) {
	while ($row = $result -> fetch_array()) {
		echo "<tr>";
		echo "<td>" . $row['p_id'] . "</td>";
		echo "<td>" . $row['p_name'] . "</td>";
		echo "<td>" . $row['p_price'] . "</td>";
		echo "<td><b>" . 
		'<a href = "del.php?del_id='. $row['p_id'].'">X</a>' . "</b></td>";
		echo "</tr>";
	}
}

// Close Connection
$mysqli -> close();

?>



</body>
</html>