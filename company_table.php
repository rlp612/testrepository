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
	$query="select * from companies order by company_name";
	$result=mysql_query($query);
	$num=mysql_numrows($result);
	mysql_close();
?>

<h1>Company List</h1>
<table>
<tr>
<td><b>
<font face="Arial, Helvetica, sans-serif">Company Name</font>
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
</tr>

<?php
	$i=0;
	while ($i < $num) {
		$f1=mysql_result($result,$i,"company_name");
		$f2=mysql_result($result,$i,"street");
		$f3=mysql_result($result,$i,"city");
		$f4=mysql_result($result,$i,"state");
		$f5=mysql_result($result,$i,"zip");
		$f6=mysql_result($result,$i,"email");
		$f7=mysql_result($result,$i,"phone");
?>

<tr>
<td>
<font face="Arial, Helvetica, sans-serif"><?php echo $f1; ?></font>
</td>
<td>
<font face="Arial, Helvetica, sans-serif"><?php echo $f2; ?></font>
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
</tr>

<?php	$i++;}?>

</body>
</html>