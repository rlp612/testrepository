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
	$query="call get_balance(null, null)";
	$result=mysql_query($query);
	$num=mysql_numrows($result);
	mysql_close();
?>

<br>
	<a href="http://rlp612.azurewebsites.net/index.php">Previous Page</a>
</br>


<table>
<tr>
<td><b>
<font face="Arial, Helvetica, sans-serif">Date</font>
</b></td>
<td><b>
<font face="Arial, Helvetica, sans-serif">Client Name</font>
</b></td>
<td><b>
<font face="Arial, Helvetica, sans-serif">Company Name</font>
</b></td>
<td><b>
<font face="Arial, Helvetica, sans-serif">Account</font>
</b></td>
<td><b>
<font face="Arial, Helvetica, sans-serif">Category</font>
</b></td>
<td><b>
<font face="Arial, Helvetica, sans-serif">Product</font>
</b></td>
<td><b>
<font face="Arial, Helvetica, sans-serif">Notes</font>
</b></td>
<td><b>
<font face="Arial, Helvetica, sans-serif">Transaction Amount</font>
</b></td>
<td><b>
<font face="Arial, Helvetica, sans-serif">Balance</font>
</b></td>
<td><b>
<font face="Arial, Helvetica, sans-serif">Transaction Number</font>
</b></td>
</tr>

<?php
	$i=0;
	while ($i < $num) {
		$f1=mysql_result($result,$i,"Date");
		$f2=mysql_result($result,$i,"Client Name");
		$f3=mysql_result($result,$i,"Company Name");
		$f4=mysql_result($result,$i,"Account");
		$f5=mysql_result($result,$i,"Category");
		$f6=mysql_result($result,$i,"Product");
		$f7=mysql_result($result,$i,"Notes");
		$f8=mysql_result($result,$i,"Transaction Amount");
		$f9=mysql_result($result,$i,"Balance");
		$f10=mysql_result($result,$i,"Transaction Number");
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
<td>
<font face="Arial, Helvetica, sans-serif"><?php echo $f8; ?></font>
</td>
<td>
<font face="Arial, Helvetica, sans-serif"><?php echo $f9; ?></font>
</td>
<td>
<a href="edit_transaction.php?search=<?php echo $f10;?>">
  <?php echo $f10;?>
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