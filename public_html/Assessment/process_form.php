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
<?php

include 'database_conn.php'; /*This copies a database connection script into this file*/

$toyName = $dbConn->real_escape_string(isset($_REQUEST["toyName"])?$_REQUEST["toyName"]:null);     /*|This grabs a user inputted value from the corresponding input field in the HTML form, checks its not empty and escapes special characters*/
$description = $dbConn->real_escape_string(isset($_REQUEST["description"])?$_REQUEST["description"]:null);
$toyPrice = $dbConn->real_escape_string(isset($_REQUEST["toyPrice"])?$_REQUEST["toyPrice"]:null);
$catID = $dbConn->real_escape_string(isset($_REQUEST["catID"])?$_REQUEST["catID"]:null);
$manID = $dbConn->real_escape_string(isset($_REQUEST["manID"])?$_REQUEST["manID"]:null);
$toyID = $dbConn->real_escape_string(null);
$catDesc = null;
$manName = null;



$sql = "SELECT MAX(toyID)+1 as toyID 
FROM NTL_toys"; /*This generates new toy ID numbers to input new toys in the database*/

$queryResult = $dbConn->query($sql);
if($queryResult === false) {
	echo "<p>Query failed: ".$dbConn->error."</p>\n</body>\n</html>"; /*This displays an error if the query fails*/
	exit;
  }
  else {
     while($rowObj = $queryResult->fetch_object()){
		$toyID = $dbConn->real_escape_string(isset($rowObj->toyID)?$rowObj->toyID:null);
	 }
  }



$sql = "SELECT catDesc 
FROM NTL_category
WHERE NTL_category.catID = '$catID' "; /*This queries the database for the category description which matches the catID inputted from the form*/

$queryResult = $dbConn->query($sql);
if($queryResult === false) {
	echo "<p>Query failed: ".$dbConn->error."</p>\n</body>\n</html>";
	exit;
  }
  else {
     while($rowObj = $queryResult->fetch_object()){
		$catDesc = $dbConn->real_escape_string(isset($rowObj->catDesc)?$rowObj->catDesc:null); /*This sets the value of a category description variable*/
	 }
  }
  
  $sql = "SELECT manName 
FROM NTL_manufacturer
WHERE NTL_manufacturer.manID = '$manID' "; /*This queries the database for the manufacter name which matches the manID inputted from the form*/

$queryResult = $dbConn->query($sql);
if($queryResult === false) {
	echo "<p>Query failed: ".$dbConn->error."</p>\n</body>\n</html>";
	exit;
  }
  else {
     while($rowObj = $queryResult->fetch_object()){
		$manName = $dbConn->real_escape_string(isset($rowObj->manName)?$rowObj->manName:null); /*This sets the value of a manufactuer name variable*/
	 }
  }

echo "<table>
		<tr>
			<th>Toy Name</th>
			<th>Description</th>
			<th>Price</th>
			<th>Category</th>
			<th>Manufacturer</th>
		</tr>
		<tr>
			<td>$toyName</td>
			<td>$description</td>
			<td>$toyPrice</td>
			<td>$catDesc</td>
			<td>$manName</td>
		</tr>
	</table><br>"; /*This displays a table of what information was inputted into the form, and was therefore inserted into the database*/
 

$sql = "INSERT INTO NTL_toys(toyID,toyName,description,toyPrice,catID,manID)  
VALUES('$toyID','$toyName','$description','$toyPrice','$catID','$manID')"; /*This inputs into the toys table of the database, the user input of all fields of the form*/

$queryResult = $dbConn->query($sql);
if($queryResult === false) {
	echo "<p>Query failed: ".$dbConn->error."</p>\n</body>\n</html>";
	exit;
  }
  else{
	  echo "New record added to toys database with the above details."; /*This shows error messages if the user leaves input fields empty in the form*/
	  if (empty($toyName)) {
          echo "<p>You have not entered a Toy Name. Enter a toy name.</p>\n";
     }
	 if (empty($description)) {
          echo "<p>You have not entered a Description. Enter a description.</p>\n";
     }
	  if (empty($toyPrice)) {
          echo "<p>You have not entered a price. Enter a price.</p>\n";
     }
	  if (empty($toyName)) {
          echo "<p>You have not selected a Category. Select a category.</p>\n";
     }
	  if (empty($toyName)) {
          echo "<p>You have not selected a Manufacturer. Select a manufacturer.</p>\n";
     }

  }

  $dbConn->close();
?>
</body>
</html>