<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/classes/Utils.php';

$utils = new Utils();
$ip = $utils->getPublicIp();
$loc = $utils->getLocation($ip);

header('Content-Type: application/json');
echo json_encode($loc);
