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
	$query="select * from clients order by first_name";
	$result=mysql_query($query);
	$query1="select company_name, first_name from companies a
			right join clients b
			on a.companyID=b.company_id
			order by first_name";
	$result1=mysql_query($query1);
	$num=mysql_numrows($result);
	mysql_close();
?>

<h1>Client List</h1>
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
		$f9=mysql_result($result1,$i,"company_name");
		$f10=mysql_result($result,$i,"clientID");
?>

<tbody>
<tr>

<td>
<a href="balance_table2.php?search=<?php echo $f1.' '.$f2;?>">
  <?php echo $f1.' '.$f2;?>
</a>
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
<a href="edit_client.php?search=<?php echo $f10;?>">
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