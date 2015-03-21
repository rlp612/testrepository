<html>
<head>
<title>Delete Student</title>

</head>
<body>
<?php
	require_once 'config.php';
	$search=$_GET['search'];
	
	$sql = "DELETE FROM roster WHERE rosterID='$search' ";
	
	mysql_select_db($database);
	$retval = mysql_query( $sql );

	if(! $retval ){
		die('Could not delete data: ' . mysql_error());
	}
	
	echo "The student has been removed from this class\n";
	mysql_close();
?>
	
<br>
<form action="class_table.php">
    <input type="submit" value="Back">
</form>
</body>
</html>