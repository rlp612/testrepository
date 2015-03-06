<html>

<html>
<head>
<style>
table, th, td {
    border: 1px solid black;
	background-color: #E6E6E6;
}
</style>
</head>

<body>
<?php
	require_once 'config.php';
	$query="select * from categories order by categoryName";
	$result=mysql_query($query);
	$num=mysql_numrows($result);
	mysql_close();
?>

<h1>Category List</h1>
<table>
<tr>
<td><b>
<font face="Arial, Helvetica, sans-serif">Category Name</font>
</b></td>
</tr>

<?php
	$i=0;
	while ($i < $num) {
		$f1=mysql_result($result,$i,"categoryName");
?>

<tr>
<td>
<a href="balance_table2.php?search=<?php echo $f1;?>">
  <?php echo $f1;?>
</a>
</td>

</tr>

<?php	$i++;}?>
</table>
	<br>
	<a href="http://rlp612.azurewebsites.net/index.php">Previous Page</a>
	</br>
</body>
</html>