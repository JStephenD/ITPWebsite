<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/models/Connection.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/models/CityMunicipality.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/models/Barangay.php';

$db = new Connection();
$citymun = new CityMunicipality(($db->connect()));
$barangay = new Barangay($db->connect());

$res = [];

$citymun_filter = $_POST['citymun_filter'];
$cm = $citymun->getCityMunicipalities('citymun', null, $citymun_filter);
$idcm = $cm['id'];
array_push($res, $cm);

$brgy = $barangay->getBarangays('barangay', $idcm);
if ($brgy) {
    array_push($res, ...$brgy);
}

header('Content-Type: application/json');
echo json_encode($res);
