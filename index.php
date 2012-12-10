<html>
<head><title>Music Box: A social music site for everyone!</title></head>
<body>

<h1><a href="/">Music Box</a></h1>
A social music site for everyone!<p>
<center><hr width=100% noshade=noshade></center><p>
Please log in below:<br/>
<form action="/" method="post">
Username: <input type="text" name="username">
<!--Password: <input type="password" name="password"> -->
<input type="submit" value="Log In">
</form>
<p>
<i>Not a registered user? <a href="/createAccount.php">Create an account</a> now!</i>
<p>
<?php
include('header.php');
session_start();

if ($_SESSION['username']){
    header('Location: /profile.php');
    exit;
}

if($_POST['username']){
    $con = mysql_connect("cs336-64.rutgers.edu", "csuser", "cs277315");
    if (!$con) {
        die('cannot connect: '.mysql_error());
    }

    mysql_select_db("cs336", $con);

    $user = $_POST['username'];

    $result = mysql_query("SELECT * FROM user u WHERE u.username='$user'");

    if (mysql_num_rows($result) == 0) {
        echo "Error: user not found, please try again.";
    }
    else {
        $row = mysql_fetch_array($result);
        $_SESSION['username'] = $row['username'];
        $_SESSION['firstname'] = $row['firstname'];
        $_SESSION['lastname'] = $row['lastname'];
        $_SESSION['uid'] = $row['uid'];
        $_SESSION['email'] = $row['email'];
        $_SESSION['birth'] = $row['birth'];
        $_SESSION['address'] = $row['address'];
        $_SESSION['gender'] = $row['gender'];
        $_SESSION['picurl'] = $row['picurl'];
        header("Location: /profile.php");
        exit;
    }
    mysql_close($con);
}
?>

</body>
</html>
