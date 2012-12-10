<html>
<head><title>Edit Profile</title></head>

<body>
<a href="/"><h1>Music Box</h1></a>
A social music site for everyone!
<p><center><hr width=100% noshade=noshade></center>
    <h2> Edit Profile </h2>
    <i>* = required field</i><p>

<form action="editProfile.php" method="POST">
<?php
session_start();

$con = mysql_connect("cs336-64.rutgers.edu", "csuser", "cs277315");
if (!$con) {
    die('cannot connect: '.mysql_error());
}

mysql_select_db("cs336",$con);

/* User Information */
echo "<b>User Information</b><br>";
echo "First name: <input type=\"textbox\" name=\"fname\" value=\"".$_SESSION['firstname']."\"><br/>\n";
echo "Last name: <input type=\"textbox\" name=\"lname\" value=\"".$_SESSION['lastname']."\"><br/>\n";
echo "Birthdate: <input type=\"date\" name=\"bdate\" value=\"".$_SESSION['birth']."\">*<br/>\n";
echo "Email: <input type=\"textbox\" name=\"email\" value=\"".$_SESSION['email']."\"><br/>\n";
echo "Address: <input type=\"textbox\" name=\"address\" value=\"".$_SESSION['address']."\"><br/>\n";
echo "Gender: <select name=\"gender\">\n";

if ($_SESSION['gender']=="Male"){
    echo "<option value=\"Male\" selected>Male</option>\n";
    echo "<option value=\"Female\">Female</option>\n";
} else {
    echo "<option value=\"Male\">Male</option>\n";
    echo "<option value=\"Female\" selected>Female</option>\n";
}

echo "</select>*<br/>\n";
echo "Profile Picture URL: <input type=\"textbox\" name=\"purl\" value=\"".$_SESSION['picurl']."\"><br/>\n";
echo "<input type=\"submit\" value=\"update\">\n";

?>
    </form>
<p>

<!-- education information -->
<form action="editProfile.php" method="POST">
<?php
$curruser = $_SESSION['username'];
$education = mysql_query("SELECT * FROM user u, attended a, school s WHERE u.uid=a.uid AND a.sid=s.sid AND u.username='$curruser'");
$schoolrow = mysql_fetch_array($education);
$schoollist = mysql_query("SELECT * FROM school");

echo "<b>Education</b><br>";
echo "School: <select name=\"school\">\n";
echo "<option value=\"".$schoolrow['sname']."\" selected>".$schoolrow['sname']."<br>\n";
while ($school = mysql_fetch_array($schoollist)) {
    if ($school['sname'] == $schoolrow['sname']) continue;
    echo "<option value=\"".$school['sname']."\">".$school['sname']."</option>";
}
echo "</select>*<br>\n";
echo "Start date: <input type=\"date\" name=\"sdate\" value=\"".$schoolrow['start']."\"><br>\n";
echo "End date: <input type=\"date\" name=\"edate\" value=\"".$schoolrow['end']."\"><br>\n";
echo "Degree: <input type=\"textbox\" name=\"degree\" value=\"".$schoolrow['degree']."\">*<br>\n";
echo "<input type=\"submit\" value=\"update\">\n";
?>    
</form>

<!-- employment information -->
<?php
$curruser = $_SESSION['username'];
$employment = mysql_query("SELECT * FROM user u, company c, employment e WHERE u.uid=e.uid AND c.cid=e.cid AND u.username='$curruser'");
$jobinfo = mysql_fetch_array($employment);
// can only edit information if user has employment 
if (mysql_num_rows($employment) != 0) {
    echo "<form action=\"editProfile.php\" method=\"POST\">\n";
    echo "<b>Employment</b><br>";
    echo "Employer: <input type=\"textbox\" name=\"employer\" value=\"".$jobinfo['employer_name']."\">*<br>\n";
    echo "Address: <input type=\"textbox\" name=\"address\" value=\"".$jobinfo['address']."\"><br>\n";
    echo "Position: <input type=\"textbox\" name=\"position\" value=\"".$jobinfo['job_title']."\"><br>\n";
    echo "Salary (per hour): <input type=\"textbox\" name=\"salary\" value=\"".$jobinfo['salary']."\"><br>\n";
    echo "Start date: <input type=\"date\" name=\"jsdate\" value=\"".$jobinfo['start']."\"><br>\n";
    echo "End date: <input type=\"date\" name=\"jedate\" value=\"".$jobinfo['end']."\"><br>\n";
    echo "<input type=\"submit\" name=\"editemployment\" value=\"update\">\n";
    echo "</form>\n";
}
 
?>

<h2>Add more information</h2>
<!-- employment information -->
<form action="editProfile.php" method="POST">
    <b>Employment</b><br>
    Employer: <input type="textbox" name="employer">*<br>
    Address: <input type="textbox" name="address"><br>
    Position: <input type="textbox" name="position"><br>
    Salary (per hour): <input type="textbox" name="salary"><br>
    Start date: <input type="date" name="jsdate"><br>
    End date: <input type="date" name="jedate"><br>
    <input type="submit" name="addemployment" value="add">
</form><p>

<!-- activities information -->
<form action="editProfile.php" method="POST">
    <b>Interests</b><br>
    Activity: <input type="textbox" name="interest">*
    <input type="submit" value="add">
</form>

</body>
</html>




<?php

