<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Northumbria Toy Co.</title>
	<link href="NTC_CSS.css" rel="stylesheet">
</head> 
<body>
	<header><h1>Northumbria Toy Company</h1></header>
	<nav>
		<ol>
			
			<li class="navlink"><a href="home.php">Home</a></li>
			<li class="navlink"><a href="view_toys.php">View Toys</a></li>
			<li class="navlink"><a href="admin.php">Admin</a></li>
			<li class="navlink"><a href="credits.html">Credits</a></li>
		</ol>
	</nav>
	<?php
	$image = null;
	include "database_conn.php"; /*This copies code from a dabatbase connection script into this file */
	$sql = "SELECT toyName, imgsrc   
	FROM NTL_toys 
	WHERE toyID > 113"; /*This queries the toys table of the database for names and image file names of toys with an ID greater than 113*/
	$queryResult = $dbConn->query($sql);
	if($queryResult === false) {
	echo "<p>Query failed: ".$dbConn->error."</p>\n</body>\n</html>"; /*This shows an error message if the query fails*/
	exit;
	}
	else{
		echo "<main  class='homemain'>
		<section>
		<h2>New Toys</h2>";
	while($rowObj = $queryResult->fetch_object()){ /*This loops through every record of the table of query results*/
	echo"<div class = 'product'><img src={$rowObj->imgsrc} alt='alternatetext' style='width: 220px; height: 220px;'><br>{$rowObj->toyName}</div>"; /*This ouputs images of toys, from the database, with their names below it*/	
	}
	echo "</section>";
	}
	$sql = "SELECT toyName, imgsrc
	FROM NTL_toys
	WHERE toyPrice < 1.95";
	$queryResult = $dbConn->query($sql);
	if($queryResult === false) {
	echo "<p>Query failed: ".$dbConn->error."</p>\n</body>\n</html>";
	exit;
	}
	else{
		echo "<section>
		<h2>Bargains - Toys Under £1.95</h2>";
	while($rowObj = $queryResult->fetch_object()){
	echo "<div class='product'><img src={$rowObj->imgsrc} alt='alternatetext' style='width: 220px; height: 220px;'><br>{$rowObj->toyName}</div>";	
	}
	}
	echo "</section>
	</main>";
	$sql = "SELECT catDesc
	from NTL_category";
	$queryResult = $dbConn->query($sql);
	if($queryResult === false) {
	echo "<p>Query failed: ".$dbConn->error."</p>\n</body>\n</html>";
	exit;
	}
	else{
		echo"<aside>
	<section>
	<h2>Categories We Sell</h2>
	<ul>";
	while($rowObj = $queryResult->fetch_object()){
	echo"<li>{$rowObj->catDesc}</li>";	
	}
	echo "</ul>
	</section>";
	}
?>
<section>
<h2>News</h2>
<p>We now offer free delivery for orders of at least £10.</p>
<p>We are offering a 20% Father's Days discount for orders placed between June 1 and June 19.</p>
<p>Coming Autumn 2022, we are expanding our selection of toys available to include virtual digital toys.</p>
<p>A New Northumbria Toy Company distribution centre is under construction in the West Midlands. This will open
in Spring 2023 and reduce the maximum delivery time of our toys to 3 days.</p>
<p>We are partnering with Hasbro to release an exclusive line of toys for Xmas 2022.</p>
</section>
</aside>
</body> 
</html>
