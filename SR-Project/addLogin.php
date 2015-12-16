<link rel="stylesheet" href="main.css" type="text/css">
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
	$usernameTip = "Please select a username with only letters and numbers";
	$emailTip = "Please enter valid email. You will be sent a single email after you register";
	$passwordTip = "Pick a password of your chosing";
	$comfirmTip = "Chose the same password from above";

      if(isset($_SESSION['loggedin']) && $_SESSION['username'] == true){
	echo "already registered";
}
else {
    if (isset($_POST["submit"])) {
	



	$params = array(mysqli_real_escape_string($_POST['username']), mysqli_real_escape_string($_POST['email']), mysqli_real_escape_string($_POST['password']));

	$username = mysqli_real_escape_string($db, $_POST['username']);
	$email = mysqli_real_escape_string($db, $_POST['email']);
	$password  = $_POST['password'];
	$confirmPass = mysqli_real_escape_string($db, $_POST['confirmPass']);

	$hash = hash("sha256", $password);
	
	
	
	if ((isset($_POST["username"]) && $_POST["username"] !== "") && (isset($_POST["email"]) && $_POST["email"] !== "") &&(isset($_POST["password"]) && $_POST["password"] !== "") 
	&& $password == $confirmPass && isset($_POST['agree']) && filter_var($email, FILTER_VALIDATE_EMAIL) && preg_match("/^[a-zA-Z0-9]*$/", $username)) {
	  
	  
	  $table = mysqli_query($db, "SELECT * FROM Health_Records_v2");
	  
	  $query = "INSERT INTO Logins_v2 (username, email, password) ";
	  $query .= "VALUES (";
//	  $query .= "?, ?, ?,)";
	  $query .= "'".$username."', ";
	  $query .= "'".$email."', ";
	  $query .= "'".$hash."'); "; 


	  $result = mysqli_query($db, $query);

	  if ($result) {
   	    $_SESSION['loggedin'] = true;
	    $_SESSION['username'] = stripslashes($_POST['username']);

	    $_SESSION["message"] = $_POST["username"]." was added";
	    header("Location: firstLogin.php");

		$insertHealth = "INSERT INTO Health_Records_v2 (username) VALUES ('".$username."');";
		//$insertEmc = "INSERT INTO Emergency_Contact_v2 (username) VALUES ('".$username."');";
		$addedHealth = mysqli_query($db, $insertHealth);
		//$addedEmc = mysqli_query($db, $insertEmc);
		
	    $addHealth = "ALTER TABLE Health_Records_v2 ADD FOREIGN KEY (username) REFERENCES Logins_v2 (username);";
	    //$addEmc = "ALTER TABLE Emergency_Contact_v2 ADD FOREIGN KEY (username) REFERENCES Logins_v2 (username);";
	    $done = mysqli_query($db, $addHealth);
	    //$doneEmc = mysqli_query($db, $addEmc);
				
				
		
		$subject = "Account Information";
		$message = "Thank you for using Health QR. \n \n	Username: ".$username."\n	Password: ".$password."\n	QR Code: http://turing.cs.olemiss.edu/~crmcmaho/test6/qr.php?id=".urlencode($username)."\n You can delete your account at any time.";
		$header = "From: healthqr@turing.cs.olemiss.edu";
		$testEmail = "phersrpro@mailinator.com";
		mail($email, $subject, $message, $header);
		

	    exit;
	}

	else {
	  $_SESSION["message"] = "Error description: " . mysqli_error($db);
	  header("Location: addLogin.php");
	}
	
	}else if ($password != $confirmPass){
	  $_SESSION['message'] = "Passwords do not match";
	  header("Location: addLogin.php");
	}
	else if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
	  $_SESSION['message'] = "Not a valid email";
	  header("Location: addLogin.php");
	}

	else if(!isset($_POST['agree'])){
	  $_SESSION['message'] = "Did not agree to terms";
	  header("Location: addLogin.php");
	}
	
	else if(!preg_match("/^[a-zA-Z0-9]*$/",$username)){
	  $_SESSION['message'] = "Not valid username";
	  header("Location: addLogin.php");
	}

	else {
	  $_SESSION["message"] = "unable to register. Please fill out all fields ";
	  header("Location: addLogin.php");
	}
	
	
	
      }
      else {
	  echo "<h0>Hover over to view requirements</h0>";
	echo "<p><form action='addLogin.php' method='post'></p>";
	echo "<ul data-tooltip class='has-tip' title='".$usernameTip."'>Username: <input type='text' name='username'/></ul>";
	echo "<ul data-tooltip class='has-tip' title='".$emailTip."'>Email: <input type='text' name='email'/></ul>";
	echo "<ul data-tooltip class='has-tip' title='".$passwordTip."'>Password: <input type='password' name='password'/></ul>";
	echo "<ul data-tooltip class='has-tip' title='".$comfirmTip."'>Confim password: <input type='password' name='confirmPass'/></ul>";
	
	echo "<input type='checkbox' name='agree' value='agree'> By checking this box, you are agreeing that all medical information that  is input will be accessible by the public. Not all fields required. Email and password are not public.<br>";
	
	echo "<br/><ul><input type='submit' name='submit' value='Register' /></ul>";
	echo "</form>";
	
	echo "<br/><h0>* is required</h0>";
      }
}
    ?>

     </div>
  </div>
</div>
