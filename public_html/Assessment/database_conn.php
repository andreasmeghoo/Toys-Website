<?php
   $dbConn = new mysqli('localhost', 'username', 'password', 'unn_w21017158'); //This creates a connection to a database called unn_w21017158 by specifying the username, password and host

   if ($dbConn->connect_error) {
      echo "<p>Connection failed: ".$dbConn->connect_error."</p>\n";  //This displays an error if the web server fails to connect to the database
      exit;
   }
?>

