<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/models/Connection.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/models/CityMunicipality.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/models/Barangay.php';

$db = new Connection();
$citymun = new CityMunicipality(($db->connect()));
$barangay = new Barangay($db->connect());

$res = [];

$citymun_filter = 'Bacolod';
$cm = $citymun->getCityMunicipalities('citymun', null, $citymun_filter);
$idcm = $cm['id'];
array_push($res, $cm);

var_dump($idcm);

$brgy = $barangay->getBarangays('barangay', $idcm);
if ($brgy) {
    array_push($res, ...$brgy);
}

echo '<pre>';
print_r($res);
echo '</pre>';
