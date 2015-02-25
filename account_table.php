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
	$query="select * from accounts order by accountName";
	$result=mysql_query($query);
	$num=mysql_numrows($result);
	mysql_close();
?>

<h1>Account List</h1>
<table>
<tr>
<td><b>
<font face="Arial, Helvetica, sans-serif">Account Name</font>
</b></td>
</tr>

<?php
	$i=0;
	while ($i < $num) {
		$f1=mysql_result($result,$i,"accountName");
?>

<tr>
<td>
<font face="Arial, Helvetica, sans-serif"><?php echo $f1; ?></font>
</td>
</tr>

<?php	$i++;}?>

</body>
</html>