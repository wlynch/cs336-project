<html>
<body>

<form method="post">
username: <input type="text" name="username">
<input type="submit" value="go! :D">
</form>

<?php

$con = mysql_connect("cs336-64.rutgers.edu", "csuser", "cs277315");
if (!$con) {
    die('cannot connect: '.mysql_error());
}

/* hai */
mysql_select_db("cs336", $con);

$user = $_POST['username'];

$result = mysql_query("SELECT * FROM user u, attended a, school s WHERE u.uid=a.uid AND a.sid=s.sid AND u.username='$user'");

if (mysql_num_rows($result) == 0) {
    die('user not found');
}
else {
    while ($row = mysql_fetch_array($result)) {
        echo $row['username']." | ";
        echo $row['firstname']." | ";
        echo $row['lastname']." | ";
        echo $row['sname']." | ";
        echo $row['address']." | ";
        echo $row['degree']." | ";
        echo $row['start']." | ";
        echo $row['end']."</br>";
    }

}



mysql_close($con);

?>
</body>
</html>
