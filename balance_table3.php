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
	<a href="http://rlp612.azurewebsites.net/index.php">Previous Page</a>
</br>

<?php
	require_once 'config.php';
	$query="call get_balance(null, null, null)";
	$result=mysql_query($query);
	$num=mysql_numrows($result);
	mysql_close();
?>

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
if(isset($_POST['add'])){

	$conn = mysql_connect($host_name,$username,$password);

	if(! $conn ){
		die('Could not connect: ' . mysql_error());
	}

	if(! get_magic_quotes_gpc() ){
		$amount = addslashes ($_POST['amount']);
		$t_date = addslashes ($_POST['t_date']);
		$description = addslashes ($_POST['description']);
		$c_name = addslashes ($_POST['c_name']);
		$c_first_name = addslashes ($_POST['c_first_name']);
		$c_last_name = addslashes ($_POST['c_last_name']);
		$p_name = addslashes ($_POST['p_name']);
		$category_name = addslashes ($_POST['category_name']);
		$account_name = addslashes ($_POST['account_name']);
	}
	else{
		$amount = $_POST['amount'];
		$t_date = $_POST['t_date'];
		$description = $_POST['description'];
		$c_name = $_POST['c_name'];
		$c_first_name = $_POST['c_first_name'];
		$c_last_name = $_POST['c_last_name'];
		$p_name = $_POST['p_name'];
	}




	$sql = "CALL new_trans ".
       "('$amount', '$t_date', '$description', '$c_name', '$c_first_name', '$c_last_name', '$p_name', '$category_name', '$account_name') ";
	
	mysql_select_db($database);
	$retval = mysql_query( $sql, $conn );

	if(! $retval ){
		die('Could not enter data: ' . mysql_error());
	}

	echo "Entered data successfully\n";
	?>
	<br>
	<a href="http://localhost/AWS%20practice/insert%20new%20transaction.php">Previous Page</a>
	</br>
	<?php
	mysql_close($conn);
}
else
{
?>

<form method="post" action="<?php $_PHP_SELF ?>">
<tbody>

<tr>
<td><input name="t_date" type="date" id="t_date"></td>
<td><input name='c_first_name' type="text" id="c_first_name">
<input name='c_last_name' type="text" id="c_last_name"></td>
<td><input name='c_name' type="text" id="c_name"></td>
<td><input name='account_name' type="text" id="account_name"></td>
<td><input name='category_name' type="text" id="category_name"></td>
<td><input name='p_name' type="text" id="p_name"></td>
<td><input name='description' type="text" id="description"></td>
<td><input name="amount" type="number" step="any" id="amount"></td>
<td> </td>
<td><input name="add" type="submit" id="add" value="Add Client"></td>
</tr>
</form>
<?php
}
?>








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