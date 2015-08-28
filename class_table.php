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

<h1>Class List</h1>


<?php
	require_once 'config.php';
	$query1="select distinct prod_name from products order by prod_name";
	$result1=mysql_query($query1);
	$num1=mysql_numrows($result1);
	
	$query2="select distinct company_name from companies order by company_name";
	$result2=mysql_query($query2);
	$num2=mysql_numrows($result2);
	
	$query3="call archive_class()";
	$result3=mysql_query($query3);
	
	$query4="select distinct concat(first_name, ' ', last_name) as instructor_name from instructors order by instructor_name";
	$result4=mysql_query($query4);
	$num4=mysql_numrows($result4);
	
	$query="call class_list(null, null, 1)";
	$result=mysql_query($query);
	$num=mysql_numrows($result);
	mysql_close();
?>


<div class="datagrid">
<table>
<thead>
<tr>
<th>Class Name</th>
<th>Product Name</th>
<th>Sun</th>
<th>Mon</th>
<th>Tue</th>
<th>Wed</th>
<th>Thur</th>
<th>Fri</th>
<th>Sat</th>
<th>Start Date</th>
<th>End Date</th>
<th>Company</th>
<th>Instructor</th>
<th> </th>
</tr>
</thead>

<?php
if(isset($_POST['add'])){

	$conn = mysql_connect($host_name,$username,$password);

	if(! get_magic_quotes_gpc() ){
		$class_name = addslashes ($_POST['class_name']);
		$c_name = addslashes ($_POST['c_name']);
		$p_name = addslashes ($_POST['p_name']);
		$i_name = addslashes ($_POST['i_name']);
		$start_date = addslashes ($_POST['start_date']);
		$end_date = addslashes ($_POST['end_date']);
	}
	else{
		$class_name = $_POST['class_name'];
		$c_name = $_POST['c_name'];
		$p_name = $_POST['p_name'];
		$i_name = $_POST['i_name'];
		$start_date = $_POST['start_date'];
		$end_date = $_POST['end_date'];
	}

	if (isset($_POST['sunday'])){$sunday=$_POST['sunday'];}
	else {$sunday=0;}	
	
	if (isset($_POST['monday'])){$monday=$_POST['monday'];}
	else {$monday=0;}	
	
	if (isset($_POST['tuesday'])){$tuesday=$_POST['tuesday'];}
	else {$tuesday=0;}	
	
	if (isset($_POST['wednesday'])){$wednesday=$_POST['wednesday'];}
	else {$wednesday=0;}	

	if (isset($_POST['thursday'])){$thursday=$_POST['thursday'];}
	else {$thursday=0;}	
	
	if (isset($_POST['friday'])){$friday=$_POST['friday'];}
	else {$friday=0;}	

	if (isset($_POST['saturday'])){$saturday=$_POST['saturday'];}
	else {$saturday=0;}	

	$j=0;
	$sql = "CALL add_class ('$c_name', '$p_name', '$i_name', '$start_date', '$end_date', '$sunday', '$monday','$tuesday',
							'$wednesday','$thursday','$friday','$saturday','$class_name') ";
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
	$j=0;
?>


<tbody>
<form method="post" action="<?php $_PHP_SELF ?>">
<tr>

<td><input name='class_name' type="text" id="class_name"></td>

<td>
<input name='p_name' list="product" id="p_name">
<datalist id="product">
<?php
	$i=0;
	while ($i < $num1) {
		$f1=mysql_result($result1,$i,"prod_name");?>
<option value="<?php echo $f1; ?>"><?php echo $f1; ?></option>
<?php	$i++;}?>
</datalist> 
</td>

<td>
<input type='checkbox' name='sunday' value=1 id='sunday'>
</td>
<td>
<input type='checkbox' name='monday' value=1 id='monday'>
</td>
<td>
<input type='checkbox' name='tuesday' value=1 id='tuesday'>
</td>
<td>
<input type='checkbox' name='wednesday' value=1 id='wednesday'>
</td>
<td>
<input type='checkbox' name='thursday' value=1 id='thursday'>
</td>
<td>
<input type='checkbox' name='friday' value=1 id='friday'>
</td>
<td>
<input type='checkbox' name='saturday' value=1 id='saturday'>
</td>
<td><input name='start_date' type="date" id="start_date"></td>

