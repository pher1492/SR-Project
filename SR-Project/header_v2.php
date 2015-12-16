<html lang="en">
  <head>
    <title>Health QR</title>

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/foundation.css" />
    <script src="js/vendor/modernizr.js"></script>
	<script src="js/vendor/jquery-latest.js"></script>
    <script src="js/foundation/foundation.js"></script>
    <script src="js/foundation/foundation.topbar.js"></script>
    <script src="js/app.js"></script>
    <script src="js/foundation.min.js"></script>
  <!-- Other JS plugins can be included here -->

  </head>


<body>
<div class="contain-to-grid sticky">
  <nav class="top-bar" data-topbar role="navigation" data-options="sticky_on: small">


<?php

 if(isset($_SESSION['loggedin']) && $_SESSION['username'] == true){
    echo "<ul class='title-area'>";
      echo "<li class='name'>";
        echo "<h1><a href='index.php'>Menu</a></h1>";
      echo "</li>";
      echo "<li class='toggle-topbar menu-icon'><a href='logout.php'>Logout</a></li>";
    echo "</ul>";
    echo "<section class='top-bar-section'>";
      echo "<ul class='right'>";
	echo "<li><a href='logout.php'>Logout</a></li>";
      echo "</ul>";
    echo "</section";
	$_SESSION['status'] = true;


	
}


  else {

    echo "<ul class='title-area'>";
      echo "<li class='name'>";
        echo "<h1><a  href='index.php'>Menu</a></h1>";
      echo "</li>";
	  echo "<li class='toggle-topbar'><a href='login.php'><span>Login</span></a></li>";

	  echo "</ul>";
	
			echo "<section class='top-bar-section'>";
		  echo "<ul class='Right'>";

			    echo "<li><a href='login.php'>Login</a></li>";
		      echo "</ul>";

		echo "</section>";

    $_SESSION['status']=true;
  }
?>

    
  </nav>
  
</div>

</body>
</hmtl>
