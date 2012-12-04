<html>
<body>
<a href="/" ><h1>Music Box</h1></a>
A social music site for everyone!
<p>
<form method="get">
Search username: <input type="text" name="username">
<input type="submit" value="Search">
</form>
<p><center><hr width=100% noshade=noshde></center><p>

<?php

function messagebox($con, $user) {

    $message = mysql_query("SELECT u2.username sender, m.subject, m.time, m.content FROM user u1, user u2, message m WHERE u1.uid=m.ownerid AND u2.uid=m.senderid AND u1.username='$user'");

    echo "<b>Message Box</b><br>";
    if (mysql_num_rows($message) != 0) {
        while ($mes = mysql_fetch_array($message)) {
            echo "From: ".$mes['sender']."<br>";
            echo "Subject: ".$mes['subject']."<br>";
            echo "Time: ".$mes['time']."<br>";
            echo "Content: ".$mes['content']."<p>";
        }
    }
    else {
        echo "<i>No messages.</i>";
    }
}

$con = mysql_connect("cs336-64.rutgers.edu", "csuser", "cs277315");
if (!$con) {
    die('cannot connect: '.mysql_error());
}

mysql_select_db("cs336", $con);

$user = $_GET['username'];
if (!$user){
    $user=$_POST['username'];
}
if (!$user){
    exit();
}

$userinfo = mysql_query("SELECT * FROM user u WHERE u.username='$user'");

$education = mysql_query("SELECT * FROM user u, attended a, school s WHERE u.uid=a.uid AND a.sid=s.sid AND u.username='$user'");

$employment = mysql_query("SELECT * FROM user u, company c, employment e WHERE u.uid=e.uid AND c.cid=e.cid AND u.username='$user'");

$songresult = mysql_query("SELECT * FROM user u, song s, likesSong ls WHERE ls.sid = s.sid AND ls.uid = u.uid AND u.username ='$user'
    GROUP BY s.sname");

$artistresult = mysql_query("SELECT * FROM user u, artist a, likesArtist la WHERE la.aid = a.aid AND la.uid = u.uid AND u.username = '$user' GROUP BY name");

$activityresult = mysql_query("SELECT * FROM user u, activity a, interested_in i WHERE i.uid = u.uid AND i.actid = a.aid AND u.username = '$user' Group BY aname");

$friendslist = mysql_query("SELECT u2.username FROM user u1, user u2, friend f WHERE ((u1.uid=f.user1 AND u2.uid=f.user2) OR (u1.uid=f.user2 AND u2.uid=f.user1)) AND (u1.username='$user')");

$relationship = mysql_query("select u2.firstname, u2.lastname, r.status, u2.username from user u1, user u2, in_relationship_with r WHERE ((u1.uid=r.user1 AND u2.uid=r.user2) OR (u1.uid=r.user2 AND u2.uid=r.user1)) AND (u1.username = '$user')");


/* user info */
if (mysql_num_rows($userinfo) == 0) {
    die('user not found');
}
else {
    $userrow = mysql_fetch_array($userinfo);
    echo "<b>".$userrow['firstname']." ".$userrow['lastname']."</b><br>";
    echo "<img src=".$userrow['picurl'].", width=200 height=200><br>";
    echo "Username: ".$userrow['username']."<br>";
    echo "Gender: ".$userrow['gender']."<br>";
    echo "Birthday: ".$userrow['birth']."<br>";
    echo "Address: ".$userrow['address']."<br>";
    echo "Email: ".$userrow['email']."<br>";
}

/* education */
echo "<p><b>Education</b><br>";
while ($schoolrow = mysql_fetch_array($education)) {
    echo "School: ".$schoolrow['sname']."<br>";
    echo "Address: ".$schoolrow['address']."<br>";
    echo "Degree: ".$schoolrow['degree']."<br>";
    echo "Attended from ".$schoolrow['start']." until ".$schoolrow['end']."<p>";
}

/* employment */
if (mysql_num_rows($employment) != 0) {
    echo "<p><b>Employment(s)</b><br> ";
    while ($jobrow = mysql_fetch_array($employment)) {
        echo "Employer: ".$jobrow['employer_name']."<br>";
        echo "Address: ".$jobrow['address']."<br>";
        echo "Position: ".$jobrow['job_title']."<br>";
        echo "Salary: $".$jobrow['salary']."/hr<br>";
        echo "From ".$jobrow['start']." until ";
        if ($jobrow['end']) {
            echo $jobrow['end']."<p>";
        }
        else {
            echo "present<p>";
        }
    }
}
else {
    echo "<p><b>Employment</b>: none :(";
}

/* songs */
echo "<p><b>Songs I like</b><br>";
if (mysql_num_rows($songresult) != 0) {
    while ($songs = mysql_fetch_array($songresult)) {
        echo "<ul>";
        echo "<li>".$songs['sname']."</li>";
        echo "</ul>";
    }
}
else {
    echo "<i>None, add some please!</i>";
}

/* artists */
echo "<p><b>Artists I like</b><br>";
if (mysql_num_rows($artistresult) != 0) {
    while ($artists = mysql_fetch_array($artistresult)) {
        echo "<ul>";
        echo "<li>".$artists['name']."</li>";
        echo "</ul>";
    }
}
else {
    echo "<i>None, add some please!</i>";
}

/* interests */
echo "<p><b>Interests</b><br>";
if (mysql_num_rows($activityresult) != 0) {
    while ($act = mysql_fetch_array($activityresult)) {
        echo "<ul>";
        echo "<li>".$act['aname']."</li>";
        echo "</ul>";
    }
}
else {
    echo "<i>I am a boring person, I have no interests. :(</i>";
}

/* friend list */
echo "<p><b>Friends</b><br>";
if (mysql_num_rows($friendslist) != 0) {
    while($friend = mysql_fetch_array($friendslist)) {
        echo "<ul>";
        echo "<li>".$friend['username']."</li>";
        echo "</ul>";
    }
}
else {
    echo "<i>I have no friends, please add me!</i>";
}

/* relationship status */
if (mysql_num_rows($relationship)!= 0) {
    echo "<p><b>Relationship Status</b>: ";
    while ($rel = mysql_fetch_array($relationship)) {
        echo $rel['status']." with ".$rel['firstname']." ".$rel['lastname']." (".$rel['username'].")<br><br>";
    }
}

messagebox($con, $user);

mysql_close($con);

?>
</body>
</html>
