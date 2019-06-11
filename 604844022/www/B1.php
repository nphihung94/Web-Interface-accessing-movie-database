<!DOCTYPE html>
<html>
	<head> 
	<title> Actor Information </title>
	</head>
	
	<body>
	<h1 align = middle> Actor </h1>
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
		$get_query = "SELECT CONCAT(first,' ',last) as name, sex, dob,dod FROM Actor WHERE id = $id;";
		$data = mysql_query($get_query,$db_connection);
		$row = mysql_fetch_array($data);
		if ($id != "" && $row[3] == "")
			$row[3] == "Still Alive";
		echo "<h2>---- Actor Information ----</h2>";
		echo "<b> Name: </b> $row[0] <br>";
		echo "<b> Sex: </b> $row[1] <br>";
		echo "<b> Date of Birth: </b> $row[2] <br>";
		echo "<b> Date of Death: </b> $row[3] <br>";
		
		echo "<h2>---- Movie was In ---- </h2>";
		$get_mid_list_query = "SELECT mid,role FROM MovieActor WHERE aid = $id;";
		$mid_list_query = mysql_query($get_mid_list_query,$db_connection);
		//echo $mid_list_query;
		echo "<table border=1> <tr>";
		echo "<th> ID </th>";
		echo "<th> Movie Name </th>";
		echo "<th> Role </th>";
		echo "</tr>";
		
		while ($row = mysql_fetch_row($mid_list_query)) {
			echo "<tr>";
			echo "<td> $row[0] </td>";
			$get_movie_name = "SELECT title FROM Movie WHERE id = $row[0];";
			$movie_name = mysql_query($get_movie_name,$db_connection);
			$title = mysql_fetch_array($movie_name)[0];
			echo '<td > <a href="B2.php?id='.$row[0].'" target="_self">'.$title.' </a></td>';
			echo "<td> $row[1] </td>";
			echo "</tr>";
		}
		echo "</table>";
		mysql_close($db_connection);
	?>
	
</html>