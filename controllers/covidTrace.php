<?php

class CovidTrace extends Controller {
    function __construct($db) {
        $this->db = $db;
        $this->citymun = new CityMunicipality($this->db);
        $this->brgy = new Barangay($this->db);
        $this->utils = new Utils();
    }

    function citymunicipality_add($vars, $httpmethod) {
        $this->utils->login_required();

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

            $resultset = $this->citymun->addCityMunicipality($table, $data);
        } else {
            require_once $_SERVER['DOCUMENT_ROOT'] . '/views/citymunicipality/citymunicipality_add.php';
        }
    }

    function citymunicipality_listing($vars, $httpmethod) {
        $this->utils->login_required();

        $cms = $this->citymun->getCityMunicipalities('citymun');
        require_once $_SERVER['DOCUMENT_ROOT'] . '/views/citymunicipality/citymunicipality_listing.php';
    }

    function citymunicipality_edit($vars, $httpmethod) {
        $this->utils->login_required();
        
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

            $result = $this->citymun->updateCityMunicipality('citymun', $data);
            header('Content-Type: application/json');
            echo json_encode('');
        } else {
            $id = $vars['id'];
            $cm = $this->citymun->getCityMunicipalities('citymun', $id);
            require_once $_SERVER['DOCUMENT_ROOT'] . '/views/citymunicipality/citymunicipality_edit.php';
        }
    }

    function citymunicipality_delete($vars, $httpmethod) {
        $this->utils->login_required();

        $id = $vars['id'];
        $result = $this->citymun->deleteCityMunicipality('citymun', 
            array('id' => $id,));

        header('Location: /citymunicipality/listing');
    }


// -------------------------------------------------------------------------------------

    function barangay_add($vars, $httpmethod) {
        $this->utils->login_required();

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

            $resultset = $this->brgy->addBarangay($table, $data);
            header('Content-Type: application/json');
            echo json_encode('');
        } else {
            $cityMunicipalities = $this->citymun->getCityMunicipalities('citymun');

            require_once $_SERVER['DOCUMENT_ROOT'] . '/views/barangay/barangay_add.php';
        }
    }

    function barangay_listing($vars, $httpmethod) {
        $this->utils->login_required();

        $brngys = $this->brgy->getBarangays('barangay');
        $cms = $this->citymun->getCityMunicipalities('citymun');
        $cities = [];
        foreach ($cms as $row) {
            $cities[$row['id']] = $row['cmdesc'];
        }
        require_once $_SERVER['DOCUMENT_ROOT'] . '/views/barangay/barangay_listing.php';
    }

    function barangay_edit($vars, $httpmethod) {
        $this->utils->login_required();

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

            $result = $this->brgy->updateBarangay('barangay', $data);
            header('Content-Type: application/json');
            echo json_encode('');
        } else {
            $id = $vars['id'];
            $cityMunicipalities = $this->citymun->getCityMunicipalities('citymun');
            $brngy = $this->brgy->getBarangays('barangay', $id);
            require_once $_SERVER['DOCUMENT_ROOT'] . '/views/barangay/barangay_edit.php';
        }
    }

    function barangay_delete($vars, $httpmethod) {
        $this->utils->login_required();

        $id = $vars['id'];
        $result = $this->brgy->deleteBarangay('barangay', 
            array('id' => $id,));

        header('Location: /barangay/listing');
    }
}
