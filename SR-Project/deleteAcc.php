<?php require_once("session.php"); ?>
<?php require_once("db_connection.php"); ?>


<?php include("header.php");
if(($output = message()) !== null) {
  echo $output;
} ?>

<div id="main">
  <div id="page">
    <?php
$ID = $_GET["id"];

if(isset($_SESSION['loggedin']) && $_SESSION['username'] == $ID){
	echo "<br/>";
	
	$queryEmail = "SELECT email FROM Logins_v2 WHERE username = '".$ID."'";
	$resultEmail = mysqli_query($db, $queryEmail);
	
	
	$queryHealth = "DELETE FROM Health_Records_v2 WHERE username = '".$ID."'";
	$queryEmc = "DELETE FROM Emergency_Contact_v2 WHERE username = '".$ID."'"; 
	$queryLogin = "DELETE FROM Logins_v2 WHERE username = '".$ID."'";

	$resultEmc = mysqli_query($db, $queryEmc);
	$resultHealth = mysqli_query($db, $queryHealth);
	$resultLogin = mysqli_query($db, $queryLogin);

	if($resultHealth){
		$_SESSION['message'] = "Health Records Deleted";
	} else if ($resultEmc){
		$_SESSION['message'] = "Emergency Contacts Deleted";
	} else if ($resultLogin){
		$_SESSION['message'] = "Login Deleted";
	} if ($resultHealth && $resultEmc && $resultLogin){
		$_SESSION['message'] = "User Deleted";
		$_SESSION['loggedin'] = false;
		$_SESSION['username'] = '';
		header("Location: index.php");
	} else {
		$_SESSION['message'] = "look again";
		echo $queryHealth;
		echo "</br>";
		echo $queryEmc;
		echo "</br>";
		echo $queryLogin;
		//header("Location: deleteAcc.php");
	}
}
//	$_SESSION['loggedin'] = false;
//	$_SESSION['username'] = '';
//	header("Location: index.php")

     ?>
  <div/>
<div/>
