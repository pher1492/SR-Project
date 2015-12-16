<?php require_once("session.php"); ?>
<?php require_once("db_connection.php"); ?>

<?php include("header_v2.php");
if(($output = message()) !== null) {
  echo $output;
} ?>

<div class="row">
  <div class="large-12 columns">
    <div class="panel">
    <h3>Register</h3>
    <?php
	
	if (!$_SESSION['loggedin'])
{
	echo "<h3>You are not logged in</h3>";
}
if(isset($_SESSION['loggedin']) && $_SESSION['username'] == true){

      if (isset($_POST["submit"])) {
	
	if ((isset($_POST["lastName"]) && $_POST["lastName"] !== "") && (isset($_POST["firstName"]) && $_POST["firstName"] !== "")) {

	
	$lastName = mysqli_real_escape_string($db, $_POST["lastName"]);
	$firstName = mysqli_real_escape_string($db, $_POST["firstName"]);
	$gender = mysqli_real_escape_string($db, $_POST["gender"]);
	//$allergies = mysqli_real_escape_string($db, $_POST["allergies"]);
	$age = mysqli_real_escape_string($db, $_POST["age"]);
	
	
	  $query = "UPDATE Health_Records_v2 ";
	  $query .= "SET lastName = '".$lastName."', ";
	  $query .= "firstName = '".$firstName."', ";
	  $query .= "gender = '".$gender."', ";
	  $query .= "age = '".$age."' ";
	 // $query .= "allergies = '".$allergies."' ";
	  $query .= "WHERE username = '".$_SESSION["username"]."';";
	  
	  

	  $result = mysqli_query($db, $query);

	  if ($result) {

	    $_SESSION["message"] = $username." was added";
	    header("Location: editAccount.php?id={$_SESSION['username']}");

	    exit;
	}
	else {
	  $_SESSION["message"] = "Error description: " . mysqli_error($db);
	  header("Location: firstLogin.php");
	}}
	else {
	  $_SESSION["message"] = "unable to register. Please fill out all fields ";
	  header("Location: firstLogin.php");
	  
	}
      }
      else {
	echo "<p><form action='firstLogin.php' method='post'></p>";
	echo "<p>*Last Name: <input type='text' name='lastName'/></p>";
	echo "<p>*First Name: <input type='text' name='firstName'/></p>";
	echo "<p>Age: <input type='number' name='age' min='0' max='125'/></p>";
	echo "<p>Gender: <select name='gender'><option value='unspecified'>Unspecified</option> <option value='male'>Male</option><option value= 'female'>Female</option><option value= 'other'>Other</option></select>";
	//echo "<p>Allergies: <input type='text' name='allergies'/></p>";
	
	echo "<p><input type='submit' name='submit' value='Register' /></p>";
	echo "</form>";
	
	echo "<br/><h0>* is required</h0>";
      }
}
    ?>
	
     </div>
  </div>
</div>
