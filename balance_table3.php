<html>

<html>

<body>

<br>
	<a href="http://rlp612.azurewebsites.net/index.php">Previous Page</a>
</br>

<br>
<form action="balance_table2.php" method="post">

<td><b>
<font face="Arial, Helvetica, sans-serif">Search by:</font>
</b></td>

Name <input type="text" name="name">
Days <input type="number" name="days">
<input type="submit">

</form>
</br>
<?php	
	$id=10;
	$id_name='test';
?>

<a href="balance_table2.php?id=<?php echo $id;?>">
  <?php echo $house_name;?>
</a>


</body>
</html>