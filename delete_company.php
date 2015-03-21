<html>
<head>
<title>Delete Transaction</title>

</head>
<body>
<?php
	require_once 'config.php';
	$search=$_GET['search'];
	
	$sql = "DELETE FROM companies WHERE companyID='$search' ";
	
	mysql_select_db($database);
	$retval = mysql_query( $sql );

	if(! $retval ){
		die('Could not delete data: ' . mysql_error());
	}
	
	echo "The company has been deleted successfully\n";
	mysql_close();
?>
	
<br>
<form action="company_table.php">
    <input type="submit" value="Back">
</form>
</body>
</html>