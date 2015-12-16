<html lang="en">
  <head>
    <title>Health QR</title>
  </head>

</hmtl>

<?php
 if(isset($_SESSION['loggedin']) && $_SESSION['username'] == true){
	echo "<br/>";
	echo "<br/>";
	echo "Logged in as ".$_SESSION['username'].".<br/><br/>";
	echo "<a href='index.php'>Menu<a/><br/>";
	echo "<a href='logout.php'>Logout<a/><br/>";
	$_SESSION['status'] = true;
	
	
}

  else if ($_SESSION['status'] == false){
    echo "<br/>";
    echo "<br/>";
    echo "Logged out of ".$_SESSION['username'].".<br/><br/>";
    echo "<a href='index.php'>Menu<a/><br/>";
    echo "<a href='login.php'>Login<a/><br/>";
    $_SESSION['status'] = true;
    $_SESSION['username'] = "";
  }

  else {
    echo "<br/>";
    echo "<br/>";
    echo "<br/>";
    echo "<br/>";
    echo "<a href='index.php'>Menu<a/><br/>";
    echo "<a href='login.php'>Login<a/><br/>";
    $_SESSION['status'] = true;
  }
?>
