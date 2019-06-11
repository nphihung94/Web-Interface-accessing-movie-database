<!DOCTYPE html>
<html>
	<head> 
	<title> Movie Information </title>
	</head>
	
	<body>
	<h1 align=middle> Movie Info Page </h1>
	<table border = 1 bgcolor = #00FF00> 
		<th> <a href="I1.php"> Add Actor and Director </a> </th>  
		<th> <a href="I2.php"> Add Movie Information </a> </th>  
		<th> <a href="I3.php"> Add Review to Movie </a> </th>
		<th> <a href="I4.php"> Add Actor to Movie Relation </a> </th>		
		<th> <a href="I5.php"> Add Director to Movie Relation </a> </th>
		<th> <a href="S1.php"> Search For Actor and Movies </a> </th>
	</table>
	<br> -------------------------------------------- <br>
	</body>
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
		$id = $_GET["id"];
		$movie_info_query = "SELECT * FROM Movie WHERE id = $id;";
		$movie_info = mysql_query($movie_info_query,$db_connection);
		$row = mysql_fetch_row($movie_info);
		echo "<h2>---- Movie Information ----</h2>";
		echo "<b> Title: </b> $row[1] <br>";
		echo "<b> Released Year: </b> $row[2] <br>";
		echo "<b> Rating: </b> $row[3] <br>";
		echo "<b> Company: </b> $row[4] <br>";
		
		$director_query = "SELECT CONCAT(first,' ',last) as name FROM MovieDirector md JOIN Director d ON d.id = md.did WHERE md.mid = $id;";
		//echo $director_query;
		$director_list = mysql_query($director_query,$db_connection);
		echo "<b> Directors: </b>";
		while ($row = mysql_fetch_row($director_list)) {
			echo "$row[0] <br>";
		}
		echo "<br>";
		
		$genre_query = "SELECT genre FROM MovieGenre WHERE mid = $id;";
		//echo $genre_query;
		$genre_list = mysql_query($genre_query,$db_connection);
		echo "<b> Genre: </b> ";
		while ($row = mysql_fetch_row($genre_list)) {
			echo "$row[0] <br>";
		}
		
		echo "<b> Actors and Actress in the Movie: </b> <br>"; 
		$get_actor_id_query = "SELECT * FROM MovieActor WHERE mid = $id;";
		//echo $get_actor_id_query;
		$get_actor_id = mysql_query($get_actor_id_query,$db_connection);
		echo '<ol type = "1">';
		while ($row = mysql_fetch_row($get_actor_id)) {
			$get_actor_name_query = "SELECT id,CONCAT(first,' ',last) as name FROM Actor WHERE id = $row[1];";
			//echo $get_actor_name_query;
			$actor_name = mysql_query($get_actor_name_query,$db_connection);
			$actor_info = mysql_fetch_row($actor_name);
			echo '<li> <a href="B1.php?id='.$actor_info[0].'" target = "_self">'.$actor_info[1].'</a> </li>';
		}
		echo "</ol>";
		
		echo "<b> Average Rating: </b>"; 
		$get_ave_query = "SELECT AVG(rating), COUNT(*) FROM Review GROUP BY mid HAVING mid = $id;";
		$ave_res = mysql_query($get_ave_query,$db_connection);
		$row = mysql_fetch_row($ave_res);
		if ($row[1] == 0) {
			echo "There is no review for this movie <br>";
		}
		else {
			echo "$row[0] (Total of $row[1] reviews) <br>";
		}
		
		echo "<b> Reviews for this movie: </b> <br>";
		$get_review_query = "SELECT name,rating,comment FROM Review WHERE mid = $id;";
		$review_res = mysql_query($get_review_query,$db_connection);
		while ($row = mysql_fetch_row($review_res)) {
			echo $row[0].' rated this movie '.$row[1].': <br> '.$row[2].' <br>';
		}
		
		$add_comment_link = '\'I3.php?id='.$id.'\'';
		//echo $add_comment_link;
		echo '<button type="button" onclick="location.href='.$add_comment_link.'">Click to add a review for this movie</button>';
		mysql_close($db_connection);
	?>
	
</html>