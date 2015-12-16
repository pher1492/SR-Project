<?php require_once("session.php"); ?>
<?php require_once("db_connection.php"); ?>


<?php include("header_v2.php");
if(($output = message()) !== null) {
  echo $output;
} ?>

<div class="row">
  <div class="large-12 columns">
    <div class="panel">
    <?php
$ID = $_GET["id"];
$emcID = $_GET["emcID"];
if (!$_SESSION['loggedin'])
{
	echo "<h3>You are not logged in</h3>";
}else{
if(isset($_SESSION['loggedin']) && $_SESSION['username'] == $ID && $_SESSION = $emcID){

	$query = "DELETE FROM Emergency_Contact_v2 ";
	$query .= "WHERE emcID ='".$emcID."'";
	
	$result = mysqli_query($db, $query);
			
			
	//Process query
	if ($result && mysqli_affected_rows($db) === 1) {
				
	  $_SESSION["message"] = "Contact was deleted";
	  header("Location: readContacts.php");
	  exit;
	  }
	  else {
		$_SESSION["message"] = "Contact could not be deleted!";
		header("Location: readContacts.php?id=".urldecode($_SESSION["username"]));
		exit;
	  }
	}
	else {
	  $_SESSION["message"] = "Contact could not be found!";
	  header("Location: readContacts.php?id=".urldecode($_SESSION["username"]));
	  exit;
	}
}
?>

   </div>
  </div>
</div>
