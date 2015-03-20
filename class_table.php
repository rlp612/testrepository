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
.datagrid table thead th:first-child { border: none; }.datagrid table tbody td { color: #00557F; 
	border-left: 1px solid #E1EEF4;font-size: 16px;font-weight: normal; }
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
	$query1="select distinct prod_name from products order by prod_name";
	$result1=mysql_query($query1);
	$num1=mysql_numrows($result1);
	
	$query2="select distinct company_name from companies order by company_name";
	$result2=mysql_query($query2);
	$num2=mysql_numrows($result2);
	
	$query="call class_list(null, null)";
	$result=mysql_query($query);
	$num=mysql_numrows($result);
	mysql_close();
?>

<h1>Class List</h1>
<div class="datagrid">
<table>
<thead>
<tr>
<th>Class Name</th>
<th>Meeting Days</th>
<th>Start Date</th>
<th>End Date</th>
<th>Company</th>
<th> </th>
</tr>
</thead>

<?php
if(isset($_POST['add'])){

	$conn = mysql_connect($host_name,$username,$password);

	if(! get_magic_quotes_gpc() ){
		$c_name = addslashes ($_POST['c_name']);
		$p_name = addslashes ($_POST['p_name']);
		$start_date = addslashes ($_POST['start_date']);
		$end_date = addslashes ($_POST['end_date']);
		$day_of_week = addslashes ($_POST['day_of_week']);
	}
	else{
		$c_name = $_POST['c_name'];
		$p_name = $_POST['p_name'];
		$start_date = $_POST['start_date'];
		$end_date = $_POST['end_date'];
		$day_of_week = $_POST['day_of_week'];
	}
	
	if ($zip==''){
		$zip=00000;
	}
	$sql = "CALL add_class ('$c_name', '$p_name', '$start_date', '$end_date', '$day_of_week') ";
	
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
<form method="post" action="<?php $_PHP_SELF ?>">
<tr>

<td>
<input name='p_name' list="product" id="p_name">
<datalist id="product">
<?php
	$i=0;
	while ($i < $num1) {
		$f1=mysql_result($result1,$i,"first_name");?>
<option value="<?php echo $f1; ?>"><?php echo $f1; ?></option>
<?php	$i++;}?>
</datalist> 
</td>

<td>
<input name='c_name' list="comp" id="c_name">
<datalist id="comp">
<?php
	$i=0;
	while ($i < $num2) {
		$f2=mysql_result($result2,$i,"company_name");?>
<option value="<?php echo $f2; ?>"><?php echo $f2; ?></option>
<?php	$i++;}?>
</datalist> 
</td>

<td><input name='start_date' type="date" id="start_date"></td>

<td><input name='end_date' type="date" id="end_date"></td>

<td>
<input name='day_of_week' list="days" id="day_of_week">
<datalist id="days">
  <option value="Sunday">
  <option value="Monday">
  <option value="Tuesday">
  <option value="Wednesday">
  <option value="Thursday">
  <option value="Friday">
  <option value="Saturday">
</datalist> 
</td>
</tr>
</form>
<?php
}
?>


<?php
	$i=0;
	while ($i < $num) {
		$f1=mysql_result($result,$i,"prod_name");
		$f2=mysql_result($result,$i,"day_name");
		$f3=mysql_result($result,$i,"start_date");
		$f4=mysql_result($result,$i,"end_date");
		$f5=mysql_result($result,$i,"company_name");
		$f6=mysql_result($result,$i,"classID");
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
<a href="edit_class.php?search=<?php echo $f6;?>">
  <?php echo 'Edit';?>
</a>
</td>
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