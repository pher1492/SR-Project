<?php require_once("session.php"); ?>
<?php require_once("db_connection.php"); ?>

<?php include("header.php");
if(($output = message()) !== null){
	echo $output;
} ?>

<?php
	
	
	
	$_SESSION['loggedin'] = false;
	$_SESSION['username'] = "";
	$_SESSION['status'] = false;

	header("Location: index.php");

?>