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

while ($row = mysql_fetch_assoc($res)){
    echo "<user>\n";
    echo "\t<UserType>\n";
    echo "\t\t<FirstName>".$row['firstname']."</FirstName>\n";
    echo "\t\t<LastName>".$row['lastname']."</LastName>\n";
    if ($row['email']){
        echo "\t\t<EmailAddress>".$row['email']."</EmailAddress>\n";
    }

    $uid=$row['uid'];
    //Do work query here
    $wquery = "SELECT c.employer_name,e.job_title,e.start,e.end FROM employment e, company c, user u WHERE u.uid=e.uid AND c.cid=e.cid AND u.uid=$uid";
    $wres = mysql_query($wquery,$con);
    if (mysql_num_rows($wres)>0){
        echo "\t\t<WorkType>\n";
        while ($wrow = mysql_fetch_assoc($wres)){
            echo "\t\t\t<CompanyName>".$wrow['employer_name']."</CompanyName>\n";
            echo "\t\t\t<Position>".$wrow['job_title']."</JobTitle>\n";
            if ($wrow['start']){
                echo "\t\t\t<From>".$wrow['start']."</From>\n";
            }
            if ($wrow['end']){
                echo "\t\t\t<End>".$wrow['end']."</End>\n";
            }
        }
        echo "\t\t</WorkType>\n";

    }

    //Do school query here
    $squery = "SELECT s.sname,a.degree,a.start,DATE_FORMAT(a.end,'%Y') AS end FROM attended a, school s, user u WHERE u.uid=a.uid AND s.sid=a.sid AND u.uid=$uid";
    $sres = mysql_query($squery,$con);
    if (mysql_num_rows($sres)>0){
        echo "\t\t<EduType>\n";
        while ($srow = mysql_fetch_assoc($sres)){
            echo "\t\t\t<SchoolName>".$srow['sname']."</SchoolName>\n";
            if ($srow['degree']){
                echo "\t\t\t<Degree>".$srow['degree']."</Degree>\n";
            }
            if ($srow['end']){
                echo "\t\t\t<Year>".$srow['end']."</Year>\n";
            }

        }
        echo "\t\t</EduType>\n";
    }

    echo "\t\t<userID>".$uid."</userID>\n";
    echo "\t</UserType>\n";
    echo "\t<Year>".$row['byear']."</Year>\n";
    echo "</user>\n";

}

mysql_close($con);
?>
