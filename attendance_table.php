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
<form action="index.php">
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

<?php
if(isset($_POST['add'])){
	
	$conn = mysql_connect($host_name,$username,$password);
	mysql_select_db($database);
	
	$j=0;
	while ($j < $num) {
		$f1=mysql_result($result,$j,"first_name");
		echo $f1;
		$f2=mysql_result($result,$j,"last_name");
		echo $f2;
		$f5=mysql_result($result,$j,"class_date");
		echo $f5;
		
		if (isset($_POST['present[$j]'])){
			$present[$j]=$_POST['present[$j]']; 
			echo 'present is set ='.$present[$j];}
		else {
			$present[$j]=0;
			echo 'present is not set ='.$present[$j];} 
		
		if (isset($_POST['makeup[$j]'])){
			$makeup[$j]=$_POST['makeup[$j]']; 
			echo 'makeup is set ='.$makeup[$j];}
		else {
			$makeup[$j]=0;
			echo 'makeup is not set ='.$makeup[$j];}
		
		if (isset($_POST['cancelled[$j]'])){
			$cancelled[$j]=$_POST['cancelled[$j]']; 
			echo 'cancelled is set ='.$cancelled[$j];}
		else {
			$cancelled[$j]=0;
			echo 'cancelled is not set ='.$cancelled[$j];}
		
		if ($present[$j] != 0 and $present[$j] != 1){$present[$j]=0;}
		if ($makeup[$j] !=0 and $makeup[$j] !=1){$makeup[$j]=0;}
		if ($cancelled[$j] !=0 and $cancelled[$j] !=1){$cancelled[$j]=0;}
		
		$sql = "CALL mod_attendance ('$f1', '$f2', '$f5', '$search', '$present[$j]', '$makeup[$j]', '$cancelled[$j]') ";
		$retval = mysql_query($sql, $conn);
		echo 'Success!';
		if(! $retval ){
		die('Could not enter data: ' . mysql_error());
		}
		$j++;
	}
	

	
	mysql_close($conn);
}
else
{
?>
<form method="post" action="<?php $_PHP_SELF ?>">

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
<th><input name="add" type="submit" id="add" value="Update Attendance"></th>
</tr>
</thead>




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
<?php 
	if ($f6 == true)
		{echo "<input type='hidden' name='present[$i]' value='1' />
		<input type='checkbox' name='present[$i]' value=1 id='present' checked>";}
	else
		{echo "<input type='hidden' name='present[$i]' value='0' />
		<input type='checkbox' name='present['.$i.']' value=0 id='present'>";}
?>
</td>
<td>
<?php 
	if ($f7 == true)
		{echo "<input type='hidden' name='makeup[$i]' value='1' />
		<input type='checkbox' name='makeup[$i]' value=1 id='makeup' checked>";}
	else
		{echo "<input type='hidden' name='makeup[$i]' value='0' />
		<input type='checkbox' name='makeup[$i]' value=0 id='makeup'>";}
?>
</td>
<td>
<?php 
	if ($f8 == true)
		{echo "<input type='hidden' name='cancelled[$i]' value='1' />
		<input type='checkbox' name='cancelled[$i]' value=1 id='cancelled' checked>";}
	else
		{echo "<input type='hidden' name='cancelled[$i]' value='0' />
		<input type='checkbox' name='cancelled[$i]' value=0 id='cancelled'>";}
?>
</td>
<td> </td>


</tr>
<?php	$i++;}
?>

</form>

<?php
}
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