<?php

namespace models;
use PDO;

class CityMunicipality {
    public static function addCityMunicipality($table, $data) {
        $stmt = Connection::connect()->prepare(
            "INSERT INTO $table(cmdesc, latitude, longitude, cmclass, remarks)
            VALUES (:cmdesc, :latitude, :longitude, :cmclass, :remarks)"
        );

        $stmt->bindParam(":cmdesc", $data['cmdesc'], PDO::PARAM_STR);
        $stmt->bindParam(":latitude", $data['latitude'], PDO::PARAM_STR);
        $stmt->bindParam(":longitude", $data['longitude'], PDO::PARAM_STR);
        $stmt->bindParam(":cmclass", $data['cmclass'], PDO::PARAM_STR);
        $stmt->bindParam(":remarks", $data['remarks'], PDO::PARAM_STR);

        if ($stmt->execute()) {
            return 'ok';
        } else {
            return 'error';
        }
        // $stmt->close();
        $stmt = null;
    }
    public static function getAllCityMunicipalities($table) {
        $resultset = Connection::connect()->query(
            "SELECT * FROM $table"
        );

        if (isset($resultset)) {
            return $resultset;
        }
    }
}

?>