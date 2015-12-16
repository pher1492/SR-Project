<?php require_once("session.php"); ?>
<?php require_once("db_connection.php"); ?>

<?php 
if(isset($_COOKIE['ID_your_site'])){ //if there is, it logs you in and directes you to the members page
 	$username = $_COOKIE['ID_your_site']; 
 	$pass = $_COOKIE['Key_your_site'];
 	$check = mysql_query("SELECT * FROM users WHERE username = '$username'");
 	while($info = mysql_fetch_array( $check )){
 		if ($pass != $info['password']){}
 		else{
 			header("Location: login.php");
		}
 	}
 }

?>