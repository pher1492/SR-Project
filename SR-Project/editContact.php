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
	$emcID = $_GET["emcID"];
	$phoneTip = "Please enter a 10 digit phone number. \nOnly numbers
	if (!$_SESSION['loggedin'])
	{
	  echo "<h3>You are not logged in</h3>";
	}

else {
if(isset($_SESSION['loggedin']) && $_SESSION['username'] == $ID){
	echo "<br/>";
	echo "<h3>Edit Contacts<h3/>";
	
	if (isset($_POST['submit'])){
		
		$emcLast = mysqli_real_escape_string($db, $_POST["emcLast"]);
		$emcFirst = mysqli_real_escape_string($db, $_POST["emcFirst"]);
		$emcPhone = mysqli_real_escape_string($db, $_POST["emcPhone"]);
		$emcRelation = mysqli_real_escape_string($db, $_POST["emcRelation"]);
		
		$info = "UPDATE Emergency_Contact_v2 SET ";
		$info .= "emcLast = '".$emcLast."',  ";
		$info .= "emcFirst = '".$emcFirst."',  ";
		$info .= "emcPhone = '".$emcPhone."', ";
		$info .= "emcRelation = '".$emcRelation."'  ";
		$info .= "WHERE emcID = '".$emcID."' AND username='".$ID."'";
		
		
		$result = mysqli_query($db, $info);
		
		if($result){
			$_SESSION['message'] ="". $_POST['emcFirst']." ".$_POST['emcLast']." was updated";
			header("Location: readContacts.php?id=$ID");	
		}else {
			$_SESSION['message'] = "{$info}";
			header("Location: editContact.php?id=$ID&emcID=$emcID");
		}
	}
	else {
		if (isset($_SESSION['username']) && $_GET["id"] !== ""){
		$ID = $_GET['id'];
		$emcID = $_GET['emcID'];
		$contact = "SELECT * FROM Logins_v2 WHERE username = '".$ID."'";
		$checkContact = mysqli_query($db, $contact);
		
		$info = "SELECT * FROM Emergency_Contact_v2 WHERE username='".$ID."' AND emcID='".$emcID."'";
		$infoResult = mysqli_query($db, $info);
		
		if($checkContact && mysqli_num_rows($checkContact) > 0){
			$row = mysqli_fetch_assoc($infoResult);
			echo "<p><form action ='editContact.php?id={$ID}&emcID={$emcID}' method='post'></p>";
			echo "<p>*Emergency Contact Last Name: <input type='text' name='emcLast' value=".$row['emcLast']."></p>";
			echo "<p>*Emergency Contact First Name: <input type='text' name='emcFirst'value=".$row['emcFirst']."></p>";
			echo "<pdata-tooltip class='has-tip' title='".$phoneTip."'>Emergency Contact Phone Number: <input type='text' name='emcPhone' value=".$row['emcPhone']."></p>";
			echo "<p>Emergency Contact Relationship: <input type='text' name='emcRelation' value=".$row['emcRelation']."></p>";
			echo "<p><input type='submit' name='submit' value='Save Changes' ><p/>";

			echo "<form/>";
			
			echo "<h0>* is required</h0>"; 

		}
	}	
}
}
}	

?>
    </div>
  </div>
</div>
</body>
