<?php

//Config global variables here

//You can access whatever you put in here by writting "include_once '../_core/config.php';" anywhere.

// show error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

// set your default time-zone
date_default_timezone_set('Asia/Seoul');

$secretKey = <<< EOD
-----BEGIN OPENSSH PRIVATE KEY-----
APP SECRET
-----END OPENSSH PRIVATE KEY-----
EOD;

$iss = "Your back end name";
$aud = "Your Client";

$issued_at = time();

$expiration_time = $issued_at + (60 * 60); // valid for 1 hour
$issuer = "http://localhost/";

$example = array('key' => "value", );

?>