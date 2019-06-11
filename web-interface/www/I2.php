<!DOCTYPE html>
<html>
	<head>
		<title> Add Movie </title>
	</head>
	
	<body>
	<h1 align = middle> Add Movie </h1>
	
	<table border = 1 bgcolor = #00FF00> 
		<th> <a href="I1.php"> Add Actor and Director </a> </th>  
		<th> <a href="I2.php"> Add Movie Information </a> </th>  
		<th> <a href="I3.php"> Add Review to Movie </a> </th>
		<th> <a href="I4.php"> Add Actor to Movie Relation </a> </th>		
		<th> <a href="I5.php"> Add Director to Movie Relation </a> </th>
		<th> <a href="S1.php"> Search For Actor and Movies </a> </th>
	</table>
	<br> -------------------------------------------- <br>
	
	<form action = "<?php $_PHP_self ?>" method = "GET">
		Title: <br> 
		<input type = "text" name = "title" SIZE = 50 MAXLENGTH = 100> <br>
		Release Year: <br>
		<input type = "number" name = "year" SIZE = 10 MAXLENGTH = 4> <br>
		MPAA Rating: <br> 
		<input type = "text" name = "rating" SIZE = 20 MAXLENGTH = 10> <br>
		Production Company: <br> 
		<input type = "text" name = "company" SIZE = 50 HEIGHT = "40" MAXLENGTH = 50> <br>
		Genre: <br> 
		<input type = "text" name = "genre" SIZE = 20 MAXLENGTH = 20> <br>
		<input type="submit" name = "submit" value= "Submit" />
	</form>
	
	<?php
	// Initialize All Varibales
	//echo "start <br>";
	$servername = "localhost";
	$username = "cs143";
	$password = "";
	$database = "CS143";

	// Start connection
	$db_connection = mysql_connect($servername,$username,$password);

	if (!$db_connection) {
		$errmsg = mysql_error($db_connection);
		print "Connection failed: $errmsg \n";
		exit(1);
	}
	mysql_select_db($database,$db_connection);
	
	// Gather needed information
	$title = mysql_real_escape_string($_GET["title"],$db_connection);
	$year = $_GET["year"];
	$rating = mysql_real_escape_string($_GET["rating"],$db_connection);
	$company = mysql_real_escape_string($_GET["company"],$db_connection);
	$genre = mysql_real_escape_string($_GET["genre"],$db_connection);
	//echo $genre;
	// Input validation
	if (isset($_GET['submit']) && ($title == ""))
			echo "Please fill in Movie name <br>";
	if (isset($_GET['submit']) && ($year == ""))
			echo "Please fill in released year <br>";	
	
	if ($title != "" && $year != "") {
	// Form query.
	$get_ID_query = "SELECT MAX(id)+1 FROM MaxMovieID;";
	$id_results = mysql_query($get_ID_query,$db_connection);
	$id = mysql_fetch_array($id_results)[0];
	
	//echo $id."<br>";
	//echo $table;
	$insert_query = "INSERT INTO Movie VALUE('$id','$title','$year','$rating','$company');";
	$insert_genre = "INSERT INTO MovieGenre VALUE('$id','$genre');";
	$update_id = "UPDATE MaxMovieID SET id = $id;";
	//echo $query ."<br>";
	//echo $update_id ."<br>";
	
	// Run query
	$ins_ret = mysql_query($insert_query,$db_connection);
	$ins_genre = mysql_query($insert_genre,$db_connection);
	//echo $insert_genre;
	if (!$ins_ret) {
		$errmsg = mysql_error($db_connection);
		print "Error insert: $errmsg";
	}
	if (!$ins_genre) {
		$errmsg = mysql_error($db_connection);
		print "Error insert genre: $errmsg";
	}
	$up_ret = mysql_query($update_id,$db_connection);
	if (!$up_ret) {
		$errmsg = mysql_error($db_connection);
		print "Error Update max id: $errmsg";
	}
	if ($up_ret && $ins_ret) {
		echo "Added to the database succesfully <br>";
	}
	}
	mysql_close($db_connection);
	?>
	</body>

</html>