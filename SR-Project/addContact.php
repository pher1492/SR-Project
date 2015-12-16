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
$phoneTip = "Please enter a 10 digit phone number. \nOnly numbers";
if (!$_SESSION['loggedin'])
{
	echo "<h3>You are not logged in</h3>";
}else{
if(isset($_SESSION['loggedin']) && $_SESSION['username'] == $ID){
	echo "<br/>";
	echo "<h3>Add Contact<h3/>";
	
	if (isset($_POST['submit'])){
		
		$emcLast = mysqli_real_escape_string($db, $_POST["emcLast"]);
		$emcFirst = mysqli_real_escape_string($db, $_POST["emcFirst"]);
		$emcPhone = mysqli_real_escape_string($db, $_POST["emcPhone"]);
		$emcRelation = mysqli_real_escape_string($db, $_POST["emcRelation"]);
		
/*		$info = "UPDATE Emergency_Contact_v2 SET ";
		$info .= "emcLast = '".$emcLast."',  ";
		$info .= "emcFirst = '".$emcFirst."',  ";
		$info .= "emcPhone = '".$emcPhone."', ";
		$info .= "emcRelation = '".$emcRelation."'  ";
		$info .= "WHERE username = '".$ID."'";
*/
		$info = "INSERT INTO Emergency_Contact_v2 (username, emcLast, emcFirst, emcPhone, emcRelation) ";
		$info .= "VALUES ('".$ID."', '".$emcLast."', '".$emcFirst."', '".$emcPhone."', '".$emcRelation."' );";
		
		$result = mysqli_query($db, $info);
		
		if($result){
			$_SESSION['message'] ="". $_POST['emcFirst']." ".$_POST['emcLast']." is now an emergency contact";
			header("Location: userAcc.php?id=$ID");	
		}else {
			$_SESSION['message'] = "{$info}";
			header("Location: addContact.php?id=$ID");
		}
	}
	else {
		if (isset($_GET["id"]) && $_GET["id"] !== ""){
		$contact = "SELECT * FROM Logins_v2 WHERE username = '".$ID."'";
		$checkContact = mysqli_query($db, $contact);
		
		$info = "SELECT * FROM Emergency_Contact_v2 WHERE username ='".$ID."'";
		$infoResult = mysqli_query($db, $info);
		
		if($checkContact && mysqli_num_rows($checkContact) >= 0){
			$row = mysqli_fetch_assoc($infoResult);
			echo "<p><form action ='addContact.php?id={$ID}' method='post'><p/>";
			echo "<p>*Emergency Contact Last Name: <input type='text' name='emcLast' /><p/>";
			echo "<p>*Emergency Contact First Name: <input type='text' name='emcFirst' /><p/>";
			echo "<p data-tooltip class='has-tip' title='".$phoneTip."'>Emergency Contact Phone Number: <input type='text' name='emcPhone' /><p/>";
			echo "<p>Emergency Contact Relationship: <input type='text' name='emcRelation' /><p/>";
			echo "<p><input type='submit' name='submit' value='Save Changes' ><p/>";

			echo "<form/>";
			
			echo "<h0>* is required</h0>";

		}
		else {
			echo "no";
		}
	}
		}
	
	

}else {
		echo "Not Logged in";
	}
}
?>

   </div>
  </div>
</div>
