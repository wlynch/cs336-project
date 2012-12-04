<html><h1>Music Box</h1>
A social music site for everyone<br>
<body>
<form method="get">
Artist: <input type="text" name = "artist">
<input type="submit" value="Search">
</form>

<?php

$connection = mysql_connect("cs336-64.rutgers.edu","csuser","cs277315");
if (!$connection)
{
	die('Cannot connect to server'); /*Prints to the browser*/
}

mysql_select_db("cs336",$connection);
$artist = $_GET['artist']; /*get from the field the user entered */
if ($artist){
	$result = mysql_query("SELECT * FROM artist WHERE name='$artist'");
	$songs = mysql_query("SELECT * FROM song s,artist a,library l WHERE a.name ='$artist' AND 
	s.sid = l.sid AND a.aid = l.aid");
	if (mysql_num_rows($songs)==0)
	{
		echo "No songs exist";
	}
	if (mysql_num_rows($result)==0)
	{
		die('Artist doesnt exist');
	} 
	else
	{
		while($row = mysql_fetch_array($result))
		{
		
			echo "<b>". $row['name']."</b>"."<br>";
			echo "<img src=".$row['purl']."> <br>";
			echo "<br>";
			echo "Artist Bio: ".$row['bio']."<br>";
			echo "<br>";
		}
		while($row = mysql_fetch_array($songs))
		{
			echo "Song Number: ".$row['sid']."<br>";
			echo "Song Name: ". $row['sname']."<br>";
			echo "Genre: ".$row['genre']."<br>";
			$min = Floor($row['length'] / 60);
			$sec = $row['length'] % 60;
			echo "Length: ".$min."m  ".$sec."s"."<br>";
			echo "<br>";
		}
	}
	mysql_close($connection);
}
?>
</body>
</html>
