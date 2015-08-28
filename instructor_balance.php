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

<h1>Transactions Log</h1>
<br>
<form action="index.php">
    <input type="submit" value="Home">
</form>
<?php
	require_once 'config.php';
	$search=$_GET['search'];	
	$query="call instructor_balance('$search')";
	$result=mysql_query($query);
	$num=mysql_numrows($result);
	mysql_close();
	?>

<div class="datagrid">
<table>
<thead>
<tr>
<th>Date</th>
<th>Instructor Name</th>
<th>Class Name</th>
<th>Product Name</th>
<th>Student Name</th>
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

	mysql_select_db($database);
	$retval = mysql_query( $sql, $conn );

	if(! $retval ){
		die('Could not enter data: ' . mysql_error());
	}

	
	?>
		<meta http-equiv="refresh" content="0" >
	<?php
	
	mysql_close();

}
else
{
?>


<tbody>

<?php
}
?>








<?php
	$i=0;
	while ($i < $num) {
		$f1=mysql_result($result,$i,"trans_date");
		$f2=mysql_result($result,$i,"instructor_name");
		$f3=mysql_result($result,$i,"class_name");
		$f4=mysql_result($result,$i,"prod_name");
		$f5=mysql_result($result,$i,"student_name");
		$f6=mysql_result($result,$i,"trans_amount");
		$f7=mysql_result($result,$i,"balance");
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


</tr>
<?php	$i++;}

?>
</tbody>
</table>
</div>


</body>
</html>