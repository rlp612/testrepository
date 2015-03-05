<html>
<head>
<title>Modify Client Information</title>
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
	mysql_close();
?>

<?php
if(isset($_POST['add'])){

	$conn = mysql_connect($host_name,$username,$password);

	if(! get_magic_quotes_gpc() ){
		$first_name = addslashes ($_POST['first_name']);
		$last_name = addslashes ($_POST['last_name']);
		$street = addslashes ($_POST['street']);
		$city = addslashes ($_POST['city']);
		$state = addslashes ($_POST['state']);
		$zip = addslashes ($_POST['zip']);
		$email = addslashes ($_POST['email']);
		$phone = addslashes ($_POST['phone']);
		$company = addslashes ($_POST['company']);
	}
	else{
		$first_name = $_POST['first_name'];
		$last_name = $_POST['last_name'];
		$street = $_POST['street'];
		$city = $_POST['city'];
		$state = $_POST['state'];
		$zip = $_POST['zip'];
		$email = $_POST['email'];
		$phone = $_POST['phone'];
		$company = $_POST['company'];
	}

	$sql = "CALL mod_client ".
       "('$first_name', '$last_name', '$street', '$city', '$state', '$zip', '$email', '$phone', '$company') ";
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

<h1>Enter Client Information</h1>

<form method="post" action="<?php $_PHP_SELF ?>">
<table width="400" border="0" cellspacing="1" cellpadding="2">

<tr>
<td width="100">First Name</td>
<td>
<input name='first_name' list="first" id="first_name">
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
<input name='last_name' list="last" id="last_name">
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
<td width="100">Street</td>
<td><input name='street' type="text" id="street"></td>
</tr>

<tr>
<td width="100">City</td>
<td><input name='city' type="text" id="city"></td>
</tr>

<tr>
<td width="100">State</td>
<td>
<input name='state' list="States" id="state">
<datalist id="States">
  <option value="AL">
  <option value="AK">
  <option value="AZ">
  <option value="AR">
  <option value="CA">
  <option value="CO">
  <option value="CT">
  <option value="DC">
  <option value="DE">
  <option value="FL">
  <option value="GA">
  <option value="HI">
  <option value="ID">
  <option value="IL">
  <option value="IN">
  <option value="IA">
  <option value="KS">
  <option value="KY">
  <option value="LA">
  <option value="ME">
  <option value="MD">
  <option value="MA">
  <option value="MI">
  <option value="MN">
  <option value="MS">
  <option value="MO">
  <option value="MT">
  <option value="NE">
  <option value="NV">
  <option value="NH">
  <option value="NJ">
  <option value="NM">
  <option value="NY">
  <option value="NC">
  <option value="ND">
  <option value="OH">
  <option value="OK">
  <option value="OR">
  <option value="PA">
  <option value="PR">
  <option value="RI">
  <option value="SC">
  <option value="SD">
  <option value="TN">
  <option value="TX">
  <option value="UT">
  <option value="VT">
  <option value="VA">
  <option value="WA">
  <option value="WV">
  <option value="WI">
  <option value="WY">
</datalist> 
</td>
</tr>

<tr>
<td width="100">Zip</td>
<td><input name='zip' type="number" id="zip"></td>
</tr>

<tr>
<td width="100">Email</td>
<td><input name='email' type="text" id="email"></td>
</tr>

<tr>
<td width="100">Phone</td>
<td><input name='phone' type="text" id="phone"></td>
</tr>

<tr>
<td width="100">Company</td>
<td>
<input name='company' list="comp" id="company">
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
<td width="100"> </td>
<td> </td>
</tr>

<tr>
<td width="100"> </td>
<td>
<input name='add' type="submit" id="add" value="Add Client">
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