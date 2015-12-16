<?php require_once("session.php"); ?>
<?php require_once("db_connection.php"); ?>
<?php include("device.php"); ?>
<?php include("header_v2.php");
if(($output = message()) !== null){
	echo $output;
} ?>
<div class="row">
  <div class="large-3 columns">
    <div class="panel">
      <h3>menu</h3>

<?php
  if(!$_SESSION['loggedin']){
    echo "<a href='addLogin.php'>Register</a></br/>";
  }

  echo "<a href='userAcc.php?id=".urlencode($_SESSION["username"])."'>User Account<a/><br/>";
  echo "<a href='editAccount.php?id=".urlencode($_SESSION["username"])."'>Edit Account</a><br/>";
  echo "<a href='addContact.php?id=".urldecode($_SESSION["username"])."'>Add Emergency Contact</a><br/>";
  
  if($_SESSION['loggedin']){
      echo "<a href='readContacts.php?id=".urldecode($_SESSION["username"])."'>View/Edit Contacts</a><br/>";
	echo "<a href='qr.php?id=".urlencode($_SESSION["username"])."'>QR code</a><br/>";
    echo "<a href='deleteAcc.php?id=".urlencode($_SESSION["username"])."'>Delete Account</a></br>";
  }
	
?>
    </div>
  </div>
  <div class="large-9 columns">
    <div class="panel">
	This QR code is meant for emergencies. You will enter medical information and emergency contacts. If anyone scans it, it will take them to your personal page. 
	</div>
  </div>
</div>

</div>


  
