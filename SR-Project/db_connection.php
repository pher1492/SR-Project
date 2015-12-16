<?php
	include('/home/crmcmaho/DBInfo.php');
	// 1. Create a database connection
	//mysqli connect expects host, username, password, database name
  	$db = mysqli_connect(DBHost, Username, Password, DBName);
	
	// Test if connection succeeded
	if(mysqli_connect_errno()) {
			die("Could not connect to server!<br />");
	}
	else {
			echo "Successful connection";
	}
?>
