<html><body>

<h1><a href="/profile.php">Music Box</a></h1>
A social music site for everyone!<br>

<p align=right><a href="/music.php">Top Songs + Artists</a></p>
<p><center><hr width=100% noshade=noshade></center><p>

<?php
session_start();
$user = $_SESSION['username'];
$requesting = $_SESSION['requesting'];

$con = mysql_connect("cs336-64.rutgers.edu", "csuser", "cs277315");if (!$con) {
    die('Cannot connect: '.mysql_error());
}

mysql_select_db("cs336", $con);

$userrow = mysql_fetch_array(mysql_query("SELECT uid FROM user WHERE username='$user'"));
$userid = $userrow['uid'];

if (isset($_POST['friendreq'])) {
    $request = $_POST['friendreq'];
    if ($request == "accept") {
        if ($userid > $requesting) { /* adhere to user1 < user2 */
            mysql_query("INSERT INTO friend VALUES($requesting, $userid)");
        }
        else {
            mysql_query("INSERT INTO friend VALUES($userid, $requesting)");
        }
        echo "User added! :)";
    }
    else {
        echo "Request ignored.";
    }

    mysql_query("DELETE FROM pending_friend WHERE requesting=$requesting AND requested=$userid");
}
else {
    echo "Please select a choice.";
}

mysql_close($con);

header("Refresh: 2; URL=/profile.php");
exit;
?>
