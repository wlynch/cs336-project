<html>
<head><title>My Profile</title></head>
<body>
<a href="/profile.php"><h1>Music Box</h1></a>
A social music site for everyone!<p>
<div>
<?php
session_start();
if($_SESSION['username']){
    #echo "<br>";
    echo "<div align = \"left\"> <a href=\"/logout.php\">Logout</a><br></div>";
}
if ($_SESSION['username']){
    echo "Logged in as: ".$_SESSION['username']."\n<br>\n";
}
?>
<form method="get">
Search user: <input type="text" name="username">
<input type="submit" value="Search">
</form>
<div align = "right">
<p align=right> <a href="/music.php">Top Songs + Artists</a></p>
<p align=right> <a href="/artistfind.php">Search for an Artist</a></p>
<p align=right> <a href="/random.php">Site Info and Facts</a></p>
<?php

session_start();

function messagebox($con, $user) {

    $message = mysql_query("SELECT u2.username sender, m.subject, m.time, m.content FROM user u1, user u2, message m WHERE u1.uid=m.ownerid AND u2.uid=m.senderid AND u1.username='$user'");

    echo "<p><b>Message Box</b><br>";
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


function pending_friends($con, $user) {

    $pending = mysql_query("SELECT u1.username requesting, u1.uid uid FROM user u1, user u2, pending_friend p WHERE u1.uid=p.requesting AND u2.uid=p.requested AND u2.username='$user'");

    if (mysql_num_rows($pending) != 0) {
        echo "<p><b>Friend requests</b><ul>";
        while ($reqs = mysql_fetch_array($pending)) {
            echo "<li>".$reqs['requesting'];
            $_SESSION['requesting'] = $reqs['uid'];
?>
                    <form method="post" action="/friendreq.php">
                    <input type="radio" name="friendreq" value="accept">accept
                    <input type="radio" name="friendreq" value="ignore">ignore
                    <input type="submit" name="sub" value="confirm">
                    </form>
<?php
        }
        echo "</ul>";
    } 
}

/* establish connection to database */
$con = mysql_connect("cs336-64.rutgers.edu", "csuser", "cs277315");
if (!$con) {
    die('cannot connect: '.mysql_error());
}

mysql_select_db("cs336", $con);

$user = $_GET['username'];
if (!$user){
    $_SESSION['ownerID'] = $user;
    $user=$_SESSION['username'];
}
if (!$user){
    exit();
}

$nouser = 0; /* flag to limit 'send message' and 'add friend' to valid users */
$checkuser = mysql_query("SELECT * FROM user WHERE username='$user'");
if (mysql_num_rows($checkuser) == 0) {
    $nouser = 1;
}


/* CHECK FOR SPECIAL CASES TO NOT DISPLAY 'ADD FRIEND' */

/* if user is already friends with you */
$friendslist = mysql_query("SELECT u2.username FROM user u1, user u2, friend f WHERE ((u1.uid=f.user1 AND u2.uid=f.user2) OR (u1.uid=f.user2 AND u2.uid=f.user1)) AND (u1.username='$user')");
$friends = 0;
if (mysql_num_rows($friendslist) != 0) {
    #echo "YOUR FRIENDS";
    while($friend = mysql_fetch_array($friendslist)) {
        if ($_SESSION['username'] == $friend['username']) {
            $friends = 1;
        }
    }
}

$curr = $_SESSION['username'];
$requestedFriend = 0;

/* logged in user cannot be added again by requesting user */
$pending = mysql_query("SELECT u1.username as requesting, u1.uid as uid FROM user u1, user u2, pending_friend p WHERE u1.uid=p.requesting AND u2.uid=p.requested AND u2.username='$user'");
if (mysql_num_rows($pending) != 0) {
    while ($reqs = mysql_fetch_array($pending)) {
        if($_SESSION['username'] == $reqs['requesting']) {
            $requestedFriend = 1;
        }
    }
}

/* viewed user cannot add the requesting user */
$currpending = mysql_query("SELECT u1.username as requesting FROM user u1, user u2, pending_friend p WHERE u1.uid=p.requesting AND u2.uid=p.requested AND u2.username='$curr'");
if (mysql_num_rows($currpending) != 0) {
    while ($req = mysql_fetch_array($currpending)) {
        if ($user == $req['requesting']) {
            $requestedFriend = 1;
        }
    }
}

if ($nouser == 0) {
    if ($user != $_SESSION['username']) {
        echo "<p align=right> <a href=\"/message.php\">Send message</a></p>";
    }
    if ($user == $_SESSION['username']) {
        echo "<p align=right> <a href=\"/editProfile.php\">Edit my profile</a></p>";
    }
    if ($user != $_SESSION['username'] AND $friends == 0 AND $requestedFriend == 0) {	
        echo "<p align=right> <a href=\"/addfriend.php\">+ Add as friend</a></p>";
    }
}

echo "</div></div><p><center><hr width=100% noshade=noshade></center><p>";

/* Queries for user information */

$userinfo = mysql_query("SELECT * FROM user u WHERE u.username='$user'");
$education = mysql_query("SELECT * FROM user u, attended a, school s WHERE u.uid=a.uid AND a.sid=s.sid AND u.username='$user'");
$employment = mysql_query("SELECT * FROM user u, company c, employment e WHERE u.uid=e.uid AND c.cid=e.cid AND u.username='$user'");
$songresult = mysql_query("SELECT * FROM user u, song s, likesSong ls WHERE ls.sid = s.sid AND ls.uid = u.uid AND u.username ='$user'
    GROUP BY s.sname");
$artistresult = mysql_query("SELECT * FROM user u, artist a, likesArtist la WHERE la.aid = a.aid AND la.uid = u.uid AND u.username = '$user' GROUP BY name");
$activityresult = mysql_query("SELECT * FROM user u, activity a, interested_in i WHERE i.uid = u.uid AND i.actid = a.aid AND u.username = '$user' Group BY aname");
$friendslist = mysql_query("SELECT u2.username FROM user u1, user u2, friend f WHERE ((u1.uid=f.user1 AND u2.uid=f.user2) OR (u1.uid=f.user2 AND u2.uid=f.user1)) AND (u1.username='$user')");
$mutualfriends = mysql_query("SELECT u2.username FROM user u1, user u2, friend f WHERE ((u1.uid=f.user1 AND u2.uid=f.user2) OR (u1.uid=f.user2 AND u2.uid=f.user1)) AND (u1.username='$curr') AND u2.username IN (SELECT u2.username FROM user u1, user u2, friend f WHERE ((u1.uid=f.user1 AND u2.uid=f.user2) OR (u1.uid=f.user2 AND u2.uid=f.user1)) AND (u1.username='$user'))");
$relationship = mysql_query("select u2.firstname, u2.lastname, r.status, u2.username from user u1, user u2, in_relationship_with r WHERE ((u1.uid=r.user1 AND u2.uid=r.user2) OR (u1.uid=r.user2 AND u2.uid=r.user1)) AND (u1.username = '$user')");

/* user info */
if (mysql_num_rows($userinfo) == 0) {
    die('user not found');
}
else {
    $userrow = mysql_fetch_array($userinfo);
    echo "<b>".$userrow['firstname']." ".$userrow['lastname']."</b><br>";
    if ($userrow['picurl'] != NULL) {
        echo "<img src=".$userrow['picurl']." width=200 height=200><br>";
    }
    else {
        echo "<img src=http://i47.tinypic.com/30rxys8.jpg width=200 height=200><br>";
    }
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
    echo "<p><b>Employment</b>: forever unemployed :(";
}

/* songs */
echo "<p><b>Songs I like</b><br>";
if (mysql_num_rows($songresult) != 0) {
    echo "<ul>";
    while ($songs = mysql_fetch_array($songresult)) {
        echo "<li>".$songs['sname']."</li>";
    }
    echo "</ul>";
}
else {
    echo "<i>None, add some please!</i>";
}

/* artists */
echo "<p><b>Artists I like</b><br>";
if (mysql_num_rows($artistresult) != 0) {
    echo "<ul>";
    while ($artists = mysql_fetch_array($artistresult)) {
        echo "<li>".$artists['name']."</li>";
    }
    echo "</ul>";
}
else {
    echo "<i>None, add some please!</i>";
}

/* interests */
echo "<p><b>Interests</b><br>";
if (mysql_num_rows($activityresult) != 0) {
    echo "<ul>";
    while ($act = mysql_fetch_array($activityresult)) {
        echo "<li>".$act['aname']."</li>";
    }
    echo "</ul>";
}
else {
    echo "<i>I am a boring person, I have no interests. :(</i>";
}

/* friend list */
echo "<p><b>Friends</b><br>";
if (mysql_num_rows($friendslist) != 0) {
    echo "<ul>";
    while($friend = mysql_fetch_array($friendslist)) {
        echo "<li>".$friend['username']."</li>";
    }
    echo "</ul>";
}
else {
    echo "<i>I have no friends, please add me!</i>";
}

/* mutual friends list */
if ($user != $_SESSION['username']) {
    echo "<p><b>Mutual Friends</b><br>";
    if (mysql_num_rows($mutualfriends) != 0) {
        echo "<ul>";
        while($mfriend = mysql_fetch_array($mutualfriends)) {
            echo "<li>".$mfriend['username']."</li>";
        }
        echo "</ul>";
    }
    else {
        echo "<i>No mutual friends.</i>";
    }
}

/* relationship status */
if (mysql_num_rows($relationship)!= 0) {
    echo "<p><b>Relationship Status</b>: ";
    while ($rel = mysql_fetch_array($relationship)) {
        echo $rel['status']." with ".$rel['firstname']." ".$rel['lastname']." (".$rel['username'].")";
    }
}


$_SESSION['receiver'] = $user;

if ($user == $_SESSION['username']) {
    messagebox($con, $user);
    pending_friends($con, $user);
}

mysql_close($con);

?>
        </body>
        </html>
