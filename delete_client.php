<html>
<head>
<title>Delete Client</title>

</head>
<body>
<?php
	require_once 'config.php';
	$search=$_GET['search'];
	
	$sql = "DELETE FROM clients WHERE clientID='$search' ";
	
	mysql_select_db($database);
	$retval = mysql_query( $sql );

	if(! $retval ){
		die('Could not delete data: ' . mysql_error());
	}
	
	echo "The client has been deleted successfully\n";
	mysql_close();
?>
	
<br>
<form action="client_table.php">
    <input type="submit" value="Back">
</form>
</body>
</html>