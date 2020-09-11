<?php

namespace controllers;
use models\CityMunicipality, models\Barangay;
use classes\Utils;

class CovidTrace {
    public function citymunicipality_add($vars, $httpmethod) {
        Utils::login_required();

        if ($httpmethod == 'POST') {
            $table = 'citymun';
            $data = array(
                "cmdesc"=> $_POST['cmdesc'],
                "latitude"=> floatval($_POST['latitude']),
                "longitude"=> floatval($_POST['longitude']),
                "cmclass"=> $_POST['cmclass'],
                "remarks"=> $_POST['remarks']
            );

            sleep(1);

            $resultset = CityMunicipality::addCityMunicipality($table, $data);
        } else {
            require_once $_SERVER['DOCUMENT_ROOT'] . '/views/citymunicipality_add.php';
        }
    }

    public function citymunicipality_listing($vars, $httpmethod) {
        Utils::login_required();

        $cms = CityMunicipality::getCityMunicipalities('citymun');
        require_once $_SERVER['DOCUMENT_ROOT'] . '/views/citymunicipality_listing.php';
    }

    public function citymunicipality_edit($vars, $httpmethod) {
        Utils::login_required();
        
        if ($httpmethod == 'POST') {
            $data = array(
                'id' => $vars['id'],
                "cmdesc"=> $_POST['cmdesc'],
                "latitude"=> floatval($_POST['latitude']),
                "longitude"=> floatval($_POST['longitude']),
                "cmclass"=> $_POST['cmclass'],
                "remarks"=> $_POST['remarks']
            );

            sleep(1);

            $result = CityMunicipality::updateCityMunicipality('citymun', $data);
        } else {
            $id = $vars['id'];
            $cm = CityMunicipality::getCityMunicipalities('citymun', $id);
            require_once $_SERVER['DOCUMENT_ROOT'] . '/views/citymunicipality_edit.php';
        }
    }

    public function citymunicipality_delete($vars, $httpmethod) {
        Utils::login_required();

        $id = $vars['id'];
        $result = CityMunicipality::deleteCityMunicipality('citymun', 
            array('id' => $id,));

        header('Location: /citymunicipality/listing');
    }


// -------------------------------------------------------------------------------------

    public function barangay_add($vars, $httpmethod) {   
        Utils::login_required();

        if ($httpmethod == 'POST') {
            $table = 'barangay';
            $data = array(
                "bname"=> $_POST['bname'],
                "latitude"=> floatval($_POST['latitude']),
                "longitude"=> floatval($_POST['longitude']),
                "idcm"=> $_POST['idcm'],
                "remarks" => $_POST['remarks'],
                "estpop" => $_POST['estpop'],
                "blevel" => $_POST['blevel']
            );

            sleep(1);

            $resultset = Barangay::addBarangay($table, $data);        
            
        } else {
            $cityMunicipalities = CityMunicipality::getCityMunicipalities('citymun');

            require_once $_SERVER['DOCUMENT_ROOT'] . '/views/barangay_add.php';
        }
    }

    public function barangay_listing($vars, $httpmethod) {
        Utils::login_required();

        $brngys = Barangay::getBarangays('barangay');
        $cms = CityMunicipality::getCityMunicipalities('citymun');
        $cities = [];
        foreach ($cms as $row) {
            $cities[$row['id']] = $row['cmdesc'];
        }
        require_once $_SERVER['DOCUMENT_ROOT'] . '/views/barangay_listing.php';
    }

    public function barangay_edit($vars, $httpmethod) {
        Utils::login_required();

        if ($httpmethod == 'POST') {
            $data = array(
                'id' => $vars['id'],
                "bname"=> $_POST['bname'],
                "latitude"=> floatval($_POST['latitude']),
                "longitude"=> floatval($_POST['longitude']),
                "idcm"=> $_POST['idcm'],
                "remarks" => $_POST['remarks'],
                "estpop" => $_POST['estpop'],
                "blevel" => $_POST['blevel']
            );

            sleep(1);

            $result = Barangay::updateBarangay('barangay', $data);
            header('Content-Type: application/json');
            $temp = ['1', '2', '3'];
            echo json_encode($temp);
        } else {
            $id = $vars['id'];
            $cityMunicipalities = CityMunicipality::getCityMunicipalities('citymun');
            $brngy = Barangay::getBarangays('barangay', $id);
            require_once $_SERVER['DOCUMENT_ROOT'] . '/views/barangay_edit.php';
        }
    }

    public function barangay_delete($vars, $httpmethod) {
        Utils::login_required();

        $id = $vars['id'];
        $result = Barangay::deleteBarangay('barangay', 
            array('id' => $id,));

        header('Location: /barangay/listing');
    }
}
