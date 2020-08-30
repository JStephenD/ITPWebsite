<?php

namespace controllers;
use models\CityMunicipality, models\Barangay;

class CovidTrace
{
    public function citymunicipality($vars, $httpmethod)
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
            header('/citymunicipality');
        }
        
        require_once $_SERVER['DOCUMENT_ROOT'] . '\\views\\citymunicipality.php';
    }
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
            header('/barangay');
        }
        $cityMunicipalities = CityMunicipality::getAllCityMunicipalities('citymun');

        require_once 'views/barangay.php';
    }
}
