<?php

namespace controllers;
use models\CityMunicipality, models\Barangay;


class CovidTrace
{
    public function citymunicipality_add($vars, $httpmethod)
    {
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
            header('Location: /citymunicipality');
        }
        
        require_once $_SERVER['DOCUMENT_ROOT'] . '/views/citymunicipality_add.php';
    }

    public function citymunicipality_listing($vars, $httpmethod) {
        $cms = CityMunicipality::getCityMunicipalities('citymun');
        require_once $_SERVER['DOCUMENT_ROOT'] . '/views/citymunicipality_listing.php';
    }

    public function citymunicipality_edit($vars, $httpmethod) {
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
            var_dump("what");
            header('Location: /citymunicipality/listing');
        }

        $id = $vars['id'];
        $cm = CityMunicipality::getCityMunicipalities('citymun', $id);
        require_once $_SERVER['DOCUMENT_ROOT'] . '/views/citymunicipality_edit.php';
    }

    public function citymunicipality_delete($vars, $httpmethod) {
        $id = $vars['id'];
        $result = CityMunicipality::deleteCityMunicipality('citymun', 
            array('id' => $id,));

        header('Location: /citymunicipality/listing');
    }


// -------------------------------------------------------------------------------------

    public function barangay($vars, $httpmethod)
    {   
        if ($httpmethod == 'POST') {
            if (isset($_POST['save'])) {
                $table = 'barangay';
                $data = array(
                    "bname"=> $_POST['bname'],
                    "latitude"=> $_POST['latitude'],
                    "longitude"=> $_POST['longitude'],
                    "idcm"=> $_POST['idcm'],
                    "remarks"=> $_POST['remarks']
                );

                $resultset = Barangay::addBarangay($table, $data);
                if ($resultset == 'ok') {
                    
                }
            }            
            header('Location: /barangay');
        }
        $cityMunicipalities = CityMunicipality::getCityMunicipalities('citymun');

        require_once $_SERVER['DOCUMENT_ROOT'] . '/views/barangay.php';
    }

    public function barangay_listing($vars, $httpmethod) {
        $brngys = Barangay::getBarangays('barangay');
        require_once $_SERVER['DOCUMENT_ROOT'] . '/views/barangay_listing.php';
    }

    public function barangay_edit($vars, $httpmethod) {
        if ($httpmethod == 'POST') {
            if (isset($_POST['update'])) {
                $data = array(
                    'id' => $vars['id'],
                    "bname"=> $_POST['bname'],
                    "latitude"=> floatval($_POST['latitude']),
                    "longitude"=> floatval($_POST['longitude']),
                    "idcm"=> $_POST['idcm'],
                    "remarks"=> $_POST['remarks']
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
        $id = $vars['id'];
        $result = Barangay::deleteBarangay('barangay', 
            array('id' => $id,));

        header('Location: /barangay/listing');
    }
}
