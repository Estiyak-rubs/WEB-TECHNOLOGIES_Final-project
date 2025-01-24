<?php
require_once("../model/userModel.php");

$data = file_get_contents("php://input");
$mydata = JSON_decode($data, true);
$id = $mydata['uid'];
$name = $mydata['unm'];
$email = $mydata['uemail'];
$password = $mydata['ups'];
$res = updateUserInfo($id, $name, $email, $password);
echo $res;
?>