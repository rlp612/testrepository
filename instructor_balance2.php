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
	$query1="select distinct concat(first_name, ' ', last_name) as i_name from instructors order by i_name";
	$result1=mysql_query($query1);
	$num1=mysql_numrows($result1);
	$query2="select distinct class_name from class order by class_name";
	$result2=mysql_query($query2);	
	$num2=mysql_numrows($result2);
	$query3="select distinct prod_name from products order by prod_name";
	$result3=mysql_query($query3);
	$num3=mysql_numrows($result3);	
	$query4="select distinct first_name from clients order by first_name";
	$result4=mysql_query($query4);
	$num4=mysql_numrows($result4);
	$query5="select distinct last_name from clients order by last_name";
	$result5=mysql_query($query5);
	$num5=mysql_numrows($result5);
	
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

	if(! get_magic_quotes_gpc() ){
		$amount = addslashes ($_POST['amount']);
		$t_date = addslashes ($_POST['t_date']);
		$i_name = addslashes ($_POST['i_name']);
		$p_name = addslashes ($_POST['p_name']);
		$c_first_name = addslashes ($_POST['c_first_name']);
		$c_last_name = addslashes ($_POST['c_last_name']);
	}
	else{
		$amount = $_POST['amount'];
		$t_date = $_POST['t_date'];
		$i_name = $_POST['i_name'];
		$p_name = $_POST['p_name'];
		$s_name = $_POST['s_name'];
		$c_first_name = $_POST['c_first_name'];
		$c_last_name = $_POST['c_last_name'];
	}




	$sql = "CALL new_trans ".
       "('$amount', '$t_date', null, null, '$c_first_name', '$c_last_name', '$p_name', null, null, null) ";
	
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
<form method="post" action="<?php $_PHP_SELF ?>">
<tr>

<td>
<input name="t_date" type="date" id="t_date">
</td>

<td>
<input name='i_name' list="instructor" id="i_name">
<datalist id="instructor">
<?php
	$i=0;
	while ($i < $num1) {
		$f1=mysql_result($result1,$i,"i_name");?>
<option value="<?php echo $f1; ?>"><?php echo $f1; ?></option>
<?php	$i++;}?>
</datalist> 
</td>

<td>
<input name='class_name' list="class" id="class_name">
<datalist id="class">
<?php
	$i=0;
	while ($i < $num2) {
		$f2=mysql_result($result2,$i,"class_name");
?>
<option value="<?php echo $f2; ?>"><?php echo $f2; ?></option>
<?php	$i++;}?>
</datalist> 
</td>

<td>
<input name='p_name' list="prod" id="p_name">
<datalist id="prod">
<?php
	$i=0;
	while ($i < $num3) {
		$f3=mysql_result($result3,$i,"prod_name");
?>
<option value="<?php echo $f3; ?>"><?php echo $f3; ?></option>
<?php	$i++;}?>
</datalist> 
</td>

<td>
<input name='c_first_name' list="first" id="c_first_name">
<datalist id="first">
<?php
	$i=0;
	while ($i < $num4) {
		$f4=mysql_result($result4,$i,"first_name");?>
<option value="<?php echo $f4; ?>"><?php echo $f4; ?></option>
<?php	$i++;}?>
</datalist> 

<input name='c_last_name' list="last" id="c_last_name">
<datalist id="last">
<?php
	$i=0;
	while ($i < $num5) {
		$f5=mysql_result($result5,$i,"last_name");?>
<option value="<?php echo $f5; ?>"><?php echo $f5; ?></option>
<?php	$i++;}?>
</datalist> 
</td>

<td><input name="amount" type="number" step="any" id="amount"></td>
<td> </td>
<td><input name="add" type="submit" id="add" value="Add Transaction"></td>
</tr>
</form>
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

<br> </br>
<form action="index.php">
    <input type="submit" value="Home">
</form>
<br> </br>

</body>
</html>