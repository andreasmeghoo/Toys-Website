<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Northumbria Toy Co. - View Toys</title>
	<link href="NTC_CSS.css" rel="stylesheet">
</head>

<body>
	<header>
		<h1>Northumrbia Toy Company - View Toys</h1>
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
  include 'database_conn.php';	//This copies a database connection script into this file

  $sql = "SELECT toyName, description, toyPrice, catDesc, manName 
  FROM NTL_toys
  INNER JOIN NTL_category
  ON NTL_toys.catID = NTL_category.catID
  INNER JOIN NTL_manufacturer
  ON NTL_toys.manID = NTL_manufacturer.manID
  ORDER BY toyName" ; //This queries the database for all fields except manID and toyID and orders the results by toyID
  $queryResult = $dbConn->query($sql);


  if($queryResult === false) {
	echo "<p>Query failed: ".$dbConn->error."</p>\n</body>\n</html>"; //This displays an error message if the query fails
	exit;
  }

   else {
	   echo "<div class='table-responsive'>
	   <table class='table'>
		<tr>
			<th width='14%'>Toy Name</th>
			<th width='44%'>Description</th>
			<th width='14%'>Price</th>
			<th width='14%'>Category</th>
			<th width='14%'>Manufacturer</th>
		</tr>";
		
		while($rowObj = $queryResult->fetch_object()){
			
			echo"<tr><td>{$rowObj->toyName}</td>  
			<td>{$rowObj->description}</td>
			<td>{$rowObj->toyPrice}</td>
			<td>{$rowObj->catDesc}</td>
			<td>{$rowObj->manName}</td></tr>";	//This displays the query results (all toys and their details) in a table.
		}
		
		
		echo "</table></div>"; 
				
  $dbConn->close();
   }

?>
</body>
</html>