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
	$notesTip = "Enter any notes you would like to have public. \nOptional";
	$medTip = "Enter medical history. \nOptional";
	$surgTip = "Enter surgical History. \nOptional";
	$algTip = "Enter any allergies. \nOptional";
	if (!$_SESSION['loggedin'])
{
	echo "<h3>You are not logged in</h3>";
}
	

else {
if(isset($_SESSION['loggedin']) && $_SESSION['username'] == $ID){
	echo "<br/>";
	echo "<h3>Edit Your Account<h3/>";
	
	if(isset($_POST['submit'])){
		
		$allergies = mysqli_real_escape_string($db, $_POST["allergies"]);
		$notes = mysqli_real_escape_string($db, $_POST["notes"]);
		$surgicalHistory = mysqli_real_escape_string($db, $_POST["surgicalHistory"]);
		$medHistory = mysqli_real_escape_string($db, $_POST["medHistory"]);
		
		$info = "UPDATE Health_Records_v2 ";
		$info .= "SET allergies = '".$allergies."',  ";
		$info .= "notes = '".$notes."',  ";
		$info .= "surgicalHistory = '".$surgicalHistory."', ";
		$info .= "medHistory = '".$medHistory."' ";
		$info .= "WHERE username = '".$ID."'";


		$result = mysqli_query($db, $info);
		
		if($result){
			$_SESSION['message'] = $_POST["firstName"]." has been changed";
			header("Location: userAcc.php?id=$ID");
		}
		else {
			$_SESSION['message'] = "{$info}";
			header("Location: editAccount.php?id=$ID");
		}
	}
	else {
	echo "<h0>Hover over for requirements</h0>";
	if (isset($_GET["id"]) && $_GET["id"] !== ""){

		$ID = $_GET['id'];
		$user = "SELECT * FROM Logins_v2 WHERE username ='".$ID."'";
		$checkUser = mysqli_query($db, $user);

		$info = "SELECT * FROM Health_Records_v2 WHERE username ='".$ID."'";
		$infoResult = mysqli_query($db, $info);
		

		if($checkUser && mysqli_num_rows($checkUser) > 0){
			$row = mysqli_fetch_assoc($infoResult);
			echo "<p><form action='editAccount.php?id={$ID}' method='post'><p/>";
			echo "<p data-tooltip class='has-tip' title='".$algTip."'>Allergies: <input type='text' name='allergies' value=".$row['allergies']."><p/>";
			echo "<p><form action='editAccount.php?id={$ID}' method='post'><p/>";
			echo "<p data-tooltip class='has-tip' title='".$medTip."'>Medical History: <textarea rows='5' cols='20' name='medHistory'>".$row['medHistory']."</textarea></p>";  
			echo "<p data-tooltip class='has-tip' title='".$surgTip."'>Surgical History: <textarea rows='5' cols='20' name='surgicalHistory'>".$row['surgicalHistory']."</textarea></p>";
			echo "<p data-tooltip class='has-tip' title='".$notesTip."'>Notes: <textarea rows='5' cols='20' name='notes'>" . $row['notes'] . "</textarea></p>";
			echo "<p><input type='submit' name='submit' value='Save Changes' /><p/>";

			echo "<form/>";
			

		}
		else {
			echo "no";
		}
	}
	}}
else{
	echo "Not logged in.";
}	}



?>

<!--<p><textarea name='hope' rows='5' cols='40'><?php echo $row['notes'] ?></textarea></p>-->
   </div>
<div/>
<div/>