<td><input name='end_date' type="date" id="end_date"></td>

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

<td>
<input name='i_name' list="instr" id="i_name">
<datalist id="instr">
<?php
	$i=0;
	while ($i < $num4) {
		$f4=mysql_result($result4,$i,"instructor_name");?>
<option value="<?php echo $f4; ?>"><?php echo $f4; ?></option>
<?php	$i++;}?>
</datalist> 
</td>

<td><input name="add" type="submit" id="add" value="Add Class"></td>
</tr>
</form>
<?php
}
?>


<?php
	$i=0;
	while ($i < $num) {
		$f1=mysql_result($result,$i,"prod_name");
		$f2sun=mysql_result($result,$i,"sunday");
		$f2mon=mysql_result($result,$i,"monday");
		$f2tue=mysql_result($result,$i,"tuesday");
		$f2wed=mysql_result($result,$i,"wednesday");
		$f2thur=mysql_result($result,$i,"thursday");
		$f2fri=mysql_result($result,$i,"friday");
		$f2sat=mysql_result($result,$i,"saturday");
		$f3=mysql_result($result,$i,"start_date");
		$f4=mysql_result($result,$i,"end_date");
		$f5=mysql_result($result,$i,"company_name");
		$f6=mysql_result($result,$i,"classID");
		$f7=mysql_result($result,$i,"class_name");
		$f8=mysql_result($result,$i,"instructor_name");
		$f9=mysql_result($result,$i,"instructorID");
?>



<tr>

<td>
<a href="attendance_table.php?search=<?php echo $f6;?>"><?php echo $f7; ?></a>
</td>
<td>
  <?php echo $f1;?>
</td>
<td>
<?php 
	if ($f2sun == true){
		echo "<input type='checkbox' name='sunday' value=1 id='sunday' checked>";
	}
	else{
		echo "<input type='checkbox' name='sunday' value=1 id='sunday'>";
	}
?>
</td>
<td>
<?php 
	if ($f2mon == true){
		echo "<input type='checkbox' name='monday' value=1 id='monday' checked>";
	}
	else{
		echo "<input type='checkbox' name='monday' value=1 id='monday'>";
	}
?>
</td>
<td>
<?php 
	if ($f2tue == true){
		echo "<input type='checkbox' name='tuesday' value=1 id='tuesday' checked>";
	}
	else{
		echo "<input type='checkbox' name='tuesday' value=1 id='tuesday'>";
	}
?>
</td>
<td>
<?php 
	if ($f2wed == true){
		echo "<input type='checkbox' name='wednesday' value=1 id='wednesday' checked>";
	}
	else{
		echo "<input type='checkbox' name='wednesday' value=1 id='wednesday'>";
	}
?>
</td>
<td>
<?php 
	if ($f2thur == true){
		echo "<input type='checkbox' name='thursday' value=1 id='thursday' checked>";
	}
	else{
		echo "<input type='checkbox' name='thursday' value=1 id='thursday'>";
	}
?>
</td>
<td>
<?php 
	if ($f2fri == true){
		echo "<input type='checkbox' name='friday' value=1 id='friday' checked>";
	}
	else{
		echo "<input type='checkbox' name='friday' value=1 id='friday'>";
	}
?>
</td>
<td>
<?php 
	if ($f2sat == true){
		echo "<input type='checkbox' name='saturday' value=1 id='saturday' checked>";
	}
	else{
		echo "<input type='checkbox' name='saturday' value=1 id='saturday'>";
	}
?>
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
<a href="instructor_balance.php?search=<?php echo $f9;?>">
	<?php echo $f8; ?>
</a>
</td>
<td>
<a href="edit_class.php?search=<?php echo $f6;?>">
  <?php echo 'Add Students';?>
</a>
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