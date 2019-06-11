<!DOCTYPE html>
<html>

	<head>
		<title> Add Director to Movie </title>
	</head>
	
	<body>
		<h1 align=middle> Add Director to Movie Relation</h1>
	<table border = 1 bgcolor = #00FF00> 
		<th> <a href="I1.php"> Add Actor and Director </a> </th>  
		<th> <a href="I2.php"> Add Movie Information </a> </th>  
		<th> <a href="I3.php"> Add Review to Movie </a> </th>
		<th> <a href="I4.php"> Add Actor to Movie Relation </a> </th>		
		<th> <a href="I5.php"> Add Director to Movie Relation </a> </th>
		<th> <a href="S1.php"> Search For Actor and Movies </a> </th>
	</table>
	<br> -------------------------------------------- <br>
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
		?>
		
		<form action = "<?php $_PHP_self ?>" method = "GET" >
			<?php
				$get_director_query = "SELECT CONCAT(first,' ',last) as name,id FROM Director ORDER BY name ASC;";
				$get_movie_query = "SELECT title,year,id FROM Movie ORDER BY title ASC;";
				$get_director_list = mysql_query($get_director_query,$db_connection);
				$get_movie_list = mysql_query($get_movie_query,$db_connection);
			?>	
				Choose Director: <br>
				<select name = "director">
					<?php
						while ($row = mysql_fetch_array($get_director_list)) {
							echo "<option value = $row[1]> $row[0] </option>";
						}
					?>
				</select> <br>
				Choose Movie: <br>
				<select name = "movie">
					<?php
						while ($row = mysql_fetch_array($get_movie_list)) {
							echo "<option value = $row[2]> $row[0] ($row[1]) </option>";
						}
					?>
				</select> <br> 
			<input type="submit" name = "submit" value= "Submit" />
		</form>
		
		<?php 
			// Gather all information
			$mid = $_GET["movie"];
			$aid = $_GET["director"];
		
			// Create Query
			if (isset($_GET["submit"])) {
				$insert_query = "INSERT INTO MovieDirector VALUES('$mid','$aid');";
				$ins_ret = mysql_query($insert_query,$db_connection);
				if (!$ins_ret) {
					$errmsg = mysql_error($db_connection);
					echo "Failed to Insert: $errmsg";
				}
				else 
					echo "Successfully Added into database <br>";
			}
		mysql_close($db_connection);
		?>
	</body>
</html>