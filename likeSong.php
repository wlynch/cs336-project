<HTML><BODY>

<?php
session_start();
$connection = mysql_connect("cs336-64.rutgers.edu","csuser","cs277315");
if (!$connection)
{
	die('Cannot connect to server'); /*Prints to the browser*/
}
mysql_select_db("cs336",$connection);
$likedSong = $_POST['LikeSong'];
$user = $_SESSION['uid'];
mysql_query("insert into likesSong values('$user','$likedSong')");
mysql_close($connection);
mysql_close($connection);
header("Location: ".$_SESSION['url']);
?>

</body></html>
