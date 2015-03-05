<html>
<head>
<title>Enter Transaction Information</title>
</head>
<body>
<?php
	require_once 'config.php';
	$query1="select distinct first_name from clients order by first_name";
	$result1=mysql_query($query1);
	$num=mysql_numrows($result1);
	$query2="select distinct last_name from clients order by last_name";
	$result2=mysql_query($query2);
	$query3="select distinct company_name from companies order by company_name";
	$result3=mysql_query($query3);
	$query4="select distinct prod_name from products order by prod_name";
	$result4=mysql_query($query4);
	$query5="select distinct categoryName from categories order by categoryName";
	$result5=mysql_query($query5);
	$query6="select distinct accountName from accounts order by accountName";
	$result6=mysql_query($query6);
	$query7="select distinct description from transactions order by description";
	$result7=mysql_query($query7);
	mysql_close();
?>

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

<?php
	$i=0;
	while ($i < $num) {
		$f7=mysql_result($result7,$i,"description");
?>

<option value="<?php echo $f7; ?>"><?php echo $f7; ?></option>

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
	while ($i < $num) {
		$f3=mysql_result($result3,$i,"company_name");
?>

<option value="<?php echo $f3; ?>"><?php echo $f3; ?></option>

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
	while ($i < $num) {
		$f1=mysql_result($result1,$i,"first_name");
?>

<option value="<?php echo $f1; ?>"><?php echo $f1; ?></option>

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
	while ($i < $num) {
		$f2=mysql_result($result2,$i,"last_name");
?>

<option value="<?php echo $f2; ?>"><?php echo $f2; ?></option>

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
	while ($i < $num) {
		$f4=mysql_result($result4,$i,"prod_name");
?>

<option value="<?php echo $f4; ?>"><?php echo $f4; ?></option>

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
	while ($i < $num) {
		$f5=mysql_result($result5,$i,"categoryName");
?>

<option value="<?php echo $f5; ?>"><?php echo $f5; ?></option>

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
	while ($i < $num) {
		$f6=mysql_result($result6,$i,"accountName");
?>

<option value="<?php echo $f6; ?>"><?php echo $f6; ?></option>

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
<input name="add" type="submit" id="add" value="Add Client">
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