function setval($post){
    if ($post) {
        return "'".$post."'";
    } else {
        return "NULL";
    }
}

session_start();

if ($_POST['gender'] && $_POST['bdate']) {

    $fname=setval($_POST['fname']);
    $lname=setval($_POST['lname']);
    $bdate=setval($_POST['bdate']);
    $email=setval($_POST['email']);
    $address=setval($_POST['address']);
    $gender=setval($_POST['gender']);
    $purl=setval($_POST['purl']);
    $uid=$_SESSION['uid'];
    
    $query = "UPDATE user SET gender=$gender, address=$address, firstname=$fname, lastname=$lname, email=$email, birth=$bdate, picurl=$purl WHERE uid=$uid";

    $res = mysql_query($query,$con);
    if (!$res){
        echo "Error in updating user information: ".mysql_error()."\n<br/>\n";
        mysql_close($con);
    } else {
        echo "user info done\n";
        mysql_close($con);
        header("Location: /profile.php");
        exit;
    }
}
else if ($_POST['school'] && $_POST['degree']) {

    $uid = $_SESSION['uid'];
    $sname = setval($_POST['school']);
    $srow = mysql_fetch_array(mysql_query("SELECT sid FROM school WHERE sname=$sname"));
    $sid = $srow['sid'];
    $sdate = setval($_POST['sdate']);
    $edate = setval($_POST['edate']);
    $degree = setval($_POST['degree']);

    $row = mysql_fetch_array(mysql_query("SELECT a.uid, a.sid, a.degree FROM attended a, school s, user u WHERE u.uid=a.uid AND s.sid=a.sid AND u.uid=$uid"));
    $oldsid=$row['sid'];
    $olddegree=$row['degree'];

    $squery = "UPDATE attended SET start=$sdate, end=$edate, sid=$sid, degree=$degree WHERE uid=$uid AND sid=$oldsid AND degree='$olddegree'";

    $sres = mysql_query($squery, $con);
    if (!$sres){
        echo "Error in updating education information: ".mysql_error()."\n<br/>\n";
        mysql_close($con);
    } else {
        mysql_close($con);
        header("Location: /profile.php");
        exit;
    }
}
else if ($_POST['employer']) {

    $uid = $_SESSION['uid'];
    $curruser = $_SESSION['username'];
    $employer = setval($_POST['employer']);
    if (isset($_POST['editemployment'])) {
        $erow = mysql_fetch_array(mysql_query("SELECT e.cid FROM user u, company c, employment e WHERE u.uid=e.uid AND c.cid=e.cid AND u.username='$curruser'"));
        $cid = $erow['cid'];
    }
    else {
        $jquery = "SELECT MAX(cid) as max FROM company";
        $jres = mysql_query($jquery, $con);
        if (!$jres) {
            echo "error\n";
            die(mysql_error());
        }
        $row = mysql_fetch_array($jres);
        $cid = $row['max']+1;
    }
    $address = setval($_POST['address']);
    $position = setval($_POST['position']);
    $salary = setval($_POST['salary']);
    $jsdate = setval($_POST['jsdate']);
    $jedate = setval($_POST['jedate']);

    if (isset($_POST['editemployment'])) {
        echo "edit employment info\n";
        $cquery = "UPDATE company SET employer_name=$employer, address=$address WHERE cid=$cid";
        $jquery = "UPDATE employment SET job_title=$position, salary=$salary, start=$jsdate, end=$jedate WHERE cid=$cid AND uid=$uid";
    }
    else {
        echo "add employment info\n";
        $cquery = "INSERT INTO company VALUES ($cid, $employer, $address)";
        $jquery = "INSERT INTO employment VALUES ($position, $salary, $uid, $cid, $jsdate, $jedate)";
    }

    $cres = mysql_query($cquery, $con);
    $jres = mysql_query($jquery, $con);

    if (!$cres || !$jres) {
        echo "Error in updating employment information: ".mysql_error()."\n<br/>\n";
        mysql_close($con);
    }
    else {
        mysql_close($con);
        header("Location: /profile.php");
        exit;
    }
}
else if ($_POST['interest']) {


    $new = 0; // check if activity already exists

    $uid = $_SESSION['uid'];
    $aname = setval($_POST['interest']);
 
    $findact = mysql_query("SELECT aid FROM activity WHERE aname=$aname");

    if (mysql_num_rows($findact) == 0) {
        $ares = mysql_query("SELECT MAX(aid) as max FROM activity");
        $row = mysql_fetch_array($ares);
        $aid = $row['max']+1;
        $new = 1;
    }
    else {
        $actnum = mysql_fetch_array($findact);
        $aid = $actnum['aid'];
    } 

    echo $aname;
    echo $aid;

    if ($new == 1) {
        $actquery = "INSERT INTO activity VALUES ($aname, $aid)";
        $actinsert = mysql_query($actquery, $con);
        if (!$actinsert) {
            echo "Error in inserting new activity: ".mysql_error()."\n<br>\n";
            mysql_close($con);
        }
    }

    $intquery = "INSERT INTO interested_in VALUES ($aid, $uid)";
    $ires = mysql_query($intquery, $con);
    if (!$ires) {
        echo "Error in inserting new activity: ".mysql_error()."\n<br/>\n";
        mysql_close($con);
    } else {
        mysql_close($con);
        header("Location: /profile.php");
        exit;
    }
}
?>

