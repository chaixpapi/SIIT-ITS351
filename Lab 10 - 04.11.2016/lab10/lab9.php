<html>
<body>
<table border="1">
<tr>
<th>ID</th>
<th>Product Name</th>
<th>Product Price</th>
<th>Delete</th> <!-- ADD DELETE COL -->
<th>Edit</th> <!-- ADD EDIT COL -->
</tr>

<?php
require_once('connect.php');

$q = "SELECT * FROM product ORDER BY p_id ASC";
if ($result = $mysqli->query($q)) // Exec select query
{
	while ($row = $result->fetch_array()) // Fetch each row
	{
		echo "<tr>";
		echo "<td>" . $row['p_id'] . "</td>";
		echo "<td>" . $row['p_name'] . "</td>";
		echo "<td>" . $row['p_price'] . "</td>";
		echo "<td>" . '<a href="delete.php?id='.$row['p_id'].'">Del</a>' . "</td>"; // ADD DELETE COL
		echo "<td>" . '<a href="edit_form.php?id='.$row['p_id'].'">Edit</a>' . "</td>"; //ADD EDIT COL
		echo "</tr>";
	}
}
$mysqli->close(); //Close Connection
?>

</table>

<hr/>
<a href="insert_form.php"><b>Insert New Record</b></a>

</body>
</html>







