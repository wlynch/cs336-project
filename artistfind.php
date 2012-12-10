<html>
<h1><a href = "/profile.php">Music Box</h1></a>
A social music site for everyone
<body>

<form method="get">
Artist: <input type="text" name = "artist">
<input type="submit" value="Search">
</form>

<p align=right> <a href="/music.php">Top Songs + Artists</a></p>
<p><center><hr width=100% noshade=noshde></center><p>

<?php
session_start();
$connection = mysql_connect("cs336-64.rutgers.edu","csuser","cs277315");
if (!$connection)
{
	die('Cannot connect to server'); /*Prints to the browser*/
}

mysql_select_db("cs336",$connection);
if ($_POST['artist'])
{
	$artist = $_POST['artist'];
}
else
{

	$artist = $_GET['artist']; /*get from the field the user entered */
}
if ($artist){
	$result = mysql_query("SELECT * FROM artist WHERE name='$artist'");
	$songs = mysql_query("SELECT * FROM song s,artist a,library l WHERE a.name ='$artist' AND 
			s.sid = l.sid AND a.aid = l.aid");

	$friendslist = mysql_query("SELECT u2.username FROM user u1, user u2, friend f WHERE ((u1.uid=f.user1 AND u2.uid=f.user2) OR (u1.uid=f.user2 AND u2.uid=f.user1)) AND (u1.username='$user')");


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
            $_SESSION['artistID'] = $row['aid'];
            $_SESSION['artistname'] = $row['name'];
            $query="select * from likesArtist where aid = ".$row['aid']." and uid = ".$_SESSION['uid'];
            $alreadyLikes = mysql_query($query);
            if (mysql_num_rows($alreadyLikes) == 0)
            {
                echo "<form action=\"/like.php\" method=\"post\">";
                echo "<input type=\"submit\" value=\"Like\">";
                echo "</form>";
            }
			echo "<img src=".$row['purl']."> <br>";
			echo "<br>";
			echo "<b>Friends that like this artist: </b>";
			$temp = $row['aid'];
			$tempUser = $_SESSION['username'];
			$friendslist = mysql_query("SELECT u2.username as username FROM user u1, user u2, friend f , likesArtist l WHERE ((u1.uid=f.user1 AND u2.uid=f.user2) OR (u1.uid=f.user2 AND u2.uid=f.user1)) AND (u1.username='$tempUser') AND (u2.uid = l.uid) AND ('$temp' = l.aid)");
			if (mysql_num_rows($friendslist) != 0) {
				while($friend = mysql_fetch_array($friendslist)) {
					echo $friend['username']." "; 
				}
			}
			echo "<br><br><b>Artist Bio: </b>".$row['bio']."<br>";
			echo "<br>";
			$artistID = $row['aid'];
		}
		echo "<b>Most popular song : </b>";
		$query="select s.sname, count(*) as count from artist a, library lib, likesSong l, song s where a.aid = '$artistID' AND s.sid = l.sid AND lib.sid = s.sid AND lib.aid = a.aid group by l.sid order by count DESC LIMIT 1";

		$result = mysql_query($query);

		$query = mysql_fetch_array($result);
		echo $query['sname']."<br><br>";

		while($row = mysql_fetch_array($songs))
        {
            $_SESSION['songID'] = $row['sid'];
            $_SESSION['url'] = $_SERVER['REQUEST_URI']; 
            $query="select * from likesSong where sid = ".$row['sid']." and uid = ".$_SESSION['uid'];
            $alreadyLikes = mysql_query($query);
            if (mysql_num_rows($alreadyLikes)==0)
            {
                echo "<form action=\"/likeSong.php\" method=\"post\">";
                echo "<button name =\"LikeSong\" type = \"submit\" value = ".$row['sid']. ">Like</button>";
                echo "</form>";
            }
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
