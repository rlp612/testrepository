<html>

<html>
<head>
<style>
.datagrid table { border-collapse: collapse; text-align: left; width: 100%; } 
.datagrid {font: normal 16px/150% Arial, Helvetica, sans-serif; background: #fff; 
	overflow: hidden; border: 3px solid #006699; -webkit-border-radius: 9px; -moz-border-radius: 9px; 
	border-radius: 9px; }
.datagrid table td, 
.datagrid table th { padding: 10px 9px; }
.datagrid table thead th {background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #006699), 
	color-stop(1, #00557F) );background:-moz-linear-gradient( center top, #006699 5%, #00557F 100% );
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#006699', endColorstr='#00557F');
	background-color:#006699; color:#FFFFFF; font-size: 16px; font-weight: bold; } 
.datagrid table thead th:first-child { border: none; }.datagrid table tbody td { color: #00557F; 
	border-left: 1px solid #E1EEF4;font-size: 16px;font-weight: normal; }
.datagrid table tbody .alt td { background: #E1EEf4; color: #00557F; }
.datagrid table tbody td:first-child { border-left: none; }
.datagrid table tbody tr:last-child td { border-bottom: none; }
</style>
</head>

<body>
<br>
	<a href="http://rlp612.azurewebsites.net/insert_new_transaction.php">Insert New Transaction</a>
</br>
<?php
	require_once 'config.php';
	$search=$_GET['search'];
	$query="call get_balance(null, '$search', null)";
	$result=mysql_query($query);
	$num=mysql_numrows($result);
	mysql_close();
?>

<br>
	<a href="http://rlp612.azurewebsites.net/index.php">Previous Page</a>
</br>

<div class="datagrid">
<table>
<thead>
<tr>
<th>Date</th>
<th>Client Name</th>
<th>Company Name</th>
<th>Account</th>
<th>Category</th>
<th>Product</th>
<th>Description</th>
<th>Transaction Amount</th>
<th>Balance</th>
<th> </th>
</tr>
</thead>

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

<tbody>
<tr>
<td>
<?php echo $f1; ?>
</td>
<td>
<?php echo $f2; ?>
</td>
<td>
<?php echo $f3; ?>
</td>
<td>
<?php echo $f4; ?>
</td>
<td>
<?php echo $f5; ?>
</td>
<td>
<?php echo $f6; ?>
</td>
<td>
<?php echo $f7; ?>
</td>
<td>
<?php echo $f8; ?>
</td>
<td>
<?php echo $f9; ?>
</td>
<td>
<a href="edit_transaction.php?search=<?php echo $f10;?>">
  <?php echo 'Edit';?>
</a>
</td>
</tr>
<?php	$i++;}
mysql_close();
?>
</tbody>
</table>
</div>

<br>
	<a href="http://rlp612.azurewebsites.net/index.php">Previous Page</a>
</br>
</body>
</html>