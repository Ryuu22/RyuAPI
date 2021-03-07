<?php 
//Login example WIP.
//Required Headers
header("Access-Control-Allow-Origin: *"); //read.php can be read by anyone (asterisk * means all) 
header("Content-Type: application/json; charset=UTF-8"); //and will return a data in xml format.

include_once '../_core/jwt.php';
include_once '../_core/database.php';
include_once '../_core/config.php';

$jwt = new JWT();

$data = array('user_id' => 1, );

echo $jwt->generateJWT($data,$iss,$aud,$expiration_time,$secretKey);

//TODO read input from HTTP request (GET / POST / PUT).

//TODO pass the information to the object and use it to execute a function.

//TODO Read the function returned value and print the result.


?>