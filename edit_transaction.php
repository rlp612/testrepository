<html>
<head>
<title>Edit the Following Transaction</title>
</head>
<body>
<?php
	require_once 'config.php';
	$search=$_GET['search'];
	
	$query0="call get_balance (null, '$search')";
	$result0=mysql_query($query0);
	$num0=mysql_numrows($result0);
	
	$g1=mysql_result($result0,$num0,"Date");
	$g2=mysql_result($result0,$num0,"Client Name");
	$g3=mysql_result($result0,$num0,"Company Name");
	$g4=mysql_result($result0,$num0,"Account");
	$g5=mysql_result($result0,$num0,"Category");
	$g6=mysql_result($result0,$num0,"Product");
	$g7=mysql_result($result0,$num0,"Notes");
	$g8=mysql_result($result0,$num0,"Transaction Amount");
	$g9=mysql_result($result0,$num0,"Balance");
	$g10=mysql_result($result0,$num0,"Transaction Number");
		
	$query8="select clientID from transactions where transID='$g10'";
	$result8=mysql_query($query8);
	$num8=mysql_numrows($result8);
	
	$query9="select first_name from clients where clientID='$query8'";
	$result9=mysql_query($query9);
	$num9=mysql_numrows($result9);
	
	$query10="select last_name from clients where transID='$query8'";
	$result10=mysql_query($query10);
	$num10=mysql_numrows($result10);
	
	mysql_close();
?>

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
</tr>

<tr>
<td>
<font face="Arial, Helvetica, sans-serif"><?php echo $g1; ?></font>
</td>
<td>
<font face="Arial, Helvetica, sans-serif"><?php echo $g2; ?></font>
</td>
<td>
<font face="Arial, Helvetica, sans-serif"><?php echo $g3; ?></font>
</td>
<td>
<font face="Arial, Helvetica, sans-serif"><?php echo $g4; ?></font>
</td>
<td>
<font face="Arial, Helvetica, sans-serif"><?php echo $g5; ?></font>
</td>
<td>
<font face="Arial, Helvetica, sans-serif"><?php echo $g6; ?></font>
</td>
<td>
<font face="Arial, Helvetica, sans-serif"><?php echo $g7; ?></font>
</td>
<td>
<font face="Arial, Helvetica, sans-serif"><?php echo $g8; ?></font>
</td>
<td>
<font face="Arial, Helvetica, sans-serif"><?php echo $g9; ?></font>
</td>
</tr>
</table>

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

	mysql_select_db($database);
	
	$sql1 = "CALL new_trans ".
       "('$amount', '$t_date', '$description', '$c_name', '$c_first_name', '$c_last_name', '$p_name', '$category_name', '$account_name', '$g10') ";
		
	$retval = mysql_query( $sql1, $conn );

	if(! $retval ){
		die('Could not enter data: ' . mysql_error());
	}

	echo "Entered data successfully\n";
	?>
	<br>
	<a href="http://rlp612.azurewebsites.net/index.php">Previous Page</a>
	</br>
	<?php
	mysql_close($conn);
}
else
{
?>

<h1>Enter Transaction Information</h1>

<form method="post" action="<?php $_PHP_SELF ?>">
<table width="400" border="0" cellspacing="1" cellpadding="2">

<tr>
<td width="100">Amount</td>
<td><input name="amount" type="number" step="any" id="amount"></td>
</tr>

<tr>
<td width="100">Date</td>
<td><input name="t_date" type="date" id="t_date"></td>
</tr>

<tr>
<td width="100">Description</td>
<td>
<input name='description' list="desc" id="description">
<datalist id="desc">
<option value="<?php echo $g7; ?>"><?php echo $g7; ?></option>
</datalist> 
</td>
</tr>

<tr>
<td width="100">Company</td>
<td>
<input name='c_name' list="comp" id="c_name">
<datalist id="comp">
<option value="<?php echo $g3; ?>"><?php echo $g3; ?></option>
</datalist> 
</td>
</tr>

<tr>
<td width="100">First Name</td>
<td>
<input name='c_first_name' list="first" id="c_first_name">
<datalist id="first">
<option value="<?php echo $result9; ?>"><?php echo $result9; ?></option>
</datalist> 
</td>
</tr>

<tr>
<td width="100">Last Name</td>
<td>
<input name='c_last_name' list="last" id="c_last_name">
<datalist id="last">
<option value="<?php echo $result10; ?>"><?php echo $result10; ?></option>
</datalist> 
</td>
</tr>

<tr>
<td width="100">Product</td>
<td>
<input name='p_name' list="prod" id="p_name">
<datalist id="prod">
<option value="<?php echo $g6; ?>"><?php echo $g6; ?></option>
</datalist> 
</td>
</tr>

<tr>
<td width="100">Category</td>
<td>
<input name='category_name' list="cat" id="category_name">
<datalist id="cat">
<option value="<?php echo $g5; ?>"><?php echo $g5; ?></option>
</datalist> 
</td>
</tr>

<tr>
<td width="100">Account</td>
<td>
<input name='account_name' list="acc" id="account_name">
<datalist id="acc">
<option value="<?php echo $g4; ?>"><?php echo $g4; ?></option>
</datalist> 
</td>
</tr>

<tr>
<td width="100"> </td>
<td> </td>
</tr>

<tr>
<td width="100"> </td>
<td>
<input name="add" type="submit" id="add" value="Add Transaction">
</td>
</tr>

</table>
</form>
<?php
}
?>

<br>
	<a href="http://rlp612.azurewebsites.net/index.php">Previous Page</a>
</br>
</body>
</html>