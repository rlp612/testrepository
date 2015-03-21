<html>
<head>
<title>Edit the Following Class</title>
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
.datagrid table thead th:first-child { border: none; }
.datagrid table tbody td { color: #00557F; border-left: 1px solid #E1EEF4;font-size: 16px;font-weight: normal; }
.datagrid table tbody .alt td { background: #E1EEf4; color: #00557F; }
.datagrid table tbody td:first-child { border-left: none; }
.datagrid table tbody tr:last-child td { border-bottom: none; }
.datagrid table tbody input {width:100%;}
</style>

</head>

<h1>Update Class Roster</h1>

<body>
<?php
	require_once 'config.php';
	$search=$_GET['search'];
	
	$query1="select distinct first_name from clients";
	$result1=mysql_query($query1);
	$num1=mysql_num_rows($result1);
	
	$query2="select distinct last_name from clients";
	$result2=mysql_query($query2);
	$num2=mysql_num_rows($result2);
	
	$query="call get_roster('$search')";		
	$result=mysql_query($query);
	$num=mysql_num_rows($result);

	mysql_close();
?>


<div class="datagrid">
<table>
<thead>
<tr>
<th>Name</th>
<th>Street</th>
<th>City</th>
<th>State</th>
<th>Zip</th>
<th>Email</th>
<th>Phone</th>
<th>Company</th>
<th> </th>
</tr>
</thead>

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
		$f9=mysql_result($result,$i,"company_name");
		$f10=mysql_result($result,$i,"rosterID");
?>

<tbody>
<tr>
<td>
<?php echo $f1." ".$f2; ?>
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
<a href="delete_roster.php?search=<?php echo $f10;?>">
  <?php echo 'Delete Student';?>
</a>
</td>
</tr>

<?php	$i++;}?>




<?php
if(isset($_POST['add'])){

	$conn = mysql_connect($host_name,$username,$password);

	if(! get_magic_quotes_gpc() ){
		$first_name = addslashes ($_POST['first_name']);
		$last_name = addslashes ($_POST['last_name']);
	}
	else{
		$first_name = $_POST['first_name'];
		$last_name = $_POST['last_name'];
	}
	
	$sql = "CALL add_roster('$first_name', '$last_name', '$search') ";
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

<td><input name='first_name' list="first" id="first_name">
<datalist id="first">
<?php
	$i=0;
	while ($i < $num1) {
		$f1=mysql_result($result1,$i,"first_name");
?>
<option value="<?php echo $f1; ?>"><?php echo $f1; ?></option>
<?php	$i++;}?>
</datalist> 

<input name='last_name' list="last" id="last_name">
<datalist id="last">
<?php
	$i=0;
	while ($i < $num2) {
		$f2=mysql_result($result2,$i,"last_name");
?>
<option value="<?php echo $f2; ?>"><?php echo $f2; ?></option>
<?php	$i++;}?>
</datalist> 
</td>

<td> </td>
<td> </td>

<td><input name='add' type="submit" id="add" value="Add Student"></td>
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