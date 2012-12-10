<html>
<body>
<a href="/profile.php"><h1>Music Box</h1></a>
A social music site for everyone!
<p>
<form method="get">
Artist: <input type="text" name = "artist">
<input type="submit" value="Search">
</form>

<p align=right> <a href="/music.php">Top Songs + Artists</a></p>
<p><center><hr width=100% noshade=noshde></center><p>
<h2><center> Sample Facts about our users </center></h2><br>


<?php
session_start();
$connection = mysql_connect("cs336-64.rutgers.edu","csuser","cs277315");
if (!$connection)
{
    die('Cannot connect to server'); /*Prints to the browser*/
}
mysql_select_db("cs336",$connection);

echo "Number of: ";
echo "<form action=\"random.php\" method=\"post\">";
echo "<select name=\"topic\">";
echo "<option value=\"school\">schools attended by users</option>";
echo "<option value=\"company\">companies users are employed by</option>";
echo "<option value=\"message\">messages users have sent</option>";
echo "<option value=\"Male\">Male users</option>";
echo "<option value=\"Female\">Female users</option>";
echo "<option value=\"AvSongLike\">Average songs liked</option>";
echo "<option value=\"AvAgeSchool\">Average age of users by school</option>";
echo "<option value=\"GreaterThanAvMesSentBySchool\">Users that have sent more messages than the average number of messages sent by thier school</option>";
echo "<option value=\"relationship\">Users that are in a relationship and are in the same school</option>";
echo "</select>\n<input type=\"submit\"></input>\n</form>";
if ($_POST['topic']){
    if ($_POST['topic'] == 'Male')
    {
        $query = "select count(*) as count from user where gender = 'Male'";
        $res = mysql_query("$query");
        $num = mysql_fetch_array($res);
        echo $num['count']."<br/>";
    }
    else if ($_POST['topic'] == 'Female')
    {
        $query = "select count(*) as count from user where gender = 'Female'";
        $res = mysql_query("$query");
        $num = mysql_fetch_array($res);
        echo $num['count']."<br/>";
    }
    if ($_POST['topic'] == 'AvSongLike')
    {
        $query = "select count(DISTINCT l.uid)/count(DISTINCT u.uid) as count from likesSong l , user u";
        $res = mysql_query("$query");
        $num = mysql_fetch_array($res);
        echo $num['count']."<br/>";
    }
    if ($_POST['topic'] == 'AvAgeSchool')
    {
        $query = "select s.sname as name, AVG(YEAR(CURDATE())-YEAR(birth)) as avg from user u, attended a, school s where a.sid=s.sid and u.uid=a.uid group by a.sid;";
        $res = mysql_query("$query");
        while ($num = mysql_fetch_array($res)){
            echo $num['name']."\t";
            echo $num['avg']."<br/>";
        }
    }
    if ($_POST['topic'] == 'GreaterThanAvMesSentBySchool')
    {
        $query = "select username,sname,mcount from (select u.username, a.uid,count(m.mid) as mcount from user u, attended a, message m where u.uid=a.uid and m.senderid=a.uid group by a.uid) as c, (select a.sname,a.sid,a.mcount/b.scount avg from (select s.sname, s.sid,count(m.mid) as mcount from school s, attended a, message m where s.sid=a.sid and m.senderid=a.uid group by s.sid) as a, (select sid,count(distinct uid) as scount from attended group by sid) as b where a.sid=b.sid) as d, attended at where c.mcount>=avg and at.uid=c.uid and at.sid=d.sid";
        $res = mysql_query("$query");
        if ($res){
            echo mysql_error();
        }
        while ($num = mysql_fetch_array($res)){
            echo $num['sname']."\t";
            echo $num['username']."<br/>";
        }
    }
if ($_POST['topic'] == 'relationship')
    {
        $query = "
select c.username as name1, b.username as name2 from (select u.uid,sid,username from attended a, in_relationship_with r,user u where r.user1=a.uid and a.uid=u.uid) as c, (select u.uid,sid,username from attended a, in_relationship_with r, user u where r.user2=a.uid and a.uid=u.uid) as b, in_relationship_with r where c.sid=b.sid and (c.uid=user1 and b.uid=user2) or (c.uid=user2 and b.uid=user1)";
        $res = mysql_query("$query");
        while ($num = mysql_fetch_array($res))
        {
            echo $num['name1']." with ";
            echo $num['name2']."<br/>";
        }
    }


    $query="select DISTINCT count(*) as count from ".$_POST['topic'];
    $res = mysql_query("$query");
    $num = mysql_fetch_array($res);
    echo $num['count']."<br/>";
}
?>

Likes a certain artist and goes to a certain school<br>
<form action="/random.php" method="post">
Artist: <input name="artist" type="text">
School: <input name="school" type="text">
<input type="submit">
</form>

<?php
if ($_POST['artist'] && $_POST['school']){
    $connection = mysql_connect("cs336-64.rutgers.edu","csuser","cs277315");
    if (!$connection)
    {
        die('Cannot connect to server'); /*Prints to the browser*/
    }
    mysql_select_db("cs336",$connection);

    $query="select u.username as name from user u, likesArtist l, artist a, attended at, school s where s.sid=at.sid and u.uid=at.uid and u.uid=l.uid and a.aid=l.aid and a.name=\"".$_POST['artist']."\" and s.sname=\"".$_POST['school']."\"";
    $res=mysql_query($query);

    while ($row=mysql_fetch_array($res)){
        echo $row['name']."<br/>\n";
    }

    mysql_close($connection);
}



#echo "List users in a relationship from the same school<br>";
#select c.username as name1, b.username as name2 from (select u.uid,sid,username from attended a, in_relationship_with r,user u where r.user1=a.uid and a.uid=u.uid) as c, (select u.uid,sid,username from attended a, in_relationship_with r, user u where r.user2=a.uid and a.uid=u.uid) as b, in_relationship_with r where c.sid=b.sid and (c.uid=user1 and b.uid=user2) or (c.uid=user2 and b.uid=user1);
#
# BILLY DO THIS ONE ----->>>>>>>   echo "List all single users that like a certain genre<br>";
?>



