<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Northumbria Toy Co. - Admin</title>
	<link href="NTC_CSS.css" rel="stylesheet">
</head> 

<body>
<header>
<h1>Northumbria Toy Company - Admin</h1>
</header>
<nav>
		<ol>
			<li class="navlink"><a href="home.php">Home</a></li>
			<li class="navlink"><a href="view_toys.php">View Toys</a></li>
			<li class="navlink"><a href="admin.php">Admin</a></li>
			<li class="navlink"><a href="credits.html">Credits</a></li>
		</ol>
	</nav>
	<main>
	<h2>Add New Toy To Database</h2>
<form method="get" action="process_form.php"> <!--This specifies what script to run to process the input from the form and appends the user input  variables to the URL to send the data-->
	<label for="toyName">Toy Name:</label><br> 
	<input accesskey='n' type="text" name="toyName" id="toyName"><br> <!--This creates a text input field and specifies a keyboard shortcut to select it-->
	<label for="description">Description:</label><br>
	<input accesskey='d' type="text" name="description" id="description"><br>
	<label for="toyPrice">Price:</label><br>
	<input accesskey='p' type="number" name="toyPrice" id="toyPrice"><br>
	<?php
  include 'database_conn.php';	  //This copies a database connection script into this file

  $sql = "SELECT catID, catDesc FROM NTL_category"; //This queries the category table of the database for category descriptions and IDs.
  $queryResult = $dbConn->query($sql);

  if($queryResult === false) {
	echo "<p>Query failed: ".$dbConn->error."</p>\n</body>\n</html>";  //This displays an error if the query fails
	exit;
  }
  
   else {
	echo "<label for='catDesc'>Category:</label><br>";
	echo "<select accesskey='c' name='catID' id='catDesc'>";  //This creates a select list where the user selects a category description and the form sends the catID to the processing script
	echo "<option value='none' selected hidden disabled>Choose an option</option>";
     while($rowObj = $queryResult->fetch_object()){	 
	echo "<option value='{$rowObj->catID}'>{$rowObj->catDesc}</option>";
     }
	 echo "</select><br>";
  }
  
  $sql = "SELECT manID, manName FROM NTL_manufacturer";
  $queryResult = $dbConn->query($sql);
  
   if($queryResult === false) {
	echo "<p>Query failed: ".$dbConn->error."</p>\n</body>\n</html>";
	exit;
  }
  
  else {
	echo "<label for='manName'>Manufacturer:</label><br>";
	echo "<select accesskey='m' name='manID' id='manName'>";
	echo "<option value='none' selected hidden disabled>Choose an option</option>";
     while($rowObj = $queryResult->fetch_object()){	 
	echo "<option value='{$rowObj->manID}'>{$rowObj->manName}</option>";
     }
	 echo "</select><br><br>";
  }
  
  $queryResult->close();
  $dbConn->close();
?>
	<input type="submit" value="Submit"> 
</form>
</main>
</body> 
</html>



