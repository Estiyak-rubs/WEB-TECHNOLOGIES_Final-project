<?php
require_once("../model/userModel.php");

$data = stripslashes(file_get_contents("php://input"));
$mydata = json_decode($data, true);
$id = $mydata['sid'];
$res = editUserById($id);
echo json_encode(editUserById($id));

?>
