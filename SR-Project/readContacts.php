<?php require_once("session.php"); ?>
<?php require_once("db_connection.php"); ?>
<?php include('../qrlib.php');  ?>

<?php include("header_v2.php");
if(($output = message()) !== null) {
  echo $output;
} ?>
<body>
<div class="row">
  <div class="large-12 columns">
    <div class="panel">
<?php
	$ID = $_GET["id"];
	if (!$_SESSION['loggedin'])
{
	echo "<h3>You are not logged in</h3>";
}

else {
if(isset($_SESSION['loggedin']) && $_SESSION['username'] == $ID){
	echo "<br/>";
	echo "<h3>View Contacts<h3/>";
	
	$query = "SELECT emcFirst, emcLast, emcID ";
	$query .= "FROM Emergency_Contact_v2 ";
	$query .= "WHERE username ='".$ID."' ";
	$query .= "ORDER BY emcLast ASC";
	
	$result = mysqli_query($db, $query);
	
	if($result) {
	  echo "<table>";
	  while ($row = mysqli_fetch_assoc($result)) {
	    $emcFirst = $row["emcFirst"];
		$emcLast = $row["emcLast"];
		$emcID = $row["emcID"];
		
		
		echo "<tr>";
		echo "<td><strong><h1>".$emcLast.", ".$emcFirst."</h1></strong></td>";
		echo "<td>&nbsp;<a href='editContact.php?id=".urlencode($ID)."&emcID=".urlencode($emcID)."'>Edit Contact</a>&nbsp;</td>";
		echo "&nbsp;<td><a href='deleteContact.php?id=".urlencode($ID)."&emcID=".urlencode($emcID)."'>Delete Contact</a></td>";
		echo "</tr>";
	  }
	echo "</table>";
	} else {
	  echo "<h2>You have no contacts</h2>";
	}  
}
	echo "</br></br><a href='addContact.php?id=".urldecode($_SESSION["username"])."'>Add Emergency Contact</a><br/>";
	echo "<a href='userAcc.php?id=".urlencode($_SESSION["username"])."'>User Account<a/><br/>";
}	
?>
    </div>
  </div>
</div>