<html>
<html>
<head><title>Send Message</title></head>

<body>

<h1><a href="/profile.php">Music Box</a></h1>
A social music site for everyone!<p>

<?php
session_start();
if($_SESSION['username']){
    #echo "<br>";
    echo "<div align = \"left\"> <a href=\"/logout.php\">Logout</a><br></div>";
}
if ($_SESSION['username']){
    echo "Logged in as: ".$_SESSION['username']."\n<p>\n";
}
?>

<p><center><hr width=100% noshade=noshade></center>

<?php
session_start();
$sender = $_SESSION['username'];
$receiver = $_SESSION['receiver'];

echo "<b>Sending message to:</b> ".$receiver."<p>";
?>
<form method="POST">
Subject: <input type="textbox" name = "subject"><p>
Message: <textarea name="message" rows="5" cols="50"></textarea><p>
<input type="submit" value="Send Message">
</form>

<?php
session_start();
$sender = $_SESSION['username'];
$receiver = $_SESSION['receiver'];

$connection = mysql_connect("cs336-64.rutgers.edu","csuser","cs277315");
if (!$connection) {       
    die('Cannot connect to server'); /*Prints to the browser*/
}            

mysql_select_db("cs336",$connection);

if ($_POST['subject']) {
   
    $subject = $_POST['subject'];
    
    if (!$_POST['message']) {
        $message = NULL;
    }
    else {
        $message = $_POST['message'];
    } 

    $senderIDtemp = mysql_query("select uid from user where username = '$sender'");
    $receiverIDtemp = mysql_query("select uid from user where username = '$receiver'");


    $senderID = mysql_fetch_array($senderIDtemp);
    $senderID = $senderID['uid'];

    $receiverID = mysql_fetch_array($receiverIDtemp);
    $receiverID = $receiverID['uid'];

    $date = date('m/d/Y h:i:s a', time());
    $date = date( "Y-m-d H:i:s", strtotime( $date ) );
    $tempMid = mysql_query("select MAX(mid) as mid from message");

    $mid = mysql_fetch_array($tempMid);
    $mid = $mid['mid'];

    $newmid = $mid+1;
    
    $query = "INSERT INTO message VALUES ($newmid, $receiverID, $senderID, '$date', '$message', '$subject')";
    $res = mysql_query($query, $connection);

    
    if (!$res) {
        echo "Error: ".mysql_error()."\n<br>\n";
        mysql_close($connection);
    }
    else {
        echo "Message sent!! Redirecting in 2 sec.\n<br>";
        header("Refresh: 2; URL=/profile.php");
        mysql_close($connection);
        exit();
    }
}

?>

</body>
</html>
