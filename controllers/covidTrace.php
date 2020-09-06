<?php

namespace controllers;
use models\CityMunicipality, models\Barangay;
use classes\Utils;

class CovidTrace {
    public function citymunicipality_add($vars, $httpmethod) {
        Utils::login_required();

        if ($httpmethod == 'POST') {
            if (isset($_POST['save'])) {
                $table = 'citymun';
                $data = array(
                    "cmdesc"=> $_POST['cmdesc'],
                    "latitude"=> floatval($_POST['latitude']),
                    "longitude"=> floatval($_POST['longitude']),
                    "cmclass"=> $_POST['cmclass'],
                    "remarks"=> $_POST['remarks']
                );

                $resultset = CityMunicipality::addCityMunicipality($table, $data);
                if ($resultset == 'ok') {
                    echo '' ?>
                    <script>
                        swal({
                            type: "success",
                            title: "City/Municipality has been successfully added!",
                            showConfirmButton: true,
                            confirmButtonText: "Ok",
                        }).then((result) => {
                            if (result.value) {
                                window.location = "citymunicipality"
                            }
                        });
                    </script>
                    <?php
                }

            }
            header('Location: /citymunicipality/listing');
        }
        
        require_once $_SERVER['DOCUMENT_ROOT'] . '/views/citymunicipality_add.php';
    }

    public function citymunicipality_listing($vars, $httpmethod) {
        Utils::login_required();

        $cms = CityMunicipality::getCityMunicipalities('citymun');
        require_once $_SERVER['DOCUMENT_ROOT'] . '/views/citymunicipality_listing.php';
    }

    public function citymunicipality_edit($vars, $httpmethod) {
        Utils::login_required();
        
        if ($httpmethod == 'POST') {
            if (isset($_POST['update'])) {
                $data = array(
                    'id' => $vars['id'],
                    "cmdesc"=> $_POST['cmdesc'],
                    "latitude"=> floatval($_POST['latitude']),
                    "longitude"=> floatval($_POST['longitude']),
                    "cmclass"=> $_POST['cmclass'],
                    "remarks"=> $_POST['remarks']
                );

                $result = CityMunicipality::updateCityMunicipality('citymun', $data);
            }
            header('Location: /citymunicipality/listing');
        }

        $id = $vars['id'];
        $cm = CityMunicipality::getCityMunicipalities('citymun', $id);
        require_once $_SERVER['DOCUMENT_ROOT'] . '/views/citymunicipality_edit.php';
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
            if (isset($_POST['save'])) {
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

                $resultset = Barangay::addBarangay($table, $data);
                if ($resultset == 'ok') {
                    
                }
            }            
            header('Location: /barangay/listing');
        }
        $cityMunicipalities = CityMunicipality::getCityMunicipalities('citymun');

        require_once $_SERVER['DOCUMENT_ROOT'] . '/views/barangay_add.php';
    }

    public function barangay_listing($vars, $httpmethod) {
        Utils::login_required();

        $brngys = Barangay::getBarangays('barangay');
        require_once $_SERVER['DOCUMENT_ROOT'] . '/views/barangay_listing.php';
    }

    public function barangay_edit($vars, $httpmethod) {
        Utils::login_required();

        if ($httpmethod == 'POST') {
            if (isset($_POST['update'])) {
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

                $result = Barangay::updateBarangay('barangay', $data);
            }

            header('Location: /barangay/listing');
        }

        $id = $vars['id'];
        $cityMunicipalities = CityMunicipality::getCityMunicipalities('citymun');
        $brngy = Barangay::getBarangays('barangay', $id);
        require_once $_SERVER['DOCUMENT_ROOT'] . '/views/barangay_edit.php';
    }

    public function barangay_delete($vars, $httpmethod) {
        Utils::login_required();

        $id = $vars['id'];
        $result = Barangay::deleteBarangay('barangay', 
            array('id' => $id,));

        header('Location: /barangay/listing');
    }
}
