<?php

$con = mysql_connect('cs336-64','csuser','cs277315');

if (!$con){
    die(mysql_error());
} else {
    echo "Successful connection\n";
}

mysql_select_db("cs336",$con);

$query = "SELECT * FROM user";
echo $query."\n";
$res = mysql_query($query,$con);
if (!$res){
    die(mysql_error());
}

while ($row = mysql_fetch_assoc($res)){
    echo $row;
    echo "\n";
}

mysql_close($con);
?>
