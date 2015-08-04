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
<form action="class_table.php">
    <input type="submit" value="Back">
</form>

<?php
	require_once 'config.php';
	if (isset($_GET['search'])){
		$search=$_GET['search'];
		$query="call get_attendance(null, '$search', null)";
	} 
	if (isset($_GET['client'])){
		$client=$_GET['client'];
		$query="call get_attendance('$client', null, null)";
	} 
	if (isset($_GET['date'])){
		$date=$_GET['date'];
		$query="call get_attendance(null, null, '$date')";
	} 
	
	$result=mysql_query($query);
	$num=mysql_numrows($result);
	mysql_close();
?>

<?php
if(isset($_POST['add'])){
	
	$conn = mysql_connect($host_name,$username,$password);
	mysql_select_db($database);
	
	if (isset($_POST['present'])){
		$present=$_POST['present']; 
		for($n=0; $n < $num; $n++){
			if(! isset($present[$n])){$present[$n]=0;}
			#echo "present".$n." = " . $present[$n] . "<br/>";
			}
	}
	else {
		for($n=0; $n < $num; $n++){
			if(! isset($present[$n])){$present[$n]=0;}
			#echo "present".$n." = " . $present[$n] . "<br/>";
			}
	}
	if (isset($_POST['not_present'])){
		$not_present=$_POST['not_present']; 
		for($n=0; $n < $num; $n++){
			if(! isset($not_present[$n])){$not_present[$n]=0;}
			#echo "not_present".$n." = " . $not_present[$n] . "<br/>";
			}
	}
	else {
		for($n=0; $n < $num; $n++){
			if(! isset($not_present[$n])){$not_present[$n]=0;}
			#echo "not_present".$n." = " . $not_present[$n] . "<br/>";
			}
	}
	if (isset($_POST['makeup'])){
		$makeup=$_POST['makeup']; 
		for($n=0; $n < $num; $n++){
			if(! isset($makeup[$n])){$makeup[$n]=0;}
			#echo "makeup".$n." = " . $makeup[$n] . "<br/>";
			}
	}
	else {
		for($n=0; $n < $num; $n++){
			if(! isset($makeup[$n])){$makeup[$n]=0;}
			#echo "makeup".$n." = " . $makeup[$n] . "<br/>";
			}
	}
		
	if (isset($_POST['cancelled'])){
		$cancelled=$_POST['cancelled']; 
		for($n=0; $n < $num; $n++){
			if(! isset($cancelled[$n])){$cancelled[$n]=0;}
			#echo "cancelled".$n." = " . $cancelled[$n] . "<br/>";
			}
	}
	else {
		for($n=0; $n < $num; $n++){
			if(! isset($cancelled[$n])){$cancelled[$n]=0;}
			#echo "cancelled".$n." = " . $cancelled[$n] . "<br/>";
			}
	}
			
	$j=0;
	while ($j < $num) {
		$f1=mysql_result($result,$j,"first_name");
		#echo '<br>'.$f1;
		$f2=mysql_result($result,$j,"last_name");
		#echo $f2;
		$f5=mysql_result($result,$j,"class_date");
		#echo $f5;
		$f10=mysql_result($result,$j,"classID");
		
		if(is_null($present[$j])){$present[$j]=0;}
		
		if(is_null($not_present[$j])){$not_present[$j]=0;}
		
		if(is_null($makeup[$j])){$makeup[$j]=0;}
		
		if(is_null($cancelled[$j])){$cancelled[$j]=0;}
		
		
		$sql = "CALL mod_attendance ('$f1', '$f2', '$f5', '$f10', '$present[$j]', '$not_present[$j]', '$makeup[$j]', '$cancelled[$j]') ";
		$retval = mysql_query($sql, $conn);
		#echo '<br>'.$sql;
		if(! $retval ){
		die('Could not enter data: ' . mysql_error());
		}
		$j++;
	}
	
	?>
		<h1>Attendance Successfully Updated<h1>
		<meta http-equiv="refresh" content="1" >
	<?php
	
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
<th>Class Date</th>
<th>Present</th>
<th>Not Present</th>
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
		$f3=mysql_result($result,$i,"class_name");
		$f5=mysql_result($result,$i,"class_date");
		$f6=mysql_result($result,$i,"present");
		$f7=mysql_result($result,$i,"not_present");
		$f8=mysql_result($result,$i,"makeup");
		$f9=mysql_result($result,$i,"cancelled");
		$f10=mysql_result($result,$i,"clientID");
?>
<tr>

<td>
<a href="attendance_table.php?client=<?php echo $f10;?>">
<?php echo $f1." ".$f2; ?>
</a>
</td>
<td>
<?php echo $f3; ?>
</td>
<td>
<a href="attendance_table.php?date=<?php echo $f5;?>">
<?php echo $f5; ?>
</a>
</td>
<td>
<?php 
	if ($f6 == true){
		echo "<input type='checkbox' name='present[$i]' value=1 id='present' checked>";
	}
	else{
		echo "<input type='checkbox' name='present[$i]' value=1 id='present'>";
	}
?>
</td>
<td>
<?php 
	if ($f7 == true){
		echo "<input type='checkbox' name='not_present[$i]' value=1 id='not_present' checked>";
	}
	else{
		echo "<input type='checkbox' name='not_present[$i]' value=1 id='not_present'>";
	}
?>
</td>
<td>
<?php 
	if ($f8 == true){
		echo "<input type='checkbox' name='makeup[$i]' value=1 id='makeup' checked>";
	}
	else{
		echo "<input type='checkbox' name='makeup[$i]' value=1 id='makeup'>";
	}
?>
</td>
<td>
<?php 
	if ($f9 == true){
		echo "<input type='checkbox' name='cancelled[$i]' value=1 id='cancelled' checked>";
	}
	else{
		echo "<input type='checkbox' name='cancelled[$i]' value=1 id='cancelled'>";
	}
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
<form action="class_table.php">
    <input type="submit" value="Back">
</form>
<br> </br>

</body>
</html>