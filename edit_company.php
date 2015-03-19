<html>
<head>
<title>Edit the Following Transaction</title>
<style>
.datagrid table { border-collapse: collapse; text-align: left; width: 100%; } 
.datagrid {display: inline-block; font: normal 16px/150% Arial, Helvetica, sans-serif; background: #fff; 
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
.datagrid table tbody input {width:100%;}
</style>

</head>

<h1>Update Company Information</h1>
<body>
<?php
	require_once 'config.php';
	$search=$_GET['search'];
	
	$query="select * from companies where companyID='$search'";
	$result=mysql_query($query);
	$num=mysql_numrows($result);

	mysql_close();
?>


<div class="datagrid">
<table>
<thead>
<tr>
<th>Company Name</th>
<th>Street</th>
<th>City</th>
<th>State</th>
<th>Zip</th>
<th>Email</th>
<th>Phone</th>
<th> </th>
</tr>
</thead>

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
		$f8=mysql_result($result,$i,"companyID");
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
<a href="delete_company.php?search=<?php echo $f8;?>">
  <?php echo 'Delete Company';?>
</a>
</td>
</tr>

<?php	$i++;}?>




<?php
if(isset($_POST['add'])){

	$conn = mysql_connect($host_name,$username,$password);

	if(! $conn ){
		die('Could not connect: ' . mysql_error());
	}

	if(! get_magic_quotes_gpc() ){
		$company_name = addslashes ($_POST['company']);
		$street = addslashes ($_POST['street']);
		$city = addslashes ($_POST['city']);
		$state = addslashes ($_POST['state']);
		$zip = addslashes ($_POST['zip']);
		$email = addslashes ($_POST['email']);
		$phone = addslashes ($_POST['phone']);
	}
	else{
		$company_name = $_POST['company'];
		$street = $_POST['street'];
		$city = $_POST['city'];
		$state = $_POST['state'];
		$zip = $_POST['zip'];
		$email = $_POST['email'];
		$phone = $_POST['phone'];
	}




	$sql = "CALL mod_company ".
       "('$company_name', '$street', '$city', '$state', '$zip', '$phone', '$email') ";
	
	mysql_select_db($database);
	$retval = mysql_query( $sql, $conn );

	if(! $retval ){
		die('Could not enter data: ' . mysql_error());
	}

	
	?>
		<meta http-equiv="refresh" content="0" >
	<?php
	

	mysql_close($conn);
}
else
{
?>


<form method="post" action="<?php $_PHP_SELF ?>">

<td><input name='company' list="comp" id="company">
<datalist id="comp">
<?php
	$i=0;
	while ($i < $num) {
		$f1=mysql_result($result,$i,"company_name");
?>
<option value="<?php echo $f1; ?>"><?php echo $f1; ?></option>
<?php	$i++;}?>
</datalist> 
</td>

<td><input name="street" type="text" id="street"></td>

<td><input name="city" type="text" id="city"></td>

<td><input name='state' list="States" id="state">
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

<td><input name="zip" type="number" id="zip"></td>

<td><input name="email" type="text" id="email"></td>

<td><input name="phone" type="text" id="phone"></td>

<td><input name="add" type="submit" id="add" value="Modify Company"></td>
</tr>

</form>
<?php
}
?>
</tbody>
</table>
</div>

<br> </br>
<form action="http://rlp612.azurewebsites.net/index.php">
    <input type="submit" value="Home">
</form>
<br> </br>
</body>
</html>