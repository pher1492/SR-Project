<?php require_once("session.php"); ?>
<?php require_once("db_connection.php"); ?>


<?php include("header.php"); 
if (($output = message()) !== null) {
	echo $output;
}?>
<div id="main">
  <div id="page">
    <h3>Accounts</h3>
      <?php
	
	$query = "SELECT * FROM Logins_v2";
	$result = mysqli_query($db, $query);
	  
	echo "query: {$query} <br/><br/>";

	if ($result) {
	  while($row = mysqli_fetch_assoc($result)){
	    echo "username: ".$row["username"]."--- ".$row["accountID"]."<br/>";
	  }
	}
	else {
	  echo "0 results";
	}

	echo "<a href='login.php'>Login<a/><br/>";

	
mysqli_close($db);
?>