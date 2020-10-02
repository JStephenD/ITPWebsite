<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/models/Connection.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/models/EmployeesModel.php';

$db = new Connection();
$employees = new EmployeesModel($db->connect());

header('Content-Type: application/json');
echo json_encode($employees->getEmployees());
