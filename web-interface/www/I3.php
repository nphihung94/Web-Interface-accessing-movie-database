<!DOCTYPE html>
<html>

	<head>
		<title> Add Comment </title>
	</head>
	
	<body>
		<h1 align=middle> Add Review to movie </h1>
		
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
			$id = $_GET["id"];
			if (empty($id))
				$get_movie_query = "SELECT title,year,id FROM Movie ORDER BY title ASC;";
			else
				$get_movie_query = "SELECT title,year,id FROM Movie WHERE id = $id;";
			$movie_list = mysql_query($get_movie_query,$db_connection);
			?>
			
			Movie: <select name = "movie">
				<?php
					while ($row = mysql_fetch_array($movie_list)) {
						echo "<OPTION value = $row[2]> $row[0] ( $row[1]) </OPTION>";
					}
				?>
				</select> <br>
			Your Name: <br> 
			<input type = "text" name = "name" SIZE = 20 MAXLENGTH = 20> <br> 
			Review Rating: 
			<input type = "radio" name = "rating" value = "1"> One Star
			<input type = "radio" name = "rating" value = "2"> Two Star
			<input type = "radio" name = "rating" value = "3"> Three Star
			<input type = "radio" name = "rating" value = "4"> Four Star
			<input type = "radio" name = "rating" value = "5"> Five Star <br>
			Comment: <br>
			<textarea name = "comment" id = ROWS = 10 COLS = 50> Comment </textarea> 
			<br>
		<input type="submit" name = "submit" value= "Submit" />
		</form>
		
		<?php
			// Gather information
			$name = $_GET["name"];
			$mid = $_GET["movie"];
			//echo $mid."<br>";
			$rating = $_GET["rating"];
			$comment = mysql_real_escape_string($_GET["comment"],$db_connection);
			$get_time_query = "SELECT NOW()";
			$time_res = mysql_query($get_time_query);
			$time = mysql_fetch_array($time_res)[0];
			//echo "$time";
			
			// Input validation
			if (isset($_GET["submit"]) && $rating == "") {
				echo "Please rate the movie <br>";
			}
			if (isset($_GET["submit"]) && $name == "") {
				echo "Please fill your name <br>";
			}
			if ($rating != "" && $name != "") {
				$insert_query = "INSERT INTO Review VALUES('$name','$time','$mid','$rating','$comment');";
				$ins_res = mysql_query($insert_query,$db_connection);
				if ($ins_res)
					echo "Succesfully Added to Review <br>";
				else {
					$errmsg = mysql_error($db_connection);
					echo "Failed to Insert: $errmsg";
				}
			}
			mysql_close($db_connection);		
		?>
	</body>
</html>