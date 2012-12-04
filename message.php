<HTML><BODY>
<a href="/profile.php"><h1>Music Box</h1></a>
A social music site for everyone!
<p align=right> <a href="/music.php">Top Songs + Artists</a></p>
<p><center><hr width=100% noshade=noshade></center><p>


<form action="/profile.php" method="post">
	<textarea name="subject" id="comments" style="width:300px;height:100px;font-family:cursive;border:dashed 12px #6DB72C;">
	Enter your subject here
	</textarea><br>
	
	<textarea name="message" id="comments" style="width:300px;height:300px;font-family:cursive;border:dashed 12px #6DB72C;">
	Enter you message here :)
	</textarea><br>
	<input type="submit" value="Submit">
</form>


<?php
session_start();

#$_SESSION['user'];

$subject = $_POST['subject'];
$content = $_POST['message'];



/* establish connection to database */
$con = mysql_connect("cs336-64.rutgers.edu", "csuser", "cs277315");
if (!$con) {
    die('cannot connect: '.mysql_error());
}

mysql_select_db("cs336", $con);

/*$message = mysql_query("insert into message values(mid,ownerid,$_SESSION['user'],time(),'$content','$subject'));*/

mysql_close($con);


?>
