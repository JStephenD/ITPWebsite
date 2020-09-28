<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/models/Connection.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/models/CityMunicipality.php';

$db = new Connection();
$citymun = new CityMunicipality($db->connect());


$response = [
    "data" => []
];

$cms = $citymun->getCityMunicipalities('citymun');
foreach ($cms as $row) {
    $action = '<abbr title="Edit">
                <a href="/citymunicipality/edit/' . $row['id'] . '">
                    <i class="fas fa-edit table-edit abbr-edit"></i>
                </a>
            </abbr>
            <abbr title="Delete">
                <i 
                    data-href="/citymunicipality/delete/' . $row['id'] . '" 
                    data-name="' . $row['cmdesc'] . '" 
                    class="fas fa-backspace table-delete abbr-delete">
                </i>
            </abbr>';
    $row['actions'] = $action;
    array_push($response['data'], $row);
}

header('Content-Type: application/json');
echo json_encode($response);
