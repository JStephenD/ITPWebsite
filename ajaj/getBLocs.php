<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/models/connection.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/models/barangay.php';

$db = new Connection();
$barangay = new Barangay($db->connect());

$brgs = $barangay->getBarangays('barangay');
header('Content-Type: application/json');
echo json_encode($brgs)

?>