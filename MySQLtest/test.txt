<?php

require_once ('credentials.php');

?>

<html>
  <head>
    <title>MySQL Test</title>
  </head>
  <body>

  <h2>Results</h2>

<?php



mysql_connect('localhost',$username,$password);
@mysql_select_db('testDB') or die( "Unable to select database");


$query="SELECT * FROM testTable";
$result=mysql_query($query);

$num=mysql_numrows($result);

$i=0;
while ($i < $num) {

  $name=mysql_result($result,$i,"name");
  $value=mysql_result($result,$i,"value");

?>

    Name : <?php echo $name ?><br/>
      Value : <?php echo $value ?><br/>
    <br/>

<?php

      $i++;
 }


mysql_close();

?>
<br/>
<a href="test.txt">See source code here.</a>
  </body>
</html>
