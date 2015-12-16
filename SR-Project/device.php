<?php 
    $agent = $_SERVER['HTTP_USER_AGENT'];
    
    if (ereg("(iPhone|BlackBerry|PalmSource)", $agent) != false) {
echo <<<END
    <meta name="viewport" content="width = device-width">
    <link rel="stylesheet" href="/main.css">
END;
    }        
    else {
       echo "<!-- not mobile -->";
    }
?>  