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

	



     if (isset($_POST['submit']))
     {
       if(!$_POST['username'] | !$_POST['password']){
	$_SESSION["message"] = "Enter all fields.";
	header("Location: login.php");
       }

	   $username = mysqli_real_escape_string($db, $_POST['username']);
	   $password = mysqli_real_escape_string($db, $_POST['password']);
       $query = "SELECT * FROM Logins_v2 WHERE username = '".$username."'";
       $result = mysqli_query($db, $query);

	   $hash = hash("sha256", $password);
       $checkUser = mysql_fetch_assoc($result);

       if (mysqli_num_rows($result) == 0)
       {
	$_SESSION["message"] = "User does not exist. Please register";
	header("Location: login.php");
       }

       while($row = mysqli_fetch_assoc($result))
       {
	$_POST['password'] = stripcslashes($_POST['password']);
	$row['password'] = stripcslashes($row['password']);

	if ($hash != $row['password'])
	{
         $_SESSION["message"] = "Password is incorrect.";
	 header("Location: login.php");
	}

      else 
      {
	$_POST['username'] = $username;
	$_SESSION['loggedin'] = true;
	$_SESSION['username'] = $username;

	
	$queryPass = "SELECT * FROM Health_Records_v2 WHERE username='".$_SESSION['username']."';";
	$resultPass = mysqli_query($db, $queryPass);

	$row = mysqli_fetch_assoc($resultPass);
	if($row['lastName'] == NULL){
	  header("Location: firstLogin.php");
	}


	else
	  header("Location: index.php");
      }
    }
  }
  else
  {
  
  echo "<p><form action='login.php' method='post'></p>";
  echo "<p>Username: <input type='text' name='username'/></p>";
  echo "<p>Password: <input type='password' name='password'/></p>";
  echo "<p><input type='submit' name='submit' value='Login' /></p>";
  echo "</form>";

  echo "<br/><br/><a href=addLogin.php>Register<a/>";
  }
 ?>

    </div>
  </div>
</div>

	
