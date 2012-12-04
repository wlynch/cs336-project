<?php
function query(){
    $input=$_POST['input'];
    echo $input."\n<br/>\n";
    $arr = explode(' ',trim($input));
    if (strtolower($arr[0])=="select"){

        $con = mysql_connect('cs336-64','csuser','cs277315');

        if (!$con){
            die(mysql_error());
        }

        mysql_select_db("cs336",$con);

        //echo $query."\n";
        $res = mysql_query($input,$con);
        // If any errors, exit. This includes empty results
        if (!$res){
            die(mysql_error());
        }

        for($i=0;$i<mysql_num_fields($res)-1;$i++){
            echo mysql_field_name($res,$i)." | ";
        }
        echo mysql_field_name($res,$i)."\n<br/>\n";

        
        while ($row = mysql_fetch_array($res)){
            for($i=0;$i<mysql_num_fields($res)-1;$i++){
                echo $row[$i]." | ";
            }
            echo $row[$i]."\n";
            echo "\n<br/>\n";
        }
        mysql_close($con);
    }
}
?>

<html>
    <body>
        <form action="query.php" method="post">
            Enter Query: <input type="text" name="input"><br>
            <input type="submit">
        </form>
        <?php query() ?>
   </body>
</html>

