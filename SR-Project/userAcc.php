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
	


	if (isset($_GET["id"]) && $_GET["id"] !== ""){
		//GET id 
	
		$ID = $_GET['id'];
		
		$user = "SELECT * FROM Logins_v2 WHERE username ='".$ID."'";
		
		$checkUser = mysqli_query($db, $user);

		$infoHR = "SELECT * FROM Health_Records_v2 WHERE username ='".$ID."'; ";
		$hrResult = mysqli_query($db, $infoHR);
		
		$infoEmc = "SELECT * FROM Emergency_Contact_v2 WHERE username ='".$ID."';";
		$emcResult = mysqli_query($db, $infoEmc);

		/* echo querys
		echo "{$ID}<br/>";
		echo "{$info}<br/>";
		echo "{$user}<br/>";
		*/
		
		//echo "{$infoHR}<br/>";
		//echo "{$infoEmc}<br/>";

		//Will need to make this a table
		echo "<br/>";
		echo "<table>";
		if($checkUser && mysqli_num_rows($checkUser) > 0){
				
			$row = mysqli_fetch_assoc($hrResult);
			$rowEmc = mysqli_fetch_assoc($emcResult);
			
			echo "<tr><td><h1>".$row['firstName']." ".$row['lastName']."</h1></td></tr>";
			if ($row['allergies'] !=''){
				echo "<tr><td>Allergies: ".$row['allergies']."</tr></td>";
			}else{
				echo"<tr><td>Allergies: None Listed</td><tr/>";
			}
			if ($row['gender'] != ''){
				echo "<tr><td>Gender: ".$row['gender']."</td><tr/>";
			}

			if ($row['medHistory'] == ''){
				echo "<tr><td>Medical History: None Listed<td/><tr/>";
			}else{
				echo "<tr><td>Medical History: ".$row['medHistory']."<td/><tr/>";
			}
			
			if ($row['surgicalHistory'] == ''){
				echo "<tr><td>Surgical History: None Listed</td><tr/>";
			}else{
				echo "<tr><td>Surgical History: ".$row['surgicalHistory']."</td><tr/>";
			}
			
			if ($row['notes'] != ''){
				echo "<tr><td>Notes: ".$row['notes']."<td/><tr/>";
			}else {
				echo "<tr><td>Notes: None Listed<td/><tr/>";
			}
			echo "</table>";
			
			//echo $rowEmc['emcFirst']." ".$rowEmc['emcLast'];
	$query = "SELECT * ";
	$query .= "FROM Emergency_Contact_v2 ";
	$query .= "WHERE username ='".$ID."' ";
	$query .= "ORDER BY emcLast ASC";
	
	$result = mysqli_query($db, $query);
	
	if($result) {
	  echo "<h3>Emergency Contacts</h3>";
	  echo "<table>";
	  while ($rowEmc = mysqli_fetch_assoc($result)) {
	    
	    $emcFirst = $rowEmc["emcFirst"];
		$emcLast = $rowEmc["emcLast"];
		$emcPhone = $rowEmc["emcPhone"];
		$emcRelation = $rowEmc["emcRelation"];
		$emcID = $rowEmc["emcID"];
		echo "<tr>";
		echo "<td><h2>".$emcFirst." ".$emcLast."</h2></td>";
		if ($rowEmc['emcPhone'] !=''){
				echo "<tr><td>Phone Number: <a href='tel:".$rowEmc["emcPhone"]."'>".$rowEmc["emcPhone"]."</a></tr/></td>";
			}else{
				echo"<tr><td>Phone Number: None Listed</td></tr>";
			}
			if ($rowEmc['emcRelation'] != ''){
				echo "<tr><td>Relationship: ".$emcRelation."</td></tr>";
			}else {
				echo "<tr><td>Relationship: None Listed</td><tr/>";
			}
		echo "</tr>";
		echo "<tr></tr>";
	  }
	echo "</table>";
	} else {
	  echo "<h2>No Emergency Contacts Listed</h2>";
	}
	}
		
			
			
			
		}
		else{
			echo "no";
		}
		echo "</table>";
		echo "</br>";
		echo "<h2><a href='qr.php?id=".$ID."'>QR code</a></h2><br/>";
	
	
    
	?>
     </div>
  </div>
</div>
