<html>
<head><title>Top Songs & Artists </title></head>
<body>
<a href="/profile.php"><h1>Music Box</h1></a>
A social music site for everyone!<p>

<?php
session_start();
if($_SESSION['username']){
    #echo "<br>";
    echo "<div align = \"left\"> <a href=\"/logout.php\">Logout</a><br></div>";
}
if ($_SESSION['username']){
    echo "Logged in as: ".$_SESSION['username']."\n<p>\n";
}
?>

<div align=right>
| <a href="/music.php">Top Songs & Artists</a> |
<a href="/artistfind.php">Search for Artist</a> |
<a href="/random.php">Site Info and Facts</a> |
</div>
<p><center><hr width=100% noshade=noshade></center><p>
<form action="/artistfind.php" method="post">
Search for artist: <input type="text" name="artist">
<input type="submit" value="Search">
</form>

<?php
session_start();

$con = mysql_connect("cs336-64.rutgers.edu", "csuser", "cs277315");
if (!$con) {
    die('cannot connect: '.mysql_error());
}


mysql_select_db("cs336", $con);

$topSongs = mysql_query("select s.sname, count(*) as count from likesSong l, song s where s.sid = l.sid group by l.sid order by count DESC");

$topArtists = mysql_query("select a.name, count(*) as count from likesArtist l, artist a where a.aid = l.aid group by l.aid order by count DESC");


echo "<center><h2>The Popularity Chart</h2></center>";

echo "<p><b>Top 10 Songs</b><ul>";
$counter = 0;
while ($topSongsTable = mysql_fetch_array($topSongs) AND $counter < 10) {
    echo "<li>\"".$topSongsTable['sname']."\" -- <b>Likes: </b>";
    echo $topSongsTable['count']."</li>";
    $counter = $counter + 1;
}
echo "</ul>";

echo "<p><b>Top 5 Artists</b><ul>";
$counter = 0;
while ($topArtistTable = mysql_fetch_array($topArtists) AND $counter < 5) {
    echo "<li>".$topArtistTable['name']." -- <b>Likes: </b>";
    echo $topArtistTable['count']."</li>";
    $counter = $counter + 1;
}
echo "</ul>";

mysql_close($con);

?>

</body>
</html>
