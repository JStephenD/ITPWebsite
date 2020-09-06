<?php

namespace models;
use PDO;

class CityMunicipality {
    public static function addCityMunicipality($table, $data) {
        $query = Connection::connect()->prepare(
            "INSERT INTO $table(cmdesc, latitude, longitude, cmclass, remarks)
            VALUES (:cmdesc, :latitude, :longitude, :cmclass, :remarks)"
        );
        $query->execute($data);
        $query = null;
    }

    public static function getCityMunicipalities($table, $id=null) {
        if (isset($id)) {
            $query = Connection::connect()->prepare(
                "SELECT * FROM $table WHERE id = :id"
            );
            $query->bindParam(':id', $id, PDO::PARAM_STR);
            $query->execute();
            return $query->fetch();
            $query = null;
        } else {
            $query = Connection::connect()->query(
                "SELECT * FROM $table"
            );
            return $query->fetchAll();
        }
    }

    public static function updateCityMunicipality($table, $data) {
        $query = Connection::connect()->prepare(
            "UPDATE $table SET 
                cmdesc = :cmdesc,  
                latitude = :latitude,
                longitude = :longitude,
                cmclass = :cmclass,
                remarks = :remarks
            WHERE id = :id"
        );
        $query->execute($data);
    }

    public static function deleteCityMunicipality($table, $data) {
        $query = Connection::connect()->prepare(
            "DELETE FROM $table WHERE id = :id"
        );
        $query->execute($data);
    }
}

?>