<?php
session_start();
session_destroy();
?>

<html>
<body>


<h1>Music Box</h1>
A social music site for everyone!<p>

Please log in below:<br>
<form action="profile.php" method="post">
Username: <input type="text" name="username">
<!--Password: <input type="password" name="password"> -->
<input type="submit" value="Log In">
</form>

<p align=right> <a href="/music.php">Top Songs + Artists</a></p>



</body>
</html>
