<?php
$dbhost = "localhost";
$dbname = "freelancingmarketplace";
$dbuser = "root";
$dbpass = "";

function getConnection(){
    global $dbhost;
    global $dbname;
    global $dbpass;
    global $dbuser;
    $con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
    if(mysqli_connect_errno()){
        echo "Faild to connect in mysql" . mysqli_connect_error();
        exit();
    }
    return  $con;
}
?>
