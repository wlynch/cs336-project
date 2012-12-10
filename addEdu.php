<html>

<head>
<title>Account Creation</title>
</head>
<body>
<a href="/"><h1>Music Box</h1></a>
A social music site for everyone!
<p><center><hr width=100% noshade=noshade></center>

<?php
session_start();

$con = mysql_connect("cs336-64.rutgers.edu", "csuser", "cs277315");
if (!$con) {
    die ('cannot connect: '.mysql_error());
}
mysql_select_db("cs336", $con);
$schoollist = mysql_query("SELECT * FROM school");

?>
    <h2>Account Creation (con't)</h2>
    <i>* = required field</i><p>


    <form action="addEdu.php" method="POST">
    <b>Education</b><br>
    School: <select name="school">
<?php
while ($school = mysql_fetch_array($schoollist)) {
    echo "<option value=\"".$school['sname']."\">".$school['sname']."</option>";
}
?>
    </select>*<br>
    Start date: <input type="date" name="sdate"><br>
    End date: <input type="date" name="edate"><br>
    Degree: <input type="textbox" name="degree">*<p>
    <input type="submit" value="create account!">    
</form>
</body>
</html>

<?php

function setval($post) {
    if($post) {
        return "'".$post."'";
    }
    else {
        return "NULL";
    }
}

if ($_POST['school'] && $_POST['degree']) {

    $uid = $_SESSION['newuid'];
    
    $sname = setval($_POST['school']);
    $srow = mysql_fetch_array(mysql_query("SELECT sid FROM school WHERE sname=$sname"));
    $sid = $srow['sid'];

    $sdate = setval($_POST['sdate']);
    $edate = setval($_POST['edate']);
    $degree = setval($_POST['degree']);

    $query = "INSERT INTO attended VALUES ($uid, $sid, $sdate, $edate, $degree)";
    $res = mysql_query($query, $con);
    if (!$res) {
        echo "Error in adding education information, please try again!\n<br>\n";
        mysql_close($con);
    }
    else {
        echo "Success! Redirecting back to home page.\n<br>\n";
        mysql_close($con);
        header("Refresh: 2; URL=/");
        exit;
    }
}

?>
