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
	$query="select * from clients order by first_name";
	$result=mysql_query($query);
	$num=mysql_numrows($result);
	mysql_close();
?>

<h1>Client List</h1>
<table>
<tr>
<td><b>
<font face="Arial, Helvetica, sans-serif">First Name</font>
</b></td>
<td><b>
<font face="Arial, Helvetica, sans-serif">Last Name</font>
</b></td>
<td><b>
<font face="Arial, Helvetica, sans-serif">Street</font>
</b></td>
<td><b>
<font face="Arial, Helvetica, sans-serif">City</font>
</b></td>
<td><b>
<font face="Arial, Helvetica, sans-serif">State</font>
</b></td>
<td><b>
<font face="Arial, Helvetica, sans-serif">Zip</font>
</b></td>
<td><b>
<font face="Arial, Helvetica, sans-serif">Email</font>
</b></td>
<td><b>
<font face="Arial, Helvetica, sans-serif">Phone</font>
</b></td>
<td><b>
<font face="Arial, Helvetica, sans-serif">Company</font>
</b></td>
</tr>

<?php
	$i=0;
	while ($i < $num) {
		$f1=mysql_result($result,$i,"first_name");
		$f2=mysql_result($result,$i,"last_name");
		$f3=mysql_result($result,$i,"street");
		$f4=mysql_result($result,$i,"city");
		$f5=mysql_result($result,$i,"state");
		$f6=mysql_result($result,$i,"zip");
		$f7=mysql_result($result,$i,"email");
		$f8=mysql_result($result,$i,"phone");
		$f9=mysql_result($result,$i,"company_id");
?>

<tr>

<td>
<a href="balance_table2.php?search=<?php echo $f1.' '.$f2;?>">
  <?php echo $f1.' '.$f2;?>
</a>
</td>
<td>
<font face="Arial, Helvetica, sans-serif"><?php echo $f3; ?></font>
</td>
<td>
<font face="Arial, Helvetica, sans-serif"><?php echo $f4; ?></font>
</td>
<td>
<font face="Arial, Helvetica, sans-serif"><?php echo $f5; ?></font>
</td>
<td>
<font face="Arial, Helvetica, sans-serif"><?php echo $f6; ?></font>
</td>
<td>
<font face="Arial, Helvetica, sans-serif"><?php echo $f7; ?></font>
</td>
<td>
<font face="Arial, Helvetica, sans-serif"><?php echo $f8; ?></font>
</td>
<td>
<font face="Arial, Helvetica, sans-serif"><?php echo $f9; ?></font>
</td>
</tr>

<?php	$i++;}?>
</table>
	<br>
	<a href="http://rlp612.azurewebsites.net/index.php">Previous Page</a>
	</br>
</body>
</html>