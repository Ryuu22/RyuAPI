<?php 
//Very simple JWT validation example. (WIP)
//Required Headers
header("Access-Control-Allow-Origin: *"); //read.php can be read by anyone (asterisk * means all) 
header("Content-Type: application/xml; charset=UTF-8"); //and will return a data in xml format.

include_once '../_core/jwt.php';
include_once '../_core/database.php';
include_once '../_core/config.php';

$jwt = new JWT();

$token = $_POST['jwt'];

$result = $jwt->validateJWT($token,$iss,$secretKey);
echo json_encode($result);

?>