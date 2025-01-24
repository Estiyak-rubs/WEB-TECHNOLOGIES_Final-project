<?php
require_once("../model/userModel.php");

$data = file_get_contents("php://input");
$mydata = json_decode($data, true);
$type = $mydata['type'];
$res = getUsersByType($type);
echo json_encode($res);


?>
