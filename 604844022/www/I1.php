<!DOCTYPE html>
<html>
	<head>
		<title> Add Actor/Director </title>
	</head>
	
	<body>
	<h1 align = middle> Add Actor and Director </h1>
	
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
		<input type = "radio" name = "table_name" value = "Actor"> Add Actor 
		<input type = "radio" name = "table_name" value = "Director"> Add Director <br>
		First Name: <br> 
		<input type = "text" name = "first" SIZE = 20 MAXLENGTH = 20> <br>
		Last Name: <br>
		<input type = "text" name = "last" SIZE = 20 MAXLENGTH = 20> <br>
		Sex: <br>
		<input type = "text" name = "sex" SIZE = 20 MAXLENGTH = 6> <br>
		Date of Birth: <br>
		<input type = "date" name = "dob" SIZE = 20> <br>
		Date of Death: <br>
		<input type = "date" name = "dod" SIZE = 20> <br>
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
	$first = mysql_real_escape_string($_GET["first"],$db_connection);
	$last = mysql_real_escape_string($_GET["last"],$db_connection);
	$sex = mysql_real_escape_string($_GET["sex"],$db_connection);
	$dob = $_GET["dob"];
	$dod = $_GET["dod"];
	$table = $_GET["table_name"];

	// Input validation
	if (isset($_GET['submit']) && ($first == "" || $last == ""))
			echo "Please fill in first name and last name <br>";
	if (isset($_GET['submit']) && ($dob == ""))
			echo "Please fill in Date of Birth <br>";
	if (isset($_GET['submit']) && ($table == ""))
			echo "Please choose Actor or Director <br>";

	if ($first != "" && $last != "" && $dob != "" && $table != "") {
	
	// Form query.
	$get_ID_query = "SELECT MAX(id)+1 FROM MaxPersonID;";
	$id_results = mysql_query($get_ID_query,$db_connection);
	$id = mysql_fetch_array($id_results)[0];
	
	//echo $id."<br>";
	//echo $table;
	if ($table == 'Actor')
		$insert_query = "INSERT INTO $table VALUE('$id','$last','$first','$sex','$dob','$dod');";
	if ($table == 'Director')
		$insert_query = "INSERT INTO $table VALUE('$id','$last','$first','$dob','$dod');";
	$update_id = "UPDATE MaxPersonID SET id = $id;";
	//echo $query ."<br>";
	//echo $update_id ."<br>";
	
	// Run query
	$ins_ret = mysql_query($insert_query,$db_connection);
	
	if (!$ins_ret) {
		$errmsg = mysql_error($db_connection);
		print "Error insert: $errmsg";
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

