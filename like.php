<HTML><BODY>

<?php
session_start();
$connection = mysql_connect("cs336-64.rutgers.edu","csuser","cs277315");
if (!$connection)
{
	die('Cannot connect to server'); /*Prints to the browser*/
}
mysql_select_db("cs336",$connection);

$likedArtist = $_SESSION['artistID'];
$user = $_SESSION['uid'];
mysql_query("insert into likesArtist values('$user','$likedArtist')");
header("Location: ".$_SESSION['url']);
mysql_close($connection);
?>

<HTML><BODY>

