<html><h1>Music Box</h1>
A social music site for everyone! Please login below<br>
<body>

<form action="profile.php" method="post">
Username: <input type="text" name="username">
<!--Password: <input type="password" name="password"> -->
<input type="submit" value="Search">
</form>

<?php

/*$con = mysql_connect("cs336-64.rutgers.edu", "csuser", "cs277315");
if (!$con) {
    die('cannot connect: '.mysql_error());
}

mysql_select_db("cs336", $con);

$user = $_GET['username'];

echo "<form action=\"cs336-64.rutgers.edu/profile.php?username="."'$user'"."\" method=\"get\" accept-charset=\"utf-8\">"."</form>";
$result = mysql_query("SELECT * FROM user u, attended a, school s WHERE u.uid=a.uid AND a.sid=s.sid AND u.username='$user'");

$songresult = mysql_query("SELECT * FROM user u, song s, likesSong ls WHERE ls.sid = s.sid AND ls.uid = u.uid AND u.username ='$user'
GROUP BY s.sname");

$artistresult = mysql_query("SELECT * FROM user u, artist a, likesArtist la WHERE la.aid = a.aid AND la.uid = u.uid AND u.username = '$user'
GROUP BY name");

$activityresult = mysql_query("SELECT * FROM user u, activity a, interested_in i WHERE i.uid = u.uid AND i.actid = a.aid AND u.username = '$user' 
Group BY aname");

$friendslist = mysql_query("select * from user u1, user u2, friend f WHERE f.user1 = u1.uid AND f.user2 = u2.uid and u1.username = '$user'");

$relationship = mysql_query("select u2.firstname, u2.lastname from user u1 , user u2 , in_relationship_with r WHERE r.user1 = u1.uid AND r.user2 = u2.uid AND u1.username = '$user'");


if (mysql_num_rows($result) == 0) {
    die('user not found');
}
else {
    while ($row = mysql_fetch_array($result)) {
	echo "<b>".$row['firstname']."  ";
        echo $row['lastname']."</b><br>";
        echo "<img src=".$row['picurl'].", width = 200 height = 200> <br>";
	echo "Username : ".$row['username']."<br>";
	echo "Birthday : ".$row['birth']."<br>";
	echo "School:".$row['sname']."<br>";
        echo "Address: ".$row['address']."<br>";
        echo "Degree: ".$row['degree']."<br>";
        echo "Attended from: ".$row['start']."	Until:	";
        echo $row['end']."<br>";
    }
	echo "<br>I Like the songs: <br>";
	echo "<br>";
   while ($rows = mysql_fetch_array($songresult)) {
	echo "- ".$rows['sname']."<br>";
    }

    echo "<br>I Like the artists: <br>";
    echo "<br>";

   while ($ro = mysql_fetch_array($artistresult)) {
	echo "- ".$ro['name']."<br>";
    }
    echo "<br>Activities: <br>";
    echo "<br>";
   while ($rowing = mysql_fetch_array($activityresult)) {
	echo "- ".$rowing['aname']."<br>";
    }
    echo "<br> Friends<br><br>";
   while ($rowingss = mysql_fetch_array($friendslist)) {
	echo "- ".$rowingss['username']."<br>";
    }

    echo "<br> In a Relationship With :";
   while ($rowings = mysql_fetch_array($relationship)) {
	echo "	 ".$rowings['firstname']."  ".$rowings['lastname']."<br><br>";
    }
}

mysql_close($con);
 */
?>
</body>
</html>
