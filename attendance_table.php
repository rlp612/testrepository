<html>

<html>
<head>
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

<body>
<form action="http://rlp612.azurewebsites.net/index.php">
    <input type="submit" value="Home">
</form>

<?php
	require_once 'config.php';
	$search=$_GET['search'];
	
	$query="call get_attendance(null, null, '$search')";
	$result=mysql_query($query);
	$num=mysql_numrows($result);
	mysql_close();
?>

<h1>Class Attendance</h1>
<div class="datagrid">
<table>
<thead>
<tr>
<th>Name</th>
<th>Class</th>
<th>Meeting Days</th>
<th>Class Date</th>
<th>Present</th>
<th>Make-up</th>
<th>Cancelled</th>
<th> </th>
</tr>
</thead>

<?php
if(isset($_POST['add'])){

	$conn = mysql_connect($host_name,$username,$password);

	if(! get_magic_quotes_gpc() ){
		$first_name = addslashes ($_POST['first_name']);
		$last_name = addslashes ($_POST['last_name']);
		$class_date = addslashes ($_POST['class_date']);
		$present = addslashes ($_POST['present']);
		$makeup = addslashes ($_POST['makeup']);
		$cancelled = addslashes ($_POST['cancelled']);
	}
	else{
		$first_name = $_POST['first_name'];
		$last_name = $_POST['last_name'];
		$class_date = $_POST['class_date'];
		$present = $_POST['present'];
		$makeup = $_POST['makeup'];
		$cancelled = $_POST['cancelled'];
	}
	
	$sql = "CALL mod_attendance ('$first_name', '$last_name', '$class_date', '$search', '$present', '$makeup', '$cancelled') ";
	
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


<tbody>
<?php
	$i=0;
	while ($i < $num) {
		$f1=mysql_result($result,$i,"first_name");
		$f2=mysql_result($result,$i,"last_name");
		$f3=mysql_result($result,$i,"prod_name");
		$f4=mysql_result($result,$i,"day_name");
		$f5=mysql_result($result,$i,"class_date");
		$f6=mysql_result($result,$i,"present");
		$f7=mysql_result($result,$i,"makeup");
		$f8=mysql_result($result,$i,"cancelled");
?>



<tr>
<form method="post" action="<?php $_PHP_SELF ?>">
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
<?php 
	if ($f6 == true)
		{echo "<input type='radio' name='present' value=' ' id='present' checked>";}
	else
		{echo "<input type='radio' name='present' value=' ' id='present'>";}
?>
</td>
</td>
<?php 
	if ($f7 == true)
		{echo "<input type='radio' name='makeup' value=' ' id='makeup' checked>";}
	else
		{echo "<input type='radio' name='makeup' value=' ' id='makeup'>";}
?>
</td>
</td>
<?php 
	if ($f8 == true)
		{echo "<input type='radio' name='cancelled' value=' ' id='cancelled' checked>";}
	else
		{echo "<input type='radio' name='cancelled' value=' ' id='cancelled'>";}
?>
</td>
<td><input name="add" type="submit" id="add" value="Update Attendance"></td>
</form>
</tr>
<?php	$i++;}
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