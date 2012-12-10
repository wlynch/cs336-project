<!-- activities information -->
<form action="editProfile.php" method="POST">
    <b>Interests</b><br>
    Activity: <select name="interest">
<?php
$actlist = mysql_query("SELECT * FROM activity");
while ($act = mysql_fetch_array($actlist)) {
    echo "<option value=\"".$act['aname']."\">".$act['aname']."</option>";
}
?>
    </select> 
    or specify: <input type="textbox" name="newinterest">*<br>
    <input type="submit" value="add">
</form>

if ($_POST['interest'] || $_POST['newinterest']) {

    $new = 1; // flag for if input is from list or textbox

    $uid = $_SESSION['uid'];
    $aname = setval($_POST['newinterest']);
    if ($aname == 'NULL') {
        $new = 0;
        $aname = setval($_POST['interest']);
    }

    $findact = mysql_query("SELECT aid FROM activity WHERE aname=$aname");

    if (mysql_num_rows($findact) == 0) {
        $ares = mysql_query("SELECT MAX(aid) as max FROM activity");
        $row = mysql_fetch_array($ares);
        $aid = $row['max']+1;
        $new = 2;
    }
    else {
        $actnum = mysql_fetch_array($findact);
        $aid = $actnum['aid'];
    } 

    echo $aname;
    echo $aid;
    if ($new == 2) {
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

