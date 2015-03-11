<html>
<head>
<title>Edit the Following Transaction</title>
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
<?php
	require_once 'config.php';
	$search=$_GET['search'];
	
	$query="call get_balance (null, null, '$search')";
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
<a href="delete_transaction.php?search=<?php echo $f10;?>">
  <?php echo 'Delete';?>
</a>
</td>
</tr>

<?php	$i++;}?>
</tbody>
</table>
</div>



<?php
	require_once 'config.php';
	$query1="select distinct first_name from clients order by first_name";
	$result1=mysql_query($query1);
	$num1=mysql_numrows($result1);
	
	$query2="select distinct last_name from clients order by last_name";
	$result2=mysql_query($query2);
	$num2=mysql_numrows($result2);
	
	$query3="select distinct company_name from companies order by company_name";
	$result3=mysql_query($query3);
	$num3=mysql_numrows($result3);
	
	$query4="select distinct prod_name from products order by prod_name";
	$result4=mysql_query($query4);
	$num4=mysql_numrows($result4);
	
	$query5="select distinct categoryName from categories order by categoryName";
	$result5=mysql_query($query5);
	$num5=mysql_numrows($result5);
	
	$query6="select distinct accountName from accounts order by accountName";
	$result6=mysql_query($query6);
	$num6=mysql_numrows($result6);
	
	$query7="select distinct description from transactions order by description";
	$result7=mysql_query($query7);
	$num7=mysql_numrows($result7);
	
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
       "('$amount', '$t_date', '$description', '$c_name', '$c_first_name', '$c_last_name', '$p_name', '$category_name', '$account_name', '$search') ";
	
	mysql_select_db($database);
	$retval = mysql_query( $sql, $conn );

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

<h1>Update Transaction Information</h1>

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

<?php
	$i=0;
	while ($i < $num7) {
		$g7=mysql_result($result7,$i,"description");
?>

<option value="<?php echo $g7; ?>"><?php echo $g7; ?></option>

<?php	$i++;}?>

</datalist> 
</td>
</tr>

<tr>
<td width="100">Company</td>
<td>
<input name='c_name' list="comp" id="c_name">
<datalist id="comp">

<?php
	$i=0;
	while ($i < $num3) {
		$g3=mysql_result($result3,$i,"company_name");
?>

<option value="<?php echo $g3; ?>"><?php echo $g3; ?></option>

<?php	$i++;}?>

</datalist> 
</td>
</tr>

<tr>
<td width="100">First Name</td>
<td>
<input name='c_first_name' list="first" id="c_first_name">
<datalist id="first">

<?php
	$i=0;
	while ($i < $num1) {
		$g1=mysql_result($result1,$i,"first_name");
?>

<option value="<?php echo $g1; ?>"><?php echo $g1; ?></option>

<?php	$i++;}?>

</datalist> 
</td>
</tr>

<tr>
<td width="100">Last Name</td>
<td>
<input name='c_last_name' list="last" id="c_last_name">
<datalist id="last">

<?php
	$i=0;
	while ($i < $num2) {
		$g2=mysql_result($result2,$i,"last_name");
?>

<option value="<?php echo $g2; ?>"><?php echo $g2; ?></option>

<?php	$i++;}?>

</datalist> 
</td>
</tr>

<tr>
<td width="100">Product</td>
<td>
<input name='p_name' list="prod" id="p_name">
<datalist id="prod">

<?php
	$i=0;
	while ($i < $num4) {
		$g4=mysql_result($result4,$i,"prod_name");
?>

<option value="<?php echo $g4; ?>"><?php echo $g4; ?></option>

<?php	$i++;}?>

</datalist> 
</td>
</tr>

<tr>
<td width="100">Category</td>
<td>
<input name='category_name' list="cat" id="category_name">
<datalist id="cat">

<?php
	$i=0;
	while ($i < $num5) {
		$g5=mysql_result($result5,$i,"categoryName");
?>

<option value="<?php echo $g5; ?>"><?php echo $g5; ?></option>

<?php	$i++;}?>

</datalist> 
</td>
</tr>

<tr>
<td width="100">Account</td>
<td>
<input name='account_name' list="acc" id="account_name">
<datalist id="acc">

<?php
	$i=0;
	while ($i < $num6) {
		$g6=mysql_result($result6,$i,"accountName");
?>

<option value="<?php echo $g6; ?>"><?php echo $g6; ?></option>

<?php	$i++;}?>

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