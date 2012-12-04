<?php

$con = mysql_connect('cs336-64','csuser','cs277315');

if (!$con){
    die(mysql_error());
} else {
    //echo "Successful connection\n";
}

mysql_select_db("cs336",$con);

$query = "SELECT *,DATE_FORMAT(birth,'%Y') AS byear FROM user";
//echo $query."\n";
$res = mysql_query($query,$con);
// If any errors, exit. This includes empty results
if (!$res){
    die(mysql_error());
}

echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
echo "<Users>\n";
/*for($i=0;$i<mysql_num_fields($res);$i++){
    echo mysql_field_name($res,$i)."\n";
}
 */
while ($row = mysql_fetch_assoc($res)){

    $uid=$row['uid'];
    echo "<User userID=\"".$uid."\">\n";
    echo "\t<FirstName>".$row['firstname']."</FirstName>\n";
    echo "\t<LastName>".$row['lastname']."</LastName>\n";
    if ($row['email']){
        echo "\t<EmailAddress>".$row['email']."</EmailAddress>\n";
    }

    //Do school query here
    $squery = "SELECT s.sname,a.degree,a.start,DATE_FORMAT(a.end,'%Y') AS end FROM attended a, school s, user u WHERE u.uid=a.uid AND s.sid=a.sid AND u.uid=$uid";
    $sres = mysql_query($squery,$con);
    if (mysql_num_rows($sres)>0){
        while ($srow = mysql_fetch_assoc($sres)){
            echo "\t<Education>\n";
            echo "\t\t<SchoolName>".$srow['sname']."</SchoolName>\n";
            if ($srow['degree']){
                echo "\t\t<Degree>".$srow['degree']."</Degree>\n";
            }
            if ($srow['end']){
                echo "\t\t<Year>".$srow['end']."</Year>\n";
            }
            echo "\t</Education>\n";
        }
    }

    //Do work query here
    $wquery = "SELECT c.employer_name,e.job_title,e.start,e.end FROM employment e, company c, user u WHERE u.uid=e.uid AND c.cid=e.cid AND u.uid=$uid";
    $wres = mysql_query($wquery,$con);
    if (mysql_num_rows($wres)>0){
        while ($wrow = mysql_fetch_assoc($wres)){
            echo "\t<WorkExperience>\n";
            echo "\t\t<CompanyName>".$wrow['employer_name']."</CompanyName>\n";
            echo "\t\t<Position>".$wrow['job_title']."</Position>\n";
            if ($wrow['start']){
                echo "\t\t<From>".$wrow['start']."</From>\n";
            }
            if ($wrow['end']){
                echo "\t\t<To>".$wrow['end']."</To>\n";
            }
            echo "\t</WorkExperience>\n";
        }
    }

    echo "</User>\n";
}

echo "</Users>\n";
mysql_close($con);
?>
