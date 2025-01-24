<?php

require_once("../model/userModel.php");

$data = file_get_contents("php://input");
$mydata = JSON_decode($data, true);
$name = $mydata['unm'];
$email = $mydata['uemail'];
$password = $mydata['ups'];
$type = $mydata['utp'];
$res = insertUserInfo($name, $email, $password, $type);
echo $res;


?>