<?php require_once("session.php"); ?>
<?php require_once("db_connection.php"); ?>
<?php include('../qrlib.php');  ?>

<?php include("header_v2.php");
if(($output = message()) !== null) {
  echo $output;
} ?>
<body>
<div class="row">
  <div class="large-12 columns">
    <div class="panel">
<?php



if (isset($_GET["id"]) && $_GET["id"] !== ""){
	$ID = $_GET['id'];
	function printQRCode($url, $size = 450) {
		return '<img src="http://chart.apis.google.com/chart?chs=' . $size . 'x' . $size . '&cht=qr&chl=' . urlencode($url) . '" />';
	}
}

?> 
 
<html>
<head>
<title>QR Code Test</title>
<body>
<?php 
echo printQRCode("http://turing.cs.olemiss.edu/~crmcmaho/test6/userAcc.php?id=".$ID); 
?>
</div>
</div>
</div>
</body>
</html>
