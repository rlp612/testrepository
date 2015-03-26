<html>
<head>
<title>Delete Transaction</title>
<style>
.datagrid table { border-collapse: collapse; text-align: left; width: 500; } 
.datagrid {display: inline-block; font: normal 16px/150% Arial, Helvetica, sans-serif; background: #fff; 
	overflow: hidden; border: 3px solid #006699; -webkit-border-radius: 9px; -moz-border-radius: 9px; 
	border-radius: 9px; }
.datagrid table td, 
.datagrid table th { text-align:center; padding: 10px 9px; }
.datagrid table thead th {background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #006699), 
	color-stop(1, #00557F) );background:-moz-linear-gradient( center top, #006699 5%, #00557F 100% );
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#006699', endColorstr='#00557F');
	background-color:#006699; color:#FFFFFF; font-size: 16px; font-weight: bold; } 
.datagrid table thead th:first-child { border: none; }
.datagrid table tbody td { color: #00557F; 
	border-left: 1px solid #E1EEF4;font-size: 16px;font-weight: normal; }
.datagrid table tbody .alt td { background: #E1EEf4; color: #00557F; }
.datagrid table tbody td:first-child { border-left: none; }
.datagrid table tbody tr:last-child td { border-bottom: none; }
.datagrid table tbody input {width:150;}
</style>
</head>
<body>
<?php
	require_once 'config.php';
	$search=$_GET['search'];
	
if(isset($_POST['submit'])) {
	
	$sql = "DELETE FROM transactions WHERE transID='$search' ";
	
	mysql_select_db($database);
	$retval = mysql_query( $sql );

	if(! $retval ){
		die('Could not delete data: ' . mysql_error());
	}
	
	echo "The transaction has been deleted successfully\n";
?>

	<form action="balance_table.php">
		<input type="submit" value="Back">
	</form>

<?php
	
	mysql_close();
}
else
{
	echo "<script type='text/javascript'>alert('WARNING: You are about to permanently delete this transaction from the balance sheet!  Are you SURE you want to do this?')</script>";
?>
	<div class="datagrid">
	<table>
	<tr>
    <th>
	<form action="" method="post">
		<input type="submit" name="submit" value="Delete Forever" />
    </form>
	</th>
	<th>
	<form action="balance_table.php">
		<input type="submit" value="Back to safety">
	</form>
	</th>
	</tr>
	</table>
	</div>
<?php
}
?>
</body>
</html>