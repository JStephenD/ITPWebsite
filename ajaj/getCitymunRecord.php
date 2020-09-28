<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/models/Connection.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/models/CityMunicipality.php';

$db = new Connection();
$citymun = new CityMunicipality($db->connect());

$id = $_POST['id'];
$cm = $citymun->getCityMunicipalities('citymun', $id);
header('Content-Type: application/json');
echo json_encode($cm);
