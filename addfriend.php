<html><body>
<?php
session_start();
echo $_SESSION['receiver'];
?>
<?php
session_start();
$con = mysql_connect("cs336-64.rutgers.edu", "csuser", "cs277315");
if (!$con) {
    die('cannot connect: '.mysql_error());
}

mysql_select_db("cs336", $con);

$user = $_SESSION['uid'];
$friending = $_SESSION['receiver'];

$friendingtemp = mysql_query("select uid from user where username = '$friending'");

$friendingID = mysql_fetch_array($friendingtemp);
$friendingID = $friendingID['uid'];

mysql_query("insert into pending_friend values('$user', '$friendingID')");

mysql_close($con);

header("Location: /profile.php");
exit();

?>
</html></body>
