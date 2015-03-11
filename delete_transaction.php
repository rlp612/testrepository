<html>
<head>
<title>Delete Transaction</title>

</head>
<body>
<?php
	require_once 'config.php';
	$search=$_GET['search'];
	
	$sql = "DELETE FROM transactions WHERE transID='$search' ";
	
	mysql_select_db($database);
	$retval = mysql_query( $sql );

	if(! $retval ){
		die('Could not delete data: ' . mysql_error());
	}
	
	echo "The transaction listed above has been deleted successfully\n";
?>
	
<br>
	<a href="http://rlp612.azurewebsites.net/index.php">Previous Page</a>
</br>
</body>
</html>