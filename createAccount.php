<html>

<head>
<title>Account Creation</title>
</head>
<body>
<a href="/"><h1>Music Box</h1></a>
A social music site for everyone!
<p><center><hr width=100% noshade=noshade></center>
    <h2> Account Creation </h2>
    <i> * = required field</i><p>


    <form action="createAccount.php" method="POST">
        <b>Basic information</b><br>
        First name: <input type="textbox" name="fname"><br/>
        Last name: <input type="textbox" name="lname"><br/>
        Username: <input type="textbox" name="username">*<br/>
        Birthdate: <input type="date" name="bdate">*<br/>
        Email: <input type="textbox" name="email"><br/>
        Address: <input type="textbox" name="address"> <i>e.g. 99 Davidson Rd. Piscataway, NJ, USA</i><br/>
        Gender: <select name="gender">
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                </select>*<br/>
        Profile Picture URL: <input type="textbox" name="purl"><br/>
        <input type="submit" value="next >>">
    </form>
</body>

</html>

<?php
session_start();
function setval($post) {
    if ($post){
        return "'".$post."'";
    } else {
        return "NULL";
    }
}

if ($_POST['username'] && $_POST['gender'] && $_POST['bdate']){
    $con = mysql_connect("cs336-64.rutgers.edu", "csuser", "cs277315");
    if (!$con) {
        die('cannot connect: '.mysql_error());
    }

    mysql_select_db("cs336",$con);
    $query = "SELECT MAX(uid) as max FROM user";
    $res = mysql_query($query,$con);

    if (!$res){
        die(mysql_error());
    }

    $row=mysql_fetch_array($res);
    $newuid=$row['max']+1;

    /* global for next page */
    $_SESSION['newuid'] = $newuid;

    $fname=setval($_POST['fname']);
    $lname=setval($_POST['lname']);
    $username=setval($_POST['username']);
    $bdate=setval($_POST['bdate']);
    $email=setval($_POST['email']);
    $address=setval($_POST['address']);
    $gender=setval($_POST['gender']);
    $purl=setval($_POST['purl']);

    $query = "INSERT INTO user VALUES ($newuid,$gender,$address,$username,$fname,$lname,$email,$bdate,$purl)";
    $res = mysql_query($query,$con);
    if (!$res){
        echo "Error in creating account\n<br/>\n";
        mysql_close($con);
    } else {
        mysql_close($con);
        header("Location: /addEdu.php");
        exit;
    }
}    

?>


