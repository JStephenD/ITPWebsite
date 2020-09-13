<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/models/connection.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/models/cityMunicipality.php';

$db = new Connection();
$citymun = new CityMunicipality($db->connect());

$cms = $citymun->getCityMunicipalities('citymun');
header('Content-Type: application/json');
echo json_encode($cms)
?>