<!DOCTYPE html>
<html>
	<head> 
		<title> Search For Person/Movie </title>
	</head>
	
	<body>
		<h1 align = middle> Search For Person/Movie </h1>
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
		Keyword to Search: <br>
		<input type = "text" name = "keyword"> <br>
		<input type="submit" name = "submit" value= "Submit" />
		</form>
		
		<?php
			$keyword = $_GET["keyword"];
			if (isset($_GET["submit"]) && $keyword != "") {
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
				
				echo "<h2>---- Actor Information ----</h2>";
				$keys = explode(" ",$keyword);
				if (count($keys) <= 2) {
					if (count($keys) == 2) {
						$actor_query = "SELECT id,CONCAT(first,' ',last) as name,dob,dod FROM Actor WHERE first LIKE '%$keys[0]%' AND last LIKE '%$keys[1]%';";
					}
					else {
						$actor_query = "SELECT id,CONCAT(first,' ',last) as name,dob,dod FROM Actor WHERE first LIKE '%$keys[0]%' OR last LIKE '%$keys[0]%';";
					}
					$actor_list = mysql_query($actor_query,$db_connection);
					echo "<table border=1> <tr>";
					echo "<th> ID </th>";
					echo "<th> Actor Name </th>";
					echo "<th> Date of Birth </th>";
					echo "<th> Date of Death </th>";
					echo "</tr>";
					
					while ($row = mysql_fetch_row($actor_list)) {
						echo "<tr>";
						echo "<td> $row[0] </td>";
						echo '<td > <a href="B1.php?id='.$row[0].'" target="_self">'.$row[1].' </a></td>';
						echo "<td> $row[2] </td>";
						echo "<td> $row[3] </td>";
						echo "</tr>";
					}
					echo "</table>";
				}
				echo "<h2>---- Movie Information ----</h2>";
				$key_movie = mysql_real_escape_string($_GET['keyword'],$db_connection);
				$movie_query = "SELECT id,title,year FROM Movie WHERE title LIKE '%$key_movie%';";
				$movie_list = mysql_query($movie_query,$db_connection);
				echo "<table border=1> <tr>";
				echo "<th> ID </th>";
				echo "<th> Movie Name </th>";
				echo "<th> Released year </th>";
				echo "</tr>";
				while ($row = mysql_fetch_row($movie_list)) {
					echo "<tr>";
					echo "<td> $row[0] </td>";
					echo '<td > <a href="B2.php?id='.$row[0].'" target="_self">'.$row[1].' </a></td>';
					echo "<td> $row[2] </td>";
					echo "</tr>";
				}
				echo "</table>";
			}
		?>
	</body>
</html>