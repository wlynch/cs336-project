<?php
session_start();
if($_POST['username']){
    $con = mysql_connect("cs336-64.rutgers.edu", "csuser", "cs277315");
    if (!$con) {
        die('cannot connect: '.mysql_error());
    }

    mysql_select_db("cs336", $con);

    $user = $_POST['username'];

    $result = mysql_query("SELECT * FROM user u WHERE u.username='$user'");

    if (mysql_num_rows($result) == 0) {
        echo 'user not found';
    }
    else {
        $row = mysql_fetch_array($result);
        $_SESSION['username'] = $row['username'];
        $_SESSION['firstname'] = $row['firstname'];
        $_SESSION['lastname'] = $row['lastname'];
        $_SESSION['uid'] = $row['uid'];
        $_SESSION['email'] = $row['email'];
        $_SESSION['birth'] = $row['degree'];
        header("Location: /profile.php");
        exit;
    }
    mysql_close($con);
}
?>

<html>
<body>


<h1>Music Box</h1>
A social music site for everyone!<p>

Please log in below:<br>
<form action="/" method="post">
Username: <input type="text" name="username">
<!--Password: <input type="password" name="password"> -->
<input type="submit" value="Log In">
</form>

<p align=right> <a href="/music.php">Top Songs + Artists</a></p>



</body>
</html>